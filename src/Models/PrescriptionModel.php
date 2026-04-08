<?php
class PrescriptionModel
{
    private $col;

    public function __construct($db)
    {
        $this->col = $db->selectCollection('prescriptions');
    }

    /**
     * Lấy danh sách đơn thuốc với bộ lọc.
     * Pharmacist chỉ thấy các trạng thái: pending (chờ phát), dispensing, done.
     */
    public function getPrescriptions($filter = [])
    {
        $query = [];

        // Nếu không có filter status → hiện tất cả trừ cancelled
        if (!empty($filter['status'])) {
            $query['status'] = $filter['status'];
        } else {
            $query['status'] = ['$in' => ['pending', 'dispensing', 'done']];
        }

        if (!empty($filter['q'])) {
            $regex        = new MongoDB\BSON\Regex(preg_quote($filter['q'], '/'), 'i');
            $query['$or'] = [
                ['patient_name' => $regex],
                ['patient_code' => $regex],
                ['code'         => $regex],
                ['doctor_name'  => $regex],
            ];
        }

        if (!empty($filter['date'])) {
            $start = new MongoDB\BSON\UTCDateTime(strtotime($filter['date']) * 1000);
            $end   = new MongoDB\BSON\UTCDateTime((strtotime($filter['date']) + 86400) * 1000);
            $query['created_at'] = ['$gte' => $start, '$lt' => $end];
        }

        return $this->formatList(
            $this->col->find($query, ['sort' => ['created_at' => -1]])->toArray()
        );
    }

    /** Đếm đơn thuốc theo trạng thái */
    public function getCountByStatus()
    {
        $counts = ['all' => 0, 'pending' => 0, 'dispensing' => 0, 'done' => 0];
        foreach (['pending', 'dispensing', 'done'] as $s) {
            $c = (int)$this->col->countDocuments(['status' => $s]);
            $counts[$s]   = $c;
            $counts['all'] += $c;
        }
        return $counts;
    }

    /**
     * Lấy chi tiết đơn thuốc, tùy chọn enrich stock từ collection drugs.
     *
     * @param string    $id
     * @param MongoDB\Collection|null $drugCol  — collection 'drugs' để lấy tồn kho
     */
    public function getPrescriptionById($id, $drugCol = null)
    {
        try {
            $doc = $this->col->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            if (!$doc) return null;

            $arr = $this->formatDoc($doc);

            // Enrich tồn kho cho từng thuốc
            if ($drugCol !== null && !empty($arr['drugs'])) {
                foreach ($arr['drugs'] as &$drug) {
                    if (empty($drug['drug_id'])) continue;
                    try {
                        $drugDoc = $drugCol->findOne(['_id' => new MongoDB\BSON\ObjectId($drug['drug_id'])]);
                        if ($drugDoc) {
                            $drug['stock_qty']        = (int)($drugDoc['stock_qty']        ?? 0);
                            $drug['active_ingredient'] = $drugDoc['active_ingredient']      ?? ($drug['active_ingredient'] ?? '');
                            $drug['concentration']     = $drugDoc['concentration']          ?? ($drug['concentration']     ?? '');
                        }
                    } catch (Exception $e) {
                        // drug_id không hợp lệ, bỏ qua
                    }
                }
                unset($drug);
            }

            return $arr;
        } catch (Exception $e) {
            return null;
        }
    }

    /** Cập nhật trạng thái đơn thuốc */
    public function updateStatus($id, $status, $extra = [])
    {
        try {
            return $this->col->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => array_merge(['status' => $status], $extra)]
            );
        } catch (Exception $e) {
            return false;
        }
    }

    /** Thống kê cho dashboard dược sĩ */
    public function getDashboardStats()
    {
        $todayStart = new MongoDB\BSON\UTCDateTime(strtotime('today') * 1000);
        $todayEnd   = new MongoDB\BSON\UTCDateTime(strtotime('tomorrow') * 1000);
        return [
            'new_rx'          => (int)$this->col->countDocuments(['status' => 'pending']),
            'dispensed_today' => (int)$this->col->countDocuments([
                'status'       => 'done',
                'dispensed_at' => ['$gte' => $todayStart, '$lt' => $todayEnd],
            ]),
        ];
    }

    /** Lấy đơn thuốc mới nhất (pending + dispensing) cho dashboard */
    public function getNewPrescriptions($limit = 10)
    {
        return $this->formatList(
            $this->col->find(
                ['status' => ['$in' => ['pending', 'dispensing']]],
                ['sort' => ['created_at' => -1], 'limit' => $limit]
            )->toArray()
        );
    }

    /** Thống kê báo cáo nhà thuốc */
    public function getReportStats($dateFrom = null, $dateTo = null)
    {
        $query = ['status' => 'done'];
        if ($dateFrom) $query['dispensed_at']['$gte'] = new MongoDB\BSON\UTCDateTime(strtotime($dateFrom) * 1000);
        if ($dateTo)   $query['dispensed_at']['$lt']  = new MongoDB\BSON\UTCDateTime((strtotime($dateTo) + 86400) * 1000);

        $docs           = $this->col->find($query)->toArray();
        $totalDispensed = count($docs);
        $totalQtyOut    = 0;
        $drugMap        = [];

        foreach ($docs as $rx) {
            foreach ($rx['drugs'] ?? [] as $drug) {
                $qty         = (int)($drug['qty'] ?? 0);
                $totalQtyOut += $qty;
                $key         = (string)($drug['drug_id'] ?? $drug['name'] ?? '');
                if (!isset($drugMap[$key])) {
                    $drugMap[$key] = [
                        'name'               => $drug['name']          ?? '?',
                        'category_name'      => $drug['category_name'] ?? '—',
                        'unit'               => $drug['unit']          ?? '',
                        'total_qty'          => 0,
                        'prescription_count' => 0,
                    ];
                }
                $drugMap[$key]['total_qty']          += $qty;
                $drugMap[$key]['prescription_count'] += 1;
            }
        }

        usort($drugMap, fn($a, $b) => $b['total_qty'] - $a['total_qty']);

        return [
            'stats'     => ['total_dispensed' => $totalDispensed, 'total_qty_out' => $totalQtyOut],
            'top_drugs' => array_slice(array_values($drugMap), 0, 10),
        ];
    }

    // ─── Private helpers ──────────────────────────────────────────────────────

    private function formatDoc($doc)
    {
        if (!$doc) return null;
        $tz  = new DateTimeZone('Asia/Ho_Chi_Minh');
        $arr = (array)$doc;
        $arr['_id'] = (string)$doc['_id'];

        foreach (['created_at', 'dispensed_at'] as $f) {
            if (isset($doc[$f]) && $doc[$f] instanceof MongoDB\BSON\UTCDateTime) {
                $arr[$f] = $doc[$f]->toDateTime()->setTimezone($tz)->getTimestamp();
            }
        }

        // Chuyển drugs thành mảng PHP thuần
        if (isset($doc['drugs'])) {
            $drugs = [];
            foreach ($doc['drugs'] as $d) {
                $di = (array)$d;
                if (isset($d['drug_id'])) $di['drug_id'] = (string)$d['drug_id'];
                if (isset($d['qty']))     $di['qty']     = (int)$d['qty'];
                $drugs[] = $di;
            }
            $arr['drugs'] = $drugs;
        }

        // Fallback drug_count nếu không có trong document
        $arr['drug_count'] = (int)($doc['drug_count'] ?? count($arr['drugs'] ?? []));

        return $arr;
    }

    private function formatList($docs)
    {
        return array_map([$this, 'formatDoc'], $docs);
    }
}

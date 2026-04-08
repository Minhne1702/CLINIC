<?php
class BillModel
{
    private $col;

    public function __construct($db)
    {
        $this->col = $db->selectCollection('bills');
    }

    /** Lấy danh sách hóa đơn chờ thanh toán */
    public function getPendingBills($limit = 0)
    {
        $opts = ['sort' => ['created_at' => 1]];
        if ($limit > 0) $opts['limit'] = $limit;
        return $this->formatList($this->col->find(['status' => 'pending'], $opts)->toArray());
    }

    /** Đếm số hóa đơn chờ thanh toán */
    public function countPending()
    {
        return (int)$this->col->countDocuments(['status' => 'pending']);
    }

    /** Lấy hóa đơn theo ID */
    public function getBillById($id)
    {
        try {
            $doc = $this->col->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            return $doc ? $this->formatDoc($doc) : null;
        } catch (Exception $e) {
            return null;
        }
    }

    /** Tìm kiếm hóa đơn chờ thanh toán theo tên/mã BN/bác sĩ */
    public function searchPendingBills($q)
    {
        $regex  = new MongoDB\BSON\Regex(preg_quote($q, '/'), 'i');
        $cursor = $this->col->find([
            'status' => 'pending',
            '$or'    => [
                ['patient_name' => $regex],
                ['patient_code' => $regex],
                ['doctor_name'  => $regex],
            ],
        ], ['sort' => ['created_at' => 1]]);
        return $this->formatList($cursor->toArray());
    }

    /** Cập nhật trạng thái thanh toán */
    public function markPaid($billId, $paymentData)
    {
        try {
            return $this->col->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($billId)],
                ['$set' => array_merge(
                    ['status' => 'paid', 'paid_at' => new MongoDB\BSON\UTCDateTime()],
                    $paymentData
                )]
            );
        } catch (Exception $e) {
            return false;
        }
    }

    /** Thống kê doanh thu hôm nay */
    public function getTodayStats()
    {
        $start   = new MongoDB\BSON\UTCDateTime(strtotime('today') * 1000);
        $end     = new MongoDB\BSON\UTCDateTime(strtotime('tomorrow') * 1000);
        $pending = (int)$this->col->countDocuments(['status' => 'pending']);

        $paidToday = $this->col->find([
            'status'  => 'paid',
            'paid_at' => ['$gte' => $start, '$lt' => $end],
        ])->toArray();

        $paidCount = count($paidToday);
        $total = $cash = $transfer = $qr = $insurance = 0;

        foreach ($paidToday as $b) {
            $amt  = (int)($b['total_amount'] ?? 0);
            $total += $amt;
            switch ($b['payment_method'] ?? '') {
                case 'cash':      $cash      += $amt; break;
                case 'transfer':  $transfer  += $amt; break;
                case 'qr':        $qr        += $amt; break;
                case 'insurance': $insurance += $amt; break;
            }
        }

        $fmt = fn($v) => number_format($v, 0, ',', '.') . 'đ';
        return [
            'today_revenue'   => $fmt($total),
            'pending_count'   => $pending,
            'paid_today'      => $paidCount,
            'advance_today'   => '0đ',
            'cash_today'      => $fmt($cash),
            'transfer_today'  => $fmt($transfer),
            'qr_today'        => $fmt($qr),
            'insurance_today' => $fmt($insurance),
        ];
    }

    /** Lịch sử thanh toán với bộ lọc */
    public function getHistory($filters = [])
    {
        $query = ['status' => 'paid'];

        if (!empty($filters['q'])) {
            $regex        = new MongoDB\BSON\Regex(preg_quote($filters['q'], '/'), 'i');
            $query['$or'] = [
                ['patient_name' => $regex],
                ['patient_code' => $regex],
                ['invoice_code' => $regex],
            ];
        }
        if (!empty($filters['method'])) {
            $query['payment_method'] = $filters['method'];
        }
        if (!empty($filters['date_from'])) {
            $query['paid_at']['$gte'] = new MongoDB\BSON\UTCDateTime(strtotime($filters['date_from']) * 1000);
        }
        if (!empty($filters['date_to'])) {
            $query['paid_at']['$lt'] = new MongoDB\BSON\UTCDateTime((strtotime($filters['date_to']) + 86400) * 1000);
        }

        return $this->formatList($this->col->find($query, ['sort' => ['paid_at' => -1]])->toArray());
    }

    /** Thống kê doanh thu theo khoảng thời gian */
    public function getRevenueStats($dateFrom = null, $dateTo = null)
    {
        $query = ['status' => 'paid'];
        if ($dateFrom) $query['paid_at']['$gte'] = new MongoDB\BSON\UTCDateTime(strtotime($dateFrom) * 1000);
        if ($dateTo)   $query['paid_at']['$lt']  = new MongoDB\BSON\UTCDateTime((strtotime($dateTo) + 86400) * 1000);

        $docs  = $this->col->find($query)->toArray();
        $total = $cash = $transfer = $qr = 0;
        foreach ($docs as $b) {
            $amt  = (int)($b['total_amount'] ?? 0);
            $total += $amt;
            switch ($b['payment_method'] ?? '') {
                case 'cash':     $cash     += $amt; break;
                case 'transfer': $transfer += $amt; break;
                case 'qr':       $qr       += $amt; break;
            }
        }
        $fmt = fn($v) => number_format($v, 0, ',', '.') . 'đ';
        return [
            'total_revenue'  => $fmt($total),
            'total_invoices' => count($docs),
            'cash_total'     => $fmt($cash),
            'transfer_total' => $fmt($transfer),
            'qr_total'       => $fmt($qr),
        ];
    }

    // ─── Private helpers ──────────────────────────────────────────────────────

    private function formatDoc($doc)
    {
        if (!$doc) return null;
        $tz  = new DateTimeZone('Asia/Ho_Chi_Minh');
        $arr = (array)$doc;
        $arr['_id'] = (string)$doc['_id'];

        foreach (['created_at', 'paid_at'] as $f) {
            if (isset($doc[$f]) && $doc[$f] instanceof MongoDB\BSON\UTCDateTime) {
                $arr[$f] = $doc[$f]->toDateTime()->setTimezone($tz)->getTimestamp();
            }
        }

        if (isset($doc['prescription_id'])) {
            $arr['prescription_id'] = (string)$doc['prescription_id'];
        }

        // Tính thời gian chờ cho hóa đơn pending
        if (isset($arr['created_at']) && ($doc['status'] ?? '') === 'pending') {
            $mins = max(0, (int)((time() - $arr['created_at']) / 60));
            $arr['wait_time'] = $mins < 60 ? "{$mins} phút" : round($mins / 60, 1) . " giờ";
        }

        // Đảm bảo các trường số là int
        foreach (['subtotal', 'bhyt_amount', 'discount', 'total_amount', 'service_fee', 'drug_fee', 'amount_received'] as $f) {
            if (isset($doc[$f])) $arr[$f] = (int)$doc[$f];
        }

        // Chuyển items thành array PHP thuần
        if (isset($doc['items'])) {
            $items = [];
            foreach ($doc['items'] as $item) {
                $i = (array)$item;
                foreach (['qty', 'unit_price', 'total'] as $nf) {
                    if (isset($i[$nf])) $i[$nf] = (int)$i[$nf];
                }
                $items[] = $i;
            }
            $arr['items'] = $items;
        }

        return $arr;
    }

    private function formatList($docs)
    {
        return array_map([$this, 'formatDoc'], $docs);
    }
}

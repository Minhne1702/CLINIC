<?php
class DrugModel
{
    private $col;    // drugs
    private $catCol; // drug_categories
    private $mvCol;  // stock_movements

    public function __construct($db)
    {
        $this->col    = $db->selectCollection('drugs');
        $this->catCol = $db->selectCollection('drug_categories');
        $this->mvCol  = $db->selectCollection('stock_movements');
    }

    /** Lấy danh sách thuốc với bộ lọc */
    public function getAllDrugs($filter = [])
    {
        $query = [];

        if (!empty($filter['q'])) {
            $regex        = new MongoDB\BSON\Regex(preg_quote($filter['q'], '/'), 'i');
            $query['$or'] = [
                ['name'             => $regex],
                ['active_ingredient'=> $regex],
            ];
        }
        if (!empty($filter['category'])) {
            $query['category_id'] = $filter['category'];
        }

        $docs = $this->col->find($query, ['sort' => ['name' => 1]])->toArray();

        // Lọc theo trạng thái tồn kho sau khi lấy data
        if (!empty($filter['stock_status'])) {
            $now30 = time() + 30 * 86400;
            $docs  = array_filter($docs, function ($d) use ($filter, $now30) {
                $stock = (int)($d['stock_qty'] ?? 0);
                $min   = (int)($d['min_qty']   ?? 0);
                $exp   = isset($d['expiry_date']) && $d['expiry_date'] instanceof MongoDB\BSON\UTCDateTime
                         ? (int)($d['expiry_date']->toDateTime()->getTimestamp())
                         : 0;
                switch ($filter['stock_status']) {
                    case 'out':      return $stock <= 0;
                    case 'low':      return $stock > 0 && $stock <= $min;
                    case 'expiring': return $exp > 0 && $exp <= $now30;
                    case 'ok':       return $stock > $min;
                    default:         return true;
                }
            });
        }

        return $this->formatList(array_values($docs));
    }

    /** Lấy danh mục thuốc */
    public function getCategories()
    {
        return $this->formatCategoryList(
            $this->catCol->find([], ['sort' => ['name' => 1]])->toArray()
        );
    }

    /** Thuốc tồn kho dưới mức tối thiểu */
    public function getLowStock()
    {
        // MongoDB $expr để so sánh 2 field trong cùng document
        $docs = $this->col->find(
            ['$expr' => ['$lte' => ['$stock_qty', '$min_qty']]],
            ['sort'  => ['stock_qty' => 1]]
        )->toArray();
        return $this->formatList($docs);
    }

    /** Thuốc sắp hết hạn trong $days ngày */
    public function getExpiring($days = 30)
    {
        $now   = new MongoDB\BSON\UTCDateTime(time() * 1000);
        $limit = new MongoDB\BSON\UTCDateTime((time() + $days * 86400) * 1000);
        $docs  = $this->col->find(
            ['expiry_date' => ['$gte' => $now, '$lte' => $limit]],
            ['sort'        => ['expiry_date' => 1]]
        )->toArray();

        $result = $this->formatList($docs);
        foreach ($result as &$d) {
            if (!empty($d['expiry_date'])) {
                $d['days_left'] = max(0, (int)(($d['expiry_date'] - time()) / 86400));
            }
        }
        unset($d);
        return $result;
    }

    /** Thống kê tổng quan cho dashboard dược sĩ */
    public function getDashboardStats()
    {
        $now30    = new MongoDB\BSON\UTCDateTime((time() + 30 * 86400) * 1000);
        $now      = new MongoDB\BSON\UTCDateTime(time() * 1000);
        $lowStock = (int)$this->col->countDocuments(
            ['$expr' => ['$lte' => ['$stock_qty', '$min_qty']]]
        );
        $expiring = (int)$this->col->countDocuments(
            ['expiry_date' => ['$gte' => $now, '$lte' => $now30]]
        );
        return ['low_stock' => $lowStock, 'expiring' => $expiring];
    }

    /** Lấy tất cả thuốc (cho dropdown chọn khi nhập kho) */
    public function getAllForSelect()
    {
        $result = [];
        foreach ($this->col->find([], ['sort' => ['name' => 1]]) as $d) {
            $result[] = [
                '_id'  => (string)$d['_id'],
                'name' => $d['name'] ?? '',
                'unit' => $d['unit'] ?? '',
            ];
        }
        return $result;
    }

    /** Ghi nhận nhập kho, cập nhật số lượng thuốc */
    public function stockIn($data)
    {
        $supplier   = trim($data['supplier']    ?? '');
        $importDate = $data['import_date']       ?? date('Y-m-d');
        $note       = trim($data['note']         ?? '');
        $drugIds    = $data['drug_id']           ?? [];
        $qtys       = $data['qty']               ?? [];
        $lots       = $data['lot_number']        ?? [];
        $expiries   = $data['expiry_date']       ?? [];
        $prices     = $data['unit_price']        ?? [];

        $success = true;
        $count   = count($drugIds);

        for ($i = 0; $i < $count; $i++) {
            $drugId = trim($drugIds[$i] ?? '');
            $qty    = (int)($qtys[$i] ?? 0);
            if (!$drugId || $qty <= 0) continue;

            try {
                $oid       = new MongoDB\BSON\ObjectId($drugId);
                $updateOp  = ['$inc' => ['stock_qty' => $qty]];
                $setFields = [];

                if (!empty($lots[$i]))    $setFields['lot_number']  = $lots[$i];
                if (!empty($expiries[$i]))$setFields['expiry_date'] = new MongoDB\BSON\UTCDateTime(strtotime($expiries[$i]) * 1000);
                if (!empty($prices[$i]))  $setFields['price']       = (int)$prices[$i];
                if (!empty($setFields))   $updateOp['$set']         = $setFields;

                $this->col->updateOne(['_id' => $oid], $updateOp);

                // Ghi log xuất nhập tồn
                $this->mvCol->insertOne([
                    'drug_id'     => $oid,
                    'type'        => 'in',
                    'qty'         => $qty,
                    'supplier'    => $supplier,
                    'import_date' => $importDate,
                    'note'        => $note,
                    'created_at'  => new MongoDB\BSON\UTCDateTime(),
                ]);
            } catch (Exception $e) {
                error_log('DrugModel::stockIn error: ' . $e->getMessage());
                $success = false;
            }
        }

        return $success;
    }

    /** Trừ tồn kho khi phát thuốc */
    public function deductStock($drugId, $qty)
    {
        try {
            $oid = new MongoDB\BSON\ObjectId($drugId);
            $this->col->updateOne(
                ['_id' => $oid],
                ['$inc' => ['stock_qty' => -abs((int)$qty)]]
            );
            $this->mvCol->insertOne([
                'drug_id'    => $oid,
                'type'       => 'out',
                'qty'        => abs((int)$qty),
                'created_at' => new MongoDB\BSON\UTCDateTime(),
            ]);
            return true;
        } catch (Exception $e) {
            error_log('DrugModel::deductStock error: ' . $e->getMessage());
            return false;
        }
    }

    /** Expose collection 'drugs' để dùng trong PrescriptionModel (enrich tồn kho) */
    public function getCollection()
    {
        return $this->col;
    }

    /** Tổng số lượng tất cả thuốc còn trong kho */
    public function getTotalStockCount()
    {
        $total = 0;
        foreach ($this->col->find([], ['projection' => ['stock_qty' => 1]]) as $d) {
            $total += (int)($d['stock_qty'] ?? 0);
        }
        return $total;
    }

    /** Tổng số lượng nhập kho trong khoảng thời gian */
    public function getStockInTotal($dateFrom = null, $dateTo = null)
    {
        $query = ['type' => 'in'];
        if ($dateFrom) $query['created_at']['$gte'] = new MongoDB\BSON\UTCDateTime(strtotime($dateFrom) * 1000);
        if ($dateTo)   $query['created_at']['$lt']  = new MongoDB\BSON\UTCDateTime((strtotime($dateTo) + 86400) * 1000);
        $total = 0;
        foreach ($this->mvCol->find($query) as $m) {
            $total += (int)($m['qty'] ?? 0);
        }
        return $total;
    }

    // ─── Private helpers ──────────────────────────────────────────────────────

    private function formatDoc($doc)
    {
        if (!$doc) return null;
        $tz  = new DateTimeZone('Asia/Ho_Chi_Minh');
        $arr = (array)$doc;
        $arr['_id'] = (string)$doc['_id'];

        if (isset($doc['category_id'])) {
            $arr['category_id'] = (string)$doc['category_id'];
        }

        // expiry_date → Unix timestamp cho Smarty date_format
        if (isset($doc['expiry_date']) && $doc['expiry_date'] instanceof MongoDB\BSON\UTCDateTime) {
            $ts = $doc['expiry_date']->toDateTime()->setTimezone($tz)->getTimestamp();
            $arr['expiry_date'] = $ts;
            $arr['is_expiring'] = $ts <= (time() + 30 * 86400);
            $arr['days_left']   = max(0, (int)(($ts - time()) / 86400));
        }

        foreach (['stock_qty', 'min_qty', 'price'] as $f) {
            if (isset($doc[$f])) $arr[$f] = (int)$doc[$f];
        }

        return $arr;
    }

    private function formatList($docs)
    {
        return array_map([$this, 'formatDoc'], $docs);
    }

    private function formatCategoryList($docs)
    {
        return array_map(function ($d) {
            $arr        = (array)$d;
            $arr['_id'] = (string)$d['_id'];
            return $arr;
        }, $docs);
    }
}

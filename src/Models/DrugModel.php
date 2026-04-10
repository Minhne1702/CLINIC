<?php
class DrugModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** 1. Lấy danh sách thuốc với bộ lọc */
    public function getAllDrugs($filter = [])
    {
        $sql = "SELECT * FROM drugs WHERE 1=1";
        $params = [];

        if (!empty($filter['q'])) {
            // Đã sửa: drug_name -> name, drug_active_ingredient -> active_ingredient
            $sql .= " AND (name LIKE :q OR active_ingredient LIKE :q2)";
            $params['q'] = '%' . $filter['q'] . '%';
            $params['q2'] = '%' . $filter['q'] . '%';
        }

        if (!empty($filter['category'])) {
            // Đã sửa: drug_category_id -> category_id
            $sql .= " AND category_id = :cat";
            $params['cat'] = $filter['category'];
        }

        if (!empty($filter['stock_status'])) {
            switch ($filter['stock_status']) {
                case 'out':
                    $sql .= " AND stock_qty <= 0";
                    break;
                case 'low':
                    $sql .= " AND stock_qty > 0 AND stock_qty <= min_qty";
                    break;
                case 'expiring':
                    $sql .= " AND expiry_date <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND expiry_date >= NOW()";
                    break;
                case 'ok':
                    $sql .= " AND stock_qty > min_qty";
                    break;
            }
        }

        $sql .= " ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $this->formatList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** 2. Lấy danh mục thuốc */
    public function getCategories()
    {
        // Thêm subquery để đếm số thuốc
        $sql = "SELECT *, drug_cat_name AS name, 
                (SELECT COUNT(*) FROM drugs WHERE category_id = drug_categories.id) as drug_count 
                FROM drug_categories ORDER BY drug_cat_name ASC";
        $stmt = $this->db->query($sql);
        return $this->formatCategoryList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** 3. Thuốc tồn kho thấp */
    public function getLowStock()
    {
        $stmt = $this->db->query("SELECT * FROM drugs WHERE stock_qty <= 10 ORDER BY stock_qty ASC");
        return $this->formatList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** 5. Thống kê Dashboard (FIX LỖI FATAL ERROR) */
    public function getDashboardStats()
    {
        try {
            // Sửa lại tên cột cho khớp với seed.php
            $low = $this->db->query("SELECT COUNT(*) FROM drugs WHERE stock_qty <= 10")->fetchColumn();
            $exp = $this->db->query("SELECT COUNT(*) FROM drugs WHERE expiry_date <= DATE_ADD(NOW(), INTERVAL 30 DAY) AND expiry_date >= NOW()")->fetchColumn();
            return [
                'low_stock' => (int)$low,
                'expiring' => (int)$exp,
                'total_drugs' => (int)$this->db->query("SELECT COUNT(*) FROM drugs")->fetchColumn()
            ];
        } catch (Exception $e) {
            return ['low_stock' => 0, 'expiring' => 0, 'total_drugs' => 0];
        }
    }

    /** 6. Dropdown chọn thuốc */
    public function getAllForSelect()
    {
        $stmt = $this->db->query("SELECT id as _id, name, unit FROM drugs ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** 7. Nhập kho */
    public function stockIn($data)
    {
        $this->db->beginTransaction();
        try {
            $count = count($data['drug_id'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $drugId = $data['drug_id'][$i];
                $qty = (int)$data['qty'][$i];
                if (!$drugId || $qty <= 0) continue;

                $stmt = $this->db->prepare("UPDATE drugs SET stock_qty = stock_qty + :qty, price = :price WHERE id = :id");
                $stmt->execute([
                    'qty' => $qty,
                    'price' => $data['unit_price'][$i] ?? null,
                    'id' => $drugId
                ]);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    // ─── Helpers (Map lại để giao diện Smarty không lỗi) ───

    private function formatDoc($doc)
    {
        if (!$doc) return null;
        $doc['_id'] = (string)$doc['id'];

        // Map các cột cơ bản
        $doc['name'] = $doc['name'] ?? '';
        $doc['active_ingredient'] = $doc['active_ingredient'] ?? '-';
        $doc['unit'] = $doc['unit'] ?? 'Viên';
        $doc['stock_qty'] = (int)($doc['stock_qty'] ?? 0);

        $doc['side_effects'] = $doc['side_effects'] ?? 'Chưa có thông tin';
        $doc['contraindications'] = $doc['contraindications'] ?? 'Chưa có thông tin';

        if (!empty($doc['expiry_date'])) {
            $ts = strtotime($doc['expiry_date']);
            $doc['expiry_date_ts'] = $ts;
            $doc['days_left'] = max(0, (int)(($ts - time()) / 86400));
        } else {
            $doc['expiry_date_ts'] = null;
            $doc['days_left'] = '-';
        }

        return $doc;
    }

    private function formatList($docs)
    {
        return array_map([$this, 'formatDoc'], $docs);
    }

    private function formatCategoryList($docs)
    {
        return array_map(function ($d) {
            $d['id'] = (string)($d['id'] ?? '');
            $d['_id'] = $d['id'];

            $d['is_active'] = (isset($d['status']) && $d['status'] === 'active') ? true : false;
            $d['description'] = !empty($d['description']) ? trim(strip_tags($d['description'])) : 'Chưa có mô tả';

            $d['name'] = !empty($d['name']) ? trim($d['name']) : 'Không tên';
            $d['status'] = $d['status'] ?? 'active';
            $d['drug_count'] = (int)($d['drug_count'] ?? 0);

            return $d;
        }, $docs);
    }

    public function getExpiring($days = 30)
    {
        try {
            // Sửa tên cột cho khớp với seed.php (expiry_date)
            $stmt = $this->db->prepare("
                SELECT * FROM drugs 
                WHERE expiry_date <= DATE_ADD(NOW(), INTERVAL :days DAY) 
                AND expiry_date >= NOW() 
                ORDER BY expiry_date ASC
            ");
            $stmt->execute(['days' => $days]);
            return $this->formatList($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            error_log("Error in getExpiring: " . $e->getMessage());
            return [];
        }
    }
    
}

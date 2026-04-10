<?php
class PrescriptionModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** Lấy thống kê cho Dashboard Dược sĩ */
    public function getDashboardStats()
    {
        try {
            $today = date('Y-m-d');
            $stmt = $this->db->prepare("
                SELECT 
                    COUNT(CASE WHEN status = 'paid' THEN 1 END) as pending_dispense,
                    COUNT(CASE WHEN status = 'done' AND DATE(created_at) = ? THEN 1 END) as completed_today,
                    COUNT(CASE WHEN status = 'dispensing' THEN 1 END) as processing
                FROM prescriptions
            ");
            $stmt->execute([$today]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in getDashboardStats: " . $e->getMessage());
            return ['pending_dispense' => 0, 'completed_today' => 0, 'processing' => 0];
        }
    }

    public function getNewPrescriptions($limit = 10)
    {
        try {
            // Sửa cột: pres_status -> status
            $stmt = $this->db->prepare("SELECT * FROM prescriptions WHERE status = 'paid' ORDER BY created_at DESC LIMIT :limit");
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();

            return $this->formatList($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            error_log("Error in getNewPrescriptions: " . $e->getMessage());
            return [];
        }
    }

    /** Lấy danh sách đơn thuốc với bộ lọc */
    public function getPrescriptions($filter = [])
    {
        $sql = "SELECT * FROM prescriptions WHERE 1=1";
        $params = [];

        if (!empty($filter['status'])) {
            $sql .= " AND status = :status";
            $params['status'] = $filter['status'];
        } else {
            $sql .= " AND status IN ('pending', 'paid', 'dispensing', 'done')";
        }

        if (!empty($filter['q'])) {
            // Sửa cột: pres_patient_name -> patient_name, pres_code -> code...
            $sql .= " AND (patient_name LIKE :q OR code LIKE :q3 OR doctor_name LIKE :q4)";
            $search = '%' . $filter['q'] . '%';
            $params['q'] = $search;
            $params['q3'] = $search;
            $params['q4'] = $search;
        }

        if (!empty($filter['date'])) {
            $sql .= " AND DATE(created_at) = :date";
            $params['date'] = $filter['date'];
        }

        $sql .= " ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $this->formatList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** Lấy chi tiết đơn thuốc và kiểm tra tồn kho */
    public function getPrescriptionById($id, $drugCol = null)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM prescriptions WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $id]);
            $doc = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$doc) return null;

            $arr = $this->formatDoc($doc);

            if ($drugCol !== null && !empty($arr['drugs'])) {
                foreach ($arr['drugs'] as &$drug) {
                    if (empty($drug['drug_id'])) continue;

                    // Khớp với bảng drugs: stock_qty, name (không dùng tiền tố drug_)
                    $stmtD = $this->db->prepare("SELECT stock_qty, name FROM drugs WHERE id = ?");
                    $stmtD->execute([$drug['drug_id']]);
                    $drugInfo = $stmtD->fetch(PDO::FETCH_ASSOC);

                    if ($drugInfo) {
                        $drug['stock_qty'] = (int)$drugInfo['stock_qty'];
                        $drug['name'] = $drugInfo['name'];
                    }
                }
                unset($drug);
            }
            return $arr;
        } catch (Exception $e) {
            return null;
        }
    }

    /** Cập nhật trạng thái */
    public function updateStatus($id, $status, $extra = [])
    {
        try {
            $fields = "status = :status";
            $params = ['status' => $status, 'id' => $id];

            foreach ($extra as $key => $val) {
                $fields .= ", $key = :$key";
                $params[$key] = $val;
            }

            $stmt = $this->db->prepare("UPDATE prescriptions SET $fields WHERE id = :id");
            return $stmt->execute($params);
        } catch (Exception $e) {
            return false;
        }
    }

    // ─── Helpers ───

    private function formatDoc($doc)
    {
        if (!$doc) return null;
        $doc['_id'] = (string)$doc['id'];

        // Map status để giao diện Smarty không bị lỗi
        $doc['status'] = $doc['status'];

        foreach (['created_at', 'dispensed_at'] as $f) {
            if (!empty($doc[$f])) {
                $doc[$f] = strtotime($doc[$f]);
            }
        }

        // Sửa cột: pres_drugs_json -> drugs_json
        $doc['drugs'] = json_decode($doc['drugs_json'] ?? '[]', true);
        return $doc;
    }

    private function formatList($docs)
    {
        return array_map([$this, 'formatDoc'], $docs);
    }
    public function getCountByStatus()
    {
        try {
            $stmt = $this->db->query("
                SELECT 
                    COUNT(*) as total,
                    COUNT(CASE WHEN status = 'paid' THEN 1 END) as pending,
                    COUNT(CASE WHEN status = 'dispensing' THEN 1 END) as dispensing,
                    COUNT(CASE WHEN status = 'done' THEN 1 END) as done
                FROM prescriptions
            ");
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return [
                'all'        => $data['total'] ?? 0,
                'pending'    => $data['pending'] ?? 0,
                'dispensing' => $data['dispensing'] ?? 0,
                'done'       => $data['done'] ?? 0
            ];
        } catch (Exception $e) {
            return ['all' => 0, 'pending' => 0, 'dispensing' => 0, 'done' => 0];
        }
    }
}

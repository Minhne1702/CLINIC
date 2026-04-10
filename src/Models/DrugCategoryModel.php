<?php
class DrugCategoryModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** Lấy tất cả danh mục thuốc và đếm số lượng thuốc mỗi loại */
    public function getAll()
    {
        try {
            $sql = "SELECT *, drug_cat_name, description, status,
                    (SELECT COUNT(*) FROM drugs WHERE category_id = drug_categories.id) as drug_count 
                    FROM drug_categories 
                    ORDER BY drug_cat_name ASC";
            $stmt = $this->db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->formatList($results);
        } catch (Exception $e) {
            return [];
        }
    }

    /** Helper format dữ liệu để xóa sạch Warning trên giao diện */
    private function formatList($docs)
    {
        return array_map(function ($d) {
            $id = (string)($d['id'] ?? '');

            // Lấy mã code (Nếu trong DB bạn chưa có cột code, tạm lấy drug_cat_name hoặc chuỗi trống)
            // Lưu ý: Nếu DB của bạn có cột 'code' thì đổi thành $d['code']
            $code = $d['drug_cat_code'] ?? ($d['code'] ?? 'N/A');

            $desc = !empty($d['description']) ? strip_tags($d['description']) : 'Chưa có mô tả';
            $desc = str_replace(["\r", "\n", "'"], [" ", " ", " "], $desc);

            $name = !empty($d['drug_cat_name']) ? trim($d['drug_cat_name']) : 'Không tên';
            $name = str_replace("'", " ", $name);

            return [
                'id'          => $id,
                '_id'         => $id,
                'name'        => $name,
                'code'        => $code,
                'description' => $desc,
                'is_active'   => (isset($d['status']) && $d['status'] === 'active'),
                'status'      => $d['status'] ?? 'active',
                'drug_count'  => (int)($d['drug_count'] ?? 0)
            ];
        }, $docs);
    }
}

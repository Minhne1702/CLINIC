<?php

class DiseaseCategoryModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createCategory($data)
    {
        try {
            // 1. Xử lý dữ liệu (Map đúng tên cột với tiền tố dis_cat_)
            $formattedData = [
                'dis_cat_code'        => $data['code'],
                'dis_cat_name'        => $data['name'],
                'dis_cat_description' => $data['description'] ?? null,
                'dis_cat_parent_id'   => (!empty($data['parentId'])) ? $data['parentId'] : null,
                'dis_cat_is_active'   => 1,
                'created_at'          => date('Y-m-d H:i:s')
            ];

            unset($data['_id']);

            // 2. Build câu lệnh INSERT động (Giữ nguyên logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO disease_categories (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createCategory (DiseaseCategoryModel): " . $e->getMessage());
            return false;
        }
    }

    public function getActiveCategories()
    {
        try {
            // Cập nhật tên cột theo tiền tố dis_cat_
            $sql = "SELECT * FROM disease_categories WHERE dis_cat_is_active = 1 ORDER BY created_at DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getActiveCategories: " . $e->getMessage());
            return [];
        }
    }
}

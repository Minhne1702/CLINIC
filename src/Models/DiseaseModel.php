<?php

class DiseaseModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createDisease($data)
    {
        try {
            // 1. Xử lý dữ liệu (Map đúng tên cột với tiền tố dis_ cho MySQL)
            $formattedData = [
                'dis_category_id' => (!empty($data['categoryId'])) ? $data['categoryId'] : null,
                'dis_icd_code'    => $data['icdCode'],
                'dis_name'        => $data['name'],
                'dis_symptoms'    => $data['symptoms'] ?? null,
                'dis_is_active'   => 1,
                'created_at'      => date('Y-m-d H:i:s')
            ];

            // Dọn dẹp key rác của Mongo nếu vô tình lọt vào
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

            $sql = "INSERT INTO diseases (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createDisease (DiseaseModel): " . $e->getMessage());
            return false;
        }
    }

    public function findByIcdCode($code)
    {
        try {
            // Đã cập nhật tên cột dis_icd_code và dis_is_active
            $sql = "SELECT * FROM diseases WHERE dis_icd_code = :code AND dis_is_active = 1 LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':code' => $code]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở findByIcdCode (DiseaseModel): " . $e->getMessage());
            return null;
        }
    }
}

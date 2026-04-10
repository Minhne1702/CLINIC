<?php

class DiseaseCategoryToDrugMapModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Thêm mapping giữa nhóm bệnh và nhóm thuốc
     */
    public function addMapping($diseaseCatId, $drugCatId, $priority = 1)
    {
        try {
            // Sử dụng tiền tố map_cat_ để khớp với cấu trúc bảng mới
            $sql = "INSERT INTO disease_category_to_drug_maps (map_cat_disease_id, map_cat_drug_id, map_cat_priority) 
                    VALUES (:disease_category_id, :drug_category_id, :priority)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':disease_category_id' => $diseaseCatId,
                ':drug_category_id'    => $drugCatId,
                ':priority'            => (int)$priority
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addMapping: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách nhóm thuốc theo mã nhóm bệnh, sắp xếp theo ưu tiên
     */
    public function getDrugGroupsByCategory($diseaseCatId)
    {
        try {
            // Truy vấn dựa trên map_cat_disease_id và sắp xếp theo map_cat_priority
            $sql = "SELECT * FROM disease_category_to_drug_maps 
                    WHERE map_cat_disease_id = :disease_category_id 
                    ORDER BY map_cat_priority ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':disease_category_id' => $diseaseCatId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getDrugGroupsByCategory: " . $e->getMessage());
            return [];
        }
    }
}

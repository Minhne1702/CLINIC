<?php

class DiseaseCategoryToDrugMapModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addMapping($diseaseCatId, $drugCatId, $priority = 1)
    {
        try {
            // Đã cập nhật tên cột với tiền tố map_cat_ để khớp MySQL
            $sql = "INSERT INTO disease_category_to_drug_maps (map_cat_disease_id, map_cat_drug_id, map_cat_priority) 
                    VALUES (:diseaseCategoryId, :drugCategoryId, :priority)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':diseaseCategoryId' => $diseaseCatId,
                ':drugCategoryId'    => $drugCatId,
                ':priority'         => (int)$priority
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addMapping: " . $e->getMessage());
            return false;
        }
    }

    public function getDrugGroupsByCategory($diseaseCatId)
    {
        try {
            // Truy vấn theo tiền tố map_cat_ và sắp xếp theo priority
            $sql = "SELECT * FROM disease_category_to_drug_maps 
                    WHERE map_cat_disease_id = :diseaseCategoryId 
                    ORDER BY map_cat_priority ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':diseaseCategoryId' => $diseaseCatId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getDrugGroupsByCategory: " . $e->getMessage());
            return [];
        }
    }
}

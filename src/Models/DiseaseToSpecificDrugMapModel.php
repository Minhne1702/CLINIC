<?php

class DiseaseToSpecificDrugMapModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addSpecificMapping($diseaseId, $drugId, $priority = 1)
    {
        try {
            // Cập nhật tên cột với tiền tố map_spec_
            $sql = "INSERT INTO disease_to_specific_drug_maps (map_spec_disease_id, map_spec_drug_id, map_spec_priority) 
                    VALUES (:diseaseId, :drugId, :priority)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':diseaseId' => $diseaseId,
                ':drugId'    => $drugId,
                ':priority'  => (int)$priority
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addSpecificMapping: " . $e->getMessage());
            return false;
        }
    }

    public function getSpecificDrugs($diseaseId)
    {
        try {
            // Truy vấn theo tiền tố map_spec_
            $sql = "SELECT * FROM disease_to_specific_drug_maps 
                    WHERE map_spec_disease_id = :diseaseId 
                    ORDER BY map_spec_priority ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':diseaseId' => $diseaseId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getSpecificDrugs: " . $e->getMessage());
            return [];
        }
    }
}

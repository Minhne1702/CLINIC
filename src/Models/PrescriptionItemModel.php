<?php

class PrescriptionItemModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Thêm danh sách thuốc vào đơn thuốc
     */
    public function addItems($items)
    {
        try {
            // Chuẩn bị câu lệnh SQL với tiền tố pre_item_
            $sql = "INSERT INTO prescription_items (pre_item_prescription_id, pre_item_drug_id, pre_item_quantity, pre_item_dosage, pre_item_note) 
                    VALUES (:prescriptionId, :drugId, :quantity, :dosage, :note)";

            $stmt = $this->db->prepare($sql);

            $insertedCount = 0;
            foreach ($items as $item) {
                $result = $stmt->execute([
                    ':prescriptionId' => $item['prescriptionId'],
                    ':drugId'         => $item['drugId'],
                    ':quantity'       => $item['quantity'] ?? 1,
                    ':dosage'         => $item['dosage'] ?? '', // Ví dụ: "Sáng 1, Chiều 1"
                    ':note'           => $item['note'] ?? ''
                ]);
                if ($result) $insertedCount++;
            }

            return $insertedCount; // Trả về số lượng thuốc đã thêm vào đơn thành công

        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addItems (PrescriptionItemModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách thuốc của một đơn thuốc cụ thể
     */
    public function getItemsByPrescription($prescriptionId)
    {
        try {
            // JOIN với bảng drugs (sử dụng drug_name đã chuẩn hóa ở các bảng trước)
            $sql = "SELECT pi.*, d.drug_name as drugName, d.drug_unit as drugUnit 
                    FROM prescription_items pi
                    LEFT JOIN drugs d ON pi.pre_item_drug_id = d.id
                    WHERE pi.pre_item_prescription_id = :prescriptionId";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':prescriptionId' => $prescriptionId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getItemsByPrescription: " . $e->getMessage());
            return [];
        }
    }
}

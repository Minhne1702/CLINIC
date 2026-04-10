<?php

class DispensingLogModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function logAction($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map đúng tên cột với tiền tố dislog_)
            $formattedData = [
                'dislog_prescription_item_id' => $data['prescriptionItemId'] ?? null,
                'dislog_inventory_item_id'    => $data['inventoryItemId'] ?? null,
                'dislog_dispensed_by'         => $data['dispensedBy'] ?? null,
                'dislog_quantity'             => $data['quantity'] ?? 0,
                'dislog_dispensed_at'         => date('Y-m-d H:i:s')
            ];

            // Xóa _id rác nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động (Giữ nguyên logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO dispensing_logs (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở logAction (DispensingLogModel): " . $e->getMessage());
            return false;
        }
    }
}

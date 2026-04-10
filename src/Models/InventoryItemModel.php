<?php

class InventoryItemModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Thêm một lô thuốc mới vào kho
     */
    public function addBatch($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map đúng tên cột với tiền tố inv_)
            $formattedData = [
                'inv_drug_id'     => $data['drugId'] ?? null,
                'inv_lot_number'  => $data['lotNumber'] ?? null,
                'inv_quantity'    => $data['quantity'] ?? 0,
                // Chuyển expiryDate về định dạng Y-m-d của MySQL
                'inv_expiry_date' => date('Y-m-d', strtotime($data['expiryDate'])),
                'inv_location'    => $data['location'] ?? null,
                'created_at'      => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động (Logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO inventory_items (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addBatch (InventoryItemModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy các lô thuốc còn hàng và còn hạn sử dụng để cấp phát
     */
    public function getStockForDispensing($drugId)
    {
        try {
            // Đã cập nhật tên cột sang tiền tố inv_
            // Sắp xếp: inv_expiry_date ASC để lô gần hết hạn xuất trước (FEFO)
            $sql = "SELECT * FROM inventory_items 
                    WHERE inv_drug_id = :drugId 
                      AND inv_quantity > 0 
                      AND inv_expiry_date > CURDATE() 
                    ORDER BY inv_expiry_date ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':drugId' => $drugId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getStockForDispensing: " . $e->getMessage());
            return [];
        }
    }
}

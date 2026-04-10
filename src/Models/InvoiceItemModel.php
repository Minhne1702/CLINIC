<?php

class InvoiceItemModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Thêm danh sách chi tiết hóa đơn
     */
    public function addItems($invoiceId, $items)
    {
        try {
            // Chuẩn bị câu lệnh SQL với tiền tố inv_item_
            $sql = "INSERT INTO invoice_items (inv_item_invoice_id, inv_item_name, inv_item_quantity, inv_item_unit_price, inv_item_total_price) 
                    VALUES (:invoiceId, :itemName, :quantity, :unitPrice, :totalPrice)";

            $stmt = $this->db->prepare($sql);

            $insertedCount = 0;
            foreach ($items as $item) {
                // Tính toán dựa trên dữ liệu đầu vào, map vào các cột mới
                $qty = $item['quantity'] ?? 1;
                $price = $item['unitPrice'] ?? $item['price'] ?? 0;

                $result = $stmt->execute([
                    ':invoiceId'  => $invoiceId,
                    ':itemName'   => $item['itemName'] ?? $item['name'] ?? 'Không rõ',
                    ':quantity'   => $qty,
                    ':unitPrice'  => $price,
                    ':totalPrice' => $qty * $price
                ]);
                if ($result) $insertedCount++;
            }

            return $insertedCount; // Trả về số lượng dòng đã chèn thành công

        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addItems (InvoiceItemModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy chi tiết các món hàng của một hóa đơn
     */
    public function getItemsByInvoice($invoiceId)
    {
        try {
            // Đã cập nhật tên cột inv_item_invoice_id
            $sql = "SELECT * FROM invoice_items WHERE inv_item_invoice_id = :invoiceId";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':invoiceId' => $invoiceId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getItemsByInvoice: " . $e->getMessage());
            return [];
        }
    }
}

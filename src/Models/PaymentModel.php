<?php

class PaymentModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Ghi nhận giao dịch thanh toán mới
     */
    public function recordPayment($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map sang tiền tố pay_)
            $formattedData = [
                'pay_invoice_id'      => $data['invoiceId'] ?? null,
                'pay_cashier_id'      => $data['cashierId'] ?? null,
                'pay_amount'          => $data['amount'] ?? 0,
                'pay_method'          => $data['method'] ?? 'cash',
                'pay_transaction_ref' => $data['transactionRef'] ?? null,
                'pay_note'            => $data['note'] ?? null,
                'paid_at'             => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác của Mongo nếu có
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

            $sql = "INSERT INTO payments (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            // Trả về ID giao dịch vừa tạo
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở recordPayment (PaymentModel): " . $e->getMessage());
            return false;
        }
    }
}

<?php
class InvoiceModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // 1. Hàm đếm số hóa đơn chưa thanh toán (Giải quyết lỗi dòng 32)
    public function countPending()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM invoices WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // 2. Lấy danh sách hóa đơn chờ thanh toán
    public function getPendingBills($limit = null)
    {
        $sql = "SELECT * FROM invoices WHERE status = 'pending' ORDER BY created_at DESC";
        if ($limit) $sql .= " LIMIT " . (int)$limit;

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Lấy chi tiết một hóa đơn
    public function getBillById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM invoices WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Lấy thống kê hôm nay (Dùng cho Dashboard)
    public function getTodayStats()
    {
        $today = date('Y-m-d');
        $stmt = $this->db->prepare("
            SELECT 
                SUM(CASE WHEN status = 'paid' THEN total_amount ELSE 0 END) as today_revenue,
                COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending_count,
                COUNT(CASE WHEN status = 'paid' AND DATE(updated_at) = ? THEN 1 END) as paid_today
            FROM invoices
        ");
        $stmt->execute([$today]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        // Định dạng tiền tệ đơn giản
        return [
            'today_revenue' => number_format($stats['today_revenue'] ?? 0, 0, ',', '.') . 'đ',
            'pending_count' => $stats['pending_count'] ?? 0,
            'paid_today'    => $stats['paid_today'] ?? 0,
            'cash_today'    => '0đ', // Cần query bảng payments nếu muốn chi tiết hơn
            'transfer_today' => '0đ'
        ];
    }

    // 5. Đánh dấu đã thanh toán
    public function markPaid($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE invoices 
            SET status = 'paid', 
                invoice_code = :invoice_code,
                payment_method = :payment_method,
                cashier_id = :cashier_id,
                updated_at = NOW()
            WHERE id = :id
        ");
        return $stmt->execute([
            ':invoice_code'    => $data['invoice_code'],
            ':payment_method'  => $data['payment_method'],
            ':cashier_id'      => $data['cashier_id'],
            ':id'              => $id
        ]);
    }
}

<?php
class CashierController
{
    private $smarty;
    private $invoiceModel; // Đã đổi tên
    private $paymentModel; // Đã thêm Model mới
    private $prescriptionModel;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'cashier') {
            header('Location: ' . BASE_URL . '/?page=login');
            exit;
        }

        if ($db) {
            // SỬA TẠI ĐÂY: Khởi tạo các Model mới thay vì BillModel
            $this->invoiceModel      = new InvoiceModel($db);
            $this->paymentModel      = new PaymentModel($db);
            $this->prescriptionModel = new PrescriptionModel($db);
        }

        $user = $_SESSION['user'];
        $name = $user['fullName'] ?? $user['full_name'] ?? $user['name'] ?? $user['username'] ?? 'Thu ngân';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'cashier');
        $this->smarty->assign('notification_count', 0);

        // Cập nhật đếm hóa đơn chờ thanh toán từ InvoiceModel
        $pendingCount = $this->invoiceModel ? $this->invoiceModel->countPending() : 0;
        $this->smarty->assign('pending_count', $pendingCount);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':
                $this->dashboard();
                break;
            case 'billing':
                $this->billing();
                break;
            case 'pending':
                $this->pending();
                break;
            case 'history':
                $this->history();
                break;
            case 'advance':
                $this->advance();
                break;
            case 'insurance':
                $this->insurance();
                break;
            case 'reports':
                $this->reports();
                break;
            default:
                $this->dashboard();
                break;
        }
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    private function dashboard()
    {
        // Sử dụng invoiceModel để lấy thống kê
        $stats        = $this->invoiceModel ? $this->invoiceModel->getTodayStats()    : $this->emptyStats();
        $pendingBills = $this->invoiceModel ? $this->invoiceModel->getPendingBills(10) : [];

        $this->smarty->assign('stats',         $stats);
        $this->smarty->assign('pending_bills', $pendingBills);
        $this->smarty->display('cashier/dashboard.tpl');
    }

    // ─── Thanh toán ───────────────────────────────────────────────────────────

    private function billing()
    {
        $billId        = $_GET['id'] ?? null;
        $searchQ       = $_GET['q']  ?? '';
        $searchResults = [];
        $bill          = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'pay') {
            $billId        = $_POST['bill_id']       ?? null;
            $payMethod     = $_POST['payment_method'] ?? 'cash';
            $amtReceived   = (int)($_POST['amount_received'] ?? 0);

            if ($billId && $this->invoiceModel) {
                // Lấy thông tin hóa đơn
                $bill = $this->invoiceModel->getBillById($billId);

                if ($bill) {
                    $invoiceCode = 'INV-' . strtoupper(substr(uniqid(), -6));
                    $user        = $_SESSION['user'];
                    $cashierId   = (string)($user['id'] ?? ''); // Sửa từ _id sang id cho khớp seed.php
                    $cashierName = $user['fullName'] ?? 'Thu ngân';

                    // 1. Đánh dấu hóa đơn đã thanh toán (Sử dụng invoiceModel)
                    $this->invoiceModel->markPaid($billId, [
                        'invoice_code'    => $invoiceCode,
                        'payment_method'  => $payMethod,
                        'amount_received' => $amtReceived,
                        'cashier_id'      => $cashierId,
                        'cashier_name'    => $cashierName,
                    ]);

                    // 2. CẬP NHẬT ĐƠN THUỐC thông qua prescriptionModel
                    if (!empty($bill['prescription_id']) && $this->prescriptionModel) {
                        $this->prescriptionModel->updateStatus($bill['prescription_id'], 'paid');
                    }

                    $change = $amtReceived - ($bill['total_amount'] ?? 0);
                    $msg = "Thanh toán thành công! Mã đơn: <strong>{$invoiceCode}</strong>.";
                    if ($change > 0) {
                        $msg .= " Tiền thối lại: <strong>" . number_format($change, 0, ',', '.') . "đ</strong>";
                    }

                    $this->smarty->assign('success_message', $msg);
                }
            } else {
                $this->smarty->assign('error_message', 'Không tìm thấy hóa đơn. Vui lòng thử lại.');
            }
            $billId = null;
        }

        if ($billId && $this->invoiceModel) {
            $bill = $this->invoiceModel->getBillById($billId);
        } elseif ($searchQ && $this->invoiceModel) {
            $searchResults = $this->invoiceModel->searchPendingBills($searchQ);
        }

        $this->smarty->assign('bill',           $bill);
        $this->smarty->assign('search_q',       $searchQ);
        $this->smarty->assign('search_results', $searchResults);
        $this->smarty->display('cashier/billing.tpl');
    }

    private function pending()
    {
        $pendingBills = $this->invoiceModel ? $this->invoiceModel->getPendingBills() : [];
        $this->smarty->assign('pending_bills', $pendingBills);
        $this->smarty->display('cashier/pending.tpl');
    }

    private function history()
    {
        $filter  = [
            'q'         => $_GET['q']         ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to'   => $_GET['date_to']   ?? '',
            'method'    => $_GET['method']    ?? '',
        ];
        // Lịch sử có thể lấy từ invoiceModel hoặc paymentModel tùy cách bạn thiết kế
        $history = $this->invoiceModel ? $this->invoiceModel->getHistory($filter) : [];

        $this->smarty->assign('history', $history);
        $this->smarty->assign('filter',  $filter);
        $this->smarty->display('cashier/history.tpl');
    }

    private function advance()
    {
        $this->smarty->display('cashier/advance.tpl');
    }

    private function insurance()
    {
        $filter       = ['q' => $_GET['q'] ?? ''];
        $pendingBills = [];

        if ($this->invoiceModel) {
            $pendingBills = $this->invoiceModel->getPendingBills();
            $pendingBills = array_filter($pendingBills, fn($b) => !empty($b['bhyt_code']));
            $pendingBills = array_values($pendingBills);
        }

        $this->smarty->assign('pending_bills',   $pendingBills);
        $this->smarty->assign('filter',          $filter);
        $this->smarty->display('cashier/insurance.tpl');
    }

    private function reports()
    {
        $dateFrom = $_GET['date_from'] ?? date('Y-m-d', strtotime("-30 days"));
        $dateTo   = $_GET['date_to']   ?? date('Y-m-d');

        $report = $this->invoiceModel
            ? $this->invoiceModel->getRevenueStats($dateFrom, $dateTo)
            : $this->emptyStats();

        $this->smarty->assign('report', $report);
        $this->smarty->display('cashier/reports.tpl');
    }

    private function emptyStats()
    {
        return [
            'today_revenue'   => '0đ',
            'pending_count'   => 0,
            'paid_today'      => 0,
            'cash_today'      => '0đ',
            'transfer_today'  => '0đ',
        ];
    }
}

<?php
class CashierController
{
    private $smarty;
    private $billModel;
    private $prescriptionModel;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'cashier') {
            header('Location: ' . BASE_URL . '/?page=login');
            exit;
        }

        if ($db) {
            $this->billModel         = new BillModel($db);
            $this->prescriptionModel = new PrescriptionModel($db);
        }

        $user = $_SESSION['user'];
        $name = $user['fullName'] ?? $user['full_name'] ?? $user['name'] ?? $user['username'] ?? 'Thu ngân';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'cashier');
        $this->smarty->assign('notification_count', 0);

        $pendingCount = $this->billModel ? $this->billModel->countPending() : 0;
        $this->smarty->assign('pending_count', $pendingCount);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard': $this->dashboard(); break;
            case 'billing':   $this->billing();   break;
            case 'pending':   $this->pending();   break;
            case 'history':   $this->history();   break;
            case 'advance':   $this->advance();   break;
            case 'insurance': $this->insurance(); break;
            case 'reports':   $this->reports();   break;
            default:          $this->dashboard(); break;
        }
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    private function dashboard()
    {
        $stats        = $this->billModel ? $this->billModel->getTodayStats()       : $this->emptyStats();
        $pendingBills = $this->billModel ? $this->billModel->getPendingBills(10)   : [];

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

            if ($billId && $this->billModel) {
                // Lấy thông tin hóa đơn trước khi cập nhật
                $bill = $this->billModel->getBillById($billId);
                
                if ($bill) {
                    $invoiceCode = 'INV-' . strtoupper(substr(uniqid(), -6));
                    $user        = $_SESSION['user'];
                    $cashierId   = (string)($user['_id'] ?? '');
                    $cashierName = $user['fullName'] ?? $user['full_name'] ?? 'Thu ngân';

                    // 1. Đánh dấu hóa đơn đã thanh toán
                    $this->billModel->markPaid($billId, [
                        'invoice_code'    => $invoiceCode,
                        'payment_method'  => $payMethod,
                        'amount_received' => $amtReceived,
                        'cashier_id'      => $cashierId,
                        'cashier_name'    => $cashierName,
                    ]);

                    // 2. CẬP NHẬT ĐƠN THUỐC (Để dược sĩ thấy đơn này đã sẵn sàng)
                    if (!empty($bill['prescription_id']) && $this->prescriptionModel) {
                        // Chuyển từ 'pending' (chờ khám xong) sang 'paid' (đã thu tiền, chờ phát)
                        $this->prescriptionModel->updateStatus($bill['prescription_id'], 'paid');
                    }

                    // Tính tiền thừa để hiển thị
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
            $billId = null; // Quay lại trang tìm kiếm
        }

        // Logic hiển thị View (giữ nguyên của bạn)
        if ($billId && $this->billModel) {
            $bill = $this->billModel->getBillById($billId);
        } elseif ($searchQ && $this->billModel) {
            $searchResults = $this->billModel->searchPendingBills($searchQ);
        }

        $this->smarty->assign('bill',           $bill);
        $this->smarty->assign('search_q',       $searchQ);
        $this->smarty->assign('search_results', $searchResults);
        $this->smarty->display('cashier/billing.tpl');
    }

    // ─── Chờ thanh toán ───────────────────────────────────────────────────────

    private function pending()
{
    $pendingBills = $this->billModel ? $this->billModel->getPendingBills() : [];
    $this->smarty->assign('pending_bills', $pendingBills);
    $this->smarty->display('cashier/pending.tpl');
}

    // ─── Lịch sử ──────────────────────────────────────────────────────────────

    private function history()
    {
        if (($_GET['action'] ?? '') === 'export') {
            // Export Excel yêu cầu thư viện PhpSpreadsheet — chưa cài
            $this->smarty->assign('error_message', 'Tính năng xuất Excel chưa được kích hoạt.');
        }

        $filter  = [
            'q'         => $_GET['q']         ?? '',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to'   => $_GET['date_to']   ?? '',
            'method'    => $_GET['method']    ?? '',
        ];
        $history = $this->billModel ? $this->billModel->getHistory($filter) : [];

        $this->smarty->assign('history', $history);
        $this->smarty->assign('filter',  $filter);
        $this->smarty->display('cashier/history.tpl');
    }

    // ─── Tạm ứng ──────────────────────────────────────────────────────────────

    private function advance()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Lưu tạm ứng vào collection 'advances'
            $this->smarty->assign('success_message', 'Đã ghi nhận tạm ứng.');
        }
        $this->smarty->assign('advances', []);
        $this->smarty->display('cashier/advance.tpl');
    }

    // ─── BHYT ─────────────────────────────────────────────────────────────────

    private function insurance()
    {
        $filter       = ['q' => $_GET['q'] ?? ''];
        $pendingBills = [];

        if ($this->billModel) {
            $pendingBills = $this->billModel->getPendingBills();
            // Lọc chỉ lấy hóa đơn có bhyt_code
            $pendingBills = array_filter($pendingBills, fn($b) => !empty($b['bhyt_code']));
            $pendingBills = array_values($pendingBills);

            if (!empty($filter['q'])) {
                $q = mb_strtolower($filter['q']);
                $pendingBills = array_filter($pendingBills, function ($b) use ($q) {
                    return str_contains(mb_strtolower($b['patient_name'] ?? ''), $q)
                        || str_contains(mb_strtolower($b['bhyt_code']    ?? ''), $q);
                });
                $pendingBills = array_values($pendingBills);
            }
        }

        $this->smarty->assign('pending_bills',   $pendingBills);
        $this->smarty->assign('insurance_bills', $pendingBills);
        $this->smarty->assign('filter',          $filter);
        $this->smarty->display('cashier/insurance.tpl');
    }

    // ─── Báo cáo ──────────────────────────────────────────────────────────────

    private function reports()
    {
        if (($_GET['action'] ?? '') === 'export') {
            $this->smarty->assign('error_message', 'Tính năng xuất báo cáo chưa được kích hoạt.');
        }

        $period   = (int)($_GET['period']    ?? 30);
        $dateFrom = $_GET['date_from']       ?? date('Y-m-d', strtotime("-{$period} days"));
        $dateTo   = $_GET['date_to']         ?? date('Y-m-d');

        $filter = [
            'period'    => (string)$period,
            'date_from' => $dateFrom,
            'date_to'   => $dateTo,
        ];

        $report = $this->billModel
            ? $this->billModel->getRevenueStats($dateFrom, $dateTo)
            : ['total_revenue' => '0đ', 'total_invoices' => 0, 'cash_total' => '0đ', 'transfer_total' => '0đ', 'qr_total' => '0đ'];

        $this->smarty->assign('report',       $report);
        $this->smarty->assign('filter',       $filter);
        $this->smarty->assign('top_services', []);
        $this->smarty->display('cashier/reports.tpl');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function emptyStats()
    {
        return [
            'today_revenue'   => '0đ',
            'pending_count'   => 0,
            'paid_today'      => 0,
            'advance_today'   => '0đ',
            'cash_today'      => '0đ',
            'transfer_today'  => '0đ',
            'qr_today'        => '0đ',
            'insurance_today' => '0đ',
        ];
    }
}

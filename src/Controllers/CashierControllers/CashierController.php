<?php

class CashierController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'cashier') {
            header('Location: ' . BASE_URL . '/?page=login'); exit;
        }

        $user = $_SESSION['user'];
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? $user['username'] ?? 'Thu ngân';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'cashier');
        $this->smarty->assign('notification_count', 0);
        $this->smarty->assign('pending_count', 0); // TODO: query real count
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

    private function dashboard()
    {
        $this->smarty->assign('stats', ['today_revenue'=>'0đ','pending_count'=>0,'paid_today'=>0,'advance_today'=>'0đ','cash_today'=>'0đ','transfer_today'=>'0đ','qr_today'=>'0đ','insurance_today'=>'0đ']);
        $this->smarty->assign('pending_bills', []);
        $this->smarty->display('cashier/dashboard.tpl');
    }

    private function billing()
    {
        $billId   = $_GET['id']  ?? null;
        $searchQ  = $_GET['q']   ?? '';
        $searchResults = [];
        $bill = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'pay') {
            // TODO: Update bill status = paid
            // TODO: Update prescription status = paid (ready for pharmacist)
            // TODO: Generate invoice PDF
            // TODO: Deduct from stock if applicable
            $invoiceCode = 'INV' . strtoupper(substr(uniqid(), -6));
            $this->smarty->assign('success_message', "Thanh toán thành công! Mã hóa đơn: <strong>{$invoiceCode}</strong>");
        }

        if ($billId) {
            // TODO: Query bill from MongoDB by id
            $bill = null;
        } elseif ($searchQ) {
            // TODO: Search bills
            $searchResults = [];
        }

        $this->smarty->assign('bill', $bill);
        $this->smarty->assign('search_q', $searchQ);
        $this->smarty->assign('search_results', $searchResults);
        $this->smarty->assign('pending_count', 0);
        $this->smarty->display('cashier/billing.tpl');
    }

    private function pending()
    {
        // TODO: Query all unpaid bills from MongoDB
        $this->smarty->assign('pending_bills', []);
        $this->smarty->display('cashier/pending.tpl');
    }

    private function history()
    {
        if (($_GET['action'] ?? '') === 'export') {
            // TODO: Export to Excel
        }
        $filter = ['q' => $_GET['q'] ?? '', 'date_from' => $_GET['date_from'] ?? '', 'date_to' => $_GET['date_to'] ?? '', 'method' => $_GET['method'] ?? ''];
        $this->smarty->assign('history', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('cashier/history.tpl');
    }

    private function advance()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Record advance payment
            $this->smarty->assign('success_message', 'Đã ghi nhận tạm ứng.');
        }
        $this->smarty->assign('advances', []);
        // Reuse billing page with advance mode
        $this->smarty->display('cashier/billing.tpl');
    }

    private function insurance()
    {
        $this->smarty->assign('insurance_bills', []);
        $this->smarty->assign('filter', ['q' => $_GET['q'] ?? '']);
        $this->smarty->display('cashier/pending.tpl');
    }

    private function reports()
    {
        if (($_GET['action'] ?? '') === 'export') {
            // TODO: Export revenue report
        }
        $filter = ['period' => $_GET['period'] ?? '30', 'date_from' => $_GET['date_from'] ?? '', 'date_to' => $_GET['date_to'] ?? ''];
        $this->smarty->assign('report', ['total_revenue'=>'0đ','total_invoices'=>0,'cash_total'=>'0đ','transfer_total'=>'0đ','qr_total'=>'0đ']);
        $this->smarty->assign('filter', $filter);
        $this->smarty->assign('top_services', []);
        $this->smarty->display('admin/reports.tpl');
    }
}

<?php

class PharmacyController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pharmacist') {
            header('Location: /CLINIC/public/?page=login'); exit;
        }

        $user = $_SESSION['user'];
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? $user['username'] ?? 'Dược sĩ';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'pharmacist');
        $this->smarty->assign('notification_count', 0);
        $this->smarty->assign('new_rx_count', 0); // TODO: real count
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':      $this->dashboard();     break;
            case 'prescriptions':  $this->prescriptions(); break;
            case 'dispensing':     $this->dispensing();    break;
            case 'inventory':      $this->inventory();     break;
            case 'stock-in':       $this->stockIn();       break;
            case 'low-stock':      $this->lowStock();      break;
            case 'expiring':       $this->expiring();      break;
            case 'drugs':          $this->drugs();         break;
            case 'drug-categories':$this->drugCategories();break;
            case 'reports':        $this->reports();       break;
            default:               $this->dashboard();     break;
        }
    }

    private function dashboard()
    {
        $this->smarty->assign('stats', ['new_rx'=>0,'dispensed_today'=>0,'low_stock'=>0,'expiring'=>0]);
        $this->smarty->assign('new_prescriptions', []);
        $this->smarty->assign('low_stock_drugs', []);
        $this->smarty->display('pharmacist/dashboard.tpl');
    }

    private function prescriptions()
    {
        $filter = ['status' => $_GET['status'] ?? '', 'q' => $_GET['q'] ?? '', 'date' => $_GET['date'] ?? ''];
        $this->smarty->assign('prescriptions', []);
        $this->smarty->assign('count', ['all'=>0,'pending'=>0,'dispensing'=>0,'done'=>0]);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('pharmacist/prescriptions.tpl');
    }

    private function dispensing()
    {
        $rxId = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'dispense') {
            $rxId = $_POST['prescription_id'] ?? null;
            // TODO: Update prescription status = done
            // TODO: Deduct drug quantities from stock
            // TODO: Notify patient to pick up
            $this->smarty->assign('success_message', 'Đã phát thuốc thành công. Gọi bệnh nhân đến nhận.');
        }

        $prescription = null;
        if ($rxId) {
            // TODO: Query prescription with drug details and stock info
            $prescription = null;
        }

        $this->smarty->assign('prescription', $prescription);
        $this->smarty->display('pharmacist/dispensing.tpl');
    }

    private function inventory()
    {
        $filter = ['q' => $_GET['q'] ?? '', 'category' => $_GET['category'] ?? '', 'stock_status' => $_GET['stock_status'] ?? ''];
        $this->smarty->assign('drugs', []);
        $this->smarty->assign('drug_categories', []);
        $this->smarty->assign('stats', ['low_stock'=>0,'expiring'=>0]);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('pharmacist/inventory.tpl');
    }

    private function stockIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
            // TODO: Loop through drugs and update stock quantities + log import
            $this->smarty->assign('success_message', 'Đã lưu phiếu nhập kho thành công.');
        }

        // TODO: Query all drugs for the select dropdown
        $this->smarty->assign('drug_options_json', json_encode([]));
        $this->smarty->assign('form', []);
        $this->smarty->display('pharmacist/stock-in.tpl');
    }

    private function lowStock()
    {
        // TODO: Query drugs where stock_qty <= min_qty
        $this->smarty->assign('low_stock_drugs', []);
        $this->smarty->display('pharmacist/low-stock.tpl');
    }

    private function expiring()
    {
        // TODO: Query drugs where expiry_date within 30 days
        $this->smarty->assign('expiring_drugs', []);
        $this->smarty->display('pharmacist/expiring.tpl');
    }

    private function drugs()
    {
        $filter = ['q' => $_GET['q'] ?? '', 'category' => $_GET['category'] ?? '', 'stock_status' => ''];
        $this->smarty->assign('drugs', []);
        $this->smarty->assign('drug_categories', []);
        $this->smarty->assign('low_stock_count', 0);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/drugs.tpl');
    }

    private function drugCategories()
    {
        $this->smarty->assign('drug_categories', []);
        $this->smarty->display('admin/drug-categories.tpl');
    }

    private function reports()
    {
        if (($_GET['action'] ?? '') === 'export') {
            // TODO: Export report
        }
        $filter = ['period' => $_GET['period'] ?? '30', 'date_from' => $_GET['date_from'] ?? '', 'date_to' => $_GET['date_to'] ?? ''];
        $this->smarty->assign('report', ['total_dispensed'=>0,'total_qty_out'=>0,'total_qty_in'=>0,'total_stock'=>0]);
        $this->smarty->assign('top_drugs', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('pharmacist/reports.tpl');
    }
}

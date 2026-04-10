<?php
class PharmacyController
{
    private $smarty;
    private $drugModel;
    private $prescriptionModel;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'pharmacist') {
            header('Location: ' . BASE_URL . '/?page=login');
            exit;
        }

        if ($db) {
            $this->drugModel         = new DrugModel($db);
            $this->prescriptionModel = new PrescriptionModel($db);
        }

        $user = $_SESSION['user'];
        $name = $user['fullName'] ?? 'Dược sĩ';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'pharmacist');
        $this->smarty->assign('notification_count', 0);

        // FIX LỖI: Sử dụng đúng key 'pending_dispense' từ PrescriptionModel
        $stats = $this->prescriptionModel ? $this->prescriptionModel->getDashboardStats() : null;
        $newRxCount = $stats['pending_dispense'] ?? 0;
        $this->smarty->assign('new_rx_count', $newRxCount);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':
                $this->dashboard();
                break;
            case 'prescriptions':
                $this->prescriptions();
                break;
            case 'dispensing':
                $this->dispensing();
                break;
            case 'inventory':
                $this->inventory();
                break;
            case 'stock-in':
                $this->stockIn();
                break;
            case 'low-stock':
                $this->lowStock();
                break;
            case 'expiring':
                $this->expiring();
                break;
            case 'drugs':
                $this->drugs();
                break;
            case 'drug-categories':
                $this->drugCategories();
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
        // FIX LỖI: Đồng bộ key 'pending_dispense' và 'completed_today'
        $rxStats   = $this->prescriptionModel ? $this->prescriptionModel->getDashboardStats() : ['pending_dispense' => 0, 'completed_today' => 0];
        $drugStats = $this->drugModel         ? $this->drugModel->getDashboardStats()         : ['low_stock' => 0, 'expiring' => 0];

        $stats = [
            'new_rx'          => $rxStats['pending_dispense'] ?? 0,
            'dispensed_today' => $rxStats['completed_today'] ?? 0,
            'low_stock'       => $drugStats['low_stock'] ?? 0,
            'expiring'        => $drugStats['expiring'] ?? 0,
        ];

        $newPrescriptions = $this->prescriptionModel ? $this->prescriptionModel->getNewPrescriptions(10) : [];
        $lowStockDrugs    = $this->drugModel         ? $this->drugModel->getLowStock()                 : [];

        $this->smarty->assign('stats',             $stats);
        $this->smarty->assign('new_prescriptions', $newPrescriptions);
        $this->smarty->assign('low_stock_drugs',   $lowStockDrugs);
        $this->smarty->display('pharmacist/dashboard.tpl');
    }

    // ─── Danh sách đơn thuốc ──────────────────────────────────────────────────

    private function prescriptions()
    {
        $filter = [
            'status' => $_GET['status'] ?? '',
            'q'      => $_GET['q']      ?? '',
            'date'   => $_GET['date']   ?? '',
        ];

        $prescriptions = $this->prescriptionModel ? $this->prescriptionModel->getPrescriptions($filter) : [];
        // Map lại key cho CountByStatus
        $count = $this->prescriptionModel ? $this->prescriptionModel->getCountByStatus() : ['all' => 0, 'pending' => 0, 'dispensing' => 0, 'done' => 0];

        $this->smarty->assign('prescriptions', $prescriptions);
        $this->smarty->assign('count',         $count);
        $this->smarty->assign('filter',        $filter);
        $this->smarty->display('pharmacist/prescriptions.tpl');
    }

    // ─── Phát thuốc ───────────────────────────────────────────────────────────

    private function dispensing()
    {
        $rxId = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'dispense') {
            $rxId = $_POST['prescription_id'] ?? null;

            if ($rxId && $this->prescriptionModel) {
                // Sửa: Truyền true để lấy kèm thông tin thuốc từ MySQL
                $rx = $this->prescriptionModel->getPrescriptionById($rxId, true);

                if ($rx) {
                    // Trừ tồn kho
                    if ($this->drugModel && !empty($rx['drugs'])) {
                        foreach ($rx['drugs'] as $drug) {
                            $dId = $drug['drug_id'] ?? null;
                            $qty = $drug['qty'] ?? 0;
                            if ($dId && $qty > 0) {
                                $this->drugModel->deductStock($dId, $qty);
                            }
                        }
                    }

                    $user = $_SESSION['user'];
                    $pharmacistId   = $user['id'] ?? 0;
                    $pharmacistName = $user['fullName'] ?? 'Dược sĩ';

                    // Cập nhật trạng thái → done
                    $this->prescriptionModel->updateStatus($rxId, 'done', [
                        'dispensed_at'   => date('Y-m-d H:i:s'),
                        'dispensed_by'   => $pharmacistId,
                        'dispensed_name' => $pharmacistName
                    ]);

                    $this->smarty->assign('success_message', 'Đã phát thuốc thành công.');
                }
            }
            $rxId = null;
        }

        $prescription = null;
        if ($rxId && $this->prescriptionModel) {
            $prescription = $this->prescriptionModel->getPrescriptionById($rxId, true);
        }

        $this->smarty->assign('prescription', $prescription);
        $this->smarty->display('pharmacist/dispensing.tpl');
    }

    // ─── Tồn kho ──────────────────────────────────────────────────────────────

    private function inventory()
    {
        $filter = [
            'q'            => $_GET['q']            ?? '',
            'category'     => $_GET['category']     ?? '',
            'stock_status' => $_GET['stock_status'] ?? '',
        ];

        $drugs          = $this->drugModel ? $this->drugModel->getAllDrugs($filter) : [];
        $drugCategories = $this->drugModel ? $this->drugModel->getCategories()       : [];
        $drugStats      = $this->drugModel ? $this->drugModel->getDashboardStats()   : ['low_stock' => 0, 'expiring' => 0];

        $this->smarty->assign('drugs',           $drugs);
        $this->smarty->assign('drug_categories', $drugCategories);
        $this->smarty->assign('stats',           $drugStats);
        $this->smarty->assign('filter',          $filter);
        $this->smarty->display('pharmacist/inventory.tpl');
    }

    // ─── Nhập kho ─────────────────────────────────────────────────────────────

    private function stockIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'save') {
            if ($this->drugModel && !empty($_POST['drug_id'])) {
                $ok = $this->drugModel->stockIn($_POST);
                if ($ok) {
                    $this->smarty->assign('success_message', 'Đã lưu phiếu nhập kho thành công.');
                } else {
                    $this->smarty->assign('error_message', 'Có lỗi xảy ra khi nhập kho. Vui lòng kiểm tra lại.');
                }
            } else {
                $this->smarty->assign('error_message', 'Vui lòng thêm ít nhất một loại thuốc.');
            }
        }

        $preselectedDrugId = $_GET['drug_id'] ?? null;
        $drugOptions = $this->drugModel ? $this->drugModel->getAllForSelect() : [];

        $this->smarty->assign('drug_options_json', json_encode($drugOptions));
        $this->smarty->assign('preselected_drug_id', $preselectedDrugId);
        $this->smarty->assign('form', [
            'supplier'    => $_POST['supplier']    ?? '',
            'import_date' => $_POST['import_date'] ?? date('Y-m-d'),
            'note'        => $_POST['note']        ?? '',
        ]);
        $this->smarty->display('pharmacist/stock-in.tpl');
    }

    // ─── Thuốc sắp hết ────────────────────────────────────────────────────────

    private function lowStock()
    {
        $lowStockDrugs = $this->drugModel ? $this->drugModel->getLowStock() : [];
        $this->smarty->assign('low_stock_drugs', $lowStockDrugs);
        $this->smarty->display('pharmacist/low-stock.tpl');
    }

    // ─── Thuốc sắp hết hạn ───────────────────────────────────────────────────

    private function expiring()
    {
        $expiringDrugs = $this->drugModel ? $this->drugModel->getExpiring(30) : [];
        $this->smarty->assign('expiring_drugs', $expiringDrugs);
        $this->smarty->display('pharmacist/expiring.tpl');
    }

    // ─── Danh mục thuốc ───────────────────────────────────────────

    private function drugs()
    {
        $filter = [
            'q'            => $_GET['q']        ?? '',
            'category'     => $_GET['category'] ?? '',
            'stock_status' => '',
        ];

        $drugs          = $this->drugModel ? $this->drugModel->getAllDrugs($filter)  : [];
        $drugCategories = $this->drugModel ? $this->drugModel->getCategories()         : [];
        $drugStats      = $this->drugModel ? $this->drugModel->getDashboardStats()    : ['low_stock' => 0];

        $this->smarty->assign('drugs',           $drugs);
        $this->smarty->assign('drug_categories', $drugCategories);
        $this->smarty->assign('low_stock_count', $drugStats['low_stock'] ?? 0);
        $this->smarty->assign('filter',          $filter);
        $this->smarty->display('admin/drugs.tpl');
    }

    // ─── Nhóm thuốc ───────────────────────────────────────────────

    private function drugCategories()
    {
        $categories = $this->drugModel ? $this->drugModel->getCategories() : [];
        $this->smarty->assign('drug_categories', $categories);
        $this->smarty->display('admin/drug-categories.tpl');
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

        $report   = ['total_dispensed' => 0, 'total_qty_out' => 0, 'total_qty_in' => 0, 'total_stock' => 0];
        $topDrugs  = [];

        // Kiểm tra hàm tồn tại trước khi gọi để tránh lỗi Fatal
        if ($this->prescriptionModel && method_exists($this->prescriptionModel, 'getReportStats')) {
            $data = $this->prescriptionModel->getReportStats($dateFrom, $dateTo);
            $report['total_dispensed'] = $data['stats']['total_dispensed'] ?? 0;
            $report['total_qty_out']   = $data['stats']['total_qty_out'] ?? 0;
            $topDrugs                  = $data['top_drugs'] ?? [];
        }

        // Các hàm phụ trợ thống kê cho DrugModel
        if ($this->drugModel) {
            if (method_exists($this->drugModel, 'getStockInTotal')) {
                $report['total_qty_in'] = $this->drugModel->getStockInTotal($dateFrom, $dateTo);
            }
            if (method_exists($this->drugModel, 'getTotalStockCount')) {
                $report['total_stock']  = $this->drugModel->getTotalStockCount();
            }
        }

        $this->smarty->assign('report',    $report);
        $this->smarty->assign('filter',    $filter);
        $this->smarty->assign('top_drugs', $topDrugs);
        $this->smarty->display('pharmacist/reports.tpl');
    }
}

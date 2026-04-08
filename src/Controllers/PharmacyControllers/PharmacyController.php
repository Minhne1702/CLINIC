<?php
class PharmacyController
{
    private $smarty;
    private $drugModel;
    private $prescriptionModel;

    public function __construct($smarty, $db = null) // $db dùng để khởi tạo models bên dưới
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
        $name = $user['fullName'] ?? $user['full_name'] ?? $user['name'] ?? $user['username'] ?? 'Dược sĩ';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'pharmacist');
        $this->smarty->assign('notification_count', 0);

        $newRxCount = $this->prescriptionModel
            ? $this->prescriptionModel->getDashboardStats()['new_rx']
            : 0;
        $this->smarty->assign('new_rx_count', $newRxCount);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':       $this->dashboard();      break;
            case 'prescriptions':   $this->prescriptions();  break;
            case 'dispensing':      $this->dispensing();     break;
            case 'inventory':       $this->inventory();      break;
            case 'stock-in':        $this->stockIn();        break;
            case 'low-stock':       $this->lowStock();       break;
            case 'expiring':        $this->expiring();       break;
            case 'drugs':           $this->drugs();          break;
            case 'drug-categories': $this->drugCategories(); break;
            case 'reports':         $this->reports();        break;
            default:                $this->dashboard();      break;
        }
    }

    // ─── Dashboard ────────────────────────────────────────────────────────────

    private function dashboard()
    {
        $rxStats   = $this->prescriptionModel ? $this->prescriptionModel->getDashboardStats()  : ['new_rx' => 0, 'dispensed_today' => 0];
        $drugStats = $this->drugModel         ? $this->drugModel->getDashboardStats()           : ['low_stock' => 0, 'expiring' => 0];

        $stats = [
            'new_rx'          => $rxStats['new_rx'],
            'dispensed_today' => $rxStats['dispensed_today'],
            'low_stock'       => $drugStats['low_stock'],
            'expiring'        => $drugStats['expiring'],
        ];

        $newPrescriptions = $this->prescriptionModel ? $this->prescriptionModel->getNewPrescriptions(10) : [];
        $lowStockDrugs    = $this->drugModel         ? $this->drugModel->getLowStock()                    : [];

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

        $prescriptions = $this->prescriptionModel ? $this->prescriptionModel->getPrescriptions($filter)    : [];
        $count         = $this->prescriptionModel ? $this->prescriptionModel->getCountByStatus()            : ['all' => 0, 'pending' => 0, 'dispensing' => 0, 'done' => 0];

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
                $drugCol = $this->drugModel ? $this->drugModel->getCollection() : null;
                $rx      = $this->prescriptionModel->getPrescriptionById($rxId, $drugCol);

                if ($rx) {
                    // Trừ tồn kho cho từng thuốc
                    if ($this->drugModel && !empty($rx['drugs'])) {
                        foreach ($rx['drugs'] as $drug) {
                            if (!empty($drug['drug_id']) && !empty($drug['qty'])) {
                                $this->drugModel->deductStock($drug['drug_id'], (int)$drug['qty']);
                            }
                        }
                    }

                    $user        = $_SESSION['user'];
                    $pharmacistId   = (string)($user['_id'] ?? '');
                    $pharmacistName = $user['fullName'] ?? $user['full_name'] ?? $user['username'] ?? 'Dược sĩ';

                    // Cập nhật trạng thái đơn thuốc → done
                    $this->prescriptionModel->updateStatus($rxId, 'done', [
                        'dispensed_at'   => new MongoDB\BSON\UTCDateTime(),
                        'dispensed_by'   => $pharmacistId,
                        'dispensed_name' => $pharmacistName,
                    ]);

                    $this->smarty->assign('success_message', 'Đã phát thuốc thành công. Gọi bệnh nhân đến nhận.');
                } else {
                    $this->smarty->assign('error_message', 'Không tìm thấy đơn thuốc.');
                }
            }
            $rxId = null; // Hiện thông báo, không load lại đơn
        }

        $prescription = null;
        if ($rxId && $this->prescriptionModel) {
            $drugCol      = $this->drugModel ? $this->drugModel->getCollection() : null;
            $prescription = $this->prescriptionModel->getPrescriptionById($rxId, $drugCol);
            if (!$prescription) {
                $this->smarty->assign('error_message', 'Không tìm thấy đơn thuốc.');
            }
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

        $drugs          = $this->drugModel ? $this->drugModel->getAllDrugs($filter)  : [];
        $drugCategories = $this->drugModel ? $this->drugModel->getCategories()        : [];
        $drugStats      = $this->drugModel ? $this->drugModel->getDashboardStats()    : ['low_stock' => 0, 'expiring' => 0];

        $this->smarty->assign('drugs',          $drugs);
        $this->smarty->assign('drug_categories',$drugCategories);
        $this->smarty->assign('stats',          $drugStats);
        $this->smarty->assign('filter',         $filter);
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

        // Nếu có drug_id từ URL (click "Nhập thêm" từ tồn kho), pre-select thuốc đó
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

    // ─── Danh mục thuốc (read-only) ───────────────────────────────────────────

    private function drugs()
    {
        $filter = [
            'q'            => $_GET['q']        ?? '',
            'category'     => $_GET['category'] ?? '',
            'stock_status' => '',
        ];

        $drugs          = $this->drugModel ? $this->drugModel->getAllDrugs($filter)  : [];
        $drugCategories = $this->drugModel ? $this->drugModel->getCategories()        : [];
        $lowStockCount  = $this->drugModel ? $this->drugModel->getDashboardStats()['low_stock'] : 0;

        $this->smarty->assign('drugs',           $drugs);
        $this->smarty->assign('drug_categories', $drugCategories);
        $this->smarty->assign('low_stock_count', $lowStockCount);
        $this->smarty->assign('filter',          $filter);
        $this->smarty->display('admin/drugs.tpl');
    }

    // ─── Nhóm thuốc (read-only) ───────────────────────────────────────────────

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

        $report    = ['total_dispensed' => 0, 'total_qty_out' => 0, 'total_qty_in' => 0, 'total_stock' => 0];
        $topDrugs  = [];

        if ($this->prescriptionModel) {
            $data              = $this->prescriptionModel->getReportStats($dateFrom, $dateTo);
            $report['total_dispensed'] = $data['stats']['total_dispensed'];
            $report['total_qty_out']   = $data['stats']['total_qty_out'];
            $topDrugs                  = $data['top_drugs'];
        }

        if ($this->drugModel) {
            $report['total_qty_in'] = $this->drugModel->getStockInTotal($dateFrom, $dateTo);
            $report['total_stock']  = $this->drugModel->getTotalStockCount();
        }

        $this->smarty->assign('report',    $report);
        $this->smarty->assign('filter',    $filter);
        $this->smarty->assign('top_drugs', $topDrugs);
        $this->smarty->display('pharmacist/reports.tpl');
    }

}


<?php

class AdminController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db = $db;

        // Kiểm tra quyền admin
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /CLINIC/public/?page=login');
            exit;
        }

        // Lấy tên user - hỗ trợ nhiều key khác nhau
        $user = $_SESSION['user'];
        $name = $user['full_name']
             ?? $user['fullName']
             ?? $user['name']
             ?? $user['username']
             ?? 'Admin';

        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', $user['role'] ?? 'admin');
        $this->smarty->assign('notification_count', 0);
        $this->smarty->assign('pending_count', 0);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';

        switch ($page) {
            case 'dashboard':       $this->dashboard();      break;
            case 'users':           $this->users();          break;
            case 'doctors':         $this->doctors();        break;
            case 'patients':        $this->patients();       break;
            case 'specialties':     $this->specialties();    break;
            case 'diseases':        $this->diseases();       break;
            case 'drugs':           $this->drugs();          break;
            case 'drug-categories': $this->drugCategories(); break;
            case 'appointments':    $this->appointments();   break;
            case 'reports':         $this->reports();        break;
            case 'audit-log':       $this->auditLog();       break;
            case 'settings':        $this->settings();       break;
            default:                $this->dashboard();      break;
        }
    }

    // ===================== DASHBOARD =====================
    private function dashboard()
    {
        // TODO: Query MongoDB thực tế
        $stats = [
            'today_patients'      => 0,
            'today_appointments'  => 0,
            'today_revenue'       => '0đ',
            'doctors_on_duty'     => 0,
            'total_patients'      => 0,
            'total_doctors'       => 0,
            'month_appointments'  => 0,
            'month_revenue'       => '0đ',
            'today_prescriptions' => 0,
            'low_stock_drugs'     => 0,
        ];

        $this->smarty->assign('stats', $stats);
        $this->smarty->assign('recent_appointments', []);
        $this->smarty->assign('chart_labels',   json_encode(['T2','T3','T4','T5','T6','T7','CN']));
        $this->smarty->assign('chart_revenues', json_encode([0,0,0,0,0,0,0]));
        $this->smarty->assign('specialty_labels', json_encode(['Tim mạch','Nhi','Da liễu','Nha','Khác']));
        $this->smarty->assign('specialty_data',   json_encode([0,0,0,0,0]));
        $this->smarty->display('admin/dashboard.tpl');
    }

    // ===================== USERS =====================
    private function users()
    {
        $action = $_GET['action'] ?? '';

        if ($action === 'delete' && isset($_GET['id'])) {
            // TODO: $this->db->users->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);
            $this->smarty->assign('success_message', 'Đã xóa tài khoản.');
        }

        if ($action === 'toggle' && isset($_GET['id'])) {
            // TODO: toggle is_active
            $this->smarty->assign('success_message', 'Đã cập nhật trạng thái.');
        }

        $filter = [
            'q'      => $_GET['q']            ?? '',
            'role'   => $_GET['filter_role']  ?? '',
            'status' => $_GET['filter_status'] ?? '',
        ];

        // TODO: Query MongoDB với filter
        $users = [];

        $this->smarty->assign('users', $users);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/users.tpl');
    }

    // ===================== DOCTORS =====================
    private function doctors()
    {
        $filter = [
            'q'         => $_GET['q']         ?? '',
            'specialty' => $_GET['specialty']  ?? '',
            'status'    => $_GET['status']     ?? '',
        ];

        // TODO: Query MongoDB
        $doctors    = [];
        $specialties = [];

        $this->smarty->assign('doctors',    $doctors);
        $this->smarty->assign('specialties', $specialties);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/doctors.tpl');
    }

    // ===================== PATIENTS =====================
    private function patients()
    {
        $filter = [
            'q'      => $_GET['q']      ?? '',
            'gender' => $_GET['gender'] ?? '',
        ];

        // TODO: Query MongoDB
        $patients = [];

        $this->smarty->assign('patients', $patients);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/patients.tpl');
    }

    // ===================== SPECIALTIES =====================
    private function specialties()
    {
        $action = $_GET['action'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'save') {
            // TODO: Upsert specialty into MongoDB
            $this->smarty->assign('success_message', 'Đã lưu chuyên khoa.');
        }

        if ($action === 'delete' && isset($_GET['id'])) {
            // TODO: Delete
            $this->smarty->assign('success_message', 'Đã xóa chuyên khoa.');
        }

        // TODO: Query MongoDB
        $specialties = [];

        $this->smarty->assign('specialties', $specialties);
        $this->smarty->display('admin/specialties.tpl');
    }

    // ===================== DISEASES =====================
    private function diseases()
    {
        $action = $_GET['action'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'save') {
            // TODO: Upsert disease
            $this->smarty->assign('success_message', 'Đã lưu bệnh.');
        }

        $filter = [
            'q'     => $_GET['q']     ?? '',
            'group' => $_GET['group'] ?? '',
        ];

        // TODO: Query MongoDB
        $diseases       = [];
        $disease_groups = [];

        $this->smarty->assign('diseases',       $diseases);
        $this->smarty->assign('disease_groups', $disease_groups);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/diseases.tpl');
    }

    // ===================== DRUGS =====================
    private function drugs()
    {
        $action = $_GET['action'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'save') {
            // TODO: Upsert drug
            $this->smarty->assign('success_message', 'Đã lưu thuốc.');
        }

        if ($action === 'delete' && isset($_GET['id'])) {
            // TODO: Delete drug
            $this->smarty->assign('success_message', 'Đã xóa thuốc.');
        }

        $filter = [
            'q'            => $_GET['q']            ?? '',
            'category'     => $_GET['category']     ?? '',
            'stock_status' => $_GET['stock_status'] ?? '',
        ];

        // TODO: Query MongoDB
        $drugs          = [];
        $drug_categories = [];
        $low_stock_count = 0;

        $this->smarty->assign('drugs',           $drugs);
        $this->smarty->assign('drug_categories', $drug_categories);
        $this->smarty->assign('low_stock_count', $low_stock_count);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/drugs.tpl');
    }

    // ===================== DRUG CATEGORIES =====================
    private function drugCategories()
    {
        $action = $_GET['action'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'save') {
            // TODO: Upsert drug category
            $this->smarty->assign('success_message', 'Đã lưu nhóm thuốc.');
        }

        if ($action === 'delete' && isset($_GET['id'])) {
            $this->smarty->assign('success_message', 'Đã xóa nhóm thuốc.');
        }

        // TODO: Query MongoDB
        $drug_categories = [];

        $this->smarty->assign('drug_categories', $drug_categories);
        $this->smarty->display('admin/drug-categories.tpl');
    }

    // ===================== APPOINTMENTS =====================
    private function appointments()
    {
        $action = $_GET['action'] ?? '';

        if ($action === 'confirm' && isset($_GET['id'])) {
            // TODO: Update status = confirmed
            $this->smarty->assign('success_message', 'Đã xác nhận lịch hẹn.');
        }

        if ($action === 'cancel' && isset($_GET['id'])) {
            // TODO: Update status = cancelled
            $this->smarty->assign('success_message', 'Đã hủy lịch hẹn.');
        }

        $filter = [
            'q'         => $_GET['q']         ?? '',
            'status'    => $_GET['status']     ?? '',
            'doctor_id' => $_GET['doctor_id']  ?? '',
            'date_from' => $_GET['date_from']  ?? '',
            'date_to'   => $_GET['date_to']    ?? '',
        ];

        // TODO: Query MongoDB
        $appointments = [];
        $doctors      = [];
        $count = ['all'=>0,'pending'=>0,'confirmed'=>0,'completed'=>0,'cancelled'=>0];

        $this->smarty->assign('appointments', $appointments);
        $this->smarty->assign('doctors', $doctors);
        $this->smarty->assign('count', $count);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/appointments.tpl');
    }

    // ===================== REPORTS =====================
    private function reports()
    {
        $filter = [
            'period'    => $_GET['period']    ?? '30',
            'date_from' => $_GET['date_from'] ?? '',
            'date_to'   => $_GET['date_to']   ?? '',
        ];

        if (($_GET['action'] ?? '') === 'export') {
            // TODO: Export Excel
        }

        $report = [
            'total_patients'      => 0,
            'total_revenue'       => '0đ',
            'total_appointments'  => 0,
            'total_prescriptions' => 0,
            'patients_growth'     => 0,
            'revenue_growth'      => 0,
            'appointments_growth' => 0,
            'avg_drugs_per_rx'    => 0,
        ];

        $this->smarty->assign('report', $report);
        $this->smarty->assign('top_doctors', []);
        $this->smarty->assign('top_drugs', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->assign('chart_labels',     json_encode(['T2','T3','T4','T5','T6','T7','CN']));
        $this->smarty->assign('chart_revenues',   json_encode([0,0,0,0,0,0,0]));
        $this->smarty->assign('specialty_labels', json_encode(['Tim mạch','Nhi','Da liễu','Nha','Khác']));
        $this->smarty->assign('specialty_data',   json_encode([0,0,0,0,0]));
        $this->smarty->display('admin/reports.tpl');
    }

    // ===================== AUDIT LOG =====================
    private function auditLog()
    {
        if (($_GET['action'] ?? '') === 'export') {
            // TODO: Export logs
        }

        $filter = [
            'q'           => $_GET['q']           ?? '',
            'action_type' => $_GET['action_type'] ?? '',
            'user_role'   => $_GET['user_role']   ?? '',
            'date_from'   => $_GET['date_from']   ?? '',
        ];

        // TODO: Query audit_logs collection
        $logs = [];

        $this->smarty->assign('logs', $logs);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/audit-log.tpl');
    }

    // ===================== SETTINGS =====================
    private function settings()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Save settings to MongoDB settings collection
            $this->smarty->assign('success_message', 'Đã lưu cài đặt thành công.');
        }

        // TODO: Load settings from MongoDB
        $settings = [];

        $this->smarty->assign('settings', $settings);
        $this->smarty->display('admin/settings.tpl');
    }
}

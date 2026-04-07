<?php

class DoctorController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
            header('Location: /CLINIC/public/?page=login'); exit;
        }

        $user = $_SESSION['user'];
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? $user['username'] ?? 'Bác sĩ';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'doctor');
        $this->smarty->assign('notification_count', 0);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':     $this->dashboard();     break;
            case 'queue':         $this->queue();         break;
            case 'examination':   $this->examination();   break;
            case 'appointments':  $this->appointments();  break;
            case 'prescriptions': $this->prescriptions(); break;
            case 'patients':      $this->patients();      break;
            case 'diseases':      $this->diseases();      break;
            case 'drugs':         $this->drugsLookup();   break;
            case 'schedule':      $this->schedule();      break;
            case 'profile':       $this->profile();       break;
            default:              $this->dashboard();     break;
        }
    }

    private function dashboard()
    {
        $this->smarty->assign('stats', ['today_queue'=>0,'done_today'=>0,'appointments_today'=>0,'prescriptions_today'=>0]);
        $this->smarty->assign('queue', []);
        $this->smarty->assign('today_appointments', []);
        $this->smarty->display('doctor/dashboard.tpl');
    }

    private function queue()
    {
        // TODO: Query queue for this doctor from MongoDB
        $this->smarty->assign('queue', []);
        $this->smarty->assign('count', ['waiting'=>0,'in_progress'=>0,'done'=>0]);
        $this->smarty->display('doctor/queue.tpl');
    }

    private function examination()
    {
        $patientId = $_GET['patient_id'] ?? null;
        $queueId   = $_GET['queue_id']   ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['exam_status'] ?? 'draft';
            // TODO: Save examination record to MongoDB
            // TODO: Save prescription if drugs provided
            // TODO: Save lab orders if provided
            // TODO: If completed → update queue status → notify cashier
            $this->smarty->assign('success_message', $status === 'completed' ? 'Đã hoàn tất khám. Bệnh nhân chuyển sang thanh toán.' : 'Đã lưu nháp.');
        }

        // TODO: Query patient info from MongoDB
        $patient = $patientId ? [] : null;
        $this->smarty->assign('patient',        $patient);
        $this->smarty->assign('queue_id',       $queueId);
        $this->smarty->assign('queue_symptoms', '');
        $this->smarty->assign('recent_records', []);
        $this->smarty->assign('exam',           []);
        $this->smarty->display('doctor/examination.tpl');
    }

    private function appointments()
    {
        $filter = ['status' => $_GET['status'] ?? '', 'q' => $_GET['q'] ?? '', 'date' => $_GET['date'] ?? ''];
        $this->smarty->assign('appointments', []);
        $this->smarty->assign('count', ['all'=>0,'confirmed'=>0,'pending'=>0,'completed'=>0]);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('doctor/appointments.tpl');
    }

    private function prescriptions()
    {
        $filter = ['q' => $_GET['q'] ?? '', 'date_from' => $_GET['date_from'] ?? '', 'date_to' => $_GET['date_to'] ?? ''];
        $this->smarty->assign('prescriptions', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('doctor/prescriptions.tpl');
    }

    private function patients()
    {
        // TODO: Query patients this doctor has treated
        $this->smarty->assign('patients', []);
        $this->smarty->assign('filter', ['q' => $_GET['q'] ?? '']);
        $this->smarty->display('admin/patients.tpl'); // Reuse admin patient list
    }

    private function diseases()
    {
        $this->smarty->assign('diseases', []);
        $this->smarty->assign('disease_groups', []);
        $this->smarty->assign('filter', ['q' => $_GET['q'] ?? '', 'group' => $_GET['group'] ?? '']);
        $this->smarty->display('admin/diseases.tpl'); // Reuse read-only
    }

    private function drugsLookup()
    {
        $this->smarty->assign('drugs', []);
        $this->smarty->assign('drug_categories', []);
        $this->smarty->assign('low_stock_count', 0);
        $this->smarty->assign('filter', ['q' => $_GET['q'] ?? '', 'category' => $_GET['category'] ?? '', 'stock_status' => '']);
        $this->smarty->display('admin/drugs.tpl'); // Reuse read-only
    }

    private function schedule()
    {
        $this->smarty->assign('schedule', []);
        $this->smarty->display('doctor/schedule.tpl');
    }

    private function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Update doctor profile
            $this->smarty->assign('success_message', 'Đã cập nhật hồ sơ.');
        }
        $this->smarty->assign('patient', []);
        $this->smarty->display('patient/profile.tpl'); // Reuse profile template
    }
}

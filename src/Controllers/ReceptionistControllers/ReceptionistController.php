<?php

class ReceptionistController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'receptionist') {
            header('Location: /CLINIC/public/?page=login'); exit;
        }

        $user = $_SESSION['user'];
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? $user['username'] ?? 'Lễ tân';
        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'receptionist');
        $this->smarty->assign('notification_count', 0);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';
        switch ($page) {
            case 'dashboard':    $this->dashboard();    break;
            case 'checkin':      $this->checkin();      break;
            case 'queue':        $this->queue();        break;
            case 'appointments': $this->appointments(); break;
            case 'walk-in':      $this->walkIn();       break;
            case 'patients':     $this->patients();     break;
            case 'patient-new':  $this->patientNew();   break;
            case 'doctors':      $this->doctors();      break;
            default:             $this->dashboard();    break;
        }
    }

    private function dashboard()
    {
        $this->smarty->assign('stats', ['today_checkins'=>0,'today_appointments'=>0,'waiting'=>0,'new_patients'=>0]);
        $this->smarty->assign('queue', []);
        $this->smarty->assign('upcoming_appointments', []);
        $this->smarty->display('receptionist/dashboard.tpl');
    }

    private function checkin()
    {
        $searchQ = $_GET['q'] ?? '';
        $foundPatient = null;
        $foundAppointment = null;

        if ($searchQ) {
            // TODO: Query MongoDB for patient by CCCD/phone/name/code
            $foundPatient = null;
            // TODO: Query upcoming appointment for this patient today
            $foundAppointment = null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'checkin') {
            // TODO: Create queue entry in MongoDB
            // TODO: Generate queue number based on priority
            // TODO: Send notification to doctor
            $this->smarty->assign('success_message', 'Check-in thành công! Số thứ tự: ' . rand(1, 50));
        }

        $this->smarty->assign('search_q', $searchQ);
        $this->smarty->assign('found_patient', $foundPatient);
        $this->smarty->assign('found_appointment', $foundAppointment);
        $this->smarty->assign('doctors', []);
        $this->smarty->display('receptionist/checkin.tpl');
    }

    private function queue()
    {
        // TODO: Query today's queue from MongoDB
        $this->smarty->assign('queue', []);
        $this->smarty->assign('count', ['waiting'=>0,'in_progress'=>0,'done'=>0]);
        $this->smarty->display('receptionist/queue.tpl');
    }

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

        $filter = ['status' => $_GET['status'] ?? '', 'q' => $_GET['q'] ?? '', 'date' => $_GET['date'] ?? '', 'doctor_id' => $_GET['doctor_id'] ?? ''];
        $this->smarty->assign('appointments', []);
        $this->smarty->assign('count', ['all'=>0,'pending'=>0,'confirmed'=>0]);
        $this->smarty->assign('doctors', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('receptionist/appointments.tpl');
    }

    private function walkIn()
    {
        $searchQ = $_GET['q'] ?? '';
        $foundPatient = null;

        if ($searchQ) {
            // TODO: Query patient
            $foundPatient = null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'register') {
            // TODO: Create/update patient + create queue entry
            $queueNo = rand(1, 99);
            $this->smarty->assign('success_message', 'Đăng ký walk-in thành công.');
            $this->smarty->assign('queue_no', $queueNo);
        }

        $this->smarty->assign('search_q', $searchQ);
        $this->smarty->assign('found_patient', $foundPatient);
        $this->smarty->assign('doctors', []);
        $this->smarty->display('receptionist/walk-in.tpl');
    }

    private function patients()
    {
        $filter = ['q' => $_GET['q'] ?? '', 'gender' => $_GET['gender'] ?? ''];
        $this->smarty->assign('patients', []);
        $this->smarty->assign('filter', $filter);
        $this->smarty->display('admin/patients.tpl');
    }

    private function patientNew()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Insert new patient into MongoDB
            $this->smarty->assign('success_message', 'Đã tạo hồ sơ bệnh nhân mới.');
        }
        $this->smarty->assign('patient', []);
        $this->smarty->display('patient/profile.tpl');
    }

    private function doctors()
    {
        $this->smarty->assign('doctors', []);
        $this->smarty->assign('specialties', []);
        $this->smarty->assign('filter', ['q' => '', 'specialty' => '', 'status' => '']);
        $this->smarty->display('admin/doctors.tpl');
    }
}

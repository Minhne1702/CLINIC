<?php

class PatientController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
            header('Location: /CLINIC/public/?page=login');
            exit;
        }

        $user = $_SESSION['user'];
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? $user['username'] ?? 'Bệnh nhân';

        $this->smarty->assign('current_user_name', $name);
        $this->smarty->assign('current_user_role', 'patient');
        $this->smarty->assign('notification_count', 0); // TODO: query unread count
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';

        switch ($page) {
            case 'dashboard':     $this->dashboard();    break;
            case 'book':          $this->book();         break;
            case 'appointments':  $this->appointments(); break;
            case 'records':       $this->records();      break;
            case 'prescriptions': $this->prescriptions();break;
            case 'test-results':  $this->testResults();  break;
            case 'notifications': $this->notifications();break;
            case 'profile':       $this->profile();      break;
            default:              $this->dashboard();    break;
        }
    }

    // ===== DASHBOARD =====
    private function dashboard()
    {
        $userId = $_SESSION['user']['_id'] ?? null;

        // TODO: Query MongoDB - upcoming appointments for this patient
        $upcomingAppointments = [];

        // TODO: Query recent medical records
        $recentRecords = [];

        // TODO: Query unread notifications
        $notifications = [];

        // TODO: Query stats
        $stats = [
            'upcoming'      => count($upcomingAppointments),
            'total_visits'  => 0,
            'prescriptions' => 0,
            'test_results'  => 0,
        ];

        $this->smarty->assign('stats',                 $stats);
        $this->smarty->assign('upcoming_appointments', $upcomingAppointments);
        $this->smarty->assign('recent_records',        $recentRecords);
        $this->smarty->assign('notifications',         $notifications);
        $this->smarty->display('patient/dashboard.tpl');
    }

    // ===== BOOK APPOINTMENT =====
    private function book()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'submit') {

            $specialtyId = $_POST['specialty_id'] ?? '';
            $doctorId    = $_POST['doctor_id']    ?? '';
            $date        = $_POST['date']         ?? '';
            $time        = $_POST['time']         ?? '';
            $type        = $_POST['type']         ?? 'offline';
            $symptoms    = $_POST['symptoms']     ?? '';

            if (!$specialtyId || !$date || !$time) {
                $this->smarty->assign('error_message', 'Vui lòng điền đầy đủ thông tin bắt buộc.');
            } else {
                // TODO: Insert appointment into MongoDB
                $code = 'APT' . date('Ymd') . strtoupper(substr(uniqid(), -4));

                // TODO: Send SMS/Email confirmation

                $this->smarty->assign('success_message',
                    "Đặt lịch thành công! Mã lịch hẹn: <strong>{$code}</strong>. Chúng tôi sẽ xác nhận trong 30 phút."
                );
            }
        }

        // TODO: Query specialties from MongoDB
        $specialties = [];

        // TODO: Query doctors (filter by specialty if provided)
        $doctors = [];

        $this->smarty->assign('specialties', $specialties);
        $this->smarty->assign('doctors',     $doctors);
        $this->smarty->display('patient/book.tpl');
    }

    // ===== APPOINTMENTS =====
    private function appointments()
    {
        $action = $_GET['action'] ?? '';
        $id     = $_GET['id']     ?? null;

        if ($action === 'cancel' && $id) {
            // TODO: Check 2-hour cancellation rule
            // TODO: Update appointment status = cancelled in MongoDB
            $this->smarty->assign('success_message', 'Đã hủy lịch hẹn thành công.');
        }

        $filter = ['status' => $_GET['status'] ?? ''];

        // TODO: Query appointments from MongoDB filtered by patient_id + status
        $appointments = [];
        $count = [
            'all'       => 0,
            'pending'   => 0,
            'confirmed' => 0,
            'completed' => 0,
            'cancelled' => 0,
        ];

        $this->smarty->assign('appointments', $appointments);
        $this->smarty->assign('count',        $count);
        $this->smarty->assign('filter',       $filter);
        $this->smarty->display('patient/appointments.tpl');
    }

    // ===== MEDICAL RECORDS =====
    private function records()
    {
        $recordId = $_GET['id']     ?? null;
        $aptId    = $_GET['apt_id'] ?? null;

        if ($recordId || $aptId) {
            // TODO: Query single record with prescription + lab results + images
            $lookupId = $recordId ?? $aptId;
            $record   = null; // TODO: MongoDB query

            $this->smarty->assign('record',  $record);
            $this->smarty->assign('records', null);
        } else {
            // TODO: Query all records for this patient, newest first
            $records = [];

            $this->smarty->assign('record',  null);
            $this->smarty->assign('records', $records);
        }

        $this->smarty->display('patient/records.tpl');
    }

    // ===== PRESCRIPTIONS =====
    private function prescriptions()
    {
        $rxId     = $_GET['id']        ?? null;
        $recordId = $_GET['record_id'] ?? null;

        if ($rxId || $recordId) {
            $lookupId = $rxId ?? $recordId;
            // TODO: Query single prescription with drug details from MongoDB
            $prescription = null;

            $this->smarty->assign('prescription',  $prescription);
            $this->smarty->assign('prescriptions', null);
        } else {
            // TODO: Query all prescriptions for this patient
            $prescriptions = [];

            $this->smarty->assign('prescription',  null);
            $this->smarty->assign('prescriptions', $prescriptions);
        }

        $this->smarty->display('patient/prescriptions.tpl');
    }

    // ===== TEST RESULTS =====
    private function testResults()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            // TODO: Query single test result from MongoDB
            $this->smarty->assign('test_result',  null);
            $this->smarty->assign('test_results', null);
        } else {
            $filter = [
                'q'         => $_GET['q']         ?? '',
                'date_from' => $_GET['date_from'] ?? '',
                'date_to'   => $_GET['date_to']   ?? '',
            ];
            // TODO: Query all test results for this patient
            $this->smarty->assign('test_result',  null);
            $this->smarty->assign('test_results', []);
            $this->smarty->assign('filter', $filter);
        }

        $this->smarty->display('patient/test-results.tpl');
    }

    // ===== NOTIFICATIONS =====
    private function notifications()
    {
        $action = $_GET['action'] ?? '';

        if ($action === 'mark-all-read') {
            // TODO: Update all notifications is_read = true for this patient
        }

        // TODO: Query all notifications for this patient, newest first
        $notifications = [];
        $unreadCount   = 0;

        $this->smarty->assign('notifications', $notifications);
        $this->smarty->assign('unread_count',  $unreadCount);
        $this->smarty->display('patient/notifications.tpl');
    }

    // ===== PROFILE =====
    private function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tab = $_POST['tab'] ?? 'info';

            switch ($tab) {
                case 'info':
                    // TODO: Update patient personal info in MongoDB
                    $this->smarty->assign('success_message', 'Đã cập nhật thông tin cá nhân thành công.');
                    break;

                case 'health':
                    // TODO: Update health info
                    $this->smarty->assign('success_message', 'Đã cập nhật thông tin sức khỏe thành công.');
                    break;

                case 'allergy':
                    // TODO: Update allergy info
                    $this->smarty->assign('success_message', 'Đã cập nhật thông tin dị ứng thành công.');
                    break;

                case 'security':
                    $newPw  = $_POST['new_password']     ?? '';
                    $confPw = $_POST['confirm_password'] ?? '';
                    $curPw  = $_POST['current_password'] ?? '';

                    if (empty($curPw) || empty($newPw)) {
                        $this->smarty->assign('error_message', 'Vui lòng điền đầy đủ thông tin.');
                    } elseif ($newPw !== $confPw) {
                        $this->smarty->assign('error_message', 'Mật khẩu xác nhận không khớp.');
                    } elseif (strlen($newPw) < 8) {
                        $this->smarty->assign('error_message', 'Mật khẩu mới phải có ít nhất 8 ký tự.');
                    } else {
                        // TODO: Verify current password with bcrypt
                        // TODO: Update password hash in MongoDB
                        $this->smarty->assign('success_message', 'Đã đổi mật khẩu thành công.');
                    }
                    break;
            }
        }

        // TODO: Query patient profile from MongoDB by session user id
        $patient = [
            '_id'          => $_SESSION['user']['_id'] ?? null,
            'full_name'    => $_SESSION['user']['full_name']  ?? $_SESSION['user']['fullName']  ?? '',
            'email'        => $_SESSION['user']['email']      ?? '',
            'phone'        => $_SESSION['user']['phone']      ?? '',
            'patient_code' => $_SESSION['user']['patient_code'] ?? '',
        ];

        $this->smarty->assign('patient', $patient);
        $this->smarty->display('patient/profile.tpl');
    }
}

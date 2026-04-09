<?php

class PatientController
{
    private $smarty;
    private $db;
    private $baseUrl;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db     = $db;
        $this->baseUrl = '/public'; 

        $page = $_GET['page'] ?? 'dashboard';
        
        // Các trang Guest được phép vào
        $publicPages = ['home', 'contact', 'services', 'doctors', 'about', 'appointments', 'book'];

        if (!in_array($page, $publicPages)) {
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
                header('Location: ' . $this->baseUrl . '/?page=login');
                exit;
            }
        }

        $user = $_SESSION['user'] ?? null;
        $name = $user['full_name'] ?? $user['fullName'] ?? $user['name'] ?? 'Khách';
        
        $this->smarty->assign('BASE_URL', $this->baseUrl);
        $this->smarty->assign('current_user_name', $name);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';

        switch ($page) {
            // --- XỬ LÝ CÁC FILE TRONG THƯ MỤC GUEST ---
            case 'home':
            case 'contact':
            case 'services':
            case 'doctors':
            case 'about':
                $this->smarty->display("guest/{$page}.tpl");
                break;

            case 'appointments': 
            case 'book':
                // Nếu chưa đăng nhập -> Trang đặt lịch cho khách
                if (!isset($_SESSION['user'])) {
                    $this->guestBooking(); 
                } else {
                    // Nếu đã đăng nhập -> Chạy đúng hàm của Bệnh nhân
                    if ($page === 'book') {
                        $this->book();
                    } else {
                        $this->appointments();
                    }
                }
                break;

            // --- XỬ LÝ CÁC FILE TRONG THƯ MỤC PATIENT ---
            case 'dashboard':     $this->dashboard();    break;
            case 'records':       $this->records();      break;
            case 'prescriptions': $this->prescriptions();break;
            case 'test-results':  $this->testResults();  break;
            case 'notifications': $this->notifications();break;
            case 'profile':       $this->profile();      break;
            
            default:              $this->dashboard();    break;
        }
    }

    // Hàm gọi giao diện cho Khách chưa đăng nhập
    private function guestBooking() {
        $this->smarty->display('guest/appointments.tpl');
    }

    // ===== 1. TỔNG QUAN (DASHBOARD) =====
    private function dashboard()
    {
        $userId = $_SESSION['user']['_id'] ?? null;

        // TODO: Query MongoDB - Lấy thông tin lịch khám TRONG NGÀY HÔM NAY
        $todayVisit = null; 

        // TODO: Query MongoDB - Lịch hẹn sắp tới
        $upcomingAppointments = []; 

        // TODO: Query MongoDB - Lịch sử khám gần đây
        $recentRecords = [];

        // TODO: Query MongoDB - Thông báo mới
        $notifications = [];

        // ĐÃ SỬA: Thay unpaid_bills bằng records
        $stats = [
            'upcoming'      => count($upcomingAppointments),
            'records'       => count($recentRecords), 
            'prescriptions' => 0,
            'test_results'  => 0
        ];

        // Gán dữ liệu ra View
        $this->smarty->assign('today_visit',           $todayVisit);
        $this->smarty->assign('stats',                 $stats);
        $this->smarty->assign('upcoming_appointments', $upcomingAppointments);
        $this->smarty->assign('recent_records',        $recentRecords);
        $this->smarty->assign('notifications',         $notifications);
        
        $this->smarty->display('patient/dashboard.tpl');
    }

    // ===== 2. ĐẶT LỊCH KHÁM (BOOK APPOINTMENT) =====
    private function book() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'submit') {
            $code = 'APT' . date('Ymd') . rand(1000, 9999);
            $this->smarty->assign('success_message', "Đặt lịch thành công! Mã lịch hẹn của bạn là: <strong>{$code}</strong>. Bộ phận CSKH sẽ xác nhận trong ít phút.");
        }

        $specialties = [];
        if ($this->db) {
            $specCursor = $this->db->selectCollection('specialties')->find(['is_active' => true]);
            foreach ($specCursor as $doc) {
                $specialties[] = (array)$doc;
            }
        }

        $doctors = [];
        if ($this->db) {
            $docCursor = $this->db->selectCollection('users')->find(['role' => 'doctor']);
            foreach ($docCursor as $doc) {
                $d = (array)$doc;
                $d['full_name'] = $d['fullName'] ?? 'Bác sĩ'; 
                $doctors[] = $d;
            }
        }

        $this->smarty->assign('specialties', $specialties);
        $this->smarty->assign('doctors', $doctors);
        $this->smarty->display('patient/book.tpl'); 
    }
    // ===== 3. QUẢN LÝ LỊCH HẸN (APPOINTMENTS) =====
    private function appointments()
    {
        $action = $_GET['action'] ?? '';
        $id     = $_GET['id']     ?? null;

        if ($action === 'cancel' && $id) {
            $this->smarty->assign('success_message', 'Đã hủy lịch hẹn thành công.');
        }

        $filter = ['status' => $_GET['status'] ?? 'all'];

        // DỮ LIỆU MẪU (Mock Data) ĐỂ TEST GIAO DIỆN TIMELINE QR
        $appointments = [
            [
                'id' => 'apt_1', 'code' => 'APT88219', 'doctor_name' => 'Nguyễn Văn Huy', 'specialty' => 'Tim mạch',
                'date' => date('Y-m-d', strtotime('+1 day')), 'time' => '08:00 - 08:30', 
                'status' => 'pending', 'status_text' => 'Chờ xác nhận', 'type' => 'offline'
            ],
            [
                'id' => 'apt_2', 'code' => 'APT99234', 'doctor_name' => 'Trần Thị Bé', 'specialty' => 'Nhi khoa',
                'date' => date('Y-m-d'), 'time' => '09:00 - 09:30', 
                'status' => 'waiting', 'status_text' => 'Chờ khám', 'type' => 'offline'
            ],
            [
                'id' => 'apt_3', 'code' => 'APT11223', 'doctor_name' => 'Lê Hoàng Minh', 'specialty' => 'Da liễu',
                'date' => date('Y-m-d'), 'time' => '10:00 - 10:30', 
                'status' => 'consulting', 'status_text' => 'Đang khám', 'type' => 'offline'
            ],
            [
                'id' => 'apt_4', 'code' => 'APT55432', 'doctor_name' => 'Phạm Ngọc Hà', 'specialty' => 'Tiêu hóa',
                'date' => date('Y-m-d', strtotime('-1 day')), 'time' => '14:00 - 14:30', 
                'status' => 'completed', 'status_text' => 'Hoàn thành', 'type' => 'offline'
            ]
        ];

        // Đếm số lượng theo status
        $count = [
            'all'       => count($appointments),
            'pending'   => 1,
            'confirmed' => 3, 
            'cancelled' => 0,
        ];

        $this->smarty->assign('appointments', $appointments);
        $this->smarty->assign('appointments_json', json_encode($appointments)); // Truyền JSON để Javascript đọc
        $this->smarty->assign('count',        $count);
        $this->smarty->assign('filter',       $filter);
        $this->smarty->display('patient/appointments.tpl');
    }

    // ===== 4. HỒ SƠ BỆNH ÁN (RECORDS / EMR) =====
    private function records()
    {
        $recordId = $_GET['id']     ?? null;
        $aptId    = $_GET['apt_id'] ?? null;

        if ($recordId || $aptId) {
            $lookupId = $recordId ?? $aptId;
            $record   = null; 

            $this->smarty->assign('record',  $record);
            $this->smarty->assign('records', null);
        } else {
            $records = [];

            $this->smarty->assign('record',  null);
            $this->smarty->assign('records', $records);
        }

        $this->smarty->display('patient/records.tpl');
    }

    // ===== 5. ĐƠN THUỐC (PRESCRIPTIONS) =====
    private function prescriptions()
    {
        $rxId     = $_GET['id']        ?? null;
        $recordId = $_GET['record_id'] ?? null;

        if ($rxId || $recordId) {
            $lookupId = $rxId ?? $recordId;
            $prescription = null;

            $this->smarty->assign('prescription',  $prescription);
            $this->smarty->assign('prescriptions', null);
        } else {
            $prescriptions = [];

            $this->smarty->assign('prescription',  null);
            $this->smarty->assign('prescriptions', $prescriptions);
        }

        $this->smarty->display('patient/prescriptions.tpl');
    }
    // ===== 6. KẾT QUẢ XÉT NGHIỆM / CẬN LÂM SÀNG (TEST RESULTS) =====
    private function testResults()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $testResult = null; 

            $this->smarty->assign('test_result',  $testResult);
            $this->smarty->assign('test_results', null);
        } else {
            $filter = [
                'q'         => $_GET['q']         ?? '',
                'date_from' => $_GET['date_from'] ?? '',
                'date_to'   => $_GET['date_to']   ?? '',
            ];
            
            $testResults = [];

            $this->smarty->assign('test_result',  null);
            $this->smarty->assign('test_results', $testResults);
            $this->smarty->assign('filter',       $filter);
        }

        $this->smarty->display('patient/test-results.tpl');
    }

    // ===== 7. THÔNG BÁO HỆ THỐNG (NOTIFICATIONS) =====
    private function notifications()
    {
        $action = $_GET['action'] ?? '';

        if ($action === 'mark-all-read') {
            header('Location: ' . $this->baseUrl . '/?page=notifications');
            exit;
        }

        $notifications = [];
        $unreadCount   = 0;

        $this->smarty->assign('notifications', $notifications);
        $this->smarty->assign('unread_count',  $unreadCount);
        $this->smarty->display('patient/notifications.tpl');
    }

    // ===== 8. HỒ SƠ CÁ NHÂN & BẢO MẬT (PROFILE) =====
    private function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tab = $_POST['tab'] ?? 'info';

            switch ($tab) {
                case 'info':
                    $this->smarty->assign('success_message', 'Đã cập nhật thông tin liên hệ thành công.');
                    break;
                case 'health':
                    $this->smarty->assign('success_message', 'Đã lưu hồ sơ sức khỏe thành công.');
                    break;
                case 'allergy':
                    $this->smarty->assign('success_message', 'Đã cập nhật thông tin dị ứng.');
                    break;
                case 'security':
                    $newPw  = $_POST['new_password']     ?? '';
                    $confPw = $_POST['confirm_password'] ?? '';
                    $curPw  = $_POST['current_password'] ?? '';

                    if (empty($curPw) || empty($newPw) || empty($confPw)) {
                        $this->smarty->assign('error_message', 'Vui lòng điền đầy đủ các trường mật khẩu.');
                    } elseif ($newPw !== $confPw) {
                        $this->smarty->assign('error_message', 'Mật khẩu xác nhận không khớp.');
                    } elseif (strlen($newPw) < 8) {
                        $this->smarty->assign('error_message', 'Mật khẩu mới phải có ít nhất 8 ký tự.');
                    } else {
                        $this->smarty->assign('success_message', 'Đã đổi mật khẩu thành công. Lần đăng nhập tới hãy sử dụng mật khẩu mới.');
                    }
                    break;
            }
        }

        $patient = [
            '_id'              => $_SESSION['user']['_id'] ?? null,
            'full_name'        => $_SESSION['user']['full_name']  ?? $_SESSION['user']['fullName'] ?? '',
            'email'            => $_SESSION['user']['email']      ?? '',
            'phone'            => $_SESSION['user']['phone']      ?? '',
            'patient_code'     => $_SESSION['user']['patient_code'] ?? 'BN' . time(),
            'gender'           => 'male',
            'blood_type'       => 'O+',
            'drug_allergies'   => '', 
        ];

        $this->smarty->assign('patient', $patient);
        $this->smarty->display('patient/profile.tpl');
    }
}
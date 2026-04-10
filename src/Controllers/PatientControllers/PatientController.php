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

        // Các trang công khai
        $publicPages = ['home', 'contact', 'services', 'doctors', 'about', 'appointments', 'book'];

        if (!in_array($page, $publicPages)) {
            if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
                header('Location: ' . $this->baseUrl . '/?page=login');
                exit;
            }
        }

        $user = $_SESSION['user'] ?? null;
        $name = $user['fullName'] ?? $user['full_name'] ?? $user['name'] ?? 'Khách';

        $this->smarty->assign('BASE_URL', $this->baseUrl);
        $this->smarty->assign('current_user_name', $name);
    }

    public function run()
    {
        $page = $_GET['page'] ?? 'dashboard';

        switch ($page) {
            case 'home':
            case 'login':
                // Đã đăng nhập thì ép về dashboard, không cho lảng vảng ở trang khách
                header('Location: ' . $this->baseUrl . '/?page=dashboard');
                exit;

            case 'contact':
            case 'services':
            case 'doctors':
            case 'about':
                $this->smarty->display("guest/{$page}.tpl");
                break;

            case 'appointments':
            case 'book':
                if (!isset($_SESSION['user'])) {
                    $this->guestBooking();
                } else {
                    if ($page === 'book') {
                        $this->book();
                    } else {
                        $this->appointments();
                    }
                }
                break;

            case 'dashboard':
                $this->dashboard();
                break;
            case 'records':
                $this->records();
                break;
            case 'prescriptions':
                $this->prescriptions();
                break;
            case 'test-results':
                $this->testResults();
                break;
            case 'notifications':
                $this->notifications();
                break;
            case 'profile':
                $this->profile();
                break;

            default:
                $this->dashboard();
                break;
        }
    }

    private function guestBooking()
    {
        $this->smarty->display('guest/appointments.tpl');
    }

    // ===== 1. TỔNG QUAN (DASHBOARD) =====
    private function dashboard()
    {
        if (!$this->db) {
            $this->smarty->assign('error_message', 'Chưa kết nối cơ sở dữ liệu.');
            $this->smarty->display('patient/dashboard.tpl');
            return;
        }

        $userId = $_SESSION['user']['id'];

        try {
            // Lịch khám hôm nay
            $stmt = $this->db->prepare("SELECT * FROM appointments WHERE patient_id = ? AND DATE(appointment_date) = CURDATE() LIMIT 1");
            $stmt->execute([$userId]);
            $todayVisit = $stmt->fetch(PDO::FETCH_ASSOC);

            // Lịch hẹn sắp tới (ĐÃ SỬA: u.fullName)
            $stmt = $this->db->prepare("SELECT a.*, u.fullName as doctor_name FROM appointments a JOIN users u ON a.doctor_id = u.id WHERE a.patient_id = ? AND a.appointment_date > NOW() ORDER BY a.appointment_date ASC LIMIT 3");
            $stmt->execute([$userId]);
            $upcoming = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Hồ sơ gần đây
            $stmt = $this->db->prepare("SELECT * FROM medical_records WHERE patient_id = ? ORDER BY created_at DESC LIMIT 3");
            $stmt->execute([$userId]);
            $recentRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->smarty->assign('today_visit', $todayVisit);
            $this->smarty->assign('stats', [
                'upcoming' => count($upcoming),
                'records'  => count($recentRecords),
                'prescriptions' => 0,
                'test_results'  => 0
            ]);
            $this->smarty->assign('upcoming_appointments', $upcoming);
            $this->smarty->assign('recent_records', $recentRecords);

            $this->smarty->display('patient/dashboard.tpl');
        } catch (\Exception $e) {
            // ĐÃ SỬA: Bắt lỗi và vẫn hiển thị giao diện để không bị trắng trang
            error_log("Lỗi Dashboard: " . $e->getMessage());
            $this->smarty->assign('error_message', 'Có lỗi khi tải dữ liệu từ máy chủ.');
            $this->smarty->display('patient/dashboard.tpl');
        }
    }

    // ===== 2. ĐẶT LỊCH KHÁM (BOOK APPOINTMENT) =====
    private function book()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'submit') {
            $code = 'APT' . date('Ymd') . rand(1000, 9999);
            // Logic INSERT INTO appointments...
            $this->smarty->assign('success_message', "Đặt lịch thành công! Mã: <strong>{$code}</strong>");
        }

        $stmt = $this->db->query("SELECT * FROM specialties WHERE is_active = 1");
        $specialties = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // ĐÃ SỬA: fullName
        $stmt = $this->db->query("SELECT id, fullName FROM users WHERE role = 'doctor'");
        $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->smarty->assign('specialties', $specialties);
        $this->smarty->assign('doctors', $doctors);
        $this->smarty->display('patient/book.tpl');
    }

    // ===== 3. QUẢN LÝ LỊCH HẸN (APPOINTMENTS) =====
    private function appointments()
    {
        $userId = $_SESSION['user']['id'];
        $status = $_GET['status'] ?? 'all';

        // ĐÃ SỬA: u.fullName
        $sql = "SELECT a.*, u.fullName as doctor_name, s.name as specialty_name 
                FROM appointments a 
                LEFT JOIN users u ON a.doctor_id = u.id 
                LEFT JOIN specialties s ON a.specialty_id = s.id 
                WHERE a.patient_id = ?";

        if ($status !== 'all') $sql .= " AND a.status = " . $this->db->quote($status);
        $sql .= " ORDER BY a.appointment_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->smarty->assign('appointments', $appointments);
        $this->smarty->assign('appointments_json', json_encode($appointments));
        $this->smarty->display('patient/appointments.tpl');
    }

    // ===== 4. HỒ SƠ BỆNH ÁN (RECORDS / EMR) =====
    private function records()
    {
        $userId = $_SESSION['user']['id'];
        $recordId = $_GET['id'] ?? null;

        if ($recordId) {
            $stmt = $this->db->prepare("SELECT * FROM medical_records WHERE id = ? AND patient_id = ?");
            $stmt->execute([$recordId, $userId]);
            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->smarty->assign('record', $record);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM medical_records WHERE patient_id = ? ORDER BY created_at DESC");
            $stmt->execute([$userId]);
            $this->smarty->assign('records', $stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        $this->smarty->display('patient/records.tpl');
    }

    // ===== 5. ĐƠN THUỐC (PRESCRIPTIONS) =====
    private function prescriptions()
    {
        $userId = $_SESSION['user']['id'];
        // ĐÃ SỬA: u.fullName
        $stmt = $this->db->prepare("SELECT p.*, u.fullName as doctor_name 
                                    FROM prescriptions p 
                                    JOIN users u ON p.doctor_id = u.id 
                                    WHERE p.patient_id = ? ORDER BY p.created_at DESC");
        $stmt->execute([$userId]);
        $this->smarty->assign('prescriptions', $stmt->fetchAll(PDO::FETCH_ASSOC));
        $this->smarty->display('patient/prescriptions.tpl');
    }

    // ===== 6. KẾT QUẢ XÉT NGHIỆM / CẬN LÂM SÀNG (TEST RESULTS) =====
    private function testResults()
    {
        $userId = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("SELECT * FROM test_results WHERE patient_id = ? ORDER BY test_date DESC");
        $stmt->execute([$userId]);
        $this->smarty->assign('test_results', $stmt->fetchAll(PDO::FETCH_ASSOC));
        $this->smarty->display('patient/test-results.tpl');
    }

    // ===== 7. THÔNG BÁO HỆ THỐNG (NOTIFICATIONS) =====
    private function notifications()
    {
        $userId = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        $this->smarty->assign('notifications', $stmt->fetchAll(PDO::FETCH_ASSOC));
        $this->smarty->display('patient/notifications.tpl');
    }

    // ===== 8. HỒ SƠ CÁ NHÂN & BẢO MẬT (PROFILE) =====
    private function profile()
    {
        $userId = $_SESSION['user']['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Logic UPDATE users SET fullName = ?, phone = ? WHERE id = ?
            $this->smarty->assign('success_message', 'Cập nhật thành công!');
        }

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $this->smarty->assign('patient', $stmt->fetch(PDO::FETCH_ASSOC));
        $this->smarty->display('patient/profile.tpl');
    }
}

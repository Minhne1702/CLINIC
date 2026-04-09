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
            header('Location: ' . BASE_URL . '/?page=login'); exit;
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
        $queueId   = $_GET['queue_id'] ?? 'Q-123'; 
        $patientId = $_GET['patient_id'] ?? 'P-TEST';

        // 1. XỬ LÝ KHI BÁC SĨ ẤN NÚT "HOÀN TẤT" HOẶC "LƯU NHÁP"
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['exam_status'] ?? 'draft';
            // TODO: Kết nối DB để lưu...
            
            if ($status === 'completed') {
                $this->smarty->assign('success_message', '✅ Đã hoàn tất khám. Trạng thái bệnh nhân đã chuyển thành "Chờ thanh toán".');
            } else {
                $this->smarty->assign('success_message', '💾 Đã lưu nháp hồ sơ bệnh án thành công.');
            }
        }

        // =====================================================================
        // 2. GIẢ LẬP DỮ LIỆU BỆNH NHÂN (Đã sửa lại key cho khớp 100% với .tpl)
        // =====================================================================
        $patient = [
            '_id'             => $patientId,
            'patient_code'    => 'BN-12345',
            'full_name'       => 'Bệnh Nhân Test',
            'birthday'        => '1990-05-15',
            'gender'          => 'male',      // File .tpl của bạn đang check if == 'male'
            'blood_type'      => 'O+',
            'bhyt_code'       => 'DN40123456789',
            'drug_allergies'  => 'Dị ứng Penicillin',
            'medical_history' => 'Viêm dạ dày mãn tính',
            'weight'          => 68
        ];

        // 3. TRUYỀN DATA RA VIEW
        $this->smarty->assign('patient', $patient);
        $this->smarty->assign('queue_id', $queueId);
        
        // Truyền thêm các mảng rỗng này để file .tpl không bị lỗi "Undefined variable" 
        // ở các phần Sinh hiệu ($exam) và Lịch sử khám ($recent_records)
        $this->smarty->assign('exam', []); 
        // Khởi tạo sẵn các mảng rỗng để View không bị lỗi Undefined array key
        $this->smarty->assign('exam', [
            'prescription_drugs' => [],
            'lab_orders'         => []
        ]);
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
        // Lấy thông tin user từ session
        $user = $_SESSION['user'];
        // Lấy ID linh hoạt: ưu tiên _id (MongoDB), nếu không có thì lấy id (MySQL), nếu vẫn không có thì gán mặc định để tránh lỗi
        $doctorId = $user['_id'] ?? $user['id'] ?? 'unknown_doctor';

        // 1. Xử lý khi bác sĩ Submit form đăng ký/cập nhật lịch
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $scheduleData = $_POST['schedule'] ?? [];
            
            // TODO: Validate và Lưu vào DB với $doctorId
            
            $this->smarty->assign('success_message', 'Đã đăng ký/cập nhật lịch làm việc thành công!');
        }

        // 2. Lấy lịch hiện tại từ DB để hiển thị lên View
        // TODO: Query db lấy lịch làm việc tuần này của $doctorId
        $currentScheduleFromDB = []; // Giả sử query ra được kết quả

        // 3. Khởi tạo mảng chuẩn 7 ngày
        $standardSchedule = [];
        for ($i = 0; $i < 7; $i++) {
            $standardSchedule[$i] = [
                'morning'   => $currentScheduleFromDB[$i]['morning'] ?? false,
                'afternoon' => $currentScheduleFromDB[$i]['afternoon'] ?? false,
                'evening'   => $currentScheduleFromDB[$i]['evening'] ?? false, 
                'room'      => $currentScheduleFromDB[$i]['room'] ?? '',
                'note'      => $currentScheduleFromDB[$i]['note'] ?? ''
            ];
        }

        $this->smarty->assign('schedule', $standardSchedule);
        $this->smarty->display('doctor/schedule.tpl');
    }
    private function profile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Update doctor profile
            $this->smarty->assign('success_message', 'Đã cập nhật hồ sơ.');
        }
        $this->smarty->assign('doctor', []);
        $this->smarty->display('doctor/profile.tpl');
    }
}

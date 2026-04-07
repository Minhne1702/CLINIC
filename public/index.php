<?php
// 1. Cấu hình hiển thị lỗi và session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// 2. Nạp Composer Autoload lên ĐẦU TIÊN (Để PHP biết Smarty là ai)
require_once __DIR__ . '/../vendor/autoload.php';

// 3. Khai báo sử dụng Class
use Smarty\Smarty;

// 4. Khởi tạo Smarty (Chỉ cần 1 lần duy nhất)
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates_c/');

// 5. Định nghĩa và gán biến đường dẫn
define('BASE_URL', 'http://localhost:3000/public');
$smarty->assign('BASE_URL', BASE_URL);

// 6. Nạp các file cấu hình và logic khác
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Models/UserModel.php';
require_once __DIR__ . '/../src/Controllers/AuthControllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/HomeController.php';

// 7. Khởi tạo Database và Controllers
$db = (new Database())->getDb();
$userModel      = new UserModel($db);
$authController = new AuthController($userModel, $smarty);
$homeController = new HomeController($smarty);

// --- Logout ---
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController->logout();
    exit;
}

// --- Router cho người dùng đã đăng nhập ---
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    switch ($role) {
        case 'admin':
            require_once __DIR__ . '/../src/Controllers/AdminControllers/AdminController.php';
            (new AdminController($smarty, $db))->run();
            break;
        case 'doctor':
            require_once __DIR__ . '/../src/Controllers/DoctorControllers/DoctorController.php';
            (new DoctorController($smarty, $db))->run();
            break;
        case 'patient':
            require_once __DIR__ . '/../src/Controllers/PatientControllers/PatientController.php';
            (new PatientController($smarty, $db))->run();
            break;
        case 'receptionist':
            require_once __DIR__ . '/../src/Controllers/ReceptionistControllers/ReceptionistController.php';
            (new ReceptionistController($smarty, $db))->run();
            break;
        case 'cashier':
            require_once __DIR__ . '/../src/Controllers/CashierControllers/CashierController.php';
            (new CashierController($smarty, $db))->run();
            break;
        case 'pharmacist':
            require_once __DIR__ . '/../src/Controllers/PharmacyControllers/PharmacyController.php';
            (new PharmacyController($smarty, $db))->run();
            break;
    }
    exit;
}

// --- Router cho khách (Guest) ---
$page = $_GET['page'] ?? '';

switch ($page) {
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'forgot-password':
        $authController->forgotPassword();
        break;
    case 'google-auth':
        $authController->googleLogin();
        break;
    case 'about':
        $smarty->assign('active_page', 'about');
        $smarty->display('guest/about.tpl');
        break;
    case 'doctors':
        $smarty->assign('active_page', 'doctors');
        $smarty->assign('doctors', []);
        $smarty->display('guest/doctors.tpl');
        break;
    case 'services':
        $smarty->assign('active_page', 'services');
        $smarty->assign('services', []);
        $smarty->display('guest/services.tpl');
        break;
    case 'appointments':
        $smarty->assign('active_page', 'appointments');
        $smarty->display('guest/appointments.tpl');
        break;
    case 'contact':
        $smarty->assign('active_page', 'contact');
        $smarty->display('guest/contact.tpl');
        break;
    default:
        $homeController->index();
        break;
}

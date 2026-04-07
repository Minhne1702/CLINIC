<?php

use Smarty\Smarty;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Models/UserModel.php';
require_once __DIR__ . '/../src/Controllers/AuthControllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/HomeController.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates_c/');

$db = (new Database())->getDb();
$userModel    = new UserModel($db);
$authController = new AuthController($userModel, $smarty);
$homeController = new HomeController($smarty);

// --- Logout ---
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController->logout();
    exit;
}

// --- Đã đăng nhập → chuyển vào dashboard theo role ---
if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    switch ($role) {
        case 'admin':
            require_once __DIR__ . '/../src/Controllers/AdminControllers/AdminController.php';
            $adminController = new AdminController($smarty, $db);
            $adminController->run();
            break;
        case 'doctor':
            require_once __DIR__ . '/../src/Controllers/DoctorControllers/DoctorController.php';
            $ctrl = new DoctorController($smarty, $db);
            $ctrl->run();
            break;
        case 'patient':
            require_once __DIR__ . '/../src/Controllers/PatientControllers/PatientController.php';
            $patientController = new PatientController($smarty, $db);
            $patientController->run();
            break;
        case 'receptionist':
            require_once __DIR__ . '/../src/Controllers/ReceptionistControllers/ReceptionistController.php';
            $ctrl = new ReceptionistController($smarty, $db);
            $ctrl->run();
            break;
        case 'cashier':
            require_once __DIR__ . '/../src/Controllers/CashierControllers/CashierController.php';
            $ctrl = new CashierController($smarty, $db);
            $ctrl->run();
            break;
        case 'pharmacist':
            require_once __DIR__ . '/../src/Controllers/PharmacyControllers/PharmacyController.php';
            $ctrl = new PharmacyController($smarty, $db);
            $ctrl->run();
            break;
    }
    exit;
}

// --- Guest router ---
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
        $smarty->assign('doctors', []);   // TODO: query MongoDB
        $smarty->display('guest/doctors.tpl');
        break;

    case 'services':
        $smarty->assign('active_page', 'services');
        $smarty->assign('services', []);  // TODO: query MongoDB
        $smarty->display('guest/services.tpl');
        break;

    case 'appointments':
        $smarty->assign('active_page', 'appointments');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: xử lý lưu lịch hẹn vào MongoDB
            $smarty->assign('success_message', 'Đặt lịch thành công! Chúng tôi sẽ xác nhận trong 30 phút.');
        }
        $smarty->display('guest/appointments.tpl');
        break;

    case 'contact':
        $smarty->assign('active_page', 'contact');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: xử lý gửi email liên hệ
            $smarty->assign('success_message', 'Tin nhắn đã được gửi! Chúng tôi sẽ phản hồi sớm nhất.');
        }
        $smarty->display('guest/contact.tpl');
        break;

    default:
        $homeController->index();
        break;
}

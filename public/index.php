<?php

use Smarty\Smarty;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../src/Models/UserModel.php';
require_once __DIR__ . '/../src/Controllers/AuthControllers/AuthController.php';
require_once __DIR__ . '/../config/config.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates/');
$smarty->setCompileDir(__DIR__ . '/../templates_c/');

$db = (new Database())->getDb();
$userModel = new UserModel($db);
$authController = new AuthController($userModel, $smarty);

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController->logout();
}

if (isset($_SESSION['user'])) {
    $role = $_SESSION['user']['role'];
    switch ($role) {
        case 'admin':
            require_once __DIR__ . '/../src/Controllers/AdminControllers/AdminController.php';
            break;
        case 'doctor':
            require_once __DIR__ . '/../src/Controllers/DoctorControllers/DoctorController.php';
            break;
        case 'patient':
            require_once __DIR__ . '/../src/Controllers/PatientControllers/PatientController.php';
            break;
        case 'receptionist':
            require_once __DIR__ . '/../src/Controllers/ReceptionistControllers/ReceptionistController.php';
            break;
        case 'cashier':
            require_once __DIR__ . '/../src/Controllers/CashierControllers/CashierController.php';
            break;
        case 'pharmacist':
            require_once __DIR__ . '/../src/Controllers/PharmacyControllers/PharmacyController.php';
            break;
    }
    exit;
}

$page = $_GET['page'] ?? '';

switch ($page) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'about':
        $smarty->display('guest/about.tpl');
        break;
    case 'doctors':
        $smarty->display('guest/doctors.tpl');
        break;
    case 'google-auth':
        $authController->googleLogin();
        break;
    case 'appointments':
        $smarty->display('guest/appointments.tpl');
        break;
    case 'contact':
        $smarty->display('guest/contact.tpl');
        break;
    case 'services':
        $smarty->display('guest/services.tpl');
        break;
    case 'forgot-password':
        $authController->forgotPassword();
        break;
    default:
        $smarty->display('guest/home.tpl');
        break;
}
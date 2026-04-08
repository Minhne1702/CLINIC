<?php
namespace Controllers\AuthControllers;

use MongoDB\BSON\UTCDateTime;
use Google\Service\Oauth2;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use Twilio\Rest\Client;
class AuthController
{
    private $userModel;
    private $smarty;
    // private $twilioSid;
    // private $twilioToken;
    // private $verifySid;

    public function __construct($userModel, $smarty)
    {
        $this->userModel = $userModel;
        $this->smarty = $smarty;
        // $this->twilioSid = $_SERVER['TWILIO_SID'] ?? getenv('TWILIO_SID');
        // $this->twilioToken = $_SERVER['TWILIO_TOKEN'] ?? getenv('TWILIO_TOKEN');
        // $this->verifySid = $_SERVER['TWILIO_VERIFY_SID'] ?? getenv('TWILIO_VERIFY_SID');
    }

    public function login()
    {
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_login'])) {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => (string)$user['_id'],
                    'email' => $user['email'],
                    'fullName' => $user['fullName'],
                    'role' => $user['role'],
                ];
                header("Location: index.php");
                exit;
            }
            $error_message = "Email hoặc mật khẩu không chính xác!";
        }
        $this->smarty->assign('error_message', $error_message);
        $this->smarty->display('guest/login.tpl');
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_register'])) {
        $email = trim($_POST['email'] ?? '');
        $fullName = $_POST['fullName'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm_password) {
            $this->smarty->assign('error_message', 'Mật khẩu xác nhận không khớp!');
            $this->smarty->display('guest/register.tpl');
            return;
        }

        if ($this->userModel->checkEmailExists($email)) {
            $this->smarty->assign('error_message', 'Email này đã tồn tại!');
            $this->smarty->assign('form', $_POST); 
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $userData = [
                'fullName' => $fullName,
                'phone'    => $phone,
                'email'    => $email,
                'password' => $hashedPassword,
                'role'     => 'patient',
                'createdAt' => new UTCDateTime()
            ];

            $userId = $this->userModel->createUser($userData);

            if ($userId) {
                $_SESSION['user'] = [
                    'id'       => (string) $userId,
                    'email'    => $email,
                    'fullName' => $fullName,
                    'role'     => 'patient',
                ];

                header("Location: index.php");
                exit;
            }
        }
    }
    $this->smarty->display('guest/register.tpl');
}

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    public function googleLogin()
    {
        require_once __DIR__ . '/../../../vendor/autoload.php';

        $client = new \Google\Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URL']);
        $client->addScope("email");
        $client->addScope("profile");

        $httpClient = new \GuzzleHttp\Client([
            'verify' => false
        ]);
        $client->setHttpClient($httpClient);

        if (!isset($_GET['code'])) {
            $authUrl = $client->createAuthUrl();
            header("Location: " . $authUrl);
            exit;
        }

        else {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);

            $googleService = new Oauth2($client);
            $data = $googleService->userinfo->get();

            $email = $data->email;
            $fullName = $data->name;
            $googleId = $data->id;

            $user = $this->userModel->findUserByEmail($email);

            if (!$user) {
                $newUser = [
                    'fullName' => $fullName,
                    'email' => $email,
                    'googleId' => $googleId,
                    'role' => 'patient',
                    'createdAt' => new \MongoDB\BSON\UTCDateTime()
                ];
                $this->userModel->registerUser($newUser);
                $user = $this->userModel->findUserByEmail($email);
            }

            $_SESSION['user'] = [
                'id'       => (string)$user['_id'],
                'email'    => $user['email'],
                'fullName' => $user['fullName'],
                'role'     => $user['role'],
            ];

            header("Location: index.php?page=home");
            exit;
        }
    }
    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_forgot'])) {
            $email = trim($_POST['email'] ?? '');
            $user = $this->userModel->findUserByEmail($email);

            if ($user) {
                if (!isset($user['password'])) {
                    $message = "Tài khoản này đăng nhập bằng Google!";
                    $status = 'error';
                } else {
                    // Tạo mật khẩu mới ngẫu nhiên 8 ký tự
                    $newPassword = substr(str_shuffle('abcdefghjkmnpqrstuvwxyz23456789'), 0, 8);
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                    // Cập nhật vào Database
                    $this->userModel->updateProfile((string)$user['_id'], ['password' => $hashedPassword]);

                    // Gửi Mail
                    if ($this->sendEmail($email, $newPassword)) {
                        $message = "Mật khẩu mới đã được gửi vào Email của bạn!";
                        $status = 'success';
                    } else {
                        $message = "Lỗi hệ thống không thể gửi mail. Vui lòng thử lại sau!";
                        $status = 'error';
                    }
                }
            } else {
                $message = "Email này không tồn tại trên hệ thống!";
                $status = 'error';
            }

            $this->smarty->assign('message', $message);
            $this->smarty->assign('status', $status);
        }
        $this->smarty->display('guest/forgot_password.tpl');
    }

    private function sendEmail($toEmail, $newPass)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            
            // Dùng $_SERVER thay vì $_ENV để đảm bảo lúc nào cũng lấy được dữ liệu
            $mail->Username   = $_SERVER['EMAIL_ACCOUNT'] ?? getenv('EMAIL_ACCOUNT');
            $mail->Password   = $_SERVER['EMAIL_PASSWORD'] ?? getenv('EMAIL_PASSWORD');
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = "UTF-8";

            // Fix lỗi SSL trên Localhost
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Dùng lại biến thay cho $_ENV
            $mail->setFrom($mail->Username, 'MediCare Clinic');
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Khôi phục mật khẩu - MediCare Clinic';
            $mail->Body    = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <h2 style='color: #007bff;'>Mật khẩu mới của bạn</h2>
                <p>Hệ thống vừa cấp lại mật khẩu cho tài khoản <b>$toEmail</b></p>
                <p style='font-size: 20px; background: #f8f9fa; padding: 10px; display: inline-block; border: 1px dashed #ccc;'>
                    Mật khẩu: <b style='color: #d9534f;'>$newPass</b>
                </p>
                <p>Vui lòng đăng nhập và thay đổi mật khẩu ngay để bảo mật.</p>
            </div>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    // private function formatPhoneNumber($phone)
    // {
    //     $phone = trim($phone);
    //     if (strpos($phone, '0') === 0) {
    //         return '+84' . substr($phone, 1);
    //     }
    //     return $phone;
    // }
    public function sendOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $otp = rand(100000, 999999);

            $_SESSION['temp_otp'] = $otp;
            $_SESSION['temp_email'] = $email;
            $_SESSION['register_data'] = $_POST;

            if ($this->sendOTPEmail($email, $otp)) {
                header("Location: index.php?page=verify-otp");
                exit;
            } else {
                $this->smarty->assign('error_message', 'Lỗi: Không thể gửi email xác thực!');
                $this->smarty->display('guest/register.tpl');
            }
        }
    }

    public function verifyOTP()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_verify'])) {
            $userOtp = trim($_POST['otp'] ?? '');
            $systemOtp = $_SESSION['temp_otp'] ?? '';

            if ($userOtp == $systemOtp) {
                $data = $_SESSION['register_data'];
                $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

                $userData = [
                    'fullName'  => $data['fullName'],
                    'phone'     => $data['phone'],
                    'email'     => $data['email'],
                    'password'  => $hashedPassword,
                    'role'      => 'patient',
                    'createdAt' => new \MongoDB\BSON\UTCDateTime()
                ];

                $userId = $this->userModel->createUser($userData);

                if ($userId) {
                    unset($_SESSION['temp_otp'], $_SESSION['temp_email'], $_SESSION['register_data']);
                    $_SESSION['user'] = [
                        'id'       => (string) $userId,
                        'email'    => $data['email'],
                        'fullName' => $data['fullName'],
                        'role'     => 'patient',
                    ];
                    header("Location: index.php");
                    exit;
                }
            } else {
                $this->smarty->assign('error_message', 'Mã OTP không chính xác!');
            }
        }
        $this->smarty->display('guest/verify_otp.tpl');
    }

    private function sendOTPEmail($toEmail, $otp)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_SERVER['EMAIL_ACCOUNT'] ?? getenv('EMAIL_ACCOUNT');
            $mail->Password   = $_SERVER['EMAIL_PASSWORD'] ?? getenv('EMAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = "UTF-8";

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom($mail->Username, 'MediCare Clinic');
            $mail->addAddress($toEmail);
            $mail->isHTML(true);
            $mail->Subject = 'Mã xác thực MediCare';
            $mail->Body    = "<h3>Mã xác thực của bạn là: <b style='color:red;'>$otp</b></h3>";

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}

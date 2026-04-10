<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class AuthController
{
    private $userModel;
    private $smarty;

    public function __construct($userModel, $smarty)
    {
        $this->userModel = $userModel;
        $this->smarty = $smarty;
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
                    'id' => $user['id'],
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
            $userOtp = trim($_POST['otp'] ?? '');
            $phone = trim($_POST['phone'] ?? '');

            if (!preg_match('/^(0[3|5|7|8|9])[0-9]{8}$/', $phone)) {
                $this->smarty->assign('error_message', 'Số điện thoại không hợp lệ!');
                $this->smarty->assign('form', $_POST);
                $this->smarty->display('guest/register.tpl');
                return;
            }

            if (!isset($_SESSION['register_otp']) || $userOtp != $_SESSION['register_otp']) {
                $this->smarty->assign('error_message', 'Mã OTP không chính xác!');
                $this->smarty->assign('form', $_POST);
            } elseif (time() > $_SESSION['otp_expire']) {
                $this->smarty->assign('error_message', 'Mã OTP đã hết hạn!');
                $this->smarty->assign('form', $_POST);
            } elseif ($_POST['password'] !== $_POST['confirm_password']) {
                $this->smarty->assign('error_message', 'Mật khẩu xác nhận không khớp!');
                $this->smarty->assign('form', $_POST);
            } else {
                $userData = [
                    'fullName'  => $_POST['fullName'],
                    'phone'     => $_POST['phone'],
                    'email'     => $email,
                    'password'  => $_POST['password'],
                    'role'      => 'patient'
                ];

                $userId = $this->userModel->registerUser($userData);

                if ($userId) {
                    unset($_SESSION['register_otp'], $_SESSION['register_email'], $_SESSION['otp_expire']);

                    $_SESSION['user'] = [
                        'id'       => $userId,
                        'email'    => $email,
                        'fullName' => $_POST['fullName'],
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

        $httpClient = new \GuzzleHttp\Client(['verify' => false]);
        $client->setHttpClient($httpClient);

        // 1. Chuyển hướng người dùng sang Google
        if (!isset($_GET['code'])) {
            $authUrl = $client->createAuthUrl();
            header("Location: " . $authUrl);
            exit;
        }

        // 2. Xử lý khi Google trả mã code về URL
        try {
            // Đây là dòng gây ra lỗi Fatal Error nếu không có try-catch
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            // Kiểm tra xem có lỗi trong mảng trả về không
            if (isset($token['error'])) {
                throw new \Exception("Google API Error: " . ($token['error_description'] ?? $token['error']));
            }

            $client->setAccessToken($token);

            // Lấy thông tin user
            $googleService = new \Google\Service\Oauth2($client);
            $data = $googleService->userinfo->get();

            $email = $data->email;
            $fullName = $data->name;
            $googleId = $data->id;

            // Tìm user trong Database MySQL
            $user = $this->userModel->findUserByEmail($email);

            if (!$user) {
                $newUser = [
                    'fullName' => $fullName,
                    'email' => $email,
                    'googleId' => $googleId,
                    'role' => 'patient',
                    'avatar' => $data->picture
                ];
                $this->userModel->registerUser($newUser);
                $user = $this->userModel->findUserByEmail($email);
            }

            // Lưu Session cho user
            $_SESSION['user'] = [
                'id'       => $user['id'],
                'email'    => $user['email'],
                'fullName' => $user['fullName'],
                'role'     => $user['role'],
            ];

            header("Location: index.php?page=dashboard");
            exit;
        } catch (\Exception $e) {
            // Ghi lại log lỗi để bạn kiểm tra trong file log của XAMPP
            error_log("Lỗi Google Login: " . $e->getMessage());

            // Thay vì hiện lỗi Fatal, ta quay lại trang Login và báo lỗi thân thiện
            $this->smarty->assign('error_message', 'Đăng nhập thất bại hoặc phiên làm việc đã hết hạn. Vui lòng thử lại.');
            $this->smarty->display('guest/login.tpl');
            exit;
        }
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_forgot'])) {
            $email = trim($_POST['email'] ?? '');
            $user = $this->userModel->findUserByEmail($email);

            if ($user) {
                if (empty($user['password']) && !empty($user['googleId'])) {
                    $message = "Tài khoản này đăng nhập bằng Google!";
                    $status = 'error';
                } else {
                    $newPassword = substr(str_shuffle('abcdefghjkmnpqrstuvwxyz23456789'), 0, 8);
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                    $this->userModel->updateProfile($user['id'], ['password' => $hashedPassword]); // FIXED: _id -> id

                    if ($this->sendEmail($email, $newPassword)) {
                        $message = "Mật khẩu mới đã được gửi vào Email của bạn!";
                        $status = 'success';
                    } else {
                        $message = "Lỗi gửi mail!";
                        $status = 'error';
                    }
                }
            } else {
                $message = "Email này không tồn tại!";
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

            $mail->Username   = $_SERVER['EMAIL_ACCOUNT'] ?? getenv('EMAIL_ACCOUNT');
            $mail->Password   = $_SERVER['EMAIL_PASSWORD'] ?? getenv('EMAIL_PASSWORD');
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = "UTF-8";

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom($mail->Username, 'MediCare Clinic');
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Khôi phục mật khẩu - MediCare Clinic';
            $this->smarty->assign('email', $toEmail);
            $this->smarty->assign('newPass', $newPass);
            $mail->Body = $this->smarty->fetch('mail/forgot_password_email.tpl');
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function sendOTPAjax()
    {
        header('Content-Type: application/json');
        $email = trim($_GET['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email không hợp lệ!']);
            exit;
        }

        if ($this->userModel->checkEmailExists($email)) {
            echo json_encode(['success' => false, 'message' => 'Email này đã tồn tại!']);
            exit;
        }

        $otp = rand(100000, 999999);
        $_SESSION['register_otp'] = $otp;
        $_SESSION['register_email'] = $email;
        $_SESSION['otp_expire'] = time() + 300;

        if ($this->sendEmailOTP($email, $otp)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi hệ thống không thể gửi mail!']);
        }
        exit;
    }

    private function sendEmailOTP($toEmail, $otp)
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

            $mail->setFrom($mail->Username, 'MediCare Clinic');
            $mail->addAddress($toEmail);
            $mail->isHTML(true);
            $mail->Subject = 'Mã xác thực đăng ký - MediCare Clinic';
            $this->smarty->assign('otp', $otp);
            $mail->Body = $this->smarty->fetch('mail/otp_email.tpl');
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

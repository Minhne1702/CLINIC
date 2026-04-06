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

            if ($this->userModel->checkEmailExists($email)) {
                $this->smarty->assign('error_message', 'Email này đã tồn tại!');
                $this->smarty->assign('post_data', $_POST);
            } else {
                $userData = [
                    'fullName' => $fullName,
                    'phone'    => $phone,
                    'email'    => $email,
                    'password' => $password,
                    'role'     => 'patient'
                ];

                $userId = $this->userModel->createUser($userData);

                if ($userId) {
                    $_SESSION['user'] = [
                        'id'       => (string) $userId,
                        'email'    => $userData['email'],
                        'fullName' => $userData['fullName'],
                        'role'     => $userData['role'],
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
        $client->setClientId(GOOGLE_CLIENT_ID);
        $client->setClientSecret(GOOGLE_CLIENT_SECRET);
        $client->setRedirectUri(GOOGLE_REDIRECT_URL);
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

            $googleService = new Google\Service\Oauth2($client);
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
    public function forgotPassword() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_forgot'])) {
        $email = trim($_POST['email']);
        $user = $this->userModel->findUserByEmail($email);

        if ($user) {
            if (!isset($user['password'])) {
                $message = "Tài khoản này đăng nhập bằng Google!";
                $status = 'error';
            } else {

                $newPassword = substr(str_shuffle('abcdefghjkmnpqrstuvwxyz23456789'), 0, 8);
                
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                
                $this->userModel->updateProfile((string)$user['_id'], ['password' => $hashedPassword]);

                if ($this->sendEmail($email, $newPassword)) {
                    $message = "Mật khẩu mới đã được gửi thành công!";
                    $status = 'success';
                } else {
                    $message = "Lỗi gửi mail!";
                    $status = 'error';
                }

            }
        } else {
            $message = "Email không tồn tại!";
            $status = 'error';
        }
    }
    if (isset($message)) {
    $this->smarty->assign('message', $message);
    $this->smarty->assign('status', $status);
}
    $this->smarty->display('guest/forgot_password.tpl');
}

private function sendEmail($toEmail, $newPass) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thanhminhprovip455@gmail.com'; 
        $mail->Password   = 'tefd gnmu qwns bnsn';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = "UTF-8";

        $mail->setFrom('no-reply@clinic.com', 'Clinic System');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Khoi phuc mat khau - Clinic System';
        $mail->Body    = "Chào bạn, mật khẩu mới của bạn là: <b>$newPass</b>. Hãy dùng nó để đăng nhập và đổi lại mật khẩu nhé!";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
}

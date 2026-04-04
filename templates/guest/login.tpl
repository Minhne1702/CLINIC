<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    {include file="../layout/header.tpl"}

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="login-card p-4 p-md-5">
                <div class="text-center mb-4">
                    <div class="icon-box mb-3 d-inline-block p-3 rounded-circle bg-light">
                        <i class="fa-solid fa-user-shield fa-2x text-primary"></i>
                    </div>
                    <h3 class="fw-bold">Hệ Thống Y Tế</h3>
                    <p class="text-muted">Vui lòng đăng nhập để tiếp tục</p>
                </div>

                <form action="index.php?page=login" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email Tài Khoản</label>
                        <input type="email" name="email" class="form-control" placeholder="@gmail.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Mật Khẩu</label>
                        
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="mb-3"> 
        <a href="index.php?page=forgot-password" class="forgot-password-link">Quên mật khẩu?</a>
    </div>

                    <button type="submit" name="btn_login" class="btn btn-primary w-100 shadow-sm btn-login-custom">
                        Đăng Nhập Ngay
                    </button>

                    <a href="index.php?page=google-auth" class="btn btn-outline-dark w-100 py-2 shadow-sm btn-google-custom">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
                        <span>Đăng nhập nhanh bằng Google</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="../layout/footer.tpl"}
</body>
</html>
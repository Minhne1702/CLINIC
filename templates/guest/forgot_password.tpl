<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu | Hệ thống Y tế</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    {include file="../layout/header.tpl"}

<div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="login-card p-4 p-md-5 border-0 shadow-sm">
                <div class="text-center mb-4">
                    <div class="icon-box mb-3 d-inline-block p-3 rounded-circle bg-light">
                        <i class="fa-solid fa-key fa-2x text-primary"></i>
                    </div>
                    <h3 class="fw-bold">Khôi phục mật khẩu</h3>
                    <p class="text-muted small">Nhập email đã đăng ký, chúng tôi sẽ gửi mật khẩu mới cho bạn.</p>
                </div>

                {if isset($message)}
                    {if isset($message)}
    <div class="alert {if isset($status) && $status == 'success'}alert-success{else}alert-danger{/if} border-0 small text-center mb-4">
        <i class="fa-solid {if isset($status) && $status == 'success'}fa-circle-check{else}fa-circle-exclamation{/if} me-2"></i>
        {$message}
    </div>
{/if}
                {/if}

                <form action="index.php?page=forgot-password" method="POST">
                    <div class="mb-4">
                        <label class="form-label">Email Tài Khoản</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                        </div>
                    </div>

                    <button type="submit" name="btn_forgot" class="btn btn-primary w-100 shadow-sm btn-login-custom mb-3">
                        Gửi Mật Khẩu Mới
                    </button>
                    
                    <div class="text-center mt-3">
                        <a href="index.php?page=login" class="forgot-password-link">
                            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại đăng nhập
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{include file="../layout/footer.tpl"}
</body>
</html>
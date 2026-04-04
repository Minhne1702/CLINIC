<?php
/* Smarty version 5.8.0, created on 2026-04-04 19:58:07
  from 'file:guest/forgot_password.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d16d4f115f23_98581450',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a0dc6eec27ab10cc8b0ff177dcf1aa91919fa927' => 
    array (
      0 => 'guest/forgot_password.tpl',
      1 => 1775331348,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout/header.tpl' => 1,
    'file:../layout/footer.tpl' => 1,
  ),
))) {
function content_69d16d4f115f23_98581450 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\thanh\\Documents\\Clinic\\templates\\guest';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu | Hệ thống Y tế</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:../layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

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

                <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
                    <?php if ((true && ($_smarty_tpl->hasVariable('message') && null !== ($_smarty_tpl->getValue('message') ?? null)))) {?>
    <div class="alert <?php if ((true && ($_smarty_tpl->hasVariable('status') && null !== ($_smarty_tpl->getValue('status') ?? null))) && $_smarty_tpl->getValue('status') == 'success') {?>alert-success<?php } else { ?>alert-danger<?php }?> border-0 small text-center mb-4">
        <i class="fa-solid <?php if ((true && ($_smarty_tpl->hasVariable('status') && null !== ($_smarty_tpl->getValue('status') ?? null))) && $_smarty_tpl->getValue('status') == 'success') {?>fa-circle-check<?php } else { ?>fa-circle-exclamation<?php }?> me-2"></i>
        <?php echo $_smarty_tpl->getValue('message');?>

    </div>
<?php }?>
                <?php }?>

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

<?php $_smarty_tpl->renderSubTemplate("file:../layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</body>
</html><?php }
}

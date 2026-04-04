<?php
/* Smarty version 5.8.0, created on 2026-04-04 19:43:53
  from 'file:guest/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d169f93b7617_85459351',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4e48423d60db9a87f6d6a79112ad9ee6e4019e0' => 
    array (
      0 => 'guest/register.tpl',
      1 => 1775331367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout/header.tpl' => 1,
    'file:../layout/footer.tpl' => 1,
  ),
))) {
function content_69d169f93b7617_85459351 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\thanh\\Documents\\Clinic\\templates\\guest';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:../layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div class="container my-5 py-2">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="icon-box mb-3 d-inline-block p-3 rounded-circle bg-light">
                            <i class="fa-solid fa-user-plus fa-2x text-primary"></i>
                        </div>
                        <h2 class="fw-bold text-primary">ĐĂNG KÝ</h2>
                        <p class="text-muted">Tham gia hệ thống phòng khám thông minh</p>
                    </div>

                    <?php if ((true && ($_smarty_tpl->hasVariable('error_message') && null !== ($_smarty_tpl->getValue('error_message') ?? null)))) {?>
                        <div class="alert alert-danger border-0 text-center small">
                            <i class="fa-solid fa-circle-exclamation me-2"></i><?php echo $_smarty_tpl->getValue('error_message');?>

                        </div>
                    <?php }?>

                    <form action="index.php?page=register" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Họ và Tên</label>
                            <input type="text" name="fullName" class="form-control" required placeholder="Nguyễn Văn A" value="<?php echo (($tmp = $_smarty_tpl->getValue('post_data')['fullName'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" required placeholder="09xx xxx xxx" value="<?php echo (($tmp = $_smarty_tpl->getValue('post_data')['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="@gmail.com" value="<?php echo (($tmp = $_smarty_tpl->getValue('post_data')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" required placeholder="••••••••">
                        </div>

                        <button type="submit" name="btn_register" class="btn btn-primary w-100 py-3 fw-bold mb-3">
                            TẠO TÀI KHOẢN NGAY
                        </button>

                        <a href="index.php?page=google-auth" class="btn btn-outline-dark w-100 py-2 shadow-sm btn-google-custom">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="20" alt="Google">
                            <span>Đăng ký nhanh bằng Google</span>
                        </a>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-muted small">Đã có tài khoản? </span>
                        <a href="index.php?page=login" class="text-primary fw-bold text-decoration-none">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:../layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</body>
</html><?php }
}

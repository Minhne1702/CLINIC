<?php
/* Smarty version 5.8.0, created on 2026-04-08 03:41:46
  from 'file:guest/verify_otp.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d5ce7a6673f6_93655228',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0bdcecb15c0ec27f71d7890ed07ad4fb42dc168' => 
    array (
      0 => 'guest/verify_otp.tpl',
      1 => 1775619703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d5ce7a6673f6_93655228 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Xác thực OTP — MediCare"), (int) 0, $_smarty_current_dir);
?>

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form-wrap" style="margin: 0 auto; max-width: 500px;">
            <div class="form-card">
                <div class="form-card__header">
                    <h2>Xác thực Email</h2>
                    <p>Mã xác thực đã được gửi đến địa chỉ: <br>
                        <strong style="color: var(--primary-color);"><?php echo $_SESSION['temp_email'];?>
</strong>
                    </p>
                </div>

                <?php if ($_smarty_tpl->getValue('error_message')) {?>
                    <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div>
                <?php }?>

                <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=verify-otp" method="POST" class="appt-form">
                    <div class="form-group">
                        <label>Nhập mã OTP (6 chữ số) <span class="required">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fa-solid fa-shield-halved"></i>
                            <input type="text" name="otp" placeholder="••••••" required maxlength="6"
                                style="letter-spacing: 8px; font-weight: bold; text-align: center; font-size: 24px;">
                        </div>
                    </div>

                    <button type="submit" name="btn_verify" class="btn-submit">Xác nhận & Hoàn tất đăng ký</button>

                    <div style="text-align: center; margin-top: 20px;">
                        <p style="font-size: 14px; color: #666;">Không nhận được email?
                            <br>Kiểm tra cả hòm thư <strong>Spam (Rác)</strong> hoặc
                            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=register"
                                style="color: var(--primary-color); font-weight: 600;">Quay lại đăng ký lại</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

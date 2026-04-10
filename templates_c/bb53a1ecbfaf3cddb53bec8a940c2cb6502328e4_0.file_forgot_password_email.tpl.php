<?php
/* Smarty version 5.8.0, created on 2026-04-10 14:38:39
  from 'file:mail/forgot_password_email.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d90b6f436638_41200644',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb53a1ecbfaf3cddb53bec8a940c2cb6502328e4' => 
    array (
      0 => 'mail/forgot_password_email.tpl',
      1 => 1775700266,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d90b6f436638_41200644 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\mail';
?><div
    style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px;">
    <h2 style="color: #007bff; text-align: center;">KHÔI PHỤC MẬT KHẨU</h2>
    <p>Chào bạn,</p>
    <p>Hệ thống vừa cấp lại mật khẩu mới cho tài khoản: <b><?php echo $_smarty_tpl->getValue('email');?>
</b></p>
    <div style="text-align: center; margin: 30px 0;">
        <p>Mật khẩu mới của bạn là:</p>
        <span
            style="font-size: 24px; font-weight: bold; color: #d9534f; background: #f8f9fa; padding: 10px 20px; border: 1px dashed #ccc; display: inline-block;">
            <?php echo $_smarty_tpl->getValue('newPass');?>

        </span>
    </div>
    <p style="color: #d9534f;"><b>Lưu ý:</b> Vui lòng đăng nhập và thay đổi mật khẩu ngay lập tức để đảm bảo an toàn cho
        tài khoản của bạn.</p>
    <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
    <p style="font-size: 12px; color: #888; text-align: center;">Đây là thư tự động từ MediCare Clinic.</p>
</div><?php }
}

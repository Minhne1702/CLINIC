<?php
/* Smarty version 5.8.0, created on 2026-04-09 02:25:07
  from 'file:mail/otp_email.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d70e03e3aa75_28135053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d35608f53941717ae857691f9e44119f5d91f99' => 
    array (
      0 => 'mail/otp_email.tpl',
      1 => 1775700068,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d70e03e3aa75_28135053 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\mail';
?><div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px;">
    <h2 style="color: #007bff; text-align: center;">MÃ XÁC THỰC ĐĂNG KÝ</h2>
    <p>Chào bạn,</p>
    <p>Mã OTP để hoàn tất đăng ký tài khoản tại <b>MediCare Clinic</b> của bạn là:</p>
    <div style="text-align: center; margin: 30px 0;">
        <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #d9534f; background: #f8f9fa; padding: 10px 20px; border: 1px dashed #ccc;">
            <?php echo $_smarty_tpl->getValue('otp');?>

        </span>
    </div>
    <p>Mã này có hiệu lực trong <b>5 phút</b>. Vui lòng không cung cấp mã này cho bất kỳ ai.</p>
    <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
    <p style="font-size: 12px; color: #888; text-align: center;">Đây là thư tự động từ hệ thống MediCare.</p>
</div><?php }
}

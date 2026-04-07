<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:38:03
  from 'file:guest/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4c26b58bea2_58391558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78ee1840172e7243d4aaedb6349e8e19da702ed4' => 
    array (
      0 => 'guest/register.tpl',
      1 => 1775551076,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4c26b58bea2_58391558 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đăng ký — MediCare",'active_page'=>"register"), (int) 0, $_smarty_current_dir);
?>

<section class="auth-section">
  <div class="auth-container">

    <div class="auth-brand" data-animate="fade-right">
      <div class="auth-brand__logo">
        <div class="logo-icon" style="width:56px;height:56px;font-size:24px"><i class="fa-solid fa-heart-pulse"></i></div>
        <span class="logo-name" style="font-size:24px">MediCare</span>
      </div>
      <h2>Tạo tài khoản miễn phí</h2>
      <p>Đăng ký ngay để trải nghiệm đặt lịch khám thông minh và quản lý sức khỏe toàn diện.</p>
      <div class="auth-features">
        <div class="auth-feature"><i class="fa-solid fa-calendar-check"></i><span>Đặt và quản lý lịch khám</span></div>
        <div class="auth-feature"><i class="fa-solid fa-file-medical"></i><span>Lưu trữ hồ sơ bệnh án</span></div>
        <div class="auth-feature"><i class="fa-solid fa-shield-halved"></i><span>Thông tin bảo mật tuyệt đối</span></div>
      </div>
    </div>

    <div class="auth-form-wrap" data-animate="fade-left">
      <div class="form-card">
        <div class="form-card__header">
          <h2>Đăng ký tài khoản</h2>
          <p>Đã có tài khoản? <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=login">Đăng nhập</a></p>
        </div>

        <?php if ($_smarty_tpl->getValue('error_message')) {?>
        <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div>
        <?php }?>
        <?php if ($_smarty_tpl->getValue('success_message')) {?>
        <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div>
        <?php }?>

        <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=register" method="POST" class="appt-form">
          <div class="form-row">
            <div class="form-group">
              <label>Họ và tên <span class="required">*</span></label>
              <div class="input-icon-wrap">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="fullName" placeholder="Nguyễn Văn A" required value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['full_name'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
            </div>
            <div class="form-group">
              <label>Số điện thoại <span class="required">*</span></label>
              <div class="input-icon-wrap">
                <i class="fa-solid fa-phone"></i>
                <input type="tel" name="phone" placeholder="0901 234 567" required value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="email@example.com" required value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label>Ngày sinh</label>
              <input type="date" name="birthday">
            </div>
            <div class="form-group">
              <label>Giới tính</label>
              <select name="gender">
                <option value="">-- Chọn --</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
                <option value="other">Khác</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Mật khẩu <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="password" id="pw1" placeholder="Ít nhất 8 ký tự" required minlength="8">
              <button type="button" class="input-toggle-pw" onclick="togglePw('pw1',this)">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="form-group">
            <label>Xác nhận mật khẩu <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="confirm_password" id="pw2" placeholder="Nhập lại mật khẩu" required>
              <button type="button" class="input-toggle-pw" onclick="togglePw('pw2',this)">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="form-group form-group--check">
            <label class="checkbox-label">
              <input type="checkbox" name="agree" required>
              Tôi đồng ý với <a href="#">Điều khoản dịch vụ</a> và <a href="#">Chính sách bảo mật</a>
            </label>
          </div>
              <button type="submit" name="btn_register" class="btn-submit">Tạo tài khoản</button>
        </form>

        <div class="auth-divider"><span>hoặc</span></div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=google-auth" class="btn-social">
          <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          Đăng ký với Google
        </a>
      </div>
    </div>

  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>
function togglePw(id, btn) {
  const input = document.getElementById(id);
  const icon = btn.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'fa-regular fa-eye-slash';
  } else {
    input.type = 'password';
    icon.className = 'fa-regular fa-eye';
  }
}
<?php echo '</script'; ?>
>
<?php }
}

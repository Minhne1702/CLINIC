{include file="layout/header.tpl" page_title="Đăng nhập — MediCare" active_page="login"}

<section class="auth-section">
  <div class="auth-container">

    <div class="auth-brand" data-animate="fade-right">
      <div class="auth-brand__logo">
        <div class="logo-icon" style="width:56px;height:56px;font-size:24px"><i class="fa-solid fa-heart-pulse"></i></div>
        <span class="logo-name" style="font-size:24px">MediCare</span>
      </div>
      <h2>Chào mừng trở lại!</h2>
      <p>Đăng nhập để đặt lịch khám, xem lịch sử khám bệnh và quản lý hồ sơ sức khỏe của bạn.</p>
      <div class="auth-features">
        <div class="auth-feature"><i class="fa-solid fa-calendar-check"></i><span>Đặt lịch nhanh chóng</span></div>
        <div class="auth-feature"><i class="fa-solid fa-file-medical"></i><span>Lưu hồ sơ sức khỏe</span></div>
        <div class="auth-feature"><i class="fa-solid fa-bell"></i><span>Nhắc lịch tự động</span></div>
      </div>
    </div>

    <div class="auth-form-wrap" data-animate="fade-left">
      <div class="form-card">
        <div class="form-card__header">
          <h2>Đăng nhập</h2>
          <p>Chưa có tài khoản? <a href="/CLINIC/public/?page=register">Đăng ký ngay</a></p>
        </div>

        {if $error_message}
        <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
        {/if}

        <form action="/CLINIC/public/?page=login" method="POST" class="appt-form">
          <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="email@example.com" required autocomplete="email"
                value="{$form.email|default:''}">
            </div>
          </div>
          <div class="form-group">
            <label>
              Mật khẩu <span class="required">*</span>
              <a href="/CLINIC/public/?page=forgot-password" class="label-link">Quên mật khẩu?</a>
            </label>
            <div class="input-icon-wrap">
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password">
              <button type="button" class="input-toggle-pw" onclick="togglePw('password',this)">
                <i class="fa-regular fa-eye"></i>
              </button>
            </div>
          </div>
          <div class="form-group form-group--check">
            <label class="checkbox-label">
              <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
            </label>
          </div>
          <button type="submit" name="btn_login" class="btn-submit">Đăng nhập</button>
        </form>

        <div class="auth-divider"><span>hoặc</span></div>
        <a href="/CLINIC/public/?page=google-auth" class="btn-social">
          <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          Tiếp tục với Google
        </a>

        <p class="auth-footer-note">Bằng cách đăng nhập, bạn đồng ý với <a href="#">Điều khoản dịch vụ</a> của chúng tôi.</p>
      </div>
    </div>

  </div>
</section>

{include file="layout/footer.tpl"}

<script>
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
</script>

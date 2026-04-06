{include file="layout/header.tpl" page_title="Quên mật khẩu — MediCare" active_page=""}

<section class="auth-section auth-section--center">
  <div class="auth-single-wrap" data-animate="fade-up">
    <div class="form-card">
      <div class="auth-icon-top">
        <i class="fa-solid fa-lock-open"></i>
      </div>
      <div class="form-card__header" style="text-align:center">
        <h2>Quên mật khẩu?</h2>
        <p>Nhập email của bạn, chúng tôi sẽ gửi link đặt lại mật khẩu.</p>
      </div>

      {if $success_message}
      <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>
      {else}

        {if $error_message}
        <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
        {/if}

        <form action="/CLINIC/public/?page=forgot-password" method="POST" class="appt-form">
          <div class="form-group">
            <label>Email đã đăng ký <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="email@example.com" required autocomplete="email">
            </div>
          </div>
          <button type="submit" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i>
            Gửi link đặt lại mật khẩu
          </button>
        </form>

      {/if}

      <div class="auth-back-link">
        <a href="/CLINIC/public/?page=login"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
      </div>
    </div>
  </div>
</section>

{include file="layout/footer.tpl"}

{include file="layout/header.tpl" page_title="Quên mật khẩu — MediCare" active_page=""}

<section class="auth-section auth-section--center">
  <div class="auth-single-wrap" data-animate="fade-up">
    <div class="form-card">
      <div class="auth-icon-top">
        <i class="fa-solid fa-lock-open"></i>
      </div>
      <div class="form-card__header" style="text-align:center">
        <h2>Quên mật khẩu?</h2>
        <p>Nhập email của bạn, chúng tôi sẽ gửi mật khẩu mới trực tiếp qua mail.</p>
      </div>

      {if $status === 'success'}
        <div class="alert alert--success">
          <i class="fa-solid fa-circle-check"></i> {$message}
        </div>
      {/if}

      {if $status === 'error'}
        <div class="alert alert--danger">
          <i class="fa-solid fa-circle-exclamation"></i> {$message}
        </div>
      {/if}

      {if $status !== 'success'}
        <form action="{$BASE_URL}/index.php?page=forgot-password" method="POST" class="appt-form">
          <div class="form-group">
            <label>Email đã đăng ký <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="email@example.com" required autocomplete="email">
            </div>
          </div>

          <button type="submit" name="btn_forgot" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Gửi mật khẩu mới
          </button>
        </form>
      {/if}

      <div class="auth-back-link">
        <a href="{$BASE_URL}/index.php?page=login"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
      </div>
    </div>
  </div>
</section>

{include file="layout/footer.tpl"}
{include file="layout/header.tpl" page_title="Xác thực OTP — MediCare"}

<section class="auth-section">
    <div class="auth-container">
        <div class="auth-form-wrap" style="margin: 0 auto; max-width: 500px;">
            <div class="form-card">
                <div class="form-card__header">
                    <h2>Xác thực Email</h2>
                    <p>Mã xác thực đã được gửi đến địa chỉ: <br>
                        <strong style="color: var(--primary-color);">{$smarty.session.temp_email}</strong>
                    </p>
                </div>

                {if $error_message}
                    <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
                {/if}

                <form action="{$BASE_URL}/?page=verify-otp" method="POST" class="appt-form">
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
                            <a href="{$BASE_URL}/?page=register"
                                style="color: var(--primary-color); font-weight: 600;">Quay lại đăng ký lại</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{include file="layout/footer.tpl"}
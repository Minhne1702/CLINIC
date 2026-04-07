{include file="layout/header.tpl" page_title="Liên hệ — MediCare" active_page="contact"}

<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <p class="section-eyebrow">Liên hệ</p>
      <h1 class="page-hero__title">Chúng tôi luôn <span class="text-accent">lắng nghe</span> bạn</h1>
      <p class="page-hero__desc">Có câu hỏi hoặc cần hỗ trợ? Đội ngũ của chúng tôi sẵn sàng giải đáp trong thời gian sớm nhất.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-layout">

      <!-- Contact Info -->
      <div class="contact-info" data-animate="fade-right">
        <div class="contact-info-card">
          <div class="contact-info-item">
            <div class="contact-info-icon" style="--icon-color:#0ea5e9"><i class="fa-solid fa-location-dot"></i></div>
            <div>
              <h4>Địa chỉ</h4>
              <p>123 Nguyễn Thị Minh Khai<br>Quận 1, TP. Hồ Chí Minh</p>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="contact-info-icon" style="--icon-color:#10b981"><i class="fa-solid fa-phone"></i></div>
            <div>
              <h4>Điện thoại</h4>
              <p><a href="tel:1900xxxx">1900 xxxx</a> (Hotline)</p>
              <p><a href="tel:02812345678">(028) 1234 5678</a></p>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="contact-info-icon" style="--icon-color:#8b5cf6"><i class="fa-regular fa-envelope"></i></div>
            <div>
              <h4>Email</h4>
              <p><a href="mailto:info@medicare.vn">info@medicare.vn</a></p>
              <p><a href="mailto:support@medicare.vn">support@medicare.vn</a></p>
            </div>
          </div>
          <div class="contact-info-item">
            <div class="contact-info-icon" style="--icon-color:#f59e0b"><i class="fa-regular fa-clock"></i></div>
            <div>
              <h4>Giờ làm việc</h4>
              <p>Thứ 2 – Thứ 6: 07:30 – 17:00</p>
              <p>Thứ 7: 07:30 – 12:00</p>
            </div>
          </div>
        </div>

        <div class="contact-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4!2d106.6831!3d10.7769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ2JzM3LjAiTiAxMDbCsDQwJzU5LjIiRQ!5e0!3m2!1svi!2svn!4v1"
            width="100%" height="220" style="border:0;border-radius:var(--radius-md)" allowfullscreen loading="lazy">
          </iframe>
        </div>
      </div>

      <!-- Form -->
      <div class="contact-form-wrap" data-animate="fade-left">
        <div class="form-card">
          <div class="form-card__header">
            <i class="fa-regular fa-paper-plane"></i>
            <h2>Gửi tin nhắn</h2>
          </div>

          {if $success_message}
          <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>
          {/if}
          {if $error_message}
          <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
          {/if}

          <form action="{$base_url}/?page=contact" method="POST" class="appt-form">
            <div class="form-row">
              <div class="form-group">
                <label>Họ và tên <span class="required">*</span></label>
                <input type="text" name="full_name" placeholder="Nguyễn Văn A" required>
              </div>
              <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" placeholder="email@example.com" required>
              </div>
            </div>
            <div class="form-group">
              <label>Số điện thoại</label>
              <input type="tel" name="phone" placeholder="0901 234 567">
            </div>
            <div class="form-group">
              <label>Chủ đề <span class="required">*</span></label>
              <select name="subject" required>
                <option value="">-- Chọn chủ đề --</option>
                <option value="dat-lich">Đặt lịch khám</option>
                <option value="tu-van">Tư vấn sức khỏe</option>
                <option value="khieu-nai">Góp ý / Khiếu nại</option>
                <option value="hop-tac">Hợp tác</option>
                <option value="khac">Khác</option>
              </select>
            </div>
            <div class="form-group">
              <label>Nội dung <span class="required">*</span></label>
              <textarea name="message" rows="5" placeholder="Nhập nội dung tin nhắn..." required></textarea>
            </div>
            <button type="submit" class="btn-submit">
              <i class="fa-regular fa-paper-plane"></i>
              Gửi tin nhắn
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

{include file="layout/footer.tpl"}

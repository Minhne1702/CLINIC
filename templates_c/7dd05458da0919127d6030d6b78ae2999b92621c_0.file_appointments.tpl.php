<?php
/* Smarty version 5.8.0, created on 2026-04-09 03:20:25
  from 'file:guest/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d71af91cd0e9_68355462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7dd05458da0919127d6030d6b78ae2999b92621c' => 
    array (
      0 => 'guest/appointments.tpl',
      1 => 1775610517,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d71af91cd0e9_68355462 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đặt lịch khám — MediCare",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <p class="section-eyebrow">Đặt lịch khám</p>
      <h1 class="page-hero__title">Đặt lịch <span class="text-accent">nhanh chóng</span></h1>
      <p class="page-hero__desc">Chọn bác sĩ, chuyên khoa và thời gian phù hợp. Chúng tôi sẽ xác nhận trong vòng 30 phút.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="appointment-layout">

      <!-- Form -->
      <div class="appointment-form-wrap" data-animate="fade-right">
        <div class="form-card">
          <div class="form-card__header">
            <i class="fa-regular fa-calendar-check"></i>
            <h2>Thông tin đặt lịch</h2>
          </div>

          <?php if ($_smarty_tpl->getValue('success_message')) {?>
          <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div>
          <?php }?>
          <?php if ($_smarty_tpl->getValue('error_message')) {?>
          <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div>
          <?php }?>

          <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" method="POST" class="appt-form">

            <div class="form-section-title"><span>01</span> Chọn dịch vụ</div>
            <div class="form-row">
              <div class="form-group">
                <label>Chuyên khoa <span class="required">*</span></label>
                <select name="specialty" required>
                  <option value="">-- Chọn chuyên khoa --</option>
                  <option value="tim-mach">Tim mạch</option>
                  <option value="than-kinh">Thần kinh</option>
                  <option value="nhi-khoa">Nhi khoa</option>
                  <option value="da-lieu">Da liễu</option>
                  <option value="mat">Mắt</option>
                  <option value="nha-khoa">Nha khoa</option>
                  <option value="xuong-khop">Cơ xương khớp</option>
                  <option value="tieu-hoa">Tiêu hóa</option>
                  <option value="noi-tiet">Nội tiết</option>
                  <option value="phu-khoa">Phụ khoa</option>
                </select>
              </div>
              <div class="form-group">
                <label>Hình thức khám <span class="required">*</span></label>
                <select name="type" required>
                  <option value="offline">Khám trực tiếp</option>
                  <option value="online">Khám từ xa (Video)</option>
                </select>
              </div>
            </div>

            <div class="form-section-title"><span>02</span> Chọn thời gian</div>
            <div class="form-row">
              <div class="form-group">
                <label>Ngày khám <span class="required">*</span></label>
                <input type="date" name="date" required min="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),'%Y-%m-%d');?>
">
              </div>
              <div class="form-group">
                <label>Giờ khám <span class="required">*</span></label>
                <select name="time" required>
                  <option value="">-- Chọn giờ --</option>
                  <option value="07:30">07:30</option>
                  <option value="08:00">08:00</option>
                  <option value="08:30">08:30</option>
                  <option value="09:00">09:00</option>
                  <option value="09:30">09:30</option>
                  <option value="10:00">10:00</option>
                  <option value="10:30">10:30</option>
                  <option value="11:00">11:00</option>
                  <option value="13:30">13:30</option>
                  <option value="14:00">14:00</option>
                  <option value="14:30">14:30</option>
                  <option value="15:00">15:00</option>
                  <option value="15:30">15:30</option>
                  <option value="16:00">16:00</option>
                </select>
              </div>
            </div>

            <div class="form-section-title"><span>03</span> Thông tin bệnh nhân</div>
            <div class="form-row">
              <div class="form-group">
                <label>Họ và tên <span class="required">*</span></label>
                <input type="text" name="full_name" placeholder="Nguyễn Văn A" required value="<?php echo (($tmp = $_SESSION['user']['full_name'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
              <div class="form-group">
                <label>Số điện thoại <span class="required">*</span></label>
                <input type="tel" name="phone" placeholder="0901 234 567" required value="<?php echo (($tmp = $_SESSION['user']['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" placeholder="email@example.com" value="<?php echo (($tmp = $_SESSION['user']['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
            </div>
            <div class="form-group">
              <label>Triệu chứng / Lý do khám</label>
              <textarea name="note" rows="4" placeholder="Mô tả ngắn triệu chứng hoặc lý do muốn khám..."></textarea>
            </div>

            <button type="submit" class="btn-submit">
              <i class="fa-regular fa-calendar-check"></i>
              Xác nhận đặt lịch
            </button>
          </form>
        </div>
      </div>

      <!-- Sidebar info -->
      <div class="appointment-sidebar" data-animate="fade-left">
        <div class="info-card">
          <h3><i class="fa-solid fa-circle-info"></i> Lưu ý khi đặt lịch</h3>
          <ul class="info-list">
            <li><i class="fa-solid fa-check"></i> Vui lòng đến trước giờ hẹn 15 phút</li>
            <li><i class="fa-solid fa-check"></i> Mang theo CMND/CCCD và thẻ BHYT (nếu có)</li>
            <li><i class="fa-solid fa-check"></i> Xác nhận lịch sẽ được gửi qua SMS/Email</li>
            <li><i class="fa-solid fa-check"></i> Có thể hủy lịch trước 2 tiếng</li>
          </ul>
        </div>
        <div class="info-card info-card--highlight">
          <h3><i class="fa-solid fa-phone-volume"></i> Cần hỗ trợ?</h3>
          <p>Gọi hotline để được tư vấn đặt lịch nhanh nhất</p>
          <a href="tel:1900xxxx" class="hotline-btn">1900 xxxx</a>
          <p style="font-size:12px;color:var(--text-muted);margin-top:.5rem">Thứ 2 – Thứ 7: 07:30 – 17:00</p>
        </div>
        <div class="info-card">
          <h3><i class="fa-solid fa-location-dot"></i> Địa chỉ phòng khám</h3>
          <p>123 Nguyễn Thị Minh Khai, Quận 1, TP. HCM</p>
          <a href="https://maps.google.com" target="_blank" class="btn-outline" style="margin-top:.75rem;font-size:13px;padding:.5rem 1rem">
            <i class="fa-solid fa-map"></i> Xem bản đồ
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

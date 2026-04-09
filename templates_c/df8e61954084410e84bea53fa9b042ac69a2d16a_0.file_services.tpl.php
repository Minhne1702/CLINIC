<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:42:47
  from 'file:guest/services.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d766873c5d63_93078556',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df8e61954084410e84bea53fa9b042ac69a2d16a' => 
    array (
      0 => 'guest/services.tpl',
      1 => 1775611356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d766873c5d63_93078556 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Dịch vụ — MediCare",'active_page'=>"services"), (int) 0, $_smarty_current_dir);
?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <p class="section-eyebrow">Dịch vụ y tế</p>
      <h1 class="page-hero__title">Dịch vụ <span class="text-accent">toàn diện</span> cho sức khỏe bạn</h1>
      <p class="page-hero__desc">Từ khám chuyên khoa, xét nghiệm đến phẫu thuật — tất cả tại một nơi với chất lượng hàng đầu.</p>
    </div>
  </div>
</section>

<section class="section section--light" style="padding-top:2rem;padding-bottom:2rem">
  <div class="container">
    <div class="service-tabs">
      <?php $_smarty_tpl->assign('cur_cat', (($tmp = $_GET['cat'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == '') {?>active<?php }?>">Tất cả</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services&amp;cat=kham" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == 'kham') {?>active<?php }?>">Khám bệnh</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services&amp;cat=xet-nghiem" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == 'xet-nghiem') {?>active<?php }?>">Xét nghiệm</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services&amp;cat=phau-thuat" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == 'phau-thuat') {?>active<?php }?>">Phẫu thuật</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services&amp;cat=nha-khoa" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == 'nha-khoa') {?>active<?php }?>">Nha khoa</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services&amp;cat=tu-xa" class="service-tab <?php if ($_smarty_tpl->getValue('cur_cat') == 'tu-xa') {?>active<?php }?>">Khám từ xa</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php if ($_smarty_tpl->getValue('services')) {?>
    <div class="services-full-grid" data-animate="stagger">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('services'), 'svc');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('svc')->value) {
$foreach0DoElse = false;
?>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:<?php echo $_smarty_tpl->getValue('svc')['color'];?>
">
          <i class="<?php echo $_smarty_tpl->getValue('svc')['icon'];?>
"></i>
        </div>
        <div class="service-full-card__body">
          <h3><?php echo $_smarty_tpl->getValue('svc')['name'];?>
</h3>
          <p><?php echo $_smarty_tpl->getValue('svc')['description'];?>
</p>
          <?php if ($_smarty_tpl->getValue('svc')['price']) {?>
          <p class="service-price">Từ <strong><?php echo $_smarty_tpl->getValue('svc')['price'];?>
</strong></p>
          <?php }?>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&amp;service=<?php echo $_smarty_tpl->getValue('svc')['id'];?>
" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">
          Đặt lịch
        </a>
      </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php } else { ?>
    <div class="services-full-grid" data-animate="stagger">
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#0ea5e9"><i class="fa-solid fa-stethoscope"></i></div>
        <div class="service-full-card__body">
          <h3>Khám chuyên khoa</h3>
          <p>Thăm khám trực tiếp với bác sĩ chuyên khoa đầu ngành. Chẩn đoán chính xác, tư vấn phác đồ điều trị phù hợp.</p>
          <p class="service-price">Từ <strong>200.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#8b5cf6"><i class="fa-solid fa-video"></i></div>
        <div class="service-full-card__body">
          <h3>Khám từ xa (Telemedicine)</h3>
          <p>Tư vấn sức khỏe qua video call với bác sĩ. Tiết kiệm thời gian, không cần đến phòng khám.</p>
          <p class="service-price">Từ <strong>150.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#10b981"><i class="fa-solid fa-clipboard-list"></i></div>
        <div class="service-full-card__body">
          <h3>Khám tổng quát</h3>
          <p>Gói kiểm tra sức khỏe định kỳ toàn diện. Phát hiện sớm các vấn đề sức khỏe tiềm ẩn.</p>
          <p class="service-price">Từ <strong>500.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#f59e0b"><i class="fa-solid fa-flask"></i></div>
        <div class="service-full-card__body">
          <h3>Xét nghiệm y học</h3>
          <p>Xét nghiệm máu, nước tiểu, sinh hóa, vi sinh với thiết bị hiện đại. Kết quả trong ngày.</p>
          <p class="service-price">Từ <strong>100.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#ef4444"><i class="fa-solid fa-tooth"></i></div>
        <div class="service-full-card__body">
          <h3>Nha khoa</h3>
          <p>Khám và điều trị các bệnh về răng miệng. Tẩy trắng răng, niềng răng, cấy ghép implant.</p>
          <p class="service-price">Từ <strong>200.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#ec4899"><i class="fa-solid fa-brain"></i></div>
        <div class="service-full-card__body">
          <h3>Sức khỏe tinh thần</h3>
          <p>Tư vấn tâm lý, trị liệu tâm thần. Hỗ trợ các vấn đề lo âu, trầm cảm, stress mãn tính.</p>
          <p class="service-price">Từ <strong>300.000đ</strong></p>
        </div>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
    </div>
    <?php }?>
  </div>
</section>

<section class="cta-banner">
  <div class="container cta-banner__inner">
    <div class="cta-banner__text">
      <h2>Chưa biết cần dịch vụ nào?</h2>
      <p>Liên hệ với chúng tôi để được tư vấn miễn phí và chọn dịch vụ phù hợp nhất.</p>
    </div>
    <div class="cta-banner__actions">
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=contact" class="btn-cta-primary"><i class="fa-solid fa-phone"></i> Tư vấn miễn phí</a>
    </div>
  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

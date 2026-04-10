<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:53:04
  from 'file:guest/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d900c04b4a15_62675268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad837e6f6098ffff2c454e905e53cba07082631b' => 
    array (
      0 => 'guest/home.tpl',
      1 => 1775782839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d900c04b4a15_62675268 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"MediCare — Hệ thống đặt lịch khám bệnh",'active_page'=>"home"), (int) 0, $_smarty_current_dir);
?>

<section class="hero">
  <div class="hero__bg-shapes">
    <div class="shape shape--1"></div>
    <div class="shape shape--2"></div>
    <div class="shape shape--3"></div>
  </div>
  <div class="container hero__inner">
    <div class="hero__content" data-animate="fade-up">
      <div class="hero__badge">
        <i class="fa-solid fa-shield-heart"></i>
        Hơn 10.000 bệnh nhân tin tưởng
      </div>
      <h1 class="hero__title">
        Đặt lịch khám <br>
        <span class="text-accent">nhanh chóng</span> &amp; <br>
        <span class="text-accent">tiện lợi</span>
      </h1>
      <p class="hero__desc">
        Kết nối bạn với đội ngũ bác sĩ chuyên gia giàu kinh nghiệm. 
        Đặt lịch trực tuyến 24/7, nhận xác nhận và số thứ tự ngay lập tức.
      </p>
      
      <form class="hero__search" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="GET">
        <input type="hidden" name="page" value="doctors">
        <div class="search-group">
          <div class="search-field">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" placeholder="Tìm bác sĩ, chuyên khoa, triệu chứng..." autocomplete="off">
          </div>
          <div class="search-field search-field--location">
            <i class="fa-solid fa-location-dot"></i>
            <select name="location">
              <option value="">Tất cả khu vực</option>
              <option value="hcm">TP. Hồ Chí Minh</option>
              <option value="hn">Hà Nội</option>
              <option value="dn">Đà Nẵng</option>
            </select>
          </div>
          <button type="submit" class="search-btn">Tìm kiếm</button>
        </div>
      </form>

      <div class="hero__chips">
        <span>Tìm nhanh:</span>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&spec=tim-mach" class="chip">Tim mạch</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&spec=nhi-khoa" class="chip">Nhi khoa</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&spec=da-lieu" class="chip">Da liễu</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&spec=mat" class="chip">Mắt</a>
      </div>
    </div>

    <div class="hero__visual" data-animate="fade-left">
      <div class="hero__card hero__card--main">
        <div class="doctor-avatar">
          <div class="doctor-avatar__fallback"><i class="fa-solid fa-user-doctor"></i></div>
        </div>
        <div class="hero__stats-float">
          <div class="stat-bubble stat-bubble--green"><strong>98%</strong><span>Hài lòng</span></div>
          <div class="stat-bubble stat-bubble--blue"><strong>200+</strong><span>Bác sĩ</span></div>
          <div class="stat-bubble stat-bubble--orange"><strong>24/7</strong><span>Hỗ trợ</span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="hero__statsbar">
    <div class="container">
      <div class="statsbar__grid">
        <div class="statsbar__item"><strong>50+</strong><span>Chuyên khoa</span></div>
        <div class="statsbar__divider"></div>
        <div class="statsbar__item"><strong>200+</strong><span>Bác sĩ chuyên gia</span></div>
        <div class="statsbar__divider"></div>
        <div class="statsbar__item"><strong>10.000+</strong><span>Lịch khám mỗi tháng</span></div>
        <div class="statsbar__divider"></div>
        <div class="statsbar__item"><strong>4.9 ★</strong><span>Đánh giá trung bình</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section--light services">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Dịch vụ của chúng tôi</p>
      <h2 class="section-title">Chăm sóc sức khỏe <span class="text-accent">toàn diện</span></h2>
      <p class="section-desc">Giải pháp y tế hiện đại giúp bạn kết nối với bác sĩ nhanh nhất</p>
    </div>
    <div class="services__grid" data-animate="stagger">
      <?php if ((true && ($_smarty_tpl->hasVariable('services') && null !== ($_smarty_tpl->getValue('services') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('services')) > 0) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('services'), 'svc');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('svc')->value) {
$foreach0DoElse = false;
?>
        <a href="<?php echo (($tmp = $_smarty_tpl->getValue('svc')['url'] ?? null)===null||$tmp==='' ? '#' ?? null : $tmp);?>
" class="service-card">
          <div class="service-card__icon" style="--icon-color: <?php echo (($tmp = $_smarty_tpl->getValue('svc')['color'] ?? null)===null||$tmp==='' ? '#0284c7' ?? null : $tmp);?>
">
            <i class="<?php echo $_smarty_tpl->getValue('svc')['icon'];?>
"></i>
          </div>
          <h3 class="service-card__name"><?php echo $_smarty_tpl->getValue('svc')['name'];?>
</h3>
          <p class="service-card__desc"><?php echo $_smarty_tpl->getValue('svc')['description'];?>
</p>
          <span class="service-card__link">Xem chi tiết <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
        <div class="service-card">
          <div class="service-card__icon" style="--icon-color: #0284c7"><i class="fa-solid fa-calendar-check"></i></div>
          <h3 class="service-card__name">Đặt lịch khám</h3>
          <p class="service-card__desc">Đặt lịch hẹn trực tiếp hoặc từ xa với bác sĩ chuyên khoa.</p>
        </div>
      <?php }?>
    </div>
  </div>
</section>
<section class="section specialties">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Chuyên khoa nổi bật</p>
      <h2 class="section-title">Tìm đúng <span class="text-accent">chuyên khoa</span></h2>
    </div>
    <div class="specialties__grid" data-animate="stagger">
      <?php if ((true && ($_smarty_tpl->hasVariable('specialties') && null !== ($_smarty_tpl->getValue('specialties') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('specialties')) > 0) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('specialties'), 'spec');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach1DoElse = false;
?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&spec_id=<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
" class="spec-chip">
          <i class="<?php echo (($tmp = $_smarty_tpl->getValue('spec')['icon'] ?? null)===null||$tmp==='' ? 'fa-solid fa-stethoscope' ?? null : $tmp);?>
"></i>
          <span><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</span>
        </a>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php }?>
    </div>
    <div class="text-center mt-3">
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-outline">Xem tất cả chuyên khoa <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<section class="section section--light doctors">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Đội ngũ bác sĩ</p>
      <h2 class="section-title">Bác sĩ <span class="text-accent">nổi bật</span></h2>
      <p class="section-desc">Được lựa chọn và kiểm duyệt kỹ lưỡng từ các bệnh viện uy tín</p>
    </div>
    <div class="doctors__grid" data-animate="stagger">
      <?php if ((true && ($_smarty_tpl->hasVariable('featured_doctors') && null !== ($_smarty_tpl->getValue('featured_doctors') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('featured_doctors')) > 0) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('featured_doctors'), 'doc');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach2DoElse = false;
?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book&doctor_id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="doctor-card">
          <div class="doctor-card__img">
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('doc')['avatar'] ?? null))) && $_smarty_tpl->getValue('doc')['avatar']) {?>
              <img src="<?php echo $_smarty_tpl->getValue('doc')['avatar'];?>
" alt="<?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
" loading="lazy">
            <?php } else { ?>
              <div class="doctor-avatar__fallback"><i class="fa-solid fa-user-doctor"></i></div>
            <?php }?>
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('doc')['is_featured'] ?? null))) && $_smarty_tpl->getValue('doc')['is_featured']) {?>
              <span class="doctor-card__badge">Nổi bật</span>
            <?php }?>
          </div>
          <div class="doctor-card__body">
            <p class="doctor-card__degree"><?php echo (($tmp = $_smarty_tpl->getValue('doc')['degree'] ?? null)===null||$tmp==='' ? 'Bác sĩ' ?? null : $tmp);?>
</p>
            <h3 class="doctor-card__name"><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</h3>
            <p class="doctor-card__specialty"><i class="fa-solid fa-circle-dot"></i> <?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</p>
            <div class="doctor-card__meta">
              <span class="rating"><i class="fa-solid fa-star"></i> <?php echo (($tmp = $_smarty_tpl->getValue('doc')['rating'] ?? null)===null||$tmp==='' ? '5.0' ?? null : $tmp);?>
</span>
              <span class="reviews"><?php echo (($tmp = $_smarty_tpl->getValue('doc')['review_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 đánh giá</span>
            </div>
          </div>
          <div class="doctor-card__footer">
            <span class="btn-book-sm" style="background-color: #0284c7; color: white; padding: 8px 15px; border-radius: 6px; font-weight: 600; display: block; text-align: center;">Đặt lịch khám</span>
          </div>
        </a>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php }?>
    </div>
    <div class="text-center mt-3">
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-outline">Xem tất cả bác sĩ <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<section class="section how-it-works">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Quy trình</p>
      <h2 class="section-title">Đặt lịch chỉ <span class="text-accent">3 bước</span></h2>
    </div>
    <div class="steps" data-animate="stagger">
      <div class="step-card">
        <div class="step-card__num">01</div>
        <div class="step-card__icon"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
        <h3>Tìm dịch vụ</h3>
        <p>Chọn hình thức khám và chuyên khoa phù hợp với tình trạng của bạn</p>
      </div>
      <div class="step-connector"><i class="fa-solid fa-arrow-right"></i></div>
      <div class="step-card">
        <div class="step-card__num">02</div>
        <div class="step-card__icon"><i class="fa-regular fa-calendar-check"></i></div>
        <h3>Chọn lịch hẹn</h3>
        <p>Xem danh sách bác sĩ chuyên khoa và bấm chọn khung giờ khám trống</p>
      </div>
      <div class="step-connector"><i class="fa-solid fa-arrow-right"></i></div>
      <div class="step-card">
        <div class="step-card__num">03</div>
        <div class="step-card__icon"><i class="fa-solid fa-circle-check"></i></div>
        <h3>Xác nhận</h3>
        <p>Kiểm tra thông tin, nhận mã QR check-in và đến khám đúng giờ hẹn</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); padding: 4rem 0; color: white; margin-top: 4rem;">
  <div class="container cta-banner__inner" data-animate="fade-up" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
    <div class="cta-banner__text">
      <h2 style="font-size: 2.2rem; margin-bottom: 1rem;">Sẵn sàng chăm sóc sức khỏe của bạn?</h2>
      <p style="font-size: 1.1rem; opacity: 0.9;">Đặt lịch khám ngay hôm nay — nhanh chóng, dễ dàng, không phải chờ đợi lâu.</p>
    </div>
    <div class="cta-banner__actions">
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-cta-primary" style="background: white; color: #0284c7; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; font-size: 1.1rem; box-shadow: 0 10px 15px rgba(0,0,0,0.1);">
        <i class="fa-regular fa-calendar-check"></i> ĐẶT LỊCH NGAY
      </a>
    </div>
  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

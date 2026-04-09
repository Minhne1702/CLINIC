{include file="layout/header.tpl" page_title="MediCare — Hệ thống đặt lịch khám bệnh" active_page="home"}

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
      
      <form class="hero__search" action="{$BASE_URL}/" method="GET">
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
        <a href="{$BASE_URL}/?page=book&spec=tim-mach" class="chip">Tim mạch</a>
        <a href="{$BASE_URL}/?page=book&spec=nhi-khoa" class="chip">Nhi khoa</a>
        <a href="{$BASE_URL}/?page=book&spec=da-lieu" class="chip">Da liễu</a>
        <a href="{$BASE_URL}/?page=book&spec=mat" class="chip">Mắt</a>
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
      {if isset($services) && $services|@count > 0}
        {foreach from=$services item=svc}
        <a href="{$svc.url|default:'#'}" class="service-card">
          <div class="service-card__icon" style="--icon-color: {$svc.color|default:'#0284c7'}">
            <i class="{$svc.icon}"></i>
          </div>
          <h3 class="service-card__name">{$svc.name}</h3>
          <p class="service-card__desc">{$svc.description}</p>
          <span class="service-card__link">Xem chi tiết <i class="fa-solid fa-arrow-right"></i></span>
        </a>
        {/foreach}
      {else}
        <div class="service-card">
          <div class="service-card__icon" style="--icon-color: #0284c7"><i class="fa-solid fa-calendar-check"></i></div>
          <h3 class="service-card__name">Đặt lịch khám</h3>
          <p class="service-card__desc">Đặt lịch hẹn trực tiếp hoặc từ xa với bác sĩ chuyên khoa.</p>
        </div>
      {/if}
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
      {if isset($specialties) && $specialties|@count > 0}
        {foreach from=$specialties item=spec}
        <a href="{$BASE_URL}/?page=book&spec_id={$spec._id}" class="spec-chip">
          <i class="{$spec.icon|default:'fa-solid fa-stethoscope'}"></i>
          <span>{$spec.name}</span>
        </a>
        {/foreach}
      {/if}
    </div>
    <div class="text-center mt-3">
      <a href="{$BASE_URL}/?page=book" class="btn-outline">Xem tất cả chuyên khoa <i class="fa-solid fa-arrow-right"></i></a>
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
      {if isset($featured_doctors) && $featured_doctors|@count > 0}
        {foreach from=$featured_doctors item=doc}
        <a href="{$BASE_URL}/?page=book&doctor_id={$doc._id}" class="doctor-card">
          <div class="doctor-card__img">
            {if isset($doc.avatar) && $doc.avatar}
              <img src="{$doc.avatar}" alt="{$doc.full_name}" loading="lazy">
            {else}
              <div class="doctor-avatar__fallback"><i class="fa-solid fa-user-doctor"></i></div>
            {/if}
            {if isset($doc.is_featured) && $doc.is_featured}
              <span class="doctor-card__badge">Nổi bật</span>
            {/if}
          </div>
          <div class="doctor-card__body">
            <p class="doctor-card__degree">{$doc.degree|default:'Bác sĩ'}</p>
            <h3 class="doctor-card__name">{$doc.full_name}</h3>
            <p class="doctor-card__specialty"><i class="fa-solid fa-circle-dot"></i> {$doc.specialty}</p>
            <div class="doctor-card__meta">
              <span class="rating"><i class="fa-solid fa-star"></i> {$doc.rating|default:'5.0'}</span>
              <span class="reviews">{$doc.review_count|default:0} đánh giá</span>
            </div>
          </div>
          <div class="doctor-card__footer">
            <span class="btn-book-sm" style="background-color: #0284c7; color: white; padding: 8px 15px; border-radius: 6px; font-weight: 600; display: block; text-align: center;">Đặt lịch khám</span>
          </div>
        </a>
        {/foreach}
      {/if}
    </div>
    <div class="text-center mt-3">
      <a href="{$BASE_URL}/?page=book" class="btn-outline">Xem tất cả bác sĩ <i class="fa-solid fa-arrow-right"></i></a>
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
      <a href="{$BASE_URL}/?page=appointments" class="btn-cta-primary" style="background: white; color: #0284c7; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; font-size: 1.1rem; box-shadow: 0 10px 15px rgba(0,0,0,0.1);">
        <i class="fa-regular fa-calendar-check"></i> ĐẶT LỊCH NGAY
      </a>
    </div>
  </div>
</section>

{include file="layout/footer.tpl"}
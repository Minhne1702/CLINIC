{include file="layout/header.tpl" page_title="MediCare — Đặt lịch khám bệnh" active_page="home"}

<!-- HERO -->
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
        Kết nối bạn với hàng trăm bác sĩ chuyên khoa giàu kinh nghiệm.
        Đặt lịch trực tuyến 24/7, nhận xác nhận ngay lập tức.
      </p>
      <form class="hero__search" action="{$BASE_URL}/" method="GET">
        <div class="search-group">
          <div class="search-field">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" placeholder="Tìm bác sĩ, chuyên khoa, triệu chứng..." autocomplete="off">
          </div>
          <div class="search-field search-field--location">
            <i class="fa-solid fa-location-dot"></i>
            <select name="location">
              <option value="">Tất cả khu vực</option>
              <option value="q1">Quận 1</option>
              <option value="q3">Quận 3</option>
              <option value="q7">Quận 7</option>
              <option value="binh-thanh">Bình Thạnh</option>
              <option value="thu-duc">Thủ Đức</option>
            </select>
          </div>
          <button type="submit" class="search-btn">Tìm kiếm</button>
        </div>
      </form>
      <div class="hero__chips">
        <span>Tìm nhanh:</span>
        <a href="{$BASE_URL}/?page=doctors&amp;spec=tim-mach" class="chip">Tim mạch</a>
        <a href="{$BASE_URL}/?page=doctors&amp;spec=nhi-khoa" class="chip">Nhi khoa</a>
        <a href="{$BASE_URL}/?page=doctors&amp;spec=da-lieu" class="chip">Da liễu</a>
        <a href="{$BASE_URL}/?page=doctors&amp;spec=nha-khoa" class="chip">Nha khoa</a>
        <a href="{$BASE_URL}/?page=doctors&amp;spec=mat" class="chip">Mắt</a>
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

<!-- SERVICES -->
<section class="section section--light services">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Dịch vụ của chúng tôi</p>
      <h2 class="section-title">Chăm sóc sức khỏe <span class="text-accent">toàn diện</span></h2>
      <p class="section-desc">Đội ngũ bác sĩ chuyên khoa đầu ngành sẵn sàng hỗ trợ bạn</p>
    </div>
    <div class="services__grid" data-animate="stagger">
      {foreach from=$services item=svc}
      <a href="{$svc.url}" class="service-card">
        <div class="service-card__icon" style="--icon-color: {$svc.color}">
          <i class="{$svc.icon}"></i>
        </div>
        <h3 class="service-card__name">{$svc.name}</h3>
        <p class="service-card__desc">{$svc.description}</p>
        <span class="service-card__link">Xem thêm <i class="fa-solid fa-arrow-right"></i></span>
      </a>
      {/foreach}
    </div>
  </div>
</section>

<!-- SPECIALTIES -->
<section class="section specialties">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Chuyên khoa nổi bật</p>
      <h2 class="section-title">Tìm đúng <span class="text-accent">chuyên khoa</span></h2>
    </div>
    <div class="specialties__grid" data-animate="stagger">
      {foreach from=$specialties item=spec}
      <a href="{$spec.url}" class="spec-chip">
        <i class="{$spec.icon}"></i>
        <span>{$spec.name}</span>
      </a>
      {/foreach}
    </div>
    <div class="text-center mt-3">
      <a href="{$BASE_URL}/?page=doctors" class="btn-outline">Xem tất cả chuyên khoa <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- DOCTORS -->
<section class="section section--light doctors">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Đội ngũ bác sĩ</p>
      <h2 class="section-title">Bác sĩ <span class="text-accent">nổi bật</span></h2>
      <p class="section-desc">Được lựa chọn và kiểm duyệt kỹ lưỡng từ các bệnh viện uy tín</p>
    </div>
    <div class="doctors__grid" data-animate="stagger">
      {foreach from=$featured_doctors item=doc}
      <a href="{$BASE_URL}/?page=appointments&amp;id={$doc._id}" class="doctor-card">
        <div class="doctor-card__img">
          {if $doc.avatar}
            <img src="{$doc.avatar}" alt="{$doc.full_name}" loading="lazy">
          {else}
            <div class="doctor-avatar__fallback"><i class="fa-solid fa-user-doctor"></i></div>
          {/if}
          {if $doc.is_featured}
            <span class="doctor-card__badge">Nổi bật</span>
          {/if}
        </div>
        <div class="doctor-card__body">
          <p class="doctor-card__degree">{$doc.degree}</p>
          <h3 class="doctor-card__name">{$doc.full_name}</h3>
          <p class="doctor-card__specialty"><i class="fa-solid fa-circle-dot"></i> {$doc.specialty}</p>
          <div class="doctor-card__meta">
            <span class="rating"><i class="fa-solid fa-star"></i> {$doc.rating}</span>
            <span class="reviews">{$doc.review_count} đánh giá</span>
          </div>
        </div>
        <div class="doctor-card__footer">
          <span class="btn-book-sm">Đặt lịch</span>
        </div>
      </a>
      {/foreach}
    </div>
    <div class="text-center mt-3">
      <a href="{$BASE_URL}/?page=doctors" class="btn-outline">Xem tất cả bác sĩ <i class="fa-solid fa-arrow-right"></i></a>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
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
        <h3>Tìm bác sĩ</h3>
        <p>Tìm kiếm theo chuyên khoa, khu vực hoặc tên bác sĩ phù hợp với nhu cầu</p>
      </div>
      <div class="step-connector"><i class="fa-solid fa-arrow-right"></i></div>
      <div class="step-card">
        <div class="step-card__num">02</div>
        <div class="step-card__icon"><i class="fa-regular fa-calendar-check"></i></div>
        <h3>Chọn lịch hẹn</h3>
        <p>Xem lịch rảnh của bác sĩ và chọn thời gian khám phù hợp với bạn</p>
      </div>
      <div class="step-connector"><i class="fa-solid fa-arrow-right"></i></div>
      <div class="step-card">
        <div class="step-card__num">03</div>
        <div class="step-card__icon"><i class="fa-solid fa-circle-check"></i></div>
        <h3>Xác nhận &amp; đến khám</h3>
        <p>Nhận xác nhận qua SMS/email, đến đúng giờ và nhận phiếu khám trước khi vào</p>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section section--light testimonials">
  <div class="container">
    <div class="section-header" data-animate="fade-up">
      <p class="section-eyebrow">Đánh giá</p>
      <h2 class="section-title">Bệnh nhân nói <span class="text-accent">gì về chúng tôi</span></h2>
    </div>
    <div class="testimonials__grid" data-animate="stagger">
      {foreach from=$testimonials item=t}
      <div class="review-card">
        <div class="review-card__stars">
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
        <p class="review-card__text">"{$t.content}"</p>
        <div class="review-card__author">
          <div class="review-avatar">{$t.name|truncate:1:""}</div>
          <div>
            <strong>{$t.name}</strong>
            <span>{$t.specialty}</span>
          </div>
        </div>
      </div>
      {/foreach}
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section class="cta-banner">
  <div class="container cta-banner__inner" data-animate="fade-up">
    <div class="cta-banner__text">
      <h2>Sẵn sàng chăm sóc sức khỏe của bạn?</h2>
      <p>Đặt lịch khám ngay hôm nay — nhanh chóng, dễ dàng, không phải chờ đợi lâu.</p>
    </div>
    <div class="cta-banner__actions">
      <a href="{$BASE_URL}/?page=appointments" class="btn-cta-primary">
        <i class="fa-regular fa-calendar-check"></i> Đặt lịch ngay
      </a>
      <a href="{$BASE_URL}/?page=doctors" class="btn-cta-outline">
        <i class="fa-solid fa-user-doctor"></i> Xem bác sĩ
      </a>
    </div>
  </div>
</section>

{include file="layout/footer.tpl"}

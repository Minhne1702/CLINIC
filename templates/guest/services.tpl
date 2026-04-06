{include file="layout/header.tpl" page_title="Dịch vụ — MediCare" active_page="services"}

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
      {assign var="cur_cat" value=$smarty.get.cat|default:''}
      <a href="/CLINIC/public/?page=services" class="service-tab {if $cur_cat == ''}active{/if}">Tất cả</a>
      <a href="/CLINIC/public/?page=services&amp;cat=kham" class="service-tab {if $cur_cat == 'kham'}active{/if}">Khám bệnh</a>
      <a href="/CLINIC/public/?page=services&amp;cat=xet-nghiem" class="service-tab {if $cur_cat == 'xet-nghiem'}active{/if}">Xét nghiệm</a>
      <a href="/CLINIC/public/?page=services&amp;cat=phau-thuat" class="service-tab {if $cur_cat == 'phau-thuat'}active{/if}">Phẫu thuật</a>
      <a href="/CLINIC/public/?page=services&amp;cat=nha-khoa" class="service-tab {if $cur_cat == 'nha-khoa'}active{/if}">Nha khoa</a>
      <a href="/CLINIC/public/?page=services&amp;cat=tu-xa" class="service-tab {if $cur_cat == 'tu-xa'}active{/if}">Khám từ xa</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    {if $services}
    <div class="services-full-grid" data-animate="stagger">
      {foreach from=$services item=svc}
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:{$svc.color}">
          <i class="{$svc.icon}"></i>
        </div>
        <div class="service-full-card__body">
          <h3>{$svc.name}</h3>
          <p>{$svc.description}</p>
          {if $svc.price}
          <p class="service-price">Từ <strong>{$svc.price}</strong></p>
          {/if}
        </div>
        <a href="/CLINIC/public/?page=appointments&amp;service={$svc.id}" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">
          Đặt lịch
        </a>
      </div>
      {/foreach}
    </div>
    {else}
    <div class="services-full-grid" data-animate="stagger">
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#0ea5e9"><i class="fa-solid fa-stethoscope"></i></div>
        <div class="service-full-card__body">
          <h3>Khám chuyên khoa</h3>
          <p>Thăm khám trực tiếp với bác sĩ chuyên khoa đầu ngành. Chẩn đoán chính xác, tư vấn phác đồ điều trị phù hợp.</p>
          <p class="service-price">Từ <strong>200.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#8b5cf6"><i class="fa-solid fa-video"></i></div>
        <div class="service-full-card__body">
          <h3>Khám từ xa (Telemedicine)</h3>
          <p>Tư vấn sức khỏe qua video call với bác sĩ. Tiết kiệm thời gian, không cần đến phòng khám.</p>
          <p class="service-price">Từ <strong>150.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#10b981"><i class="fa-solid fa-clipboard-list"></i></div>
        <div class="service-full-card__body">
          <h3>Khám tổng quát</h3>
          <p>Gói kiểm tra sức khỏe định kỳ toàn diện. Phát hiện sớm các vấn đề sức khỏe tiềm ẩn.</p>
          <p class="service-price">Từ <strong>500.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#f59e0b"><i class="fa-solid fa-flask"></i></div>
        <div class="service-full-card__body">
          <h3>Xét nghiệm y học</h3>
          <p>Xét nghiệm máu, nước tiểu, sinh hóa, vi sinh với thiết bị hiện đại. Kết quả trong ngày.</p>
          <p class="service-price">Từ <strong>100.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#ef4444"><i class="fa-solid fa-tooth"></i></div>
        <div class="service-full-card__body">
          <h3>Nha khoa</h3>
          <p>Khám và điều trị các bệnh về răng miệng. Tẩy trắng răng, niềng răng, cấy ghép implant.</p>
          <p class="service-price">Từ <strong>200.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
      <div class="service-full-card">
        <div class="service-full-card__icon" style="--icon-color:#ec4899"><i class="fa-solid fa-brain"></i></div>
        <div class="service-full-card__body">
          <h3>Sức khỏe tinh thần</h3>
          <p>Tư vấn tâm lý, trị liệu tâm thần. Hỗ trợ các vấn đề lo âu, trầm cảm, stress mãn tính.</p>
          <p class="service-price">Từ <strong>300.000đ</strong></p>
        </div>
        <a href="/CLINIC/public/?page=appointments" class="btn-book-sm" style="align-self:center;white-space:nowrap;padding:.6rem 1.2rem">Đặt lịch</a>
      </div>
    </div>
    {/if}
  </div>
</section>

<section class="cta-banner">
  <div class="container cta-banner__inner">
    <div class="cta-banner__text">
      <h2>Chưa biết cần dịch vụ nào?</h2>
      <p>Liên hệ với chúng tôi để được tư vấn miễn phí và chọn dịch vụ phù hợp nhất.</p>
    </div>
    <div class="cta-banner__actions">
      <a href="/CLINIC/public/?page=contact" class="btn-cta-primary"><i class="fa-solid fa-phone"></i> Tư vấn miễn phí</a>
    </div>
  </div>
</section>

{include file="layout/footer.tpl"}

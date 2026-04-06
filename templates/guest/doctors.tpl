{include file="layout/header.tpl" page_title="Bác sĩ — MediCare" active_page="doctors"}

<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <p class="section-eyebrow">Đội ngũ bác sĩ</p>
      <h1 class="page-hero__title">Tìm <span class="text-accent">bác sĩ</span> phù hợp</h1>
      <p class="page-hero__desc">Hơn 200 bác sĩ chuyên khoa được kiểm duyệt kỹ lưỡng, sẵn sàng đồng hành cùng sức khỏe của bạn.</p>
    </div>
  </div>
</section>

<section class="section section--light" style="padding-top:2rem;padding-bottom:2rem">
  <div class="container">
    <form class="doctor-filter" method="GET" action="/">
      <input type="hidden" name="page" value="doctors">
      <div class="filter-row">
        <div class="filter-field">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bác sĩ, chuyên khoa..." value="{$smarty.get.q|default:''}">
        </div>
        <div class="filter-field filter-field--select">
          <i class="fa-solid fa-stethoscope"></i>
          {assign var="cur_spec" value=$smarty.get.spec|default:''}
          <select name="spec">
            <option value="">Tất cả chuyên khoa</option>
            <option value="tim-mach" {if $cur_spec == 'tim-mach'}selected{/if}>Tim mạch</option>
            <option value="than-kinh" {if $cur_spec == 'than-kinh'}selected{/if}>Thần kinh</option>
            <option value="nhi-khoa" {if $cur_spec == 'nhi-khoa'}selected{/if}>Nhi khoa</option>
            <option value="da-lieu" {if $cur_spec == 'da-lieu'}selected{/if}>Da liễu</option>
            <option value="mat" {if $cur_spec == 'mat'}selected{/if}>Mắt</option>
            <option value="nha-khoa" {if $cur_spec == 'nha-khoa'}selected{/if}>Nha khoa</option>
            <option value="xuong-khop" {if $cur_spec == 'xuong-khop'}selected{/if}>Cơ xương khớp</option>
            <option value="tieu-hoa" {if $cur_spec == 'tieu-hoa'}selected{/if}>Tiêu hóa</option>
          </select>
        </div>
        <div class="filter-field filter-field--select">
          <i class="fa-solid fa-sort"></i>
          {assign var="cur_sort" value=$smarty.get.sort|default:'rating'}
          <select name="sort">
            <option value="rating" {if $cur_sort == 'rating'}selected{/if}>Đánh giá cao nhất</option>
            <option value="reviews" {if $cur_sort == 'reviews'}selected{/if}>Nhiều đánh giá nhất</option>
            <option value="name" {if $cur_sort == 'name'}selected{/if}>Tên A-Z</option>
          </select>
        </div>
        <button type="submit" class="search-btn" style="border-radius:var(--radius-md)">Tìm kiếm</button>
      </div>
    </form>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="doctors-list-header">
      <p class="doctors-count">Hiển thị <strong>{$doctors|@count|default:0}</strong> bác sĩ</p>
    </div>

    {if $doctors}
    <div class="doctors__grid" data-animate="stagger">
      {foreach from=$doctors item=doc}
      <a href="/CLINIC/public/?page=doctors&amp;id={$doc._id}" class="doctor-card">
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
    {else}
    <div class="empty-state">
      <i class="fa-solid fa-user-doctor"></i>
      <h3>Không tìm thấy bác sĩ</h3>
      <p>Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
      <a href="/CLINIC/public/?page=doctors" class="btn-outline" style="margin-top:1rem">Xem tất cả bác sĩ</a>
    </div>
    {/if}
  </div>
</section>

{include file="layout/footer.tpl"}

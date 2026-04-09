<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:42:39
  from 'file:guest/doctors.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7667fbecc29_99542615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05ae5b75a564db9ae9d5491b29634cc46b13493e' => 
    array (
      0 => 'guest/doctors.tpl',
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
function content_69d7667fbecc29_99542615 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Bác sĩ — MediCare",'active_page'=>"doctors"), (int) 0, $_smarty_current_dir);
?>

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
          <input type="text" name="q" placeholder="Tên bác sĩ, chuyên khoa..." value="<?php echo (($tmp = $_GET['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <div class="filter-field filter-field--select">
          <i class="fa-solid fa-stethoscope"></i>
          <?php $_smarty_tpl->assign('cur_spec', (($tmp = $_GET['spec'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
          <select name="spec">
            <option value="">Tất cả chuyên khoa</option>
            <option value="tim-mach" <?php if ($_smarty_tpl->getValue('cur_spec') == 'tim-mach') {?>selected<?php }?>>Tim mạch</option>
            <option value="than-kinh" <?php if ($_smarty_tpl->getValue('cur_spec') == 'than-kinh') {?>selected<?php }?>>Thần kinh</option>
            <option value="nhi-khoa" <?php if ($_smarty_tpl->getValue('cur_spec') == 'nhi-khoa') {?>selected<?php }?>>Nhi khoa</option>
            <option value="da-lieu" <?php if ($_smarty_tpl->getValue('cur_spec') == 'da-lieu') {?>selected<?php }?>>Da liễu</option>
            <option value="mat" <?php if ($_smarty_tpl->getValue('cur_spec') == 'mat') {?>selected<?php }?>>Mắt</option>
            <option value="nha-khoa" <?php if ($_smarty_tpl->getValue('cur_spec') == 'nha-khoa') {?>selected<?php }?>>Nha khoa</option>
            <option value="xuong-khop" <?php if ($_smarty_tpl->getValue('cur_spec') == 'xuong-khop') {?>selected<?php }?>>Cơ xương khớp</option>
            <option value="tieu-hoa" <?php if ($_smarty_tpl->getValue('cur_spec') == 'tieu-hoa') {?>selected<?php }?>>Tiêu hóa</option>
          </select>
        </div>
        <div class="filter-field filter-field--select">
          <i class="fa-solid fa-sort"></i>
          <?php $_smarty_tpl->assign('cur_sort', (($tmp = $_GET['sort'] ?? null)===null||$tmp==='' ? 'rating' ?? null : $tmp), false, NULL);?>
          <select name="sort">
            <option value="rating" <?php if ($_smarty_tpl->getValue('cur_sort') == 'rating') {?>selected<?php }?>>Đánh giá cao nhất</option>
            <option value="reviews" <?php if ($_smarty_tpl->getValue('cur_sort') == 'reviews') {?>selected<?php }?>>Nhiều đánh giá nhất</option>
            <option value="name" <?php if ($_smarty_tpl->getValue('cur_sort') == 'name') {?>selected<?php }?>>Tên A-Z</option>
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
      <p class="doctors-count">Hiển thị <strong><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('doctors')) ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong> bác sĩ</p>
    </div>

    <?php if ($_smarty_tpl->getValue('doctors')) {?>
    <div class="doctors__grid" data-animate="stagger">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach0DoElse = false;
?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=doctors&amp;id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="doctor-card">
        <div class="doctor-card__img">
          <?php if ($_smarty_tpl->getValue('doc')['avatar']) {?>
            <img src="<?php echo $_smarty_tpl->getValue('doc')['avatar'];?>
" alt="<?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
" loading="lazy">
          <?php } else { ?>
            <div class="doctor-avatar__fallback"><i class="fa-solid fa-user-doctor"></i></div>
          <?php }?>
          <?php if ($_smarty_tpl->getValue('doc')['is_featured']) {?>
            <span class="doctor-card__badge">Nổi bật</span>
          <?php }?>
        </div>
        <div class="doctor-card__body">
          <p class="doctor-card__degree"><?php echo $_smarty_tpl->getValue('doc')['degree'];?>
</p>
          <h3 class="doctor-card__name"><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</h3>
          <p class="doctor-card__specialty"><i class="fa-solid fa-circle-dot"></i> <?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</p>
          <div class="doctor-card__meta">
            <span class="rating"><i class="fa-solid fa-star"></i> <?php echo $_smarty_tpl->getValue('doc')['rating'];?>
</span>
            <span class="reviews"><?php echo $_smarty_tpl->getValue('doc')['review_count'];?>
 đánh giá</span>
          </div>
        </div>
        <div class="doctor-card__footer">
          <span class="btn-book-sm">Đặt lịch</span>
        </div>
      </a>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php } else { ?>
    <div class="empty-state">
      <i class="fa-solid fa-user-doctor"></i>
      <h3>Không tìm thấy bác sĩ</h3>
      <p>Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=doctors" class="btn-outline" style="margin-top:1rem">Xem tất cả bác sĩ</a>
    </div>
    <?php }?>
  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

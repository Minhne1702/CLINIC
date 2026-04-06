<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:38:31
  from 'file:layout/footer.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32ab7df88b8_43682764',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7f6f6d9ee197eef1092f81e611cc0fb94bfc332' => 
    array (
      0 => 'layout/footer.tpl',
      1 => 1775438033,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d32ab7df88b8_43682764 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
$_smarty_tpl->assign('current_role', (($tmp = $_SESSION['user']['role'] ?? null)===null||$tmp==='' ? 'guest' ?? null : $tmp), false, NULL);?>

<?php if ($_smarty_tpl->getValue('current_role') == 'admin' || $_smarty_tpl->getValue('current_role') == 'doctor' || $_smarty_tpl->getValue('current_role') == 'receptionist' || $_smarty_tpl->getValue('current_role') == 'cashier' || $_smarty_tpl->getValue('current_role') == 'pharmacist') {?>

  </div><!-- /.admin-content -->
</div><!-- /.admin-main -->

<?php echo '<script'; ?>
 src="/CLINIC/public/assets/js/admin.js"><?php echo '</script'; ?>
>
<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_147735978769d32ab7df2df5_89491784', "extra_js");
?>

</body>
</html>

<?php } else { ?>

</main><!-- /.main-content -->

<footer class="footer">

  <div class="footer-newsletter">
    <div class="container footer-newsletter__inner">
      <div class="footer-newsletter__text">
        <h3>Nhận thông tin sức khỏe hữu ích</h3>
        <p>Cập nhật lịch khám, tin tức y tế và ưu đãi mới nhất từ MediCare</p>
      </div>
      <form class="footer-newsletter__form" action="/subscribe" method="POST">
        <input type="email" name="email" placeholder="Nhập email của bạn..." required>
        <button type="submit">Đăng ký</button>
      </form>
    </div>
  </div>

  <div class="footer-main">
    <div class="container footer-main__grid">

      <div class="footer-col footer-col--brand">
        <div class="footer-logo">
          <div class="logo-icon logo-icon--sm"><i class="fa-solid fa-heart-pulse"></i></div>
          <span class="logo-name">MediCare</span>
        </div>
        <p class="footer-tagline">Nền tảng đặt lịch khám bệnh và chăm sóc sức khỏe toàn diện — nhanh chóng, tiện lợi, đáng tin cậy.</p>
        <div class="footer-social">
          <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" aria-label="Zalo"><i class="fa-brands fa-facebook-messenger"></i></a>
          <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Dịch vụ</h4>
        <ul>
          <li><a href="/CLINIC/public/?page=services">Khám chuyên khoa</a></li>
          <li><a href="/CLINIC/public/?page=services">Khám từ xa</a></li>
          <li><a href="/CLINIC/public/?page=services">Khám tổng quát</a></li>
          <li><a href="/CLINIC/public/?page=services">Xét nghiệm y học</a></li>
          <li><a href="/CLINIC/public/?page=services">Nha khoa</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Thông tin</h4>
        <ul>
          <li><a href="/CLINIC/public/?page=about">Về chúng tôi</a></li>
          <li><a href="/CLINIC/public/?page=doctors">Đội ngũ bác sĩ</a></li>
          <li><a href="/CLINIC/public/?page=contact">Liên hệ</a></li>
        </ul>
      </div>

      <div class="footer-col footer-col--contact">
        <h4>Liên hệ</h4>
        <ul class="footer-contact-list">
          <li><i class="fa-solid fa-location-dot"></i><span>123 Nguyễn Thị Minh Khai, Quận 1, TP. HCM</span></li>
          <li><i class="fa-solid fa-phone"></i><span><a href="tel:1900xxxx">1900 xxxx</a></span></li>
          <li><i class="fa-regular fa-envelope"></i><span><a href="mailto:info@medicare.vn">info@medicare.vn</a></span></li>
          <li><i class="fa-regular fa-clock"></i><span>Thứ 2 – Thứ 7: 07:30 – 17:00</span></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom__inner">
      <p>&copy; <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y");?>
 MediCare. Bảo lưu mọi quyền.</p>
      <div class="footer-bottom__links">
        <a href="#">Chính sách bảo mật</a>
        <a href="#">Điều khoản sử dụng</a>
        <a href="#">Sitemap</a>
      </div>
    </div>
  </div>

</footer>

<?php echo '<script'; ?>
 src="/CLINIC/public/assets/js/main.js"><?php echo '</script'; ?>
>
<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_50895894569d32ab7df6938_76871553', "extra_js");
?>


<?php echo '<script'; ?>
>
  const hamburger = document.getElementById('hamburger');
  const mobileNav = document.getElementById('mobile-nav');
  const overlay   = document.getElementById('mobile-overlay');
  const closeBtn  = document.getElementById('mobile-close');
  if (hamburger) {
    function openNav()  { mobileNav.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow='hidden'; }
    function closeNav() { mobileNav.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow=''; }
    hamburger.addEventListener('click', openNav);
    closeBtn.addEventListener('click', closeNav);
    overlay.addEventListener('click', closeNav);
  }
  const header = document.getElementById('main-header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 40);
    });
  }
<?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
/* {block "extra_js"} */
class Block_147735978769d32ab7df2df5_89491784 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
}
}
/* {/block "extra_js"} */
/* {block "extra_js"} */
class Block_50895894569d32ab7df6938_76871553 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
}
}
/* {/block "extra_js"} */
}

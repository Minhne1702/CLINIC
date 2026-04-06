<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:38:31
  from 'file:layout/header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32ab797a351_08121218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11f2a8dc472a3fd4f898e7d02d8a9832e37ae520' => 
    array (
      0 => 'layout/header.tpl',
      1 => 1775401385,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d32ab797a351_08121218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "MediCare — Đặt lịch khám bệnh" ?? null : $tmp);?>
</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/CLINIC/public/assets/css/main.css">
  <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_125154043769d32ab77f3df6_97506746', "extra_css");
?>

</head>
<body class="<?php echo (($tmp = $_smarty_tpl->getValue('body_class') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

<!-- ===== TOP BAR ===== -->
<div class="topbar">
  <div class="container topbar__inner">
    <div class="topbar__links">
      <a href="/CLINIC/public/?page=about"><i class="fa-regular fa-building"></i> Về chúng tôi</a>
      <a href="/CLINIC/public/?page=contact"><i class="fa-regular fa-envelope"></i> Liên hệ</a>
      <a href="tel:1900xxxx"><i class="fa-solid fa-phone-volume"></i> Hotline: 1900 xxxx</a>
    </div>
    <div class="topbar__auth">
      <?php if ((true && (true && null !== ($_SESSION['user'] ?? null))) && $_SESSION['user']) {?>
        <span class="topbar__welcome">Xin chào, <strong><?php echo $_SESSION['user']['full_name'];?>
</strong></span>
        <a href="/CLINIC/public/?action=logout" class="btn-topbar btn-topbar--outline">Đăng xuất</a>
      <?php } else { ?>
        <a href="/CLINIC/public/?page=login" class="btn-topbar">Đăng nhập</a>
        <a href="/CLINIC/public/?page=register" class="btn-topbar btn-topbar--primary">Đăng ký</a>
      <?php }?>
    </div>
  </div>
</div>

<!-- ===== MAIN NAV ===== -->
<header class="header" id="main-header">
  <div class="container header__inner">

    <!-- Logo -->
    <a href="/CLINIC/public/" class="header__logo">
      <div class="logo-icon">
        <i class="fa-solid fa-heart-pulse"></i>
      </div>
      <div class="logo-text">
        <span class="logo-name">MediCare</span>
        <span class="logo-sub">Phòng khám đa khoa</span>
      </div>
    </a>

    <!-- Nav links -->
    <nav class="header__nav" id="main-nav">
      <a href="/CLINIC/public/" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'home') {?>active<?php }?>">Trang chủ</a>
      <a href="/CLINIC/public/?page=doctors" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'doctors') {?>active<?php }?>">Bác sĩ</a>
      <a href="/CLINIC/public/?page=services" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'services') {?>active<?php }?>">Dịch vụ</a>
      <a href="/CLINIC/public/?page=appointments" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>">Đặt lịch</a>
      <a href="/CLINIC/public/?page=contact" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'contact') {?>active<?php }?>">Liên hệ</a>
    </nav>

    <!-- CTA + Hamburger -->
    <div class="header__actions">
      <a href="/CLINIC/public/?page=appointments" class="btn-book">
        <i class="fa-regular fa-calendar-check"></i>
        Đặt lịch ngay
      </a>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>

<!-- Mobile nav overlay -->
<div class="mobile-nav-overlay" id="mobile-overlay"></div>
<nav class="mobile-nav" id="mobile-nav">
  <div class="mobile-nav__header">
    <span class="logo-name">MediCare</span>
    <button class="mobile-nav__close" id="mobile-close"><i class="fa-solid fa-xmark"></i></button>
  </div>
  <div class="mobile-nav__links">
    <a href="/CLINIC/public/">Trang chủ</a>
    <a href="/CLINIC/public/?page=doctors">Bác sĩ</a>
    <a href="/CLINIC/public/?page=services">Dịch vụ</a>
    <a href="/CLINIC/public/?page=appointments">Đặt lịch</a>
    <a href="/CLINIC/public/?page=contact">Liên hệ</a>
    <a href="/CLINIC/public/?page=appointments" class="mobile-nav__cta">Đặt lịch ngay</a>
  </div>
</nav>

<main class="main-content">
<?php }
/* {block "extra_css"} */
class Block_125154043769d32ab77f3df6_97506746 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
}
}
/* {/block "extra_css"} */
}

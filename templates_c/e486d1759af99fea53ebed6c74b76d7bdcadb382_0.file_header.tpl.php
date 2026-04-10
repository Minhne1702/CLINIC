<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:53:04
  from 'file:layout/header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d900c0a08a39_05458053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e486d1759af99fea53ebed6c74b76d7bdcadb382' => 
    array (
      0 => 'layout/header.tpl',
      1 => 1775782839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d900c0a08a39_05458053 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\layout';
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
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/assets/css/main.css">
  <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_65832516569d900c09fc4b2_37188159', "extra_css");
?>

</head>
<body class="<?php echo (($tmp = $_smarty_tpl->getValue('body_class') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

<?php $_smarty_tpl->assign('is_patient', ((true && (true && null !== ($_SESSION['user'] ?? null))) && $_SESSION['user']['role'] == 'patient'), false, NULL);?>

<div class="topbar">
  <div class="container topbar__inner">
    <div class="topbar__links">
      <?php if (!$_smarty_tpl->getValue('is_patient')) {?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=about"><i class="fa-regular fa-building"></i> Về chúng tôi</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=contact"><i class="fa-regular fa-envelope"></i> Liên hệ</a>
      <?php } else { ?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=dashboard"><i class="fa-solid fa-house-user"></i> Cổng bệnh nhân</a>
      <?php }?>
      <a href="tel:1900xxxx"><i class="fa-solid fa-phone-volume"></i> Hotline: 1900 xxxx</a>
    </div>
    <div class="topbar__auth">
      <?php if ((true && (true && null !== ($_SESSION['user'] ?? null)))) {?>
        <span class="topbar__welcome">Xin chào, <strong><?php echo (($tmp = $_SESSION['user']['full_name'] ?? null)===null||$tmp==='' ? 'Bệnh nhân' ?? null : $tmp);?>
</strong></span>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?action=logout" class="btn-topbar btn-topbar--outline">Đăng xuất</a>
      <?php } else { ?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=login" class="btn-topbar">Đăng nhập</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=register" class="btn-topbar btn-topbar--primary">Đăng ký</a>
      <?php }?>
    </div>
  </div>
</div>

<header class="header" id="main-header">
  <div class="container header__inner">

    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="header__logo">
      <div class="logo-icon">
        <i class="fa-solid fa-heart-pulse"></i>
      </div>
      <div class="logo-text">
        <span class="logo-name">MediCare</span>
        <span class="logo-sub">Phòng khám đa khoa</span>
      </div>
    </a>

    <nav class="header__nav" id="main-nav">
      <?php if ($_smarty_tpl->getValue('is_patient')) {?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=dashboard" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>">Tổng quan</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>">Lịch hẹn</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'records') {?>active<?php }?>">Hồ sơ bệnh án</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'prescriptions') {?>active<?php }?>">Đơn thuốc</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=test-results" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'test-results') {?>active<?php }?>">Xét nghiệm</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=profile" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'profile') {?>active<?php }?>">Cá nhân</a>
      <?php } else { ?>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'home') {?>active<?php }?>">Trang chủ</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=doctors" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'doctors') {?>active<?php }?>">Bác sĩ</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'services') {?>active<?php }?>">Dịch vụ</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>">Đặt lịch</a>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=contact" class="nav-link <?php if ($_smarty_tpl->getValue('active_page') == 'contact') {?>active<?php }?>">Liên hệ</a>
      <?php }?>
    </nav>

    <div class="header__actions">
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-book">
        <i class="fa-regular fa-calendar-check"></i>
        Đặt lịch ngay
      </a>
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>

<div class="mobile-nav-overlay" id="mobile-overlay"></div>
<nav class="mobile-nav" id="mobile-nav">
  <div class="mobile-nav__header">
    <span class="logo-name">MediCare</span>
    <button class="mobile-nav__close" id="mobile-close"><i class="fa-solid fa-xmark"></i></button>
  </div>
  <div class="mobile-nav__links">
    <?php if ($_smarty_tpl->getValue('is_patient')) {?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=dashboard">Tổng quan</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments">Lịch hẹn của tôi</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records">Hồ sơ khám bệnh</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=profile">Thông tin cá nhân</a>
    <?php } else { ?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/">Trang chủ</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=doctors">Bác sĩ</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=services">Dịch vụ</a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=contact">Liên hệ</a>
    <?php }?>
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="mobile-nav__cta">Đặt lịch ngay</a>
  </div>
</nav>

<main class="main-content"><?php }
/* {block "extra_css"} */
class Block_65832516569d900c09fc4b2_37188159 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\layout';
}
}
/* {/block "extra_css"} */
}

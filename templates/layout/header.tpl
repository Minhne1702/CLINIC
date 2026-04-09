<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{$page_title|default:"MediCare — Đặt lịch khám bệnh"}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{$BASE_URL}/assets/css/main.css">
  {block name="extra_css"}{/block}
</head>
<body class="{$body_class|default:''}">

{assign var="is_patient" value=(isset($smarty.session.user) && $smarty.session.user.role == 'patient')}

<div class="topbar">
  <div class="container topbar__inner">
    <div class="topbar__links">
      {if !$is_patient}
        <a href="{$BASE_URL}/?page=about"><i class="fa-regular fa-building"></i> Về chúng tôi</a>
        <a href="{$BASE_URL}/?page=contact"><i class="fa-regular fa-envelope"></i> Liên hệ</a>
      {else}
        <a href="{$BASE_URL}/?page=dashboard"><i class="fa-solid fa-house-user"></i> Cổng bệnh nhân</a>
      {/if}
      <a href="tel:1900xxxx"><i class="fa-solid fa-phone-volume"></i> Hotline: 1900 xxxx</a>
    </div>
    <div class="topbar__auth">
      {if isset($smarty.session.user)}
        <span class="topbar__welcome">Xin chào, <strong>{$smarty.session.user.full_name|default:'Bệnh nhân'}</strong></span>
        <a href="{$BASE_URL}/?action=logout" class="btn-topbar btn-topbar--outline">Đăng xuất</a>
      {else}
        <a href="{$BASE_URL}/?page=login" class="btn-topbar">Đăng nhập</a>
        <a href="{$BASE_URL}/?page=register" class="btn-topbar btn-topbar--primary">Đăng ký</a>
      {/if}
    </div>
  </div>
</div>

<header class="header" id="main-header">
  <div class="container header__inner">

    <a href="{$BASE_URL}/" class="header__logo">
      <div class="logo-icon">
        <i class="fa-solid fa-heart-pulse"></i>
      </div>
      <div class="logo-text">
        <span class="logo-name">MediCare</span>
        <span class="logo-sub">Phòng khám đa khoa</span>
      </div>
    </a>

    <nav class="header__nav" id="main-nav">
      {if $is_patient}
        <a href="{$BASE_URL}/?page=dashboard" class="nav-link {if $active_page == 'dashboard'}active{/if}">Tổng quan</a>
        <a href="{$BASE_URL}/?page=appointments" class="nav-link {if $active_page == 'appointments'}active{/if}">Lịch hẹn</a>
        <a href="{$BASE_URL}/?page=records" class="nav-link {if $active_page == 'records'}active{/if}">Hồ sơ bệnh án</a>
        <a href="{$BASE_URL}/?page=prescriptions" class="nav-link {if $active_page == 'prescriptions'}active{/if}">Đơn thuốc</a>
        <a href="{$BASE_URL}/?page=test-results" class="nav-link {if $active_page == 'test-results'}active{/if}">Xét nghiệm</a>
        <a href="{$BASE_URL}/?page=profile" class="nav-link {if $active_page == 'profile'}active{/if}">Cá nhân</a>
      {else}
        <a href="{$BASE_URL}/" class="nav-link {if $active_page == 'home'}active{/if}">Trang chủ</a>
        <a href="{$BASE_URL}/?page=doctors" class="nav-link {if $active_page == 'doctors'}active{/if}">Bác sĩ</a>
        <a href="{$BASE_URL}/?page=services" class="nav-link {if $active_page == 'services'}active{/if}">Dịch vụ</a>
        <a href="{$BASE_URL}/?page=appointments" class="nav-link {if $active_page == 'appointments'}active{/if}">Đặt lịch</a>
        <a href="{$BASE_URL}/?page=contact" class="nav-link {if $active_page == 'contact'}active{/if}">Liên hệ</a>
      {/if}
    </nav>

    <div class="header__actions">
      <a href="{$BASE_URL}/?page=appointments" class="btn-book">
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
    {if $is_patient}
      <a href="{$BASE_URL}/?page=dashboard">Tổng quan</a>
      <a href="{$BASE_URL}/?page=appointments">Lịch hẹn của tôi</a>
      <a href="{$BASE_URL}/?page=records">Hồ sơ khám bệnh</a>
      <a href="{$BASE_URL}/?page=profile">Thông tin cá nhân</a>
    {else}
      <a href="{$BASE_URL}/">Trang chủ</a>
      <a href="{$BASE_URL}/?page=doctors">Bác sĩ</a>
      <a href="{$BASE_URL}/?page=services">Dịch vụ</a>
      <a href="{$BASE_URL}/?page=contact">Liên hệ</a>
    {/if}
    <a href="{$BASE_URL}/?page=appointments" class="mobile-nav__cta">Đặt lịch ngay</a>
  </div>
</nav>

<main class="main-content">
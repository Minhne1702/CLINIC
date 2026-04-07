<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{$page_title|default:"MediCare — Đặt lịch khám bệnh"}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{$base_url}/assets/css/main.css">
  {block name="extra_css"}{/block}
</head>
<body class="{$body_class|default:''}">

<!-- ===== TOP BAR ===== -->
<div class="topbar">
  <div class="container topbar__inner">
    <div class="topbar__links">
      <a href="{$base_url}/?page=about"><i class="fa-regular fa-building"></i> Về chúng tôi</a>
      <a href="{$base_url}/?page=contact"><i class="fa-regular fa-envelope"></i> Liên hệ</a>
      <a href="tel:1900xxxx"><i class="fa-solid fa-phone-volume"></i> Hotline: 1900 xxxx</a>
    </div>
    <div class="topbar__auth">
      {if isset($smarty.session.user) && $smarty.session.user}
        <span class="topbar__welcome">Xin chào, <strong>{$smarty.session.user.full_name}</strong></span>
        <a href="{$base_url}/?action=logout" class="btn-topbar btn-topbar--outline">Đăng xuất</a>
      {else}
        <a href="{$base_url}/?page=login" class="btn-topbar">Đăng nhập</a>
        <a href="{$base_url}/?page=register" class="btn-topbar btn-topbar--primary">Đăng ký</a>
      {/if}
    </div>
  </div>
</div>

<!-- ===== MAIN NAV ===== -->
<header class="header" id="main-header">
  <div class="container header__inner">

    <!-- Logo -->
    <a href="{$base_url}/" class="header__logo">
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
      <a href="{$base_url}/" class="nav-link {if $active_page == 'home'}active{/if}">Trang chủ</a>
      <a href="{$base_url}/?page=doctors" class="nav-link {if $active_page == 'doctors'}active{/if}">Bác sĩ</a>
      <a href="{$base_url}/?page=services" class="nav-link {if $active_page == 'services'}active{/if}">Dịch vụ</a>
      <a href="{$base_url}/?page=appointments" class="nav-link {if $active_page == 'appointments'}active{/if}">Đặt lịch</a>
      <a href="{$base_url}/?page=contact" class="nav-link {if $active_page == 'contact'}active{/if}">Liên hệ</a>
    </nav>

    <!-- CTA + Hamburger -->
    <div class="header__actions">
      <a href="{$base_url}/?page=appointments" class="btn-book">
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
    <a href="{$base_url}/">Trang chủ</a>
    <a href="{$base_url}/?page=doctors">Bác sĩ</a>
    <a href="{$base_url}/?page=services">Dịch vụ</a>
    <a href="{$base_url}/?page=appointments">Đặt lịch</a>
    <a href="{$base_url}/?page=contact">Liên hệ</a>
    <a href="{$base_url}/?page=appointments" class="mobile-nav__cta">Đặt lịch ngay</a>
  </div>
</nav>

<main class="main-content">

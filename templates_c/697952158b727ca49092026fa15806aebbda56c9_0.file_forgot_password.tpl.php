<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:55:45
  from 'file:guest/forgot_password.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d901610e4ff2_53594669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '697952158b727ca49092026fa15806aebbda56c9' => 
    array (
      0 => 'guest/forgot_password.tpl',
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
function content_69d901610e4ff2_53594669 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quên mật khẩu — MediCare",'active_page'=>''), (int) 0, $_smarty_current_dir);
?>

<section class="auth-section auth-section--center">
  <div class="auth-single-wrap" data-animate="fade-up">
    <div class="form-card">
      <div class="auth-icon-top">
        <i class="fa-solid fa-lock-open"></i>
      </div>
      <div class="form-card__header" style="text-align:center">
        <h2>Quên mật khẩu?</h2>
        <p>Nhập email của bạn, chúng tôi sẽ gửi mật khẩu mới trực tiếp qua mail.</p>
      </div>

      <?php if ($_smarty_tpl->getValue('status') === 'success') {?>
        <div class="alert alert--success">
          <i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('message');?>

        </div>
      <?php }?>

      <?php if ($_smarty_tpl->getValue('status') === 'error') {?>
        <div class="alert alert--danger">
          <i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('message');?>

        </div>
      <?php }?>

      <?php if ($_smarty_tpl->getValue('status') !== 'success') {?>
        <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/index.php?page=forgot-password" method="POST" class="appt-form">
          <div class="form-group">
            <label>Email đã đăng ký <span class="required">*</span></label>
            <div class="input-icon-wrap">
              <i class="fa-regular fa-envelope"></i>
              <input type="email" name="email" placeholder="email@example.com" required autocomplete="email">
            </div>
          </div>

          <button type="submit" name="btn_forgot" class="btn-submit">
            <i class="fa-solid fa-paper-plane"></i> Gửi mật khẩu mới
          </button>
        </form>
      <?php }?>

      <div class="auth-back-link">
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/index.php?page=login"><i class="fa-solid fa-arrow-left"></i> Quay lại đăng nhập</a>
      </div>
    </div>
  </div>
</section>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

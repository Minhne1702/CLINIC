<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:01:50
  from 'file:patient/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4b9ee0eadc9_72955265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13ffd0d84ca8521ae61fbef650691a7e501176c3' => 
    array (
      0 => 'patient/appointments.tpl',
      1 => 1775546741,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4b9ee0eadc9_72955265 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Lịch hẹn của tôi",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Lịch hẹn của tôi</h2>
    <p class="page-subtitle">Quản lý tất cả lịch hẹn khám bệnh</p>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-admin-primary">
      <i class="fa-regular fa-calendar-plus"></i> Đặt lịch mới
    </a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<div class="status-tabs mb-1">
  <?php $_smarty_tpl->assign('cur', (($tmp = $_smarty_tpl->getValue('filter')['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == '') {?>active<?php }?>">
    Tất cả <span class="tab-count"><?php echo (($tmp = $_smarty_tpl->getValue('count')['all'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&status=pending" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'pending') {?>active<?php }?>">
    Chờ xác nhận <span class="tab-count tab-count--warning"><?php echo (($tmp = $_smarty_tpl->getValue('count')['pending'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&status=confirmed" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'confirmed') {?>active<?php }?>">
    Đã xác nhận <span class="tab-count tab-count--blue"><?php echo (($tmp = $_smarty_tpl->getValue('count')['confirmed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&status=completed" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'completed') {?>active<?php }?>">
    Đã khám <span class="tab-count tab-count--success"><?php echo (($tmp = $_smarty_tpl->getValue('count')['completed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&status=cancelled" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'cancelled') {?>active<?php }?>">
    Đã hủy <span class="tab-count tab-count--danger"><?php echo (($tmp = $_smarty_tpl->getValue('count')['cancelled'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
</div>

<div class="appt-card-list">
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
  <div class="appt-full-card">
    <div class="appt-full-card__left">
      <div class="appt-full-card__date">
        <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d");?>
</strong>
        <span><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%m/%Y");?>
</span>
        <small><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</small>
      </div>
    </div>

    <div class="appt-full-card__body">
      <div class="appt-full-card__row">
        <h4>BS. <?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</h4>
        <span class="badge badge--<?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>blue<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>warning<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?>success<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'cancelled') {?>danger<?php } else { ?>neutral<?php }?>">
          <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>Đã xác nhận
          <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>Chờ xác nhận
          <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?>Đã khám
          <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'cancelled') {?>Đã hủy
          <?php } else {
echo $_smarty_tpl->getValue('apt')['status'];
}?>
        </span>
      </div>
      <p><i class="fa-solid fa-stethoscope"></i> <?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</p>
      <p>
        <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online') {?>
          <span class="badge badge--blue" style="font-size:12px"><i class="fa-solid fa-video"></i> Khám từ xa</span>
        <?php } else { ?>
          <span class="badge badge--neutral" style="font-size:12px"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
        <?php }?>
        &nbsp;·&nbsp; Mã: <code style="font-size:12px;background:#f1f5f9;padding:2px 6px;border-radius:4px"><?php echo (($tmp = $_smarty_tpl->getValue('apt')['code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</code>
      </p>
      <?php if ($_smarty_tpl->getValue('apt')['symptoms']) {?>
      <p style="font-size:13px;color:var(--admin-text-secondary);margin-top:.4rem">
        <i class="fa-solid fa-notes-medical"></i> <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('apt')['symptoms'],80,'...');?>

      </p>
      <?php }?>
    </div>

    <div class="appt-full-card__actions">
      <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online' && ($_smarty_tpl->getValue('apt')['status'] == 'confirmed' || $_smarty_tpl->getValue('apt')['status'] == 'pending')) {?>
      <a href="#" class="btn-admin-primary" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-video"></i> Vào phòng khám
      </a>
      <?php }?>
      <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed' || $_smarty_tpl->getValue('apt')['status'] == 'pending') {?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&action=cancel&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
"
         class="btn-admin-secondary" style="font-size:13px;padding:.5rem 1rem"
         onclick="return confirm('Bạn chắc chắn muốn hủy lịch này?\nLưu ý: Chỉ hủy được trước 2 tiếng.')">
        <i class="fa-solid fa-ban"></i> Hủy lịch
      </a>
      <?php }?>
      <?php if ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records&apt_id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
"
         class="btn-admin-secondary" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-file-medical"></i> Xem hồ sơ
      </a>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-admin-ghost" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-rotate-right"></i> Đặt lại
      </a>
      <?php }?>
    </div>
  </div>
  <?php
}
if ($foreach0DoElse) {
?>
  <div class="empty-state" style="padding:3rem">
    <i class="fa-regular fa-calendar"></i>
    <h3>Không có lịch hẹn nào</h3>
    <p>Bạn chưa có lịch hẹn trong mục này.</p>
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-admin-primary" style="margin-top:1rem">
      <i class="fa-regular fa-calendar-plus"></i> Đặt lịch ngay
    </a>
  </div>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

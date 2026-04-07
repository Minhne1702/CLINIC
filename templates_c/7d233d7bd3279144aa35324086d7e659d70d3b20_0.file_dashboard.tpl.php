<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:01:34
  from 'file:patient/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4b9de741bb0_07353951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d233d7bd3279144aa35324086d7e659d70d3b20' => 
    array (
      0 => 'patient/dashboard.tpl',
      1 => 1775546711,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4b9de741bb0_07353951 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<div class="patient-welcome">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span class="text-accent-light"><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Bạn" ?? null : $tmp);?>
</span> 👋</h2>
    <p>Hôm nay <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d/%m/%Y");?>
 — Chúc bạn sức khỏe!</p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="patient-welcome__btn">
    <i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám mới
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-calendar-check"></i></div>
    <div><p>Lịch hẹn sắp tới</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['upcoming'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-clock-rotate-left"></i></div>
    <div><p>Tổng lần khám</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['total_visits'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-prescription"></i></div>
    <div><p>Đơn thuốc</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['prescriptions'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-flask"></i></div>
    <div><p>Kết quả xét nghiệm</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['test_results'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
</div>

<div class="dashboard-grid">

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-calendar-check"></i> Lịch hẹn sắp tới</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0">
      <?php if ($_smarty_tpl->getValue('upcoming_appointments')) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('upcoming_appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
        <div class="appt-item">
          <div class="appt-item__date">
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d");?>
</strong>
            <span><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%m/%Y");?>
</span>
            <small><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</small>
          </div>
          <div class="appt-item__info">
            <strong><?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</strong>
            <p><i class="fa-solid fa-stethoscope"></i> <?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</p>
            <p>
              <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online') {?>
                <span class="badge badge--blue" style="font-size:11px"><i class="fa-solid fa-video"></i> Online</span>
              <?php } else { ?>
                <span class="badge badge--neutral" style="font-size:11px"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
              <?php }?>
              &nbsp; Mã: <code style="font-size:11px;background:#f1f5f9;padding:1px 5px;border-radius:4px"><?php echo (($tmp = $_smarty_tpl->getValue('apt')['code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</code>
            </p>
          </div>
          <div class="appt-item__actions">
            <span class="badge badge--<?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>blue<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>warning<?php } else { ?>neutral<?php }?>">
              <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>Đã xác nhận
              <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>Chờ xác nhận
              <?php } else {
echo $_smarty_tpl->getValue('apt')['status'];
}?>
            </span>
            <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed' || $_smarty_tpl->getValue('apt')['status'] == 'pending') {?>
            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments&action=cancel&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
"
               class="action-btn action-btn--danger" title="Hủy lịch"
               onclick="return confirm('Bạn chắc chắn muốn hủy lịch này?')">
              <i class="fa-solid fa-ban"></i>
            </a>
            <?php }?>
          </div>
        </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
        <div class="empty-state" style="padding:2.5rem">
          <i class="fa-regular fa-calendar"></i>
          <h3>Chưa có lịch hẹn sắp tới</h3>
          <p>Đặt lịch để được khám bởi bác sĩ chuyên khoa</p>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-admin-primary" style="margin-top:1rem">
            <i class="fa-regular fa-calendar-plus"></i> Đặt lịch ngay
          </a>
        </div>
      <?php }?>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-file-medical"></i> Lịch sử khám gần đây</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0">
      <?php if ($_smarty_tpl->getValue('recent_records')) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recent_records'), 'rec');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach1DoElse = false;
?>
        <div class="record-item">
          <div class="record-item__icon"><i class="fa-solid fa-notes-medical"></i></div>
          <div class="record-item__info">
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rec')['diagnosis'] ?? null)===null||$tmp==='' ? 'Khám tổng quát' ?? null : $tmp),35,'...');?>
</strong>
            <p>BS. <?php echo $_smarty_tpl->getValue('rec')['doctor_name'];?>
 &nbsp;·&nbsp; <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rec')['date'],"%d/%m/%Y");?>
</p>
          </div>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records&id=<?php echo $_smarty_tpl->getValue('rec')['_id'];?>
" class="action-btn" title="Xem chi tiết">
            <i class="fa-solid fa-eye"></i>
          </a>
        </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
        <div class="empty-state" style="padding:2rem">
          <i class="fa-solid fa-file-medical"></i>
          <p>Chưa có lịch sử khám bệnh</p>
        </div>
      <?php }?>
    </div>
  </div>

</div>

<?php if ($_smarty_tpl->getValue('notifications')) {?>
<div class="admin-card" style="margin-top:1rem">
  <div class="admin-card__header">
    <h3><i class="fa-regular fa-bell"></i> Thông báo mới</h3>
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=notifications" class="btn-link">Xem tất cả</a>
  </div>
  <div class="admin-card__body p-0">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('notifications'), 'notif');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('notif')->value) {
$foreach2DoElse = false;
?>
    <div class="notif-item <?php if (!$_smarty_tpl->getValue('notif')['is_read']) {?>notif-item--unread<?php }?>">
      <div class="notif-item__icon notif-item__icon--<?php echo (($tmp = $_smarty_tpl->getValue('notif')['type'] ?? null)===null||$tmp==='' ? 'info' ?? null : $tmp);?>
">
        <?php if ($_smarty_tpl->getValue('notif')['type'] == 'appointment') {?><i class="fa-solid fa-calendar-check"></i>
        <?php } elseif ($_smarty_tpl->getValue('notif')['type'] == 'reminder') {?><i class="fa-solid fa-bell"></i>
        <?php } elseif ($_smarty_tpl->getValue('notif')['type'] == 'result') {?><i class="fa-solid fa-flask"></i>
        <?php } else { ?><i class="fa-solid fa-circle-info"></i><?php }?>
      </div>
      <div class="notif-item__body">
        <p><?php echo $_smarty_tpl->getValue('notif')['message'];?>
</p>
        <small><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('notif')['created_at'],"%H:%M %d/%m/%Y");?>
</small>
      </div>
    </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>
</div>
<?php }?>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

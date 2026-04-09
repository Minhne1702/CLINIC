<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:54:29
  from 'file:admin/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d76945076253_36600729',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1e5d05cee43180ae97a34a75b74756596c1f202' => 
    array (
      0 => 'admin/appointments.tpl',
      1 => 1775610517,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d76945076253_36600729 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý lịch hẹn",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Quản lý lịch hẹn</h2>
    <p class="page-subtitle">Theo dõi và quản lý tất cả lịch hẹn khám</p>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Tạo lịch hẹn
    </a>
  </div>
</div>

<!-- Summary tabs -->
<div class="status-tabs mb-1">
  <?php $_smarty_tpl->assign('cur_status', (($tmp = $_smarty_tpl->getValue('filter')['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments" class="status-tab <?php if ($_smarty_tpl->getValue('cur_status') == '') {?>active<?php }?>">
    Tất cả <span class="tab-count"><?php echo (($tmp = $_smarty_tpl->getValue('count')['all'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&status=pending" class="status-tab <?php if ($_smarty_tpl->getValue('cur_status') == 'pending') {?>active<?php }?>">
    Chờ xác nhận <span class="tab-count tab-count--warning"><?php echo (($tmp = $_smarty_tpl->getValue('count')['pending'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&status=confirmed" class="status-tab <?php if ($_smarty_tpl->getValue('cur_status') == 'confirmed') {?>active<?php }?>">
    Đã xác nhận <span class="tab-count tab-count--blue"><?php echo (($tmp = $_smarty_tpl->getValue('count')['confirmed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&status=completed" class="status-tab <?php if ($_smarty_tpl->getValue('cur_status') == 'completed') {?>active<?php }?>">
    Hoàn thành <span class="tab-count tab-count--success"><?php echo (($tmp = $_smarty_tpl->getValue('count')['completed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&status=cancelled" class="status-tab <?php if ($_smarty_tpl->getValue('cur_status') == 'cancelled') {?>active<?php }?>">
    Đã hủy <span class="tab-count tab-count--danger"><?php echo (($tmp = $_smarty_tpl->getValue('count')['cancelled'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="appointments">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bệnh nhân, mã lịch..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" title="Từ ngày">
        <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"   title="Đến ngày">
        <select name="doctor_id">
          <option value="">Tất cả bác sĩ</option>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach0DoElse = false;
?>
          <option value="<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" <?php if ($_smarty_tpl->getValue('filter')['doctor_id'] == $_smarty_tpl->getValue('doc')['_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</option>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã lịch</th>
          <th>Bệnh nhân</th>
          <th>Bác sĩ</th>
          <th>Chuyên khoa</th>
          <th>Ngày giờ</th>
          <th>Hình thức</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'apt');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach1DoElse = false;
?>
        <tr>
          <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('apt')['code'];?>
</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('apt')['patient_name'],1,'');?>
</div>
              <div>
                <strong><?php echo $_smarty_tpl->getValue('apt')['patient_name'];?>
</strong>
                <small><?php echo $_smarty_tpl->getValue('apt')['patient_phone'];?>
</small>
              </div>
            </div>
          </td>
          <td><?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</td>
          <td><?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</td>
          <td>
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d/%m/%Y");?>
</strong>
            <small class="text-muted"><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</small>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online') {?>
              <span class="badge badge--blue"><i class="fa-solid fa-video"></i> Online</span>
            <?php } else { ?>
              <span class="badge badge--neutral"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
            <?php }?>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>   <span class="badge badge--warning">Chờ xác nhận</span>
            <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?> <span class="badge badge--blue">Đã xác nhận</span>
            <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?> <span class="badge badge--success">Hoàn thành</span>
            <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'cancelled') {?> <span class="badge badge--danger">Đã hủy</span>
            <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('apt')['status'];?>
</span><?php }?>
          </td>
          <td>
            <div class="table-actions">
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&action=view&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
              <?php if ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&action=confirm&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
" class="action-btn action-btn--success" title="Xác nhận"><i class="fa-solid fa-check"></i></a>
              <?php }?>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments&action=cancel&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
" class="action-btn action-btn--danger" title="Hủy" onclick="return confirm('Hủy lịch hẹn này?')"><i class="fa-solid fa-ban"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach1DoElse) {
?>
        <tr><td colspan="8" class="table-empty">Không có lịch hẹn nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

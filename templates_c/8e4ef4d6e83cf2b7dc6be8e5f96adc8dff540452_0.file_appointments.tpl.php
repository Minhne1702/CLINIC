<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:23:58
  from 'file:doctor/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7621ed57177_27045316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e4ef4d6e83cf2b7dc6be8e5f96adc8dff540452' => 
    array (
      0 => 'doctor/appointments.tpl',
      1 => 1775718917,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d7621ed57177_27045316 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\doctor';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Lịch hẹn",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Lịch hẹn của tôi</h2>
    <p class="page-subtitle">Tất cả lịch hẹn được phân công</p>
  </div>
</div>

<div class="status-tabs mb-1">
  <?php $_smarty_tpl->assign('cur', (($tmp = $_smarty_tpl->getValue('filter')['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=appointments" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == '') {?>active<?php }?>">
    Tất cả <span class="tab-count"><?php echo (($tmp = $_smarty_tpl->getValue('count')['all'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=appointments&status=confirmed" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'confirmed') {?>active<?php }?>">
    Đã xác nhận <span class="tab-count tab-count--blue"><?php echo (($tmp = $_smarty_tpl->getValue('count')['confirmed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=appointments&status=pending" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'pending') {?>active<?php }?>">
    Chờ xác nhận <span class="tab-count tab-count--warning"><?php echo (($tmp = $_smarty_tpl->getValue('count')['pending'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=appointments&status=completed" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'completed') {?>active<?php }?>">
    Hoàn thành <span class="tab-count tab-count--success"><?php echo (($tmp = $_smarty_tpl->getValue('count')['completed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
  </a>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="doctor">
      <input type="hidden" name="page" value="appointments">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bệnh nhân..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <input type="date" name="date" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
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
          <th>Bệnh nhân</th>
          <th>Ngày giờ</th>
          <th>Hình thức</th>
          <th>Triệu chứng</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td>
            <div class="table-user">
              <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('apt')['patient_name'],1,'');?>
</div>
              <div>
                <strong><?php echo $_smarty_tpl->getValue('apt')['patient_name'];?>
</strong>
                <small><?php echo $_smarty_tpl->getValue('apt')['patient_code'];?>
</small>
              </div>
            </div>
          </td>
          <td>
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d/%m/%Y");?>
</strong><br>
            <small><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</small>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online') {?>
              <span class="badge badge--blue"><i class="fa-solid fa-video"></i> Online</span>
            <?php } else { ?>
              <span class="badge badge--neutral">Trực tiếp</span>
            <?php }?>
          </td>
          <td>
            <span style="font-size:13px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('apt')['symptoms'],40,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>
              <span class="badge badge--blue">Xác nhận</span>
            <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>
              <span class="badge badge--warning">Chờ</span>
            <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?>
              <span class="badge badge--success">Xong</span>
            <?php } else { ?>
              <span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('apt')['status'];?>
</span>
            <?php }?>
          </td>
          <td>
            <div class="table-actions">
              
                            <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online' && $_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>
                <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=telemedicine&apt_id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem; background: #8b5cf6; border-color: #8b5cf6;">
                  <i class="fa-solid fa-video"></i> Khám Online
                </a>
              <?php } else { ?>
                <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=records&patient_id=<?php echo $_smarty_tpl->getValue('apt')['patient_id'];?>
" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem">
                  <i class="fa-solid fa-folder-open"></i> Hồ sơ
                </a>
              <?php }?>

              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=appointments&action=view&id=<?php echo $_smarty_tpl->getValue('apt')['_id'];?>
" class="action-btn" title="Xem chi tiết">
                <i class="fa-solid fa-eye"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr>
          <td colspan="6" class="table-empty">Không có lịch hẹn nào</td>
        </tr>
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

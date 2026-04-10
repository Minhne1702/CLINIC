<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:52:45
  from 'file:pharmacist/prescriptions.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d900adda98a5_33152684',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef6d2f909fb0dd72c838df4428afc3c3c404a948' => 
    array (
      0 => 'pharmacist/prescriptions.tpl',
      1 => 1775696150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d900adda98a5_33152684 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đơn thuốc đến",'active_page'=>"prescriptions"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc đến</h2><p class="page-subtitle">Danh sách đơn thuốc cần phát</p></div>
</div>
<div class="status-tabs mb-1">
  <?php $_smarty_tpl->assign('cur', (($tmp = $_smarty_tpl->getValue('filter')['status'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == '') {?>active<?php }?>">Tất cả <span class="tab-count"><?php echo (($tmp = $_smarty_tpl->getValue('count')['all'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span></a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions&status=pending" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'pending') {?>active<?php }?>">Chờ phát <span class="tab-count tab-count--warning"><?php echo (($tmp = $_smarty_tpl->getValue('count')['pending'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span></a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions&status=dispensing" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'dispensing') {?>active<?php }?>">Đang bốc <span class="tab-count tab-count--blue"><?php echo (($tmp = $_smarty_tpl->getValue('count')['dispensing'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span></a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions&status=done" class="status-tab <?php if ($_smarty_tpl->getValue('cur') == 'done') {?>active<?php }?>">Đã phát <span class="tab-count tab-count--success"><?php echo (($tmp = $_smarty_tpl->getValue('count')['done'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span></a>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="prescriptions">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã đơn..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
      <input type="date" name="date" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Mã đơn</th><th>Bệnh nhân</th><th>Bác sĩ kê</th><th>Chẩn đoán</th><th>Thời gian</th><th>Số thuốc</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
    <tbody>
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prescriptions'), 'rx');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rx')->value) {
$foreach0DoElse = false;
?>
      <tr>
        <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('rx')['code'];?>
</span></td>
        <td><div class="table-user"><div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('rx')['patient_name'],1,'');?>
</div><div><strong><?php echo $_smarty_tpl->getValue('rx')['patient_name'];?>
</strong><small><?php echo $_smarty_tpl->getValue('rx')['patient_code'];?>
</small></div></div></td>
        <td><?php echo $_smarty_tpl->getValue('rx')['doctor_name'];?>
</td>
        <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rx')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),35,'...');?>
</td>
        <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['created_at'],"%H:%M %d/%m/%Y");?>
</td>
        <td><span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('rx')['drug_count'];?>
 thuốc</span></td>
        <td>
          <?php if ($_smarty_tpl->getValue('rx')['status'] == 'pending') {?><span class="badge badge--warning">Chờ phát</span>
          <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'dispensing') {?><span class="badge badge--blue">Đang bốc</span>
          <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'done') {?><span class="badge badge--success">Đã phát</span>
          <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('rx')['status'];?>
</span><?php }?>
        </td>
        <td><div class="table-actions">
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=dispensing&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-capsules"></i> Phát thuốc</a>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=dispensing&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="action-btn" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
        </div></td>
      </tr>
      <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="8" class="table-empty">Không có đơn thuốc nào</td></tr>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
</div></div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

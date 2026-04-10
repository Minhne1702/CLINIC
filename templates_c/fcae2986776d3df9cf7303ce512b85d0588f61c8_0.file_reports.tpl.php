<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:53:51
  from 'file:pharmacist/reports.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d900ef607756_54296418',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fcae2986776d3df9cf7303ce512b85d0588f61c8' => 
    array (
      0 => 'pharmacist/reports.tpl',
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
function content_69d900ef607756_54296418 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Báo cáo nhà thuốc",'active_page'=>"reports"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-chart-bar"></i> Báo cáo nhà thuốc</h2><p class="page-subtitle">Thống kê xuất nhập tồn và thuốc bán chạy</p></div>
  <div class="page-toolbar__right"><button class="btn-admin-secondary" onclick="window.location.href='<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=reports&action=export'"><i class="fa-solid fa-file-excel"></i> Xuất Excel</button></div>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="reports">
    <div class="filter-bar__group">
      <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <select name="period"><option value="7" <?php if ($_smarty_tpl->getValue('filter')['period'] == '7') {?>selected<?php }?>>7 ngày</option><option value="30" <?php if ($_smarty_tpl->getValue('filter')['period'] == '30') {?>selected<?php }?>>30 ngày</option><option value="90" <?php if ($_smarty_tpl->getValue('filter')['period'] == '90') {?>selected<?php }?>>3 tháng</option></select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-rotate"></i> Cập nhật</button>
    </div>
  </form>
</div></div>
<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div><div><p>Đơn thuốc đã phát</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_dispensed'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-pills"></i></div><div><p>Lượt thuốc xuất</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_qty_out'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-truck-ramp-box"></i></div><div><p>Lượt thuốc nhập</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_qty_in'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-boxes-stacking"></i></div><div><p>Tổng tồn kho</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_stock'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
</div>
<div class="admin-card">
  <div class="admin-card__header"><h3><i class="fa-solid fa-trophy"></i> Thuốc sử dụng nhiều nhất</h3></div>
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead><tr><th>Tên thuốc</th><th>Nhóm</th><th>Số lượng xuất</th><th>Số đơn</th></tr></thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('top_drugs'), 'drug');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong></td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['category_name'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('drug')['total_qty'];?>
 <?php echo $_smarty_tpl->getValue('drug')['unit'];?>
</span></td>
          <td><?php echo $_smarty_tpl->getValue('drug')['prescription_count'];?>
 đơn</td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="4" class="table-empty">Chưa có dữ liệu</td></tr>
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

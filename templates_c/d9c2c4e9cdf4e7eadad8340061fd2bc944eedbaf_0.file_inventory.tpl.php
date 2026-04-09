<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:29:27
  from 'file:pharmacist/inventory.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d763679fa855_64567644',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd9c2c4e9cdf4e7eadad8340061fd2bc944eedbaf' => 
    array (
      0 => 'pharmacist/inventory.tpl',
      1 => 1775611356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d763679fa855_64567644 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tồn kho thuốc",'active_page'=>"inventory"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-boxes-stacking"></i> Tồn kho thuốc</h2><p class="page-subtitle">Theo dõi số lượng tồn kho và hạn sử dụng</p></div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=stock-in" class="btn-admin-primary"><i class="fa-solid fa-truck-ramp-box"></i> Nhập kho</a>
  </div>
</div>
<?php if ($_smarty_tpl->getValue('stats')['low_stock'] > 0) {?><div class="alert alert--warning mb-1"><i class="fa-solid fa-triangle-exclamation"></i> <strong><?php echo $_smarty_tpl->getValue('stats')['low_stock'];?>
</strong> loại thuốc tồn kho dưới mức tối thiểu. <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=low-stock">Xem ngay</a></div><?php }
if ($_smarty_tpl->getValue('stats')['expiring'] > 0) {?><div class="alert alert--danger mb-1"><i class="fa-regular fa-calendar-xmark"></i> <strong><?php echo $_smarty_tpl->getValue('stats')['expiring'];?>
</strong> loại thuốc sắp hết hạn trong 30 ngày. <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=expiring">Xem ngay</a></div><?php }?>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="inventory">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên thuốc, hoạt chất..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
      <select name="category"><option value="">Tất cả nhóm</option><?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drug_categories'), 'cat');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach0DoElse = false;
?><option value="<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
" <?php if ($_smarty_tpl->getValue('filter')['category'] == $_smarty_tpl->getValue('cat')['_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('cat')['name'];?>
</option><?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?></select>
      <select name="stock_status">
        <option value="">Tất cả tồn kho</option>
        <option value="ok"       <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'ok') {?>selected<?php }?>>Đủ hàng</option>
        <option value="low"      <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'low') {?>selected<?php }?>>Sắp hết</option>
        <option value="out"      <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'out') {?>selected<?php }?>>Hết hàng</option>
        <option value="expiring" <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'expiring') {?>selected<?php }?>>Sắp hết hạn</option>
      </select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Tên thuốc</th><th>Hoạt chất</th><th>Nhóm</th><th>Dạng bào chế</th><th>Đơn vị</th><th>Tồn kho</th><th>Hạn dùng</th><th>Cảnh báo</th><th>Thao tác</th></tr></thead>
    <tbody>
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drugs'), 'drug');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
?>
      <tr>
        <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong><br><small class="text-muted">Lô: <?php echo (($tmp = $_smarty_tpl->getValue('drug')['lot_number'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</small></td>
        <td class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('drug')['active_ingredient'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
        <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['category_name'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
        <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['dosage_form'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
        <td><?php echo $_smarty_tpl->getValue('drug')['unit'];?>
</td>
        <td>
          <?php if ($_smarty_tpl->getValue('drug')['stock_qty'] <= 0) {?><span class="badge badge--danger">Hết hàng</span>
          <?php } elseif ($_smarty_tpl->getValue('drug')['stock_qty'] <= $_smarty_tpl->getValue('drug')['min_qty']) {?><span class="badge badge--warning"><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
 (thấp)</span>
          <?php } else { ?><span class="badge badge--success"><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
</span><?php }?>
        </td>
        <td><span class="<?php if ($_smarty_tpl->getValue('drug')['is_expiring']) {?>text-danger<?php } else { ?>text-muted<?php }?>" style="font-size:12px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('drug')['expiry_date'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
        <td>
          <?php if ($_smarty_tpl->getValue('drug')['stock_qty'] <= 0) {?><span class="badge badge--danger" style="font-size:11px">Hết hàng</span>
          <?php } elseif ($_smarty_tpl->getValue('drug')['stock_qty'] <= $_smarty_tpl->getValue('drug')['min_qty']) {?><span class="badge badge--warning" style="font-size:11px">Sắp hết</span>
          <?php } elseif ($_smarty_tpl->getValue('drug')['is_expiring']) {?><span class="badge badge--danger" style="font-size:11px">Gần hết hạn</span>
          <?php } else { ?><span class="badge badge--success" style="font-size:11px">OK</span><?php }?>
        </td>
        <td><div class="table-actions">
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=stock-in&drug_id=<?php echo $_smarty_tpl->getValue('drug')['_id'];?>
" class="action-btn" title="Nhập thêm"><i class="fa-solid fa-plus"></i></a>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=inventory&action=view&id=<?php echo $_smarty_tpl->getValue('drug')['_id'];?>
" class="action-btn" title="Lịch sử"><i class="fa-solid fa-clock-rotate-left"></i></a>
        </div></td>
      </tr>
      <?php
}
if ($foreach1DoElse) {
?><tr><td colspan="9" class="table-empty">Chưa có dữ liệu tồn kho</td></tr>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
</div></div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

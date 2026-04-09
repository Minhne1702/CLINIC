<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:54:38
  from 'file:admin/drugs.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7694eda1226_53289837',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dcd585a251bdd56338e1a300e0d22cf374aa7938' => 
    array (
      0 => 'admin/drugs.tpl',
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
function content_69d7694eda1226_53289837 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý thuốc",'active_page'=>"drugs"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-pills"></i> Danh mục thuốc</h2>
    <p class="page-subtitle">Quản lý thông tin thuốc và cảnh báo tương tác</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalDrug')">
      <i class="fa-solid fa-plus"></i> Thêm thuốc
    </button>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

<!-- Low stock alert -->
<?php if ($_smarty_tpl->getValue('low_stock_count') > 0) {?>
<div class="alert alert--warning mb-1">
  <i class="fa-solid fa-triangle-exclamation"></i>
  Có <strong><?php echo $_smarty_tpl->getValue('low_stock_count');?>
</strong> loại thuốc sắp hết hàng.
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=drugs&filter=low-stock">Xem ngay</a>
</div>
<?php }?>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drugs">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên thuốc, hoạt chất..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="category">
          <option value="">Tất cả nhóm</option>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drug_categories'), 'cat');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach0DoElse = false;
?>
          <option value="<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
" <?php if ($_smarty_tpl->getValue('filter')['category'] == $_smarty_tpl->getValue('cat')['_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('cat')['name'];?>
</option>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select>
        <select name="stock_status">
          <option value="">Tồn kho</option>
          <option value="ok"       <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'ok') {?>selected<?php }?>>Đủ hàng</option>
          <option value="low"      <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'low') {?>selected<?php }?>>Sắp hết</option>
          <option value="out"      <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'out') {?>selected<?php }?>>Hết hàng</option>
          <option value="expiring" <?php if ($_smarty_tpl->getValue('filter')['stock_status'] == 'expiring') {?>selected<?php }?>>Sắp hết hạn</option>
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
          <th>Tên thuốc</th>
          <th>Hoạt chất</th>
          <th>Nhóm thuốc</th>
          <th>Dạng bào chế</th>
          <th>Đơn vị</th>
          <th>Tồn kho</th>
          <th>Hạn dùng</th>
          <th>Cảnh báo</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drugs'), 'drug');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
?>
        <tr>
          <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong></td>
          <td><span class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('drug')['active_ingredient'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['category_name'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['dosage_form'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['unit'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td>
            <?php if ($_smarty_tpl->getValue('drug')['stock_qty'] <= 0) {?>
              <span class="badge badge--danger">Hết hàng</span>
            <?php } elseif ($_smarty_tpl->getValue('drug')['stock_qty'] <= $_smarty_tpl->getValue('drug')['min_qty']) {?>
              <span class="badge badge--warning"><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
 (thấp)</span>
            <?php } else { ?>
              <span class="badge badge--success"><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
</span>
            <?php }?>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('drug')['expiry_date']) {?>
              <span class="<?php if ($_smarty_tpl->getValue('drug')['is_expiring']) {?>text-danger<?php } else { ?>text-muted<?php }?>" style="font-size:12px">
                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('drug')['expiry_date'],"%d/%m/%Y");?>

              </span>
            <?php } else { ?>—<?php }?>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('drug')['side_effects']) {?><span class="badge badge--warning" title="<?php echo $_smarty_tpl->getValue('drug')['side_effects'];?>
"><i class="fa-solid fa-triangle-exclamation"></i></span><?php }?>
            <?php if ($_smarty_tpl->getValue('drug')['contraindications']) {?><span class="badge badge--danger" title="<?php echo $_smarty_tpl->getValue('drug')['contraindications'];?>
"><i class="fa-solid fa-ban"></i></span><?php }?>
          </td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editDrug('<?php echo $_smarty_tpl->getValue('drug')['_id'];?>
')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=drugs&action=delete&id=<?php echo $_smarty_tpl->getValue('drug')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa thuốc này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach1DoElse) {
?>
        <tr><td colspan="9" class="table-empty">Chưa có thuốc nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa thuốc -->
<div class="modal-overlay" id="modalDrug">
  <div class="modal modal--lg">
    <div class="modal__header">
      <h3 id="modalDrugTitle">Thêm thuốc</h3>
      <button class="modal__close" onclick="closeModal('modalDrug')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drugs">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="drug_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Tên thuốc <span class="required">*</span></label>
          <input type="text" name="name" placeholder="VD: Amoxicillin 500mg" required>
        </div>
        <div class="form-group">
          <label>Hoạt chất</label>
          <input type="text" name="active_ingredient" placeholder="VD: Amoxicillin">
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Nhóm thuốc</label>
          <select name="category_id">
            <option value="">-- Chọn nhóm --</option>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drug_categories'), 'cat');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach2DoElse = false;
?>
            <option value="<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
"><?php echo $_smarty_tpl->getValue('cat')['name'];?>
</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </select>
        </div>
        <div class="form-group">
          <label>Dạng bào chế</label>
          <select name="dosage_form">
            <option value="tablet">Viên nén</option>
            <option value="capsule">Viên nang</option>
            <option value="syrup">Siro</option>
            <option value="injection">Tiêm</option>
            <option value="cream">Kem/Mỡ</option>
            <option value="drop">Nhỏ giọt</option>
          </select>
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Hàm lượng</label>
          <input type="text" name="concentration" placeholder="VD: 500mg">
        </div>
        <div class="form-group">
          <label>Đơn vị tính <span class="required">*</span></label>
          <select name="unit" required>
            <option value="vien">Viên</option>
            <option value="chai">Chai</option>
            <option value="ong">Ống</option>
            <option value="goi">Gói</option>
            <option value="hop">Hộp</option>
          </select>
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Số lượng tồn kho</label>
          <input type="number" name="stock_qty" placeholder="0" min="0">
        </div>
        <div class="form-group">
          <label>Cảnh báo tồn kho tối thiểu</label>
          <input type="number" name="min_qty" placeholder="10" min="0">
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Số lô</label>
          <input type="text" name="lot_number" placeholder="VD: LOT2024001">
        </div>
        <div class="form-group">
          <label>Hạn sử dụng</label>
          <input type="date" name="expiry_date">
        </div>
      </div>
      <div class="form-group">
        <label>Tác dụng phụ</label>
        <textarea name="side_effects" rows="2" placeholder="Buồn nôn, tiêu chảy..."></textarea>
      </div>
      <div class="form-group">
        <label>Chống chỉ định</label>
        <textarea name="contraindications" rows="2" placeholder="Dị ứng Penicillin..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDrug')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu thuốc</button>
      </div>
    </form>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
function editDrug(id) {
  document.getElementById('modalDrugTitle').textContent = 'Sửa thuốc';
  document.getElementById('drug_id').value = id;
  openModal('modalDrug');
}
<?php echo '</script'; ?>
>
<?php }
}

<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:54:36
  from 'file:admin/drug-categories.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7694ceb8bc5_29362152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e8cf54d1b4efee34dff5b59f809d22b0759cf6f0' => 
    array (
      0 => 'admin/drug-categories.tpl',
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
function content_69d7694ceb8bc5_29362152 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Nhóm thuốc",'active_page'=>"drug-categories"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-layer-group"></i> Nhóm thuốc</h2>
    <p class="page-subtitle">Phân loại thuốc theo nhóm dược lý</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalDrugCat')">
      <i class="fa-solid fa-plus"></i> Thêm nhóm
    </button>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã nhóm</th>
          <th>Tên nhóm thuốc</th>
          <th>Mô tả</th>
          <th>Số loại thuốc</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('drug_categories'), 'cat');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('cat')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><span class="code-tag"><?php echo (($tmp = $_smarty_tpl->getValue('cat')['code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><strong><?php echo $_smarty_tpl->getValue('cat')['name'];?>
</strong></td>
          <td><span class="text-muted" style="font-size:13px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('cat')['description'],60,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><span class="badge badge--blue"><?php echo (($tmp = $_smarty_tpl->getValue('cat')['drug_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 thuốc</span></td>
          <td><?php if ($_smarty_tpl->getValue('cat')['is_active']) {?><span class="badge badge--success">Hoạt động</span><?php } else { ?><span class="badge badge--danger">Ẩn</span><?php }?></td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editCat('<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
','<?php echo $_smarty_tpl->getValue('cat')['name'];?>
','<?php echo $_smarty_tpl->getValue('cat')['code'];?>
','<?php echo $_smarty_tpl->getValue('cat')['description'];?>
')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=drug-categories&action=toggle&id=<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=drug-categories&action=delete&id=<?php echo $_smarty_tpl->getValue('cat')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa nhóm thuốc này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr><td colspan="6" class="table-empty">Chưa có nhóm thuốc nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal-overlay" id="modalDrugCat">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalDrugCatTitle">Thêm nhóm thuốc</h3>
      <button class="modal__close" onclick="closeModal('modalDrugCat')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drug-categories">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="cat_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Mã nhóm <span class="required">*</span></label>
          <input type="text" name="code" id="cat_code" placeholder="VD: ANTIBIOTIC" required>
        </div>
        <div class="form-group">
          <label>Tên nhóm <span class="required">*</span></label>
          <input type="text" name="name" id="cat_name" placeholder="VD: Kháng sinh" required>
        </div>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" id="cat_desc" rows="3" placeholder="Mô tả nhóm thuốc..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDrugCat')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
function editCat(id, name, code, desc) {
  document.getElementById('modalDrugCatTitle').textContent = 'Sửa nhóm thuốc';
  document.getElementById('cat_id').value = id;
  document.getElementById('cat_name').value = name;
  document.getElementById('cat_code').value = code;
  document.getElementById('cat_desc').value = desc;
  openModal('modalDrugCat');
}
<?php echo '</script'; ?>
>
<?php }
}

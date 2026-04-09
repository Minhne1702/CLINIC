<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:54:39
  from 'file:admin/diseases.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7694fec6626_70347680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b332125011670e3a75dffa273b445c2dbc60f6b9' => 
    array (
      0 => 'admin/diseases.tpl',
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
function content_69d7694fec6626_70347680 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý bệnh (ICD-10)",'active_page'=>"diseases"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-virus"></i> Danh mục bệnh (ICD-10)</h2>
    <p class="page-subtitle">Chuẩn hóa dữ liệu bệnh dùng toàn hệ thống</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-secondary" onclick="openModal('modalImport')">
      <i class="fa-solid fa-file-import"></i> Import ICD-10
    </button>
    <button class="btn-admin-primary" onclick="openModal('modalDisease')">
      <i class="fa-solid fa-plus"></i> Thêm bệnh
    </button>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="diseases">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Mã ICD, tên bệnh..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="group">
          <option value="">Tất cả nhóm</option>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('disease_groups'), 'g');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('g')->value) {
$foreach0DoElse = false;
?>
          <option value="<?php echo $_smarty_tpl->getValue('g')['_id'];?>
" <?php if ($_smarty_tpl->getValue('filter')['group'] == $_smarty_tpl->getValue('g')['_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('g')['name'];?>
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
          <th>Mã ICD-10</th>
          <th>Tên bệnh</th>
          <th>Nhóm bệnh</th>
          <th>Triệu chứng phổ biến</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('diseases'), 'd');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('d')->value) {
$foreach1DoElse = false;
?>
        <tr>
          <td><span class="code-tag code-tag--blue"><?php echo $_smarty_tpl->getValue('d')['icd_code'];?>
</span></td>
          <td><strong><?php echo $_smarty_tpl->getValue('d')['name'];?>
</strong></td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('d')['group_name'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><span class="text-muted" style="font-size:12px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('d')['symptoms'],50,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><?php if ($_smarty_tpl->getValue('d')['is_active']) {?><span class="badge badge--success">Hoạt động</span><?php } else { ?><span class="badge badge--danger">Ẩn</span><?php }?></td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editDisease('<?php echo $_smarty_tpl->getValue('d')['_id'];?>
')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=diseases&action=delete&id=<?php echo $_smarty_tpl->getValue('d')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bệnh này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach1DoElse) {
?>
        <tr><td colspan="6" class="table-empty">Chưa có dữ liệu bệnh</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa bệnh -->
<div class="modal-overlay" id="modalDisease">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalDiseaseTitle">Thêm bệnh</h3>
      <button class="modal__close" onclick="closeModal('modalDisease')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="diseases">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="disease_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Mã ICD-10 <span class="required">*</span></label>
          <input type="text" name="icd_code" id="disease_code" placeholder="VD: J06.9" required>
        </div>
        <div class="form-group">
          <label>Nhóm bệnh</label>
          <select name="group_id">
            <option value="">-- Chọn nhóm --</option>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('disease_groups'), 'g');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('g')->value) {
$foreach2DoElse = false;
?>
            <option value="<?php echo $_smarty_tpl->getValue('g')['_id'];?>
"><?php echo $_smarty_tpl->getValue('g')['name'];?>
</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Tên bệnh <span class="required">*</span></label>
        <input type="text" name="name" id="disease_name" placeholder="VD: Viêm đường hô hấp trên cấp tính" required>
      </div>
      <div class="form-group">
        <label>Triệu chứng phổ biến</label>
        <textarea name="symptoms" rows="3" placeholder="Sốt, ho, chảy mũi..."></textarea>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" rows="2" placeholder="Mô tả thêm..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDisease')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
function editDisease(id) {
  document.getElementById('modalDiseaseTitle').textContent = 'Sửa bệnh';
  document.getElementById('disease_id').value = id;
  openModal('modalDisease');
}
<?php echo '</script'; ?>
>
<?php }
}

<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:48
  from 'file:admin/specialties.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b40039871_80085079',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '394a9218e8ab481296861350a6e2a13d4710227d' => 
    array (
      0 => 'admin/specialties.tpl',
      1 => 1775438021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d32b40039871_80085079 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý chuyên khoa",'active_page'=>"specialties"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-stethoscope"></i> Chuyên khoa</h2>
    <p class="page-subtitle">Quản lý danh mục chuyên khoa y tế</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalSpecialty')">
      <i class="fa-solid fa-plus"></i> Thêm chuyên khoa
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
          <th>Icon</th>
          <th>Tên chuyên khoa</th>
          <th>Mô tả</th>
          <th>Số bác sĩ</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('specialties'), 'spec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><div class="spec-icon-preview" style="background:rgba(8,145,178,.1);color:#0891b2;width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="<?php echo (($tmp = $_smarty_tpl->getValue('spec')['icon'] ?? null)===null||$tmp==='' ? 'fa-solid fa-stethoscope' ?? null : $tmp);?>
"></i></div></td>
          <td><strong><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</strong></td>
          <td><span class="text-muted" style="font-size:13px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('spec')['description'],60,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><span class="badge badge--blue"><?php echo (($tmp = $_smarty_tpl->getValue('spec')['doctor_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 BS</span></td>
          <td><?php if ($_smarty_tpl->getValue('spec')['is_active']) {?><span class="badge badge--success">Hoạt động</span><?php } else { ?><span class="badge badge--danger">Ẩn</span><?php }?></td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editSpecialty('<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="/CLINIC/public/?role=admin&page=specialties&action=toggle&id=<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="/CLINIC/public/?role=admin&page=specialties&action=delete&id=<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa chuyên khoa này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr><td colspan="6" class="table-empty">Chưa có chuyên khoa nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa chuyên khoa -->
<div class="modal-overlay" id="modalSpecialty">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalSpecialtyTitle">Thêm chuyên khoa</h3>
      <button class="modal__close" onclick="closeModal('modalSpecialty')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="/CLINIC/public/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="specialties">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="spec_id" value="">
      <div class="form-group">
        <label>Tên chuyên khoa <span class="required">*</span></label>
        <input type="text" name="name" id="spec_name" placeholder="VD: Tim mạch" required>
      </div>
      <div class="form-group">
        <label>Icon (Font Awesome class)</label>
        <input type="text" name="icon" id="spec_icon" placeholder="VD: fa-solid fa-heart">
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" id="spec_desc" rows="3" placeholder="Mô tả ngắn về chuyên khoa..."></textarea>
      </div>
      <div class="form-group">
        <label class="checkbox-label">
          <input type="checkbox" name="is_active" id="spec_active" checked> Hiển thị
        </label>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalSpecialty')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
function editSpecialty(id) {
  document.getElementById('modalSpecialtyTitle').textContent = 'Sửa chuyên khoa';
  document.getElementById('spec_id').value = id;
  openModal('modalSpecialty');
}
<?php echo '</script'; ?>
>
<?php }
}

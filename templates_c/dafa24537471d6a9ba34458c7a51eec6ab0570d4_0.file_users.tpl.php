<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:54:00
  from 'file:admin/users.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d769283c8699_66414278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dafa24537471d6a9ba34458c7a51eec6ab0570d4' => 
    array (
      0 => 'admin/users.tpl',
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
function content_69d769283c8699_66414278 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý tài khoản",'active_page'=>"users"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-users"></i> Tài khoản hệ thống</h2>
    <p class="page-subtitle">Quản lý tất cả người dùng và phân quyền</p>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=users&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm tài khoản
    </a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<!-- Filter bar -->
<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="users">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên, email, SĐT..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="filter_role">
          <option value="">Tất cả vai trò</option>
          <option value="admin"      <?php if ($_smarty_tpl->getValue('filter')['role'] == 'admin') {?>selected<?php }?>>Admin</option>
          <option value="doctor"     <?php if ($_smarty_tpl->getValue('filter')['role'] == 'doctor') {?>selected<?php }?>>Bác sĩ</option>
          <option value="receptionist" <?php if ($_smarty_tpl->getValue('filter')['role'] == 'receptionist') {?>selected<?php }?>>Lễ tân</option>
          <option value="cashier"    <?php if ($_smarty_tpl->getValue('filter')['role'] == 'cashier') {?>selected<?php }?>>Thu ngân</option>
          <option value="pharmacist" <?php if ($_smarty_tpl->getValue('filter')['role'] == 'pharmacist') {?>selected<?php }?>>Dược sĩ</option>
          <option value="patient"    <?php if ($_smarty_tpl->getValue('filter')['role'] == 'patient') {?>selected<?php }?>>Bệnh nhân</option>
        </select>
        <select name="filter_status">
          <option value="">Tất cả trạng thái</option>
          <option value="active"   <?php if ($_smarty_tpl->getValue('filter')['status'] == 'active') {?>selected<?php }?>>Hoạt động</option>
          <option value="inactive" <?php if ($_smarty_tpl->getValue('filter')['status'] == 'inactive') {?>selected<?php }?>>Vô hiệu hóa</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=users" class="btn-admin-ghost">Xóa lọc</a>
      </div>
    </form>
  </div>
</div>

<!-- Table -->
<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectAll"></th>
          <th>Người dùng</th>
          <th>Vai trò</th>
          <th>SĐT</th>
          <th>Ngày tạo</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('users'), 'u');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('u')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><input type="checkbox" class="row-check" value="<?php echo $_smarty_tpl->getValue('u')['_id'];?>
"></td>
          <td>
            <div class="table-user">
              <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('u')['full_name'],1,'');?>
</div>
              <div>
                <strong><?php echo $_smarty_tpl->getValue('u')['full_name'];?>
</strong>
                <small><?php echo $_smarty_tpl->getValue('u')['email'];?>
</small>
              </div>
            </div>
          </td>
          <td><span class="badge badge--<?php echo $_smarty_tpl->getValue('u')['role'];?>
"><?php echo $_smarty_tpl->getValue('u')['role_label'];?>
</span></td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('u')['phone'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('u')['created_at'],"%d/%m/%Y");?>
</td>
          <td>
            <?php if ($_smarty_tpl->getValue('u')['is_active']) {?>
              <span class="badge badge--success">Hoạt động</span>
            <?php } else { ?>
              <span class="badge badge--danger">Vô hiệu hóa</span>
            <?php }?>
          </td>
          <td>
            <div class="table-actions">
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=users&action=edit&id=<?php echo $_smarty_tpl->getValue('u')['_id'];?>
" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=users&action=toggle&id=<?php echo $_smarty_tpl->getValue('u')['_id'];?>
" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=users&action=delete&id=<?php echo $_smarty_tpl->getValue('u')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa tài khoản này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr><td colspan="7" class="table-empty">Không tìm thấy tài khoản nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
  <?php if ($_smarty_tpl->getValue('pagination')) {?>
  <div class="admin-card__footer">  </div>
  <?php }?>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
document.getElementById('selectAll').addEventListener('change', function() {
  document.querySelectorAll('.row-check').forEach(c => c.checked = this.checked);
});
<?php echo '</script'; ?>
>
<?php }
}

<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:45
  from 'file:admin/doctors.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b3de28608_35317244',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'be9b7564fdb7eb6c93c65e8b35aecde9bb1919e0' => 
    array (
      0 => 'admin/doctors.tpl',
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
function content_69d32b3de28608_35317244 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý bác sĩ",'active_page'=>"doctors"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-user-doctor"></i> Danh sách bác sĩ</h2>
    <p class="page-subtitle">Quản lý hồ sơ và lịch làm việc của bác sĩ</p>
  </div>
  <div class="page-toolbar__right">
    <a href="/CLINIC/public/?role=admin&page=doctors&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm bác sĩ
    </a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="/CLINIC/public/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="doctors">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bác sĩ, mã BS..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="specialty">
          <option value="">Tất cả chuyên khoa</option>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('specialties'), 'spec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach0DoElse = false;
?>
          <option value="<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
" <?php if ($_smarty_tpl->getValue('filter')['specialty'] == $_smarty_tpl->getValue('spec')['_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</option>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </select>
        <select name="status">
          <option value="">Tất cả</option>
          <option value="active"   <?php if ($_smarty_tpl->getValue('filter')['status'] == 'active') {?>selected<?php }?>>Đang làm</option>
          <option value="inactive" <?php if ($_smarty_tpl->getValue('filter')['status'] == 'inactive') {?>selected<?php }?>>Nghỉ việc</option>
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
          <th>Bác sĩ</th>
          <th>Chuyên khoa</th>
          <th>Bằng cấp</th>
          <th>SĐT</th>
          <th>Lịch làm việc</th>
          <th>Đánh giá</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach1DoElse = false;
?>
        <tr>
          <td>
            <div class="table-user">
              <div class="table-avatar table-avatar--img">
                <?php if ($_smarty_tpl->getValue('doc')['avatar']) {?><img src="<?php echo $_smarty_tpl->getValue('doc')['avatar'];?>
" alt=""><?php } else {
echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('doc')['full_name'],1,'');
}?>
              </div>
              <div>
                <strong><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</strong>
                <small>#<?php echo (($tmp = $_smarty_tpl->getValue('doc')['doctor_code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</small>
              </div>
            </div>
          </td>
          <td><?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</td>
          <td><?php echo $_smarty_tpl->getValue('doc')['degree'];?>
</td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('doc')['phone'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><span class="text-muted" style="font-size:12px"><?php echo (($tmp = $_smarty_tpl->getValue('doc')['schedule'] ?? null)===null||$tmp==='' ? 'Chưa cấu hình' ?? null : $tmp);?>
</span></td>
          <td>
            <span class="text-warning"><i class="fa-solid fa-star" style="font-size:12px"></i> <?php echo (($tmp = $_smarty_tpl->getValue('doc')['rating'] ?? null)===null||$tmp==='' ? '5.0' ?? null : $tmp);?>
</span>
            <small class="text-muted">(<?php echo (($tmp = $_smarty_tpl->getValue('doc')['review_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</small>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('doc')['is_active']) {?>
              <span class="badge badge--success">Hoạt động</span>
            <?php } else { ?>
              <span class="badge badge--danger">Nghỉ</span>
            <?php }?>
          </td>
          <td>
            <div class="table-actions">
              <a href="/CLINIC/public/?role=admin&page=doctors&action=view&id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
              <a href="/CLINIC/public/?role=admin&page=doctors&action=edit&id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="/CLINIC/public/?role=admin&page=doctors&action=schedule&id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="action-btn" title="Lịch làm"><i class="fa-regular fa-calendar"></i></a>
              <a href="/CLINIC/public/?role=admin&page=doctors&action=delete&id=<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bác sĩ này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach1DoElse) {
?>
        <tr><td colspan="8" class="table-empty">Chưa có bác sĩ nào</td></tr>
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

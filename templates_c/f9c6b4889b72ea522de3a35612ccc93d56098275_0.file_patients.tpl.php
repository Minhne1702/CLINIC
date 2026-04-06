<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:46
  from 'file:admin/patients.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b3ef0f911_48768907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9c6b4889b72ea522de3a35612ccc93d56098275' => 
    array (
      0 => 'admin/patients.tpl',
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
function content_69d32b3ef0f911_48768907 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý bệnh nhân",'active_page'=>"patients"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-hospital-user"></i> Danh sách bệnh nhân</h2>
    <p class="page-subtitle">Quản lý hồ sơ bệnh nhân (EMR)</p>
  </div>
  <div class="page-toolbar__right">
    <a href="/CLINIC/public/?role=admin&page=patients&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm bệnh nhân
    </a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="/CLINIC/public/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="patients">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên, CCCD, SĐT, mã BN..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="gender">
          <option value="">Tất cả giới tính</option>
          <option value="male"   <?php if ($_smarty_tpl->getValue('filter')['gender'] == 'male') {?>selected<?php }?>>Nam</option>
          <option value="female" <?php if ($_smarty_tpl->getValue('filter')['gender'] == 'female') {?>selected<?php }?>>Nữ</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
        <a href="/CLINIC/public/?role=admin&page=patients" class="btn-admin-ghost">Xóa lọc</a>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã BN</th>
          <th>Bệnh nhân</th>
          <th>Ngày sinh</th>
          <th>Giới tính</th>
          <th>CCCD</th>
          <th>SĐT</th>
          <th>BHYT</th>
          <th>Lần khám gần nhất</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('patients'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('p')['patient_code'];?>
</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('p')['full_name'],1,'');?>
</div>
              <div>
                <strong><?php echo $_smarty_tpl->getValue('p')['full_name'];?>
</strong>
                <small><?php echo (($tmp = $_smarty_tpl->getValue('p')['email'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</small>
              </div>
            </div>
          </td>
          <td><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['birthday'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><?php if ($_smarty_tpl->getValue('p')['gender'] == 'male') {?>Nam<?php } elseif ($_smarty_tpl->getValue('p')['gender'] == 'female') {?>Nữ<?php } else { ?>Khác<?php }?></td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('p')['cccd'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td><?php echo (($tmp = $_smarty_tpl->getValue('p')['phone'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td>
            <?php if ($_smarty_tpl->getValue('p')['bhyt']) {?>
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có</span>
            <?php } else { ?>
              <span class="badge badge--neutral">Không</span>
            <?php }?>
          </td>
          <td><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['last_visit'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? 'Chưa khám' ?? null : $tmp);?>
</td>
          <td>
            <div class="table-actions">
              <a href="/CLINIC/public/?role=admin&page=patients&action=view&id=<?php echo $_smarty_tpl->getValue('p')['_id'];?>
" class="action-btn" title="Xem hồ sơ"><i class="fa-solid fa-folder-open"></i></a>
              <a href="/CLINIC/public/?role=admin&page=patients&action=edit&id=<?php echo $_smarty_tpl->getValue('p')['_id'];?>
" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="/CLINIC/public/?role=admin&page=patients&action=history&id=<?php echo $_smarty_tpl->getValue('p')['_id'];?>
" class="action-btn" title="Lịch sử khám"><i class="fa-solid fa-clock-rotate-left"></i></a>
              <a href="/CLINIC/public/?role=admin&page=patients&action=delete&id=<?php echo $_smarty_tpl->getValue('p')['_id'];?>
" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bệnh nhân này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr><td colspan="9" class="table-empty">Chưa có bệnh nhân nào</td></tr>
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

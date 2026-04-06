<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:55
  from 'file:admin/audit-log.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b479d9f39_83020560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7b46e1eab68ac6a98e52f9087283427a2045d77' => 
    array (
      0 => 'admin/audit-log.tpl',
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
function content_69d32b479d9f39_83020560 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Audit Log",'active_page'=>"audit-log"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-shield-halved"></i> Audit Log</h2>
    <p class="page-subtitle">Theo dõi toàn bộ hoạt động hệ thống — ai làm gì, khi nào, ở đâu</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-secondary" onclick="window.location.href='/CLINIC/public/?role=admin&page=audit-log&action=export'">
      <i class="fa-solid fa-file-export"></i> Xuất log
    </button>
  </div>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="/CLINIC/public/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="audit-log">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên user, IP, action..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <select name="action_type">
          <option value="">Tất cả hành động</option>
          <option value="login"    <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'login') {?>selected<?php }?>>Đăng nhập</option>
          <option value="logout"   <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'logout') {?>selected<?php }?>>Đăng xuất</option>
          <option value="create"   <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'create') {?>selected<?php }?>>Tạo mới</option>
          <option value="update"   <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'update') {?>selected<?php }?>>Cập nhật</option>
          <option value="delete"   <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'delete') {?>selected<?php }?>>Xóa</option>
          <option value="view_emr" <?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'view_emr') {?>selected<?php }?>>Xem hồ sơ BN</option>
          <option value="prescribe"<?php if ($_smarty_tpl->getValue('filter')['action_type'] == 'prescribe') {?>selected<?php }?>>Kê đơn thuốc</option>
        </select>
        <select name="user_role">
          <option value="">Tất cả vai trò</option>
          <option value="admin"       <?php if ($_smarty_tpl->getValue('filter')['user_role'] == 'admin') {?>selected<?php }?>>Admin</option>
          <option value="doctor"      <?php if ($_smarty_tpl->getValue('filter')['user_role'] == 'doctor') {?>selected<?php }?>>Bác sĩ</option>
          <option value="receptionist"<?php if ($_smarty_tpl->getValue('filter')['user_role'] == 'receptionist') {?>selected<?php }?>>Lễ tân</option>
          <option value="cashier"     <?php if ($_smarty_tpl->getValue('filter')['user_role'] == 'cashier') {?>selected<?php }?>>Thu ngân</option>
          <option value="pharmacist"  <?php if ($_smarty_tpl->getValue('filter')['user_role'] == 'pharmacist') {?>selected<?php }?>>Dược sĩ</option>
        </select>
        <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
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
          <th>Thời gian</th>
          <th>Người dùng</th>
          <th>Vai trò</th>
          <th>Hành động</th>
          <th>Đối tượng</th>
          <th>IP</th>
          <th>Thiết bị</th>
          <th>Kết quả</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('logs'), 'log');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('log')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><span style="font-size:12px;color:var(--admin-text-secondary)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('log')['created_at'],"%d/%m %H:%M:%S");?>
</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar" style="width:28px;height:28px;font-size:11px"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('log')['user_name'],1,'');?>
</div>
              <span style="font-size:13px"><?php echo $_smarty_tpl->getValue('log')['user_name'];?>
</span>
            </div>
          </td>
          <td><span class="badge badge--<?php echo $_smarty_tpl->getValue('log')['user_role'];?>
"><?php echo $_smarty_tpl->getValue('log')['user_role'];?>
</span></td>
          <td>
            <?php if ($_smarty_tpl->getValue('log')['action_type'] == 'login') {?>     <span class="badge badge--success">Đăng nhập</span>
            <?php } elseif ($_smarty_tpl->getValue('log')['action_type'] == 'logout') {?> <span class="badge badge--neutral">Đăng xuất</span>
            <?php } elseif ($_smarty_tpl->getValue('log')['action_type'] == 'create') {?> <span class="badge badge--blue">Tạo mới</span>
            <?php } elseif ($_smarty_tpl->getValue('log')['action_type'] == 'update') {?> <span class="badge badge--orange">Cập nhật</span>
            <?php } elseif ($_smarty_tpl->getValue('log')['action_type'] == 'delete') {?> <span class="badge badge--danger">Xóa</span>
            <?php } elseif ($_smarty_tpl->getValue('log')['action_type'] == 'view_emr') {?><span class="badge badge--purple">Xem hồ sơ</span>
            <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('log')['action_type'];?>
</span><?php }?>
          </td>
          <td><span style="font-size:12px"><?php echo (($tmp = $_smarty_tpl->getValue('log')['target'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td><code style="font-size:11px;background:#f1f5f9;padding:2px 6px;border-radius:4px"><?php echo (($tmp = $_smarty_tpl->getValue('log')['ip'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</code></td>
          <td><span style="font-size:11px;color:var(--admin-text-secondary)"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('log')['device'],20,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
          <td>
            <?php if ($_smarty_tpl->getValue('log')['is_success']) {?>
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> OK</span>
            <?php } else { ?>
              <span class="badge badge--danger"><i class="fa-solid fa-xmark"></i> Lỗi</span>
            <?php }?>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr><td colspan="8" class="table-empty">Chưa có log nào</td></tr>
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

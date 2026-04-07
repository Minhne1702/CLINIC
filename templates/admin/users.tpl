{include file="layout/sidebar.tpl" page_title="Quản lý tài khoản" active_page="users"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-users"></i> Tài khoản hệ thống</h2>
    <p class="page-subtitle">Quản lý tất cả người dùng và phân quyền</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=admin&page=users&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm tài khoản
    </a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<!-- Filter bar -->
<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$BASE_URL}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="users">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên, email, SĐT..." value="{$filter.q|default:''}">
        </div>
        <select name="filter_role">
          <option value="">Tất cả vai trò</option>
          <option value="admin"      {if $filter.role == 'admin'}selected{/if}>Admin</option>
          <option value="doctor"     {if $filter.role == 'doctor'}selected{/if}>Bác sĩ</option>
          <option value="receptionist" {if $filter.role == 'receptionist'}selected{/if}>Lễ tân</option>
          <option value="cashier"    {if $filter.role == 'cashier'}selected{/if}>Thu ngân</option>
          <option value="pharmacist" {if $filter.role == 'pharmacist'}selected{/if}>Dược sĩ</option>
          <option value="patient"    {if $filter.role == 'patient'}selected{/if}>Bệnh nhân</option>
        </select>
        <select name="filter_status">
          <option value="">Tất cả trạng thái</option>
          <option value="active"   {if $filter.status == 'active'}selected{/if}>Hoạt động</option>
          <option value="inactive" {if $filter.status == 'inactive'}selected{/if}>Vô hiệu hóa</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
        <a href="{$BASE_URL}/?role=admin&page=users" class="btn-admin-ghost">Xóa lọc</a>
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
        {foreach from=$users item=u}
        <tr>
          <td><input type="checkbox" class="row-check" value="{$u._id}"></td>
          <td>
            <div class="table-user">
              <div class="table-avatar">{$u.full_name|truncate:1:""}</div>
              <div>
                <strong>{$u.full_name}</strong>
                <small>{$u.email}</small>
              </div>
            </div>
          </td>
          <td><span class="badge badge--{$u.role}">{$u.role_label}</span></td>
          <td>{$u.phone|default:'—'}</td>
          <td>{$u.created_at|date_format:"%d/%m/%Y"}</td>
          <td>
            {if $u.is_active}
              <span class="badge badge--success">Hoạt động</span>
            {else}
              <span class="badge badge--danger">Vô hiệu hóa</span>
            {/if}
          </td>
          <td>
            <div class="table-actions">
              <a href="{$BASE_URL}/?role=admin&page=users&action=edit&id={$u._id}" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=users&action=toggle&id={$u._id}" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=users&action=delete&id={$u._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa tài khoản này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="7" class="table-empty">Không tìm thấy tài khoản nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
  {if $pagination}
  <div class="admin-card__footer">  </div>
  {/if}
</div>

{include file="layout/footer.tpl"}
<script>
document.getElementById('selectAll').addEventListener('change', function() {
  document.querySelectorAll('.row-check').forEach(c => c.checked = this.checked);
});
</script>

{include file="layout/sidebar.tpl" page_title="Audit Log" active_page="audit-log"}

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
          <input type="text" name="q" placeholder="Tên user, IP, action..." value="{$filter.q|default:''}">
        </div>
        <select name="action_type">
          <option value="">Tất cả hành động</option>
          <option value="login"    {if $filter.action_type == 'login'}selected{/if}>Đăng nhập</option>
          <option value="logout"   {if $filter.action_type == 'logout'}selected{/if}>Đăng xuất</option>
          <option value="create"   {if $filter.action_type == 'create'}selected{/if}>Tạo mới</option>
          <option value="update"   {if $filter.action_type == 'update'}selected{/if}>Cập nhật</option>
          <option value="delete"   {if $filter.action_type == 'delete'}selected{/if}>Xóa</option>
          <option value="view_emr" {if $filter.action_type == 'view_emr'}selected{/if}>Xem hồ sơ BN</option>
          <option value="prescribe"{if $filter.action_type == 'prescribe'}selected{/if}>Kê đơn thuốc</option>
        </select>
        <select name="user_role">
          <option value="">Tất cả vai trò</option>
          <option value="admin"       {if $filter.user_role == 'admin'}selected{/if}>Admin</option>
          <option value="doctor"      {if $filter.user_role == 'doctor'}selected{/if}>Bác sĩ</option>
          <option value="receptionist"{if $filter.user_role == 'receptionist'}selected{/if}>Lễ tân</option>
          <option value="cashier"     {if $filter.user_role == 'cashier'}selected{/if}>Thu ngân</option>
          <option value="pharmacist"  {if $filter.user_role == 'pharmacist'}selected{/if}>Dược sĩ</option>
        </select>
        <input type="date" name="date_from" value="{$filter.date_from|default:''}">
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
        {foreach from=$logs item=log}
        <tr>
          <td><span style="font-size:12px;color:var(--admin-text-secondary)">{$log.created_at|date_format:"%d/%m %H:%M:%S"}</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar" style="width:28px;height:28px;font-size:11px">{$log.user_name|truncate:1:""}</div>
              <span style="font-size:13px">{$log.user_name}</span>
            </div>
          </td>
          <td><span class="badge badge--{$log.user_role}">{$log.user_role}</span></td>
          <td>
            {if $log.action_type == 'login'}     <span class="badge badge--success">Đăng nhập</span>
            {elseif $log.action_type == 'logout'} <span class="badge badge--neutral">Đăng xuất</span>
            {elseif $log.action_type == 'create'} <span class="badge badge--blue">Tạo mới</span>
            {elseif $log.action_type == 'update'} <span class="badge badge--orange">Cập nhật</span>
            {elseif $log.action_type == 'delete'} <span class="badge badge--danger">Xóa</span>
            {elseif $log.action_type == 'view_emr'}<span class="badge badge--purple">Xem hồ sơ</span>
            {else}<span class="badge badge--neutral">{$log.action_type}</span>{/if}
          </td>
          <td><span style="font-size:12px">{$log.target|default:'—'}</span></td>
          <td><code style="font-size:11px;background:#f1f5f9;padding:2px 6px;border-radius:4px">{$log.ip|default:'—'}</code></td>
          <td><span style="font-size:11px;color:var(--admin-text-secondary)">{$log.device|truncate:20:'...'|default:'—'}</span></td>
          <td>
            {if $log.is_success}
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> OK</span>
            {else}
              <span class="badge badge--danger"><i class="fa-solid fa-xmark"></i> Lỗi</span>
            {/if}
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="8" class="table-empty">Chưa có log nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

{include file="layout/footer.tpl"}

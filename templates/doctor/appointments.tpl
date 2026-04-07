{include file="layout/sidebar.tpl" page_title="Lịch hẹn" active_page="appointments"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Lịch hẹn của tôi</h2><p class="page-subtitle">Tất cả lịch hẹn được phân công</p></div>
</div>
<div class="status-tabs mb-1">
  {assign var="cur" value=$filter.status|default:''}
  <a href="{$BASE_URL}/?role=doctor&page=appointments" class="status-tab {if $cur==''}active{/if}">Tất cả <span class="tab-count">{$count.all|default:0}</span></a>
  <a href="{$BASE_URL}/?role=doctor&page=appointments&status=confirmed" class="status-tab {if $cur=='confirmed'}active{/if}">Đã xác nhận <span class="tab-count tab-count--blue">{$count.confirmed|default:0}</span></a>
  <a href="{$BASE_URL}/?role=doctor&page=appointments&status=pending" class="status-tab {if $cur=='pending'}active{/if}">Chờ xác nhận <span class="tab-count tab-count--warning">{$count.pending|default:0}</span></a>
  <a href="{$BASE_URL}/?role=doctor&page=appointments&status=completed" class="status-tab {if $cur=='completed'}active{/if}">Hoàn thành <span class="tab-count tab-count--success">{$count.completed|default:0}</span></a>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$BASE_URL}/" class="filter-bar"><input type="hidden" name="role" value="doctor"><input type="hidden" name="page" value="appointments">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên bệnh nhân..." value="{$filter.q|default:''}"></div>
      <input type="date" name="date" value="{$filter.date|default:''}">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Bệnh nhân</th><th>Ngày giờ</th><th>Hình thức</th><th>Triệu chứng</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
  <tbody>
    {foreach from=$appointments item=apt}
    <tr>
      <td><div class="table-user"><div class="table-avatar">{$apt.patient_name|truncate:1:""}</div><div><strong>{$apt.patient_name}</strong><small>{$apt.patient_code}</small></div></div></td>
      <td><strong>{$apt.date|date_format:"%d/%m/%Y"}</strong><br><small>{$apt.time}</small></td>
      <td>{if $apt.type=='online'}<span class="badge badge--blue"><i class="fa-solid fa-video"></i> Online</span>{else}<span class="badge badge--neutral">Trực tiếp</span>{/if}</td>
      <td><span style="font-size:13px">{$apt.symptoms|truncate:40:'...'|default:'—'}</span></td>
      <td>
        {if $apt.status=='confirmed'}<span class="badge badge--blue">Xác nhận</span>
        {elseif $apt.status=='pending'}<span class="badge badge--warning">Chờ</span>
        {elseif $apt.status=='completed'}<span class="badge badge--success">Xong</span>
        {else}<span class="badge badge--neutral">{$apt.status}</span>{/if}
      </td>
      <td><div class="table-actions">
        <a href="{$BASE_URL}/?role=doctor&page=examination&patient_id={$apt.patient_id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-stethoscope"></i> Khám</a>
        <a href="{$BASE_URL}/?role=doctor&page=appointments&action=view&id={$apt._id}" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
      </div></td>
    </tr>
    {foreachelse}<tr><td colspan="6" class="table-empty">Không có lịch hẹn nào</td></tr>
    {/foreach}
  </tbody></table>
</div></div>
{include file="layout/footer.tpl"}

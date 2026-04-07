{include file="layout/sidebar.tpl" page_title="Quản lý lịch hẹn" active_page="appointments"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Quản lý lịch hẹn</h2><p class="page-subtitle">Xác nhận và điều phối lịch hẹn</p></div>
  <div class="page-toolbar__right"><a href="/CLINIC/public/?role=receptionist&page=walk-in" class="btn-admin-primary"><i class="fa-solid fa-person-walking-arrow-right"></i> Đăng ký tại chỗ</a></div>
</div>
{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
<div class="status-tabs mb-1">
  {assign var="cur" value=$filter.status|default:''}
  <a href="/CLINIC/public/?role=receptionist&page=appointments" class="status-tab {if $cur==''}active{/if}">Tất cả <span class="tab-count">{$count.all|default:0}</span></a>
  <a href="/CLINIC/public/?role=receptionist&page=appointments&status=pending" class="status-tab {if $cur=='pending'}active{/if}">Chờ xác nhận <span class="tab-count tab-count--warning">{$count.pending|default:0}</span></a>
  <a href="/CLINIC/public/?role=receptionist&page=appointments&status=confirmed" class="status-tab {if $cur=='confirmed'}active{/if}">Đã xác nhận <span class="tab-count tab-count--blue">{$count.confirmed|default:0}</span></a>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="/CLINIC/public/" class="filter-bar"><input type="hidden" name="role" value="receptionist"><input type="hidden" name="page" value="appointments">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên bệnh nhân, mã lịch..." value="{$filter.q|default:''}"></div>
      <input type="date" name="date" value="{$filter.date|default:''}">
      <select name="doctor_id"><option value="">Tất cả bác sĩ</option>{foreach from=$doctors item=doc}<option value="{$doc._id}" {if $filter.doctor_id==$doc._id}selected{/if}>{$doc.full_name}</option>{/foreach}</select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Mã lịch</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Ngày giờ</th><th>Hình thức</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
  <tbody>
    {foreach from=$appointments item=apt}
    <tr>
      <td><span class="code-tag">{$apt.code}</span></td>
      <td><div class="table-user"><div class="table-avatar">{$apt.patient_name|truncate:1:""}</div><div><strong>{$apt.patient_name}</strong><small>{$apt.patient_phone}</small></div></div></td>
      <td>{$apt.doctor_name}<br><small class="text-muted">{$apt.specialty}</small></td>
      <td><strong>{$apt.date|date_format:"%d/%m/%Y"}</strong><br><small>{$apt.time}</small></td>
      <td>{if $apt.type=='online'}<span class="badge badge--blue"><i class="fa-solid fa-video"></i> Online</span>{else}<span class="badge badge--neutral">Trực tiếp</span>{/if}</td>
      <td>
        {if $apt.status=='pending'}<span class="badge badge--warning">Chờ xác nhận</span>
        {elseif $apt.status=='confirmed'}<span class="badge badge--blue">Đã xác nhận</span>
        {elseif $apt.status=='completed'}<span class="badge badge--success">Hoàn thành</span>
        {elseif $apt.status=='cancelled'}<span class="badge badge--danger">Đã hủy</span>{/if}
      </td>
      <td><div class="table-actions">
        {if $apt.status=='pending'}<a href="/CLINIC/public/?role=receptionist&page=appointments&action=confirm&id={$apt._id}" class="action-btn action-btn--success" title="Xác nhận"><i class="fa-solid fa-check"></i></a>{/if}
        <a href="/CLINIC/public/?role=receptionist&page=checkin&q={$apt.patient_code}" class="action-btn" title="Check-in"><i class="fa-solid fa-right-to-bracket"></i></a>
        <a href="/CLINIC/public/?role=receptionist&page=appointments&action=cancel&id={$apt._id}" class="action-btn action-btn--danger" title="Hủy" onclick="return confirm('Hủy lịch hẹn này?')"><i class="fa-solid fa-ban"></i></a>
      </div></td>
    </tr>
    {foreachelse}<tr><td colspan="7" class="table-empty">Không có lịch hẹn nào</td></tr>
    {/foreach}
  </tbody></table>
</div></div>
{include file="layout/footer.tpl"}

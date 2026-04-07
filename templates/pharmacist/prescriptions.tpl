{include file="layout/sidebar.tpl" page_title="Đơn thuốc đến" active_page="prescriptions"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc đến</h2><p class="page-subtitle">Danh sách đơn thuốc cần phát</p></div>
</div>
<div class="status-tabs mb-1">
  {assign var="cur" value=$filter.status|default:''}
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="status-tab {if $cur==''}active{/if}">Tất cả <span class="tab-count">{$count.all|default:0}</span></a>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions&status=pending" class="status-tab {if $cur=='pending'}active{/if}">Chờ phát <span class="tab-count tab-count--warning">{$count.pending|default:0}</span></a>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions&status=dispensing" class="status-tab {if $cur=='dispensing'}active{/if}">Đang bốc <span class="tab-count tab-count--blue">{$count.dispensing|default:0}</span></a>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions&status=done" class="status-tab {if $cur=='done'}active{/if}">Đã phát <span class="tab-count tab-count--success">{$count.done|default:0}</span></a>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$BASE_URL}/" class="filter-bar">
    <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="prescriptions">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã đơn..." value="{$filter.q|default:''}"></div>
      <input type="date" name="date" value="{$filter.date|default:''}">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Mã đơn</th><th>Bệnh nhân</th><th>Bác sĩ kê</th><th>Chẩn đoán</th><th>Thời gian</th><th>Số thuốc</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
    <tbody>
      {foreach from=$prescriptions item=rx}
      <tr>
        <td><span class="code-tag">{$rx.code}</span></td>
        <td><div class="table-user"><div class="table-avatar">{$rx.patient_name|truncate:1:""}</div><div><strong>{$rx.patient_name}</strong><small>{$rx.patient_code}</small></div></div></td>
        <td>{$rx.doctor_name}</td>
        <td>{$rx.diagnosis|default:'—'|truncate:35:'...'}</td>
        <td>{$rx.created_at|date_format:"%H:%M %d/%m/%Y"}</td>
        <td><span class="badge badge--blue">{$rx.drug_count} thuốc</span></td>
        <td>
          {if $rx.status=='pending'}<span class="badge badge--warning">Chờ phát</span>
          {elseif $rx.status=='dispensing'}<span class="badge badge--blue">Đang bốc</span>
          {elseif $rx.status=='done'}<span class="badge badge--success">Đã phát</span>
          {else}<span class="badge badge--neutral">{$rx.status}</span>{/if}
        </td>
        <td><div class="table-actions">
          <a href="{$BASE_URL}/?role=pharmacist&page=dispensing&id={$rx._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-capsules"></i> Phát thuốc</a>
          <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions&action=view&id={$rx._id}" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
        </div></td>
      </tr>
      {foreachelse}<tr><td colspan="8" class="table-empty">Không có đơn thuốc nào</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{include file="layout/footer.tpl"}

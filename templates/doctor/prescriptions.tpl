{include file="layout/sidebar.tpl" page_title="Đơn thuốc đã kê" active_page="prescriptions"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc đã kê</h2><p class="page-subtitle">Lịch sử đơn thuốc bác sĩ đã kê</p></div>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$base_url}/" class="filter-bar"><input type="hidden" name="role" value="doctor"><input type="hidden" name="page" value="prescriptions">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên bệnh nhân, mã đơn..." value="{$filter.q|default:''}"></div>
      <input type="date" name="date_from" value="{$filter.date_from|default:''}">
      <input type="date" name="date_to"   value="{$filter.date_to|default:''}">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Mã đơn</th><th>Bệnh nhân</th><th>Chẩn đoán</th><th>Ngày kê</th><th>Số thuốc</th><th>Tình trạng phát</th><th>Thao tác</th></tr></thead>
  <tbody>
    {foreach from=$prescriptions item=rx}
    <tr>
      <td><span class="code-tag">{$rx.code}</span></td>
      <td><strong>{$rx.patient_name}</strong></td>
      <td>{$rx.diagnosis|default:'—'|truncate:40:'...'}</td>
      <td>{$rx.date|date_format:"%d/%m/%Y"}</td>
      <td><span class="badge badge--blue">{$rx.drug_count|default:0} thuốc</span></td>
      <td>
        {if $rx.dispensed}<span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã phát</span>
        {elseif $rx.paid}<span class="badge badge--warning">Chờ phát thuốc</span>
        {else}<span class="badge badge--neutral">Chờ thanh toán</span>{/if}
      </td>
      <td><div class="table-actions">
        <a href="{$base_url}/?role=doctor&page=prescriptions&id={$rx._id}" class="action-btn" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
      </div></td>
    </tr>
    {foreachelse}<tr><td colspan="7" class="table-empty">Chưa có đơn thuốc nào</td></tr>
    {/foreach}
  </tbody></table>
</div></div>
{include file="layout/footer.tpl"}

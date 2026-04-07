{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome" style="background:linear-gradient(135deg,#4c1d95 0%,#8b5cf6 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#ede9fe">{$current_user_name|default:"Dược sĩ"}</span> 💊</h2>
    <p>Có <strong style="color:#fff">{$stats.new_rx|default:0}</strong> đơn thuốc mới cần xử lý hôm nay</p>
  </div>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-admin-primary" style="background:#fff;color:#4c1d95">
    <i class="fa-solid fa-prescription"></i> Xử lý đơn thuốc
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div><div><p>Đơn thuốc mới</p><strong>{$stats.new_rx|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-capsules"></i></div><div><p>Đã phát hôm nay</p><strong>{$stats.dispensed_today|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-triangle-exclamation"></i></div><div><p>Thuốc sắp hết</p><strong>{$stats.low_stock|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-regular fa-calendar-xmark"></i></div><div><p>Thuốc sắp hết hạn</p><strong>{$stats.expiring|default:0}</strong></div></div>
</div>

{if $stats.low_stock > 0}
<div class="alert alert--warning mb-1"><i class="fa-solid fa-triangle-exclamation"></i> Có <strong>{$stats.low_stock}</strong> loại thuốc sắp hết hàng. <a href="{$BASE_URL}/?role=pharmacist&page=low-stock">Xem ngay →</a></div>
{/if}

<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-prescription"></i> Đơn thuốc mới nhất</h3><a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Mã đơn</th><th>Bệnh nhân</th><th>Bác sĩ kê</th><th>Thời gian</th><th>Số thuốc</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          {foreach from=$new_prescriptions item=rx}
          <tr>
            <td><span class="code-tag">{$rx.code}</span></td>
            <td><div class="table-user"><div class="table-avatar">{$rx.patient_name|truncate:1:""}</div><strong>{$rx.patient_name}</strong></div></td>
            <td>{$rx.doctor_name}</td>
            <td>{$rx.created_at|date_format:"%H:%M %d/%m"}</td>
            <td><span class="badge badge--blue">{$rx.drug_count} thuốc</span></td>
            <td>
              {if $rx.status=='pending'}<span class="badge badge--warning">Chờ phát</span>
              {elseif $rx.status=='dispensing'}<span class="badge badge--blue">Đang bốc</span>
              {elseif $rx.status=='done'}<span class="badge badge--success">Đã phát</span>
              {else}<span class="badge badge--neutral">{$rx.status}</span>{/if}
            </td>
            <td><a href="{$BASE_URL}/?role=pharmacist&page=dispensing&id={$rx._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-capsules"></i> Phát thuốc</a></td>
          </tr>
          {foreachelse}<tr><td colspan="7" class="table-empty">Không có đơn thuốc mới</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-boxes-stacking"></i> Tồn kho thấp</h3><a href="{$BASE_URL}/?role=pharmacist&page=low-stock" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      {foreach from=$low_stock_drugs item=drug}
      <div class="record-item">
        <div class="record-item__icon" style="background:rgba(239,68,68,.1);color:var(--admin-danger)"><i class="fa-solid fa-pills"></i></div>
        <div class="record-item__info"><strong>{$drug.name}</strong><p>{$drug.stock_qty} {$drug.unit} còn lại · Tối thiểu: {$drug.min_qty}</p></div>
        <span class="badge badge--danger">Thấp</span>
      </div>
      {foreachelse}<div class="empty-state" style="padding:2rem"><i class="fa-solid fa-box-open"></i><p>Tồn kho ổn định</p></div>
      {/foreach}
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

{include file="layout/sidebar.tpl" page_title="Báo cáo doanh thu" active_page="reports"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-chart-line"></i> Báo cáo doanh thu</h2><p class="page-subtitle">Thống kê theo khoảng thời gian</p></div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=cashier&page=reports&action=export&date_from={$filter.date_from}&date_to={$filter.date_to}&period={$filter.period}" class="btn-admin-secondary"><i class="fa-solid fa-file-excel"></i> Xuất báo cáo</a>
  </div>
</div>

{if isset($error_message)}<div class="alert alert--warning"><i class="fa-solid fa-triangle-exclamation"></i> {$error_message}</div>{/if}

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$BASE_URL}/" class="filter-bar">
    <input type="hidden" name="role" value="cashier">
    <input type="hidden" name="page" value="reports">
    <div class="filter-bar__group">
      <select name="period" onchange="this.form.submit()">
        <option value="7"  {if $filter.period=='7'}selected{/if}>7 ngày qua</option>
        <option value="30" {if $filter.period=='30'}selected{/if}>30 ngày qua</option>
        <option value="90" {if $filter.period=='90'}selected{/if}>90 ngày qua</option>
        <option value="0"  {if $filter.period=='0'}selected{/if}>Tùy chỉnh</option>
      </select>
      <input type="date" name="date_from" value="{$filter.date_from|default:''}">
      <input type="date" name="date_to"   value="{$filter.date_to|default:''}">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Xem báo cáo</button>
    </div>
  </form>
</div></div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div>
    <div><p>Tổng doanh thu</p><strong>{$report.total_revenue|default:"0đ"}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-receipt"></i></div>
    <div><p>Số hóa đơn</p><strong>{$report.total_invoices|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#3b82f6"><i class="fa-solid fa-money-bill-wave"></i></div>
    <div><p>Tiền mặt</p><strong>{$report.cash_total|default:"0đ"}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-building-columns"></i></div>
    <div><p>Chuyển khoản</p><strong>{$report.transfer_total|default:"0đ"}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#ec4899"><i class="fa-solid fa-qrcode"></i></div>
    <div><p>QR Code</p><strong>{$report.qr_total|default:"0đ"}</strong></div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__header"><h3><i class="fa-solid fa-chart-bar"></i> Phân tích phương thức thanh toán</h3></div>
  <div class="admin-card__body">
    <div class="quick-stats">
      <div class="quick-stat"><span><i class="fa-solid fa-money-bill-wave" style="color:#3b82f6"></i> Tiền mặt</span><strong>{$report.cash_total|default:"0đ"}</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-building-columns" style="color:#8b5cf6"></i> Chuyển khoản</span><strong>{$report.transfer_total|default:"0đ"}</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-qrcode" style="color:#ec4899"></i> QR Code</span><strong>{$report.qr_total|default:"0đ"}</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-calendar-range" style="color:#6b7280"></i> Thời gian</span><strong>{$filter.date_from} → {$filter.date_to}</strong></div>
      <div class="quick-stat"><span>Tổng doanh thu</span><strong class="text-success">{$report.total_revenue|default:"0đ"}</strong></div>
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

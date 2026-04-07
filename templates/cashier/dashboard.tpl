{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome" style="background:linear-gradient(135deg,#92400e 0%,#f59e0b 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#fef3c7">{$current_user_name|default:"Thu ngân"}</span> 💰</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — Doanh thu: <strong style="color:#fff">{$stats.today_revenue|default:"0đ"}</strong></p>
  </div>
  <a href="{$base_url}/?role=cashier&page=billing" class="btn-admin-primary" style="background:#fff;color:#92400e">
    <i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div><div><p>Doanh thu hôm nay</p><strong>{$stats.today_revenue|default:"0đ"}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-clock"></i></div><div><p>Chờ thanh toán</p><strong>{$stats.pending_count|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div><div><p>Đã thanh toán</p><strong>{$stats.paid_today|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-hand-holding-dollar"></i></div><div><p>Tạm ứng</p><strong>{$stats.advance_today|default:"0đ"}</strong></div></div>
</div>

<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-clock"></i> Chờ thanh toán</h3><a href="{$base_url}/?role=cashier&page=pending" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Dịch vụ</th><th>Tổng tiền</th><th>Thao tác</th></tr></thead>
        <tbody>
          {foreach from=$pending_bills item=bill}
          <tr>
            <td><div class="table-user"><div class="table-avatar">{$bill.patient_name|truncate:1:""}</div><div><strong>{$bill.patient_name}</strong><small>#{$bill.patient_code}</small></div></div></td>
            <td>{$bill.doctor_name}</td>
            <td><small>{$bill.services|truncate:40:'...'}</small></td>
            <td><strong style="color:var(--admin-success)">{$bill.total_amount}</strong></td>
            <td><a href="{$base_url}/?role=cashier&page=billing&id={$bill._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
          </tr>
          {foreachelse}<tr><td colspan="5" class="table-empty">Không có hóa đơn chờ thanh toán</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-chart-bar"></i> Thống kê hôm nay</h3></div>
    <div class="admin-card__body">
      <div class="quick-stats">
        <div class="quick-stat"><span>Tiền mặt</span><strong>{$stats.cash_today|default:"0đ"}</strong></div>
        <div class="quick-stat"><span>Chuyển khoản</span><strong>{$stats.transfer_today|default:"0đ"}</strong></div>
        <div class="quick-stat"><span>QR Code</span><strong>{$stats.qr_today|default:"0đ"}</strong></div>
        <div class="quick-stat"><span>BHYT chi trả</span><strong>{$stats.insurance_today|default:"0đ"}</strong></div>
        <div class="quick-stat"><span>Tổng doanh thu</span><strong class="text-success">{$stats.today_revenue|default:"0đ"}</strong></div>
      </div>
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

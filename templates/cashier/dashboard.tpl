{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome" style="background:linear-gradient(135deg,#92400e 0%,#f59e0b 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#fef3c7">{$current_user_name|default:"Thu ngân"}</span> 💰</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — Doanh thu: <strong style="color:#fff">{$stats.today_revenue|default:"0đ"}</strong></p>
  </div>
  <a href="{$BASE_URL}/?role=cashier&page=billing" class="btn-admin-primary" style="background:#fff;color:#92400e; font-weight: 700;">
    <i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div>
    <div><p>Doanh thu hôm nay</p><strong>{$stats.today_revenue|default:"0đ"}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-clock"></i></div>
    <div><p>Chờ thanh toán</p><strong>{$stats.pending_count|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div>
    <div><p>Đã thanh toán</p><strong>{$stats.paid_today|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-hand-holding-dollar"></i></div>
    <div><p>Tạm ứng</p><strong>{$stats.advance_today|default:"0đ"}</strong></div>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: stretch; margin-top: 20px;">
  
  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-clock"></i> Chờ thanh toán</h3>
      <a href="{$BASE_URL}/?role=cashier&page=pending" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0" style="flex-grow: 1;">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Bệnh nhân</th>
              <th>Bác sĩ</th>
              <th>Dịch vụ</th>
              <th>Tổng tiền</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$pending_bills item=bill}
            <tr>
              <td>
                <div class="table-user">
                  <div class="table-avatar">{$bill.patient_name|truncate:1:""}</div>
                  <div><strong>{$bill.patient_name}</strong><small>#{$bill.patient_code}</small></div>
                </div>
              </td>
              <td>{$bill.doctor_name}</td>
              <td><small title="{$bill.services}">{$bill.services|truncate:40:'...'}</small></td>
              <td><strong style="color:var(--admin-success)">{$bill.total_amount}</strong></td>
              <td>
                <a href="{$BASE_URL}/?role=cashier&page=billing&id={$bill._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem">
                  <i class="fa-solid fa-cash-register"></i> Thanh toán
                </a>
              </td>
            </tr>
            {foreachelse}
            <tr>
              <td colspan="5" class="table-empty" style="padding: 4rem 0; text-align: center;">Không có hóa đơn chờ thanh toán</td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-bar" style="color: #f59e0b;"></i> Thống kê hôm nay</h3>
    </div>
    <div class="admin-card__body" style="flex-grow: 1; background: #fff; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
      <div class="quick-stats" style="display: flex; flex-direction: column; gap: 4px;">
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-money-bill-1-wave" style="width: 20px;"></i> Tiền mặt</span>
          <strong style="color: #1e293b;">{$stats.cash_today|default:"0đ"}</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-building-columns" style="width: 20px;"></i> Chuyển khoản</span>
          <strong style="color: #1e293b;">{$stats.transfer_today|default:"0đ"}</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-qrcode" style="width: 20px;"></i> QR Code</span>
          <strong style="color: #1e293b;">{$stats.qr_today|default:"0đ"}</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-shield-heart" style="width: 20px;"></i> BHYT chi trả</span>
          <strong style="color: #1e293b;">{$stats.insurance_today|default:"0đ"}</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 16px 0; margin-top: 8px;">
          <span style="color: #1e293b; font-weight: 700; font-size: 15px;">Tổng doanh thu</span>
          <strong style="color: #10b981; font-size: 18px;">{$stats.today_revenue|default:"0đ"}</strong>
        </div>

      </div>
    </div>
  </div>

</div>

{include file="layout/footer.tpl"}
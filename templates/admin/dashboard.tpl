{include file="layout/sidebar.tpl" page_title="Dashboard" active_page="dashboard"}

<!-- STATS CARDS -->
<div class="stats-grid">
  <div class="stat-card stat-card--blue">
    <div class="stat-card__icon"><i class="fa-solid fa-hospital-user"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Bệnh nhân hôm nay</p>
      <h3 class="stat-card__value">{$stats.today_patients|default:0}</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +12% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--green">
    <div class="stat-card__icon"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Lịch hẹn hôm nay</p>
      <h3 class="stat-card__value">{$stats.today_appointments|default:0}</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +5% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--orange">
    <div class="stat-card__icon"><i class="fa-solid fa-sack-dollar"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Doanh thu hôm nay</p>
      <h3 class="stat-card__value">{$stats.today_revenue|default:"0đ"}</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +8% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--purple">
    <div class="stat-card__icon"><i class="fa-solid fa-user-doctor"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Bác sĩ đang trực</p>
      <h3 class="stat-card__value">{$stats.doctors_on_duty|default:0}</h3>
      <p class="stat-card__change neutral"><i class="fa-solid fa-minus"></i> Không thay đổi</p>
    </div>
  </div>
</div>

<!-- CHARTS ROW -->
<div class="dashboard-grid">

  <!-- Revenue Chart -->
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-line"></i> Doanh thu 7 ngày gần nhất</h3>
      <div class="card-actions">
        <select class="select-sm" id="revenueRange">
          <option value="7">7 ngày</option>
          <option value="30">30 ngày</option>
          <option value="90">3 tháng</option>
        </select>
      </div>
    </div>
    <div class="admin-card__body">
      <canvas id="revenueChart" height="280"></canvas>
    </div>
  </div>

  <!-- Specialty Pie -->
  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-pie"></i> Lượt khám theo chuyên khoa</h3>
    </div>
    <div class="admin-card__body">
      <canvas id="specialtyChart" height="260"></canvas>
    </div>
  </div>

</div>

<!-- TABLES ROW -->
<div class="dashboard-grid">

  <!-- Recent Appointments -->
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-clock-rotate-left"></i> Lịch hẹn gần đây</h3>
      <a href="/CLINIC/public/?role=admin&page=appointments" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Bệnh nhân</th>
            <th>Bác sĩ</th>
            <th>Chuyên khoa</th>
            <th>Giờ</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$recent_appointments item=apt}
          <tr>
            <td><div class="table-user"><div class="table-avatar">{$apt.patient_name|truncate:1:""}</div>{$apt.patient_name}</div></td>
            <td>{$apt.doctor_name}</td>
            <td>{$apt.specialty}</td>
            <td>{$apt.time}</td>
            <td><span class="badge badge--{$apt.status_class}">{$apt.status_label}</span></td>
          </tr>
          {foreachelse}
          <tr><td colspan="5" class="table-empty">Chưa có lịch hẹn nào hôm nay</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-bolt"></i> Thống kê nhanh</h3>
    </div>
    <div class="admin-card__body">
      <div class="quick-stats">
        <div class="quick-stat">
          <span class="quick-stat__label">Tổng bệnh nhân</span>
          <span class="quick-stat__value">{$stats.total_patients|default:0}</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Tổng bác sĩ</span>
          <span class="quick-stat__value">{$stats.total_doctors|default:0}</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Lịch hẹn tháng này</span>
          <span class="quick-stat__value">{$stats.month_appointments|default:0}</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Doanh thu tháng này</span>
          <span class="quick-stat__value text-success">{$stats.month_revenue|default:"0đ"}</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Đơn thuốc hôm nay</span>
          <span class="quick-stat__value">{$stats.today_prescriptions|default:0}</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Thuốc sắp hết</span>
          <span class="quick-stat__value text-danger">{$stats.low_stock_drugs|default:0}</span>
        </div>
      </div>
    </div>
  </div>

</div>

{include file="layout/footer.tpl"}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
const labels = {$chart_labels|default:'["T2","T3","T4","T5","T6","T7","CN"]'};
const revenues = {$chart_revenues|default:'[12000000,18500000,15000000,22000000,19000000,25000000,17000000]'};
const specialtyLabels = {$specialty_labels|default:'["Tim mạch","Nhi","Da liễu","Nha","Thần kinh","Khác"]'};
const specialtyData = {$specialty_data|default:'[30,25,20,15,6,4]'};

// Revenue chart
new Chart(document.getElementById('revenueChart'), {
  type: 'line',
  data: {
    labels,
    datasets: [{
      label: 'Doanh thu (VNĐ)',
      data: revenues,
      borderColor: '#0891b2',
      backgroundColor: 'rgba(8,145,178,.08)',
      borderWidth: 2.5,
      fill: true,
      tension: 0.4,
      pointBackgroundColor: '#0891b2',
      pointRadius: 4,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      y: { ticks: { callback: v => (v/1000000).toFixed(1)+'M' }, grid: { color: '#f1f5f9' } },
      x: { grid: { display: false } }
    }
  }
});

// Specialty pie
new Chart(document.getElementById('specialtyChart'), {
  type: 'doughnut',
  data: {
    labels: specialtyLabels,
    datasets: [{
      data: specialtyData,
      backgroundColor: ['#0891b2','#10b981','#f59e0b','#ef4444','#8b5cf6','#94a3b8'],
      borderWidth: 0,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { position: 'bottom', labels: { padding: 16, font: { size: 12 } } } },
    cutout: '65%'
  }
});
</script>

{include file="layout/sidebar.tpl" page_title="Báo cáo & Thống kê" active_page="reports"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-chart-bar"></i> Báo cáo & Thống kê</h2>
    <p class="page-subtitle">Tổng hợp dữ liệu hoạt động phòng khám</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-secondary" onclick="exportExcel()">
      <i class="fa-solid fa-file-excel"></i> Xuất Excel
    </button>
  </div>
</div>

<!-- Date range filter -->
<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$base_url}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="reports">
      <div class="filter-bar__group">
        <label style="font-size:13px;font-weight:500;color:var(--admin-text-secondary)">Từ ngày</label>
        <input type="date" name="date_from" value="{$filter.date_from|default:''}">
        <label style="font-size:13px;font-weight:500;color:var(--admin-text-secondary)">Đến ngày</label>
        <input type="date" name="date_to" value="{$filter.date_to|default:''}">
        <select name="period">
          <option value="7"   {if $filter.period == '7'}selected{/if}>7 ngày qua</option>
          <option value="30"  {if $filter.period == '30'}selected{/if}>30 ngày qua</option>
          <option value="90"  {if $filter.period == '90'}selected{/if}>3 tháng qua</option>
          <option value="365" {if $filter.period == '365'}selected{/if}>1 năm qua</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-rotate"></i> Cập nhật</button>
      </div>
    </form>
  </div>
</div>

<!-- KPI Cards -->
<div class="stats-grid">
  <div class="stat-card stat-card--blue">
    <div class="stat-card__icon"><i class="fa-solid fa-hospital-user"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Tổng bệnh nhân</p>
      <h3 class="stat-card__value">{$report.total_patients|default:0}</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> {$report.patients_growth|default:0}% so với kỳ trước</p>
    </div>
  </div>
  <div class="stat-card stat-card--green">
    <div class="stat-card__icon"><i class="fa-solid fa-sack-dollar"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Tổng doanh thu</p>
      <h3 class="stat-card__value">{$report.total_revenue|default:"0đ"}</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> {$report.revenue_growth|default:0}% so với kỳ trước</p>
    </div>
  </div>
  <div class="stat-card stat-card--orange">
    <div class="stat-card__icon"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Tổng lịch hẹn</p>
      <h3 class="stat-card__value">{$report.total_appointments|default:0}</h3>
      <p class="stat-card__change">{$report.appointments_growth|default:0}% hoàn thành</p>
    </div>
  </div>
  <div class="stat-card stat-card--purple">
    <div class="stat-card__icon"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Đơn thuốc</p>
      <h3 class="stat-card__value">{$report.total_prescriptions|default:0}</h3>
      <p class="stat-card__change">{$report.avg_drugs_per_rx|default:0} thuốc/đơn TB</p>
    </div>
  </div>
</div>

<!-- Charts -->
<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-line"></i> Doanh thu theo thời gian</h3>
    </div>
    <div class="admin-card__body">
      <canvas id="revenueChart" height="260"></canvas>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-pie"></i> Lượt khám theo chuyên khoa</h3>
    </div>
    <div class="admin-card__body">
      <canvas id="specialtyChart" height="260"></canvas>
    </div>
  </div>
</div>

<div class="dashboard-grid">
  <!-- Top doctors -->
  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-trophy"></i> Bác sĩ có nhiều lượt khám nhất</h3>
    </div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Bác sĩ</th><th>Chuyên khoa</th><th>Lượt khám</th><th>Doanh thu</th></tr></thead>
        <tbody>
          {foreach from=$top_doctors item=doc}
          <tr>
            <td><strong>{$doc.full_name}</strong></td>
            <td>{$doc.specialty}</td>
            <td><span class="badge badge--blue">{$doc.visit_count}</span></td>
            <td class="text-success">{$doc.revenue}</td>
          </tr>
          {foreachelse}
          <tr><td colspan="4" class="table-empty">Chưa có dữ liệu</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>

  <!-- Top drugs -->
  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-pills"></i> Thuốc bán chạy nhất</h3>
    </div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Thuốc</th><th>Số lượng bán</th><th>Doanh thu</th></tr></thead>
        <tbody>
          {foreach from=$top_drugs item=drug}
          <tr>
            <td><strong>{$drug.name}</strong></td>
            <td><span class="badge badge--orange">{$drug.sold_qty}</span></td>
            <td class="text-success">{$drug.revenue}</td>
          </tr>
          {foreachelse}
          <tr><td colspan="3" class="table-empty">Chưa có dữ liệu</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
</div>

{include file="layout/footer.tpl"}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
const rLabels   = {$chart_labels|default:'["T2","T3","T4","T5","T6","T7","CN"]'};
const rData     = {$chart_revenues|default:'[12000000,18500000,15000000,22000000,19000000,25000000,17000000]'};
const spLabels  = {$specialty_labels|default:'["Tim mạch","Nhi","Da liễu","Nha","Thần kinh","Khác"]'};
const spData    = {$specialty_data|default:'[30,25,20,15,6,4]'};

new Chart(document.getElementById('revenueChart'), {
  type: 'bar',
  data: {
    labels: rLabels,
    datasets: [{
      label: 'Doanh thu',
      data: rData,
      backgroundColor: 'rgba(8,145,178,.75)',
      borderRadius: 6,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      y: { ticks: { callback: v => (v/1000000).toFixed(1)+'M' }, grid: { color:'#f1f5f9' } },
      x: { grid: { display: false } }
    }
  }
});

new Chart(document.getElementById('specialtyChart'), {
  type: 'doughnut',
  data: {
    labels: spLabels,
    datasets: [{ data: spData, backgroundColor: ['#0891b2','#10b981','#f59e0b','#ef4444','#8b5cf6','#94a3b8'], borderWidth: 0 }]
  },
  options: { responsive: true, plugins: { legend: { position:'bottom' } }, cutout: '65%' }
});

function exportExcel() { window.location.href = '{$base_url}/?role=admin&page=reports&action=export'; }
</script>

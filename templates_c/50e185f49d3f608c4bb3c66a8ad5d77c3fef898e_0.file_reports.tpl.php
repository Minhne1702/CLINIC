<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:53
  from 'file:admin/reports.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b45a2e226_78363323',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50e185f49d3f608c4bb3c66a8ad5d77c3fef898e' => 
    array (
      0 => 'admin/reports.tpl',
      1 => 1775438021,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d32b45a2e226_78363323 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Báo cáo & Thống kê",'active_page'=>"reports"), (int) 0, $_smarty_current_dir);
?>

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
    <form method="GET" action="/CLINIC/public/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="reports">
      <div class="filter-bar__group">
        <label style="font-size:13px;font-weight:500;color:var(--admin-text-secondary)">Từ ngày</label>
        <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        <label style="font-size:13px;font-weight:500;color:var(--admin-text-secondary)">Đến ngày</label>
        <input type="date" name="date_to" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        <select name="period">
          <option value="7"   <?php if ($_smarty_tpl->getValue('filter')['period'] == '7') {?>selected<?php }?>>7 ngày qua</option>
          <option value="30"  <?php if ($_smarty_tpl->getValue('filter')['period'] == '30') {?>selected<?php }?>>30 ngày qua</option>
          <option value="90"  <?php if ($_smarty_tpl->getValue('filter')['period'] == '90') {?>selected<?php }?>>3 tháng qua</option>
          <option value="365" <?php if ($_smarty_tpl->getValue('filter')['period'] == '365') {?>selected<?php }?>>1 năm qua</option>
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
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_patients'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> <?php echo (($tmp = $_smarty_tpl->getValue('report')['patients_growth'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
% so với kỳ trước</p>
    </div>
  </div>
  <div class="stat-card stat-card--green">
    <div class="stat-card__icon"><i class="fa-solid fa-sack-dollar"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Tổng doanh thu</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> <?php echo (($tmp = $_smarty_tpl->getValue('report')['revenue_growth'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
% so với kỳ trước</p>
    </div>
  </div>
  <div class="stat-card stat-card--orange">
    <div class="stat-card__icon"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Tổng lịch hẹn</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_appointments'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
      <p class="stat-card__change"><?php echo (($tmp = $_smarty_tpl->getValue('report')['appointments_growth'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
% hoàn thành</p>
    </div>
  </div>
  <div class="stat-card stat-card--purple">
    <div class="stat-card__icon"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Đơn thuốc</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_prescriptions'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
      <p class="stat-card__change"><?php echo (($tmp = $_smarty_tpl->getValue('report')['avg_drugs_per_rx'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 thuốc/đơn TB</p>
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
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('top_doctors'), 'doc');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><strong><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</strong></td>
            <td><?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</td>
            <td><span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('doc')['visit_count'];?>
</span></td>
            <td class="text-success"><?php echo $_smarty_tpl->getValue('doc')['revenue'];?>
</td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?>
          <tr><td colspan="4" class="table-empty">Chưa có dữ liệu</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('top_drugs'), 'drug');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
?>
          <tr>
            <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong></td>
            <td><span class="badge badge--orange"><?php echo $_smarty_tpl->getValue('drug')['sold_qty'];?>
</span></td>
            <td class="text-success"><?php echo $_smarty_tpl->getValue('drug')['revenue'];?>
</td>
          </tr>
          <?php
}
if ($foreach1DoElse) {
?>
          <tr><td colspan="3" class="table-empty">Chưa có dữ liệu</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
const rLabels   = <?php echo (($tmp = $_smarty_tpl->getValue('chart_labels') ?? null)===null||$tmp==='' ? '["T2","T3","T4","T5","T6","T7","CN"]' ?? null : $tmp);?>
;
const rData     = <?php echo (($tmp = $_smarty_tpl->getValue('chart_revenues') ?? null)===null||$tmp==='' ? '[12000000,18500000,15000000,22000000,19000000,25000000,17000000]' ?? null : $tmp);?>
;
const spLabels  = <?php echo (($tmp = $_smarty_tpl->getValue('specialty_labels') ?? null)===null||$tmp==='' ? '["Tim mạch","Nhi","Da liễu","Nha","Thần kinh","Khác"]' ?? null : $tmp);?>
;
const spData    = <?php echo (($tmp = $_smarty_tpl->getValue('specialty_data') ?? null)===null||$tmp==='' ? '[30,25,20,15,6,4]' ?? null : $tmp);?>
;

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

function exportExcel() { window.location.href = '/CLINIC/public/?role=admin&page=reports&action=export'; }
<?php echo '</script'; ?>
>
<?php }
}

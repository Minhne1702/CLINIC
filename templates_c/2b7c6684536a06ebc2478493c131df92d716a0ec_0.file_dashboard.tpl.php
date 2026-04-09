<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:53:53
  from 'file:admin/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7692168bfa6_45916231',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b7c6684536a06ebc2478493c131df92d716a0ec' => 
    array (
      0 => 'admin/dashboard.tpl',
      1 => 1775610517,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d7692168bfa6_45916231 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Dashboard",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<!-- STATS CARDS -->
<div class="stats-grid">
  <div class="stat-card stat-card--blue">
    <div class="stat-card__icon"><i class="fa-solid fa-hospital-user"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Bệnh nhân hôm nay</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_patients'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +12% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--green">
    <div class="stat-card__icon"><i class="fa-solid fa-calendar-check"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Lịch hẹn hôm nay</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_appointments'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +5% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--orange">
    <div class="stat-card__icon"><i class="fa-solid fa-sack-dollar"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Doanh thu hôm nay</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</h3>
      <p class="stat-card__change up"><i class="fa-solid fa-arrow-trend-up"></i> +8% so với hôm qua</p>
    </div>
  </div>
  <div class="stat-card stat-card--purple">
    <div class="stat-card__icon"><i class="fa-solid fa-user-doctor"></i></div>
    <div class="stat-card__body">
      <p class="stat-card__label">Bác sĩ đang trực</p>
      <h3 class="stat-card__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['doctors_on_duty'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</h3>
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
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=admin&page=appointments" class="btn-link">Xem tất cả</a>
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
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recent_appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><div class="table-user"><div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('apt')['patient_name'],1,'');?>
</div><?php echo $_smarty_tpl->getValue('apt')['patient_name'];?>
</div></td>
            <td><?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</td>
            <td><span class="badge badge--<?php echo $_smarty_tpl->getValue('apt')['status_class'];?>
"><?php echo $_smarty_tpl->getValue('apt')['status_label'];?>
</span></td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?>
          <tr><td colspan="5" class="table-empty">Chưa có lịch hẹn nào hôm nay</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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
          <span class="quick-stat__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['total_patients'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Tổng bác sĩ</span>
          <span class="quick-stat__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['total_doctors'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Lịch hẹn tháng này</span>
          <span class="quick-stat__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['month_appointments'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Doanh thu tháng này</span>
          <span class="quick-stat__value text-success"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['month_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Đơn thuốc hôm nay</span>
          <span class="quick-stat__value"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_prescriptions'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
        </div>
        <div class="quick-stat">
          <span class="quick-stat__label">Thuốc sắp hết</span>
          <span class="quick-stat__value text-danger"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['low_stock_drugs'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
        </div>
      </div>
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
const labels = <?php echo (($tmp = $_smarty_tpl->getValue('chart_labels') ?? null)===null||$tmp==='' ? '["T2","T3","T4","T5","T6","T7","CN"]' ?? null : $tmp);?>
;
const revenues = <?php echo (($tmp = $_smarty_tpl->getValue('chart_revenues') ?? null)===null||$tmp==='' ? '[12000000,18500000,15000000,22000000,19000000,25000000,17000000]' ?? null : $tmp);?>
;
const specialtyLabels = <?php echo (($tmp = $_smarty_tpl->getValue('specialty_labels') ?? null)===null||$tmp==='' ? '["Tim mạch","Nhi","Da liễu","Nha","Thần kinh","Khác"]' ?? null : $tmp);?>
;
const specialtyData = <?php echo (($tmp = $_smarty_tpl->getValue('specialty_data') ?? null)===null||$tmp==='' ? '[30,25,20,15,6,4]' ?? null : $tmp);?>
;

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
<?php echo '</script'; ?>
>
<?php }
}

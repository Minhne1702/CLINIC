{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome" style="background:linear-gradient(135deg,#065f46 0%,#10b981 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#a7f3d0">{$current_user_name|default:"Lễ tân"}</span> 🏥</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — <strong style="color:#fff">{$stats.today_checkins|default:0}</strong> bệnh nhân đã check-in</p>
  </div>
  <a href="{$base_url}/?role=receptionist&page=checkin" class="btn-admin-primary" style="background:#fff;color:#065f46">
    <i class="fa-solid fa-qrcode"></i> Check-in bệnh nhân
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-right-to-bracket"></i></div><div><p>Check-in hôm nay</p><strong>{$stats.today_checkins|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-calendar-check"></i></div><div><p>Lịch hẹn hôm nay</p><strong>{$stats.today_appointments|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-clock"></i></div><div><p>Đang chờ khám</p><strong>{$stats.waiting|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-user-plus"></i></div><div><p>BN mới hôm nay</p><strong>{$stats.new_patients|default:0}</strong></div></div>
</div>

<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-list-ol"></i> Hàng chờ hiện tại</h3><a href="{$base_url}/?role=receptionist&page=queue" class="btn-link">Xem đầy đủ</a></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>STT</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Ưu tiên</th><th>Check-in lúc</th><th>Trạng thái</th></tr></thead>
        <tbody>
          {foreach from=$queue item=q}
          <tr>
            <td><span class="code-tag">{$q.queue_no}</span></td>
            <td><div class="table-user"><div class="table-avatar">{$q.patient_name|truncate:1:""}</div><div><strong>{$q.patient_name}</strong><small>{$q.patient_code}</small></div></div></td>
            <td>{$q.doctor_name|default:'—'}</td>
            <td>{if $q.priority=='emergency'}<span class="badge badge--danger">Cấp cứu</span>{elseif $q.priority=='elderly'}<span class="badge badge--orange">NCT</span>{elseif $q.priority=='child'}<span class="badge badge--blue">Trẻ em</span>{else}<span class="badge badge--neutral">Thường</span>{/if}</td>
            <td>{$q.checkin_time|default:'—'}</td>
            <td>{if $q.status=='waiting'}<span class="badge badge--warning">Chờ khám</span>{elseif $q.status=='in_progress'}<span class="badge badge--blue">Đang khám</span>{elseif $q.status=='done'}<span class="badge badge--success">Xong</span>{/if}</td>
          </tr>
          {foreachelse}<tr><td colspan="6" class="table-empty">Hàng chờ trống</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-calendar-check"></i> Lịch hẹn sắp tới</h3><a href="{$base_url}/?role=receptionist&page=appointments" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      {foreach from=$upcoming_appointments item=apt}
      <div class="appt-item">
        <div class="appt-item__date"><strong>{$apt.time}</strong><span>{$apt.date|date_format:"%d/%m"}</span></div>
        <div class="appt-item__info"><strong>{$apt.patient_name}</strong><p>{$apt.doctor_name} · {$apt.specialty}</p></div>
        <span class="badge badge--{if $apt.status=='confirmed'}blue{else}warning{/if}">{if $apt.status=='confirmed'}Xác nhận{else}Chờ{/if}</span>
      </div>
      {foreachelse}<div class="empty-state" style="padding:2rem"><i class="fa-regular fa-calendar"></i><p>Không có lịch hẹn</p></div>
      {/foreach}
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

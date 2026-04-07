{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome" style="background:linear-gradient(135deg,#0e7490 0%,#0891b2 60%,#06b6d4 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#a5f3fc">BS. {$current_user_name|default:"Bác sĩ"}</span> 👨‍⚕️</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — Bạn có <strong style="color:#fff">{$stats.today_queue|default:0}</strong> bệnh nhân chờ khám</p>
  </div>
  <a href="/CLINIC/public/?role=doctor&page=examination" class="btn-admin-primary" style="background:#fff;color:#0e7490">
    <i class="fa-solid fa-stethoscope"></i> Bắt đầu khám
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-list-ol"></i></div><div><p>Hàng chờ hôm nay</p><strong>{$stats.today_queue|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div><div><p>Đã khám hôm nay</p><strong>{$stats.done_today|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-calendar-check"></i></div><div><p>Lịch hẹn hôm nay</p><strong>{$stats.appointments_today|default:0}</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div><div><p>Đơn thuốc đã kê</p><strong>{$stats.prescriptions_today|default:0}</strong></div></div>
</div>

<div class="dashboard-grid">

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-list-ol"></i> Hàng chờ khám hôm nay</h3>
      <a href="/CLINIC/public/?role=doctor&page=queue" class="btn-link">Xem đầy đủ</a>
    </div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>STT</th><th>Bệnh nhân</th><th>Triệu chứng</th><th>Ưu tiên</th><th>Giờ hẹn</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          {foreach from=$queue item=q}
          <tr>
            <td><span class="code-tag">{$q.queue_no}</span></td>
            <td><div class="table-user"><div class="table-avatar">{$q.patient_name|truncate:1:""}</div><div><strong>{$q.patient_name}</strong><small>{$q.patient_code}</small></div></div></td>
            <td><span style="font-size:13px">{$q.symptoms|truncate:40:'...'|default:'—'}</span></td>
            <td>
              {if $q.priority == 'emergency'}<span class="badge badge--danger"><i class="fa-solid fa-bolt"></i> Cấp cứu</span>
              {elseif $q.priority == 'elderly'}<span class="badge badge--orange">Người cao tuổi</span>
              {elseif $q.priority == 'child'}<span class="badge badge--blue">Trẻ em</span>
              {else}<span class="badge badge--neutral">Thường</span>{/if}
            </td>
            <td>{$q.time|default:'Walk-in'}</td>
            <td>
              {if $q.status == 'waiting'}<span class="badge badge--warning">Chờ khám</span>
              {elseif $q.status == 'in_progress'}<span class="badge badge--blue">Đang khám</span>
              {elseif $q.status == 'done'}<span class="badge badge--success">Đã khám</span>
              {else}<span class="badge badge--neutral">{$q.status}</span>{/if}
            </td>
            <td>
              <a href="/CLINIC/public/?role=doctor&page=examination&patient_id={$q.patient_id}&queue_id={$q._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-stethoscope"></i> Khám</a>
            </td>
          </tr>
          {foreachelse}
          <tr><td colspan="7" class="table-empty">Chưa có bệnh nhân trong hàng chờ</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-calendar-check"></i> Lịch hẹn hôm nay</h3></div>
    <div class="admin-card__body p-0">
      {foreach from=$today_appointments item=apt}
      <div class="appt-item">
        <div class="appt-item__date"><strong>{$apt.time}</strong><span>{$apt.date|date_format:"%d/%m"}</span></div>
        <div class="appt-item__info">
          <strong>{$apt.patient_name}</strong>
          <p>{$apt.specialty} · {if $apt.type=='online'}<i class="fa-solid fa-video"></i> Online{else}Trực tiếp{/if}</p>
        </div>
        <span class="badge badge--{if $apt.status=='confirmed'}blue{elseif $apt.status=='pending'}warning{else}neutral{/if}">
          {if $apt.status=='confirmed'}Xác nhận{elseif $apt.status=='pending'}Chờ{else}{$apt.status}{/if}
        </span>
      </div>
      {foreachelse}
      <div class="empty-state" style="padding:2rem"><i class="fa-regular fa-calendar"></i><p>Không có lịch hẹn hôm nay</p></div>
      {/foreach}
    </div>
  </div>

</div>

{include file="layout/footer.tpl"}

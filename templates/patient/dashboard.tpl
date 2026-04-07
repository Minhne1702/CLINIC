{include file="layout/sidebar.tpl" page_title="Tổng quan" active_page="dashboard"}

<div class="patient-welcome">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span class="text-accent-light">{$current_user_name|default:"Bạn"}</span> 👋</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — Chúc bạn sức khỏe!</p>
  </div>
  <a href="{$BASE_URL}/?page=book" class="patient-welcome__btn">
    <i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám mới
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-calendar-check"></i></div>
    <div><p>Lịch hẹn sắp tới</p><strong>{$stats.upcoming|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-clock-rotate-left"></i></div>
    <div><p>Tổng lần khám</p><strong>{$stats.total_visits|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-prescription"></i></div>
    <div><p>Đơn thuốc</p><strong>{$stats.prescriptions|default:0}</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-flask"></i></div>
    <div><p>Kết quả xét nghiệm</p><strong>{$stats.test_results|default:0}</strong></div>
  </div>
</div>

<div class="dashboard-grid">

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-calendar-check"></i> Lịch hẹn sắp tới</h3>
      <a href="{$BASE_URL}/?page=appointments" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0">
      {if $upcoming_appointments}
        {foreach from=$upcoming_appointments item=apt}
        <div class="appt-item">
          <div class="appt-item__date">
            <strong>{$apt.date|date_format:"%d"}</strong>
            <span>{$apt.date|date_format:"%m/%Y"}</span>
            <small>{$apt.time}</small>
          </div>
          <div class="appt-item__info">
            <strong>{$apt.doctor_name}</strong>
            <p><i class="fa-solid fa-stethoscope"></i> {$apt.specialty}</p>
            <p>
              {if $apt.type == 'online'}
                <span class="badge badge--blue" style="font-size:11px"><i class="fa-solid fa-video"></i> Online</span>
              {else}
                <span class="badge badge--neutral" style="font-size:11px"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
              {/if}
              &nbsp; Mã: <code style="font-size:11px;background:#f1f5f9;padding:1px 5px;border-radius:4px">{$apt.code|default:'—'}</code>
            </p>
          </div>
          <div class="appt-item__actions">
            <span class="badge badge--{if $apt.status == 'confirmed'}blue{elseif $apt.status == 'pending'}warning{else}neutral{/if}">
              {if $apt.status == 'confirmed'}Đã xác nhận
              {elseif $apt.status == 'pending'}Chờ xác nhận
              {else}{$apt.status}{/if}
            </span>
            {if $apt.status == 'confirmed' || $apt.status == 'pending'}
            <a href="{$BASE_URL}/?page=appointments&action=cancel&id={$apt._id}"
               class="action-btn action-btn--danger" title="Hủy lịch"
               onclick="return confirm('Bạn chắc chắn muốn hủy lịch này?')">
              <i class="fa-solid fa-ban"></i>
            </a>
            {/if}
          </div>
        </div>
        {/foreach}
      {else}
        <div class="empty-state" style="padding:2.5rem">
          <i class="fa-regular fa-calendar"></i>
          <h3>Chưa có lịch hẹn sắp tới</h3>
          <p>Đặt lịch để được khám bởi bác sĩ chuyên khoa</p>
          <a href="{$BASE_URL}/?page=book" class="btn-admin-primary" style="margin-top:1rem">
            <i class="fa-regular fa-calendar-plus"></i> Đặt lịch ngay
          </a>
        </div>
      {/if}
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-file-medical"></i> Lịch sử khám gần đây</h3>
      <a href="{$BASE_URL}/?page=records" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0">
      {if $recent_records}
        {foreach from=$recent_records item=rec}
        <div class="record-item">
          <div class="record-item__icon"><i class="fa-solid fa-notes-medical"></i></div>
          <div class="record-item__info">
            <strong>{$rec.diagnosis|default:'Khám tổng quát'|truncate:35:'...'}</strong>
            <p>BS. {$rec.doctor_name} &nbsp;·&nbsp; {$rec.date|date_format:"%d/%m/%Y"}</p>
          </div>
          <a href="{$BASE_URL}/?page=records&id={$rec._id}" class="action-btn" title="Xem chi tiết">
            <i class="fa-solid fa-eye"></i>
          </a>
        </div>
        {/foreach}
      {else}
        <div class="empty-state" style="padding:2rem">
          <i class="fa-solid fa-file-medical"></i>
          <p>Chưa có lịch sử khám bệnh</p>
        </div>
      {/if}
    </div>
  </div>

</div>

{if $notifications}
<div class="admin-card" style="margin-top:1rem">
  <div class="admin-card__header">
    <h3><i class="fa-regular fa-bell"></i> Thông báo mới</h3>
    <a href="{$BASE_URL}/?page=notifications" class="btn-link">Xem tất cả</a>
  </div>
  <div class="admin-card__body p-0">
    {foreach from=$notifications item=notif}
    <div class="notif-item {if !$notif.is_read}notif-item--unread{/if}">
      <div class="notif-item__icon notif-item__icon--{$notif.type|default:'info'}">
        {if $notif.type == 'appointment'}<i class="fa-solid fa-calendar-check"></i>
        {elseif $notif.type == 'reminder'}<i class="fa-solid fa-bell"></i>
        {elseif $notif.type == 'result'}<i class="fa-solid fa-flask"></i>
        {else}<i class="fa-solid fa-circle-info"></i>{/if}
      </div>
      <div class="notif-item__body">
        <p>{$notif.message}</p>
        <small>{$notif.created_at|date_format:"%H:%M %d/%m/%Y"}</small>
      </div>
    </div>
    {/foreach}
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

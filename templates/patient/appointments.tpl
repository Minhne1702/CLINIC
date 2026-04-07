{include file="layout/sidebar.tpl" page_title="Lịch hẹn của tôi" active_page="appointments"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Lịch hẹn của tôi</h2>
    <p class="page-subtitle">Quản lý tất cả lịch hẹn khám bệnh</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?page=book" class="btn-admin-primary">
      <i class="fa-regular fa-calendar-plus"></i> Đặt lịch mới
    </a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="status-tabs mb-1">
  {assign var="cur" value=$filter.status|default:''}
  <a href="{$BASE_URL}/?page=appointments" class="status-tab {if $cur == ''}active{/if}">
    Tất cả <span class="tab-count">{$count.all|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?page=appointments&status=pending" class="status-tab {if $cur == 'pending'}active{/if}">
    Chờ xác nhận <span class="tab-count tab-count--warning">{$count.pending|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?page=appointments&status=confirmed" class="status-tab {if $cur == 'confirmed'}active{/if}">
    Đã xác nhận <span class="tab-count tab-count--blue">{$count.confirmed|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?page=appointments&status=completed" class="status-tab {if $cur == 'completed'}active{/if}">
    Đã khám <span class="tab-count tab-count--success">{$count.completed|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?page=appointments&status=cancelled" class="status-tab {if $cur == 'cancelled'}active{/if}">
    Đã hủy <span class="tab-count tab-count--danger">{$count.cancelled|default:0}</span>
  </a>
</div>

<div class="appt-card-list">
  {foreach from=$appointments item=apt}
  <div class="appt-full-card">
    <div class="appt-full-card__left">
      <div class="appt-full-card__date">
        <strong>{$apt.date|date_format:"%d"}</strong>
        <span>{$apt.date|date_format:"%m/%Y"}</span>
        <small>{$apt.time}</small>
      </div>
    </div>

    <div class="appt-full-card__body">
      <div class="appt-full-card__row">
        <h4>BS. {$apt.doctor_name}</h4>
        <span class="badge badge--{if $apt.status == 'confirmed'}blue{elseif $apt.status == 'pending'}warning{elseif $apt.status == 'completed'}success{elseif $apt.status == 'cancelled'}danger{else}neutral{/if}">
          {if $apt.status == 'confirmed'}Đã xác nhận
          {elseif $apt.status == 'pending'}Chờ xác nhận
          {elseif $apt.status == 'completed'}Đã khám
          {elseif $apt.status == 'cancelled'}Đã hủy
          {else}{$apt.status}{/if}
        </span>
      </div>
      <p><i class="fa-solid fa-stethoscope"></i> {$apt.specialty}</p>
      <p>
        {if $apt.type == 'online'}
          <span class="badge badge--blue" style="font-size:12px"><i class="fa-solid fa-video"></i> Khám từ xa</span>
        {else}
          <span class="badge badge--neutral" style="font-size:12px"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
        {/if}
        &nbsp;·&nbsp; Mã: <code style="font-size:12px;background:#f1f5f9;padding:2px 6px;border-radius:4px">{$apt.code|default:'—'}</code>
      </p>
      {if $apt.symptoms}
      <p style="font-size:13px;color:var(--admin-text-secondary);margin-top:.4rem">
        <i class="fa-solid fa-notes-medical"></i> {$apt.symptoms|truncate:80:'...'}
      </p>
      {/if}
    </div>

    <div class="appt-full-card__actions">
      {if $apt.type == 'online' && ($apt.status == 'confirmed' || $apt.status == 'pending')}
      <a href="#" class="btn-admin-primary" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-video"></i> Vào phòng khám
      </a>
      {/if}
      {if $apt.status == 'confirmed' || $apt.status == 'pending'}
      <a href="{$BASE_URL}/?page=appointments&action=cancel&id={$apt._id}"
         class="btn-admin-secondary" style="font-size:13px;padding:.5rem 1rem"
         onclick="return confirm('Bạn chắc chắn muốn hủy lịch này?\nLưu ý: Chỉ hủy được trước 2 tiếng.')">
        <i class="fa-solid fa-ban"></i> Hủy lịch
      </a>
      {/if}
      {if $apt.status == 'completed'}
      <a href="{$BASE_URL}/?page=records&apt_id={$apt._id}"
         class="btn-admin-secondary" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-file-medical"></i> Xem hồ sơ
      </a>
      <a href="{$BASE_URL}/?page=book" class="btn-admin-ghost" style="font-size:13px;padding:.5rem 1rem">
        <i class="fa-solid fa-rotate-right"></i> Đặt lại
      </a>
      {/if}
    </div>
  </div>
  {foreachelse}
  <div class="empty-state" style="padding:3rem">
    <i class="fa-regular fa-calendar"></i>
    <h3>Không có lịch hẹn nào</h3>
    <p>Bạn chưa có lịch hẹn trong mục này.</p>
    <a href="{$BASE_URL}/?page=book" class="btn-admin-primary" style="margin-top:1rem">
      <i class="fa-regular fa-calendar-plus"></i> Đặt lịch ngay
    </a>
  </div>
  {/foreach}
</div>

{include file="layout/footer.tpl"}

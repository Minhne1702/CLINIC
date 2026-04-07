{include file="layout/sidebar.tpl" page_title="Thông báo" active_page="notifications"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-regular fa-bell"></i> Thông báo</h2>
    <p class="page-subtitle">Tất cả thông báo lịch hẹn và kết quả khám</p>
  </div>
  {if $unread_count > 0}
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?page=notifications&action=mark-all-read" class="btn-admin-secondary">
      <i class="fa-solid fa-check-double"></i> Đánh dấu tất cả đã đọc
    </a>
  </div>
  {/if}
</div>

{if $notifications}
<div class="admin-card">
  <div class="admin-card__body p-0">
    {foreach from=$notifications item=notif}
    <a href="{$notif.link|default:'#'}"
       class="notif-item notif-item--link {if !$notif.is_read}notif-item--unread{/if}"
       style="display:flex;text-decoration:none">
      <div class="notif-item__icon notif-item__icon--{$notif.type|default:'info'}">
        {if $notif.type == 'appointment'}<i class="fa-solid fa-calendar-check"></i>
        {elseif $notif.type == 'reminder'}<i class="fa-solid fa-bell"></i>
        {elseif $notif.type == 'result'}<i class="fa-solid fa-flask"></i>
        {elseif $notif.type == 'prescription'}<i class="fa-solid fa-prescription"></i>
        {elseif $notif.type == 'confirm'}<i class="fa-solid fa-circle-check"></i>
        {else}<i class="fa-solid fa-circle-info"></i>{/if}
      </div>
      <div class="notif-item__body" style="flex:1">
        <p style="color:var(--admin-text)">{$notif.message}</p>
        <small>{$notif.created_at|date_format:"%H:%M — %d/%m/%Y"}</small>
      </div>
      {if !$notif.is_read}
      <div style="width:8px;height:8px;background:var(--admin-primary);border-radius:50%;margin-top:6px;flex-shrink:0"></div>
      {/if}
    </a>
    {/foreach}
  </div>
</div>
{else}
<div class="empty-state admin-card" style="padding:3rem">
  <i class="fa-regular fa-bell"></i>
  <h3>Không có thông báo nào</h3>
  <p>Bạn sẽ nhận được thông báo khi có lịch hẹn mới, kết quả khám hoặc đơn thuốc.</p>
</div>
{/if}

{include file="layout/footer.tpl"}

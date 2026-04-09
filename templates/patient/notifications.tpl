{include file="layout/header.tpl" page_title="Thông báo" active_page="notifications"}

<div class="page-toolbar" style="margin-top: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <div class="page-toolbar__left">
    <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a;"><i class="fa-regular fa-bell" style="color: #0284c7;"></i> Thông báo</h2>
    <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b;">Tất cả thông báo lịch hẹn, kết quả khám và đơn thuốc</p>
  </div>
  
  {if isset($unread_count) && $unread_count > 0}
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?page=notifications&action=mark-all-read" class="btn-outline" style="padding: 0.6rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 0.5rem; background: #fff; transition: background 0.2s;">
      <i class="fa-solid fa-check-double"></i> Đánh dấu tất cả đã đọc
    </a>
  </div>
  {/if}
</div>

{if isset($notifications) && $notifications|@count > 0}
<div class="dashboard-card" style="overflow: hidden; padding: 0;">
  <div class="dashboard-card__body p-0">
    {foreach from=$notifications item=notif}
    <a href="{$notif.link|default:'#'}"
       class="notif-item {if !$notif.is_read}notif-item--unread{/if}"
       style="display: flex; padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; text-decoration: none; align-items: flex-start; gap: 1rem; transition: background-color 0.2s; {if !$notif.is_read}background-color: #f0f9ff;{else}background-color: #fff;{/if}">
      
      <div class="notif-item__icon" style="width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; {if !$notif.is_read}background: #bae6fd; color: #0369a1;{else}background: #f1f5f9; color: #64748b;{/if} font-size: 1.2rem;">
        {if $notif.type == 'appointment'}<i class="fa-solid fa-calendar-check"></i>
        {elseif $notif.type == 'reminder'}<i class="fa-solid fa-bell"></i>
        {elseif $notif.type == 'result'}<i class="fa-solid fa-flask"></i>
        {elseif $notif.type == 'prescription'}<i class="fa-solid fa-prescription-bottle-medical"></i>
        {elseif $notif.type == 'confirm'}<i class="fa-solid fa-circle-check"></i>
        {elseif $notif.type == 'billing'}<i class="fa-solid fa-file-invoice-dollar"></i>
        {else}<i class="fa-solid fa-circle-info"></i>{/if}
      </div>
      
      <div class="notif-item__body" style="flex: 1;">
        <p style="margin: 0 0 0.35rem 0; color: #1e293b; font-size: 0.95rem; line-height: 1.4; {if !$notif.is_read}font-weight: 600;{else}font-weight: 400;{/if}">
          {$notif.message}
        </p>
        <small style="color: #64748b; font-size: 0.85rem;">
          <i class="fa-regular fa-clock" style="margin-right: 3px;"></i> {$notif.created_at|date_format:"%H:%M — %d/%m/%Y"}
        </small>
      </div>
      
      {if !$notif.is_read}
      <div style="width: 10px; height: 10px; background: #0284c7; border-radius: 50%; margin-top: 6px; flex-shrink: 0; box-shadow: 0 0 0 2px #f0f9ff;"></div>
      {/if}
    </a>
    {/foreach}
  </div>
</div>
{else}
<div class="empty-state dashboard-card" style="padding: 4rem 2rem; text-align: center;">
  <i class="fa-regular fa-bell-slash" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
  <h3 style="color: #334155; font-size: 1.25rem;">Không có thông báo nào</h3>
  <p style="color: #64748b;">Bạn sẽ nhận được thông báo khi có lịch hẹn mới, có kết quả xét nghiệm hoặc đơn thuốc từ bác sĩ.</p>
</div>
{/if}

<style>
  .btn-outline:hover {
    background-color: #f8fafc !important;
    color: #334155 !important;
  }
  .notif-item:hover {
    background-color: #f8fafc !important;
  }
  .notif-item--unread:hover {
    background-color: #e0f2fe !important;
  }
</style>

{include file="layout/footer.tpl"}
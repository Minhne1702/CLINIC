{include file="layout/sidebar.tpl" page_title="Thông báo" active_page="notifications"}

<style>
  .notifications-wrapper {
    max-width: 1000px;
    margin: 2rem auto 4rem auto;
    padding: 0 1.5rem;
  }
  
  .page-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
  }
  
  .notif-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
  }

  .notif-item {
    display: flex;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
    align-items: flex-start;
    gap: 1.25rem;
    transition: background-color 0.2s, transform 0.2s;
    background-color: #fff;
  }
  .notif-item:last-child {
    border-bottom: none;
  }
  .notif-item:hover {
    background-color: #f8fafc;
  }
  .notif-item--unread {
    background-color: #f0f9ff;
  }
  .notif-item--unread:hover {
    background-color: #e0f2fe;
  }

  .notif-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.2rem;
    background: #f1f5f9;
    color: #64748b;
  }
  .notif-item--unread .notif-icon {
    background: #bae6fd;
    color: #0369a1;
  }

  .notif-body {
    flex: 1;
  }
  .notif-message {
    margin: 0 0 0.35rem 0;
    color: #1e293b;
    font-size: 1rem;
    line-height: 1.4;
    font-weight: 400;
  }
  .notif-item--unread .notif-message {
    font-weight: 600;
    color: #0f172a;
  }
  
  .notif-time {
    color: #64748b;
    font-size: 0.85rem;
  }

  .notif-dot {
    width: 10px;
    height: 10px;
    background: #0284c7;
    border-radius: 50%;
    margin-top: 8px;
    flex-shrink: 0;
    box-shadow: 0 0 0 3px #e0f2fe;
  }

  .btn-mark-read {
    padding: 0.6rem 1.2rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    text-decoration: none;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #fff;
    font-weight: 500;
    transition: all 0.2s;
  }
  .btn-mark-read:hover {
    background-color: #f1f5f9;
    color: #0f172a;
    border-color: #94a3b8;
  }

  .empty-state {
    padding: 5rem 2rem;
    text-align: center;
    background: #fff;
    border-radius: 16px;
    border: 1px dashed #cbd5e1;
  }
</style>

<div class="notifications-wrapper">
  
  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a; font-weight: 700;">
        <i class="fa-regular fa-bell" style="color: #0284c7; margin-right: 5px;"></i> Thông báo
      </h2>
      <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b; font-size: 0.95rem;">
        Cập nhật thông tin lịch hẹn, kết quả khám và đơn thuốc của bạn
      </p>
    </div>
    
    {if isset($unread_count) && $unread_count > 0}
    <div class="page-toolbar__right">
      <a href="{$BASE_URL}/?page=notifications&action=mark-all-read" class="btn-mark-read">
        <i class="fa-solid fa-check-double" style="color: #10b981;"></i> Đánh dấu tất cả đã đọc
      </a>
    </div>
    {/if}
  </div>

  {if isset($notifications) && $notifications|@count > 0}
  <div class="notif-card">
    {foreach from=$notifications item=notif}
    <a href="{$notif.link|default:'#'}" class="notif-item {if !$notif.is_read}notif-item--unread{/if}">
      
      <div class="notif-icon">
        {if $notif.type == 'appointment'}<i class="fa-solid fa-calendar-check"></i>
        {elseif $notif.type == 'reminder'}<i class="fa-solid fa-bell"></i>
        {elseif $notif.type == 'result'}<i class="fa-solid fa-flask"></i>
        {elseif $notif.type == 'prescription'}<i class="fa-solid fa-prescription-bottle-medical"></i>
        {elseif $notif.type == 'confirm'}<i class="fa-solid fa-circle-check"></i>
        {elseif $notif.type == 'billing'}<i class="fa-solid fa-file-invoice-dollar"></i>
        {else}<i class="fa-solid fa-circle-info"></i>{/if}
      </div>
      
      <div class="notif-body">
        <p class="notif-message">{$notif.message}</p>
        <small class="notif-time">
          <i class="fa-regular fa-clock" style="margin-right: 3px;"></i> {$notif.created_at|date_format:"%H:%M — %d/%m/%Y"}
        </small>
      </div>
      
      {if !$notif.is_read}
      <div class="notif-dot"></div>
      {/if}
      
    </a>
    {/foreach}
  </div>
  
  {else}
  <div class="empty-state">
    <i class="fa-regular fa-bell-slash" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1.5rem; display: block;"></i>
    <h3 style="color: #0f172a; font-size: 1.25rem; margin-bottom: 0.5rem;">Không có thông báo mới</h3>
    <p style="color: #64748b;">Bạn sẽ nhận được thông báo khi có lịch hẹn mới, có kết quả xét nghiệm hoặc đơn thuốc từ bác sĩ.</p>
  </div>
  {/if}

</div>

{include file="layout/footer.tpl"}
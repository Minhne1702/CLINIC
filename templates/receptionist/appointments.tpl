{include file="layout/sidebar.tpl" page_title="Quản lý lịch hẹn" active_page="appointments"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Quản lý lịch hẹn</h2>
    <p class="page-subtitle">Xác nhận, điều phối, và thay đổi lịch hẹn của bệnh nhân</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=receptionist&page=walk-in" class="btn-admin-primary">
      <i class="fa-solid fa-person-walking-arrow-right"></i> Đăng ký tại chỗ (Walk-in)
    </a>
  </div>
</div>

{if $success_message}
<div class="alert alert--success" style="margin-bottom: 1.5rem;">
  <i class="fa-solid fa-circle-check"></i> {$success_message}
</div>
{/if}

<div class="status-tabs mb-1" style="border-bottom: 2px solid #e2e8f0; gap: 2rem;">
  {assign var="cur" value=$filter.status|default:''}
  <a href="{$BASE_URL}/?role=receptionist&page=appointments" class="status-tab {if $cur==''}active{/if}" style="padding-bottom: 0.5rem;">
    Tất cả <span class="tab-count" style="background:#f1f5f9; color:#475569;">{$count.all|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?role=receptionist&page=appointments&status=pending" class="status-tab {if $cur=='pending'}active{/if}" style="padding-bottom: 0.5rem;">
    Chờ xác nhận <span class="tab-count tab-count--warning" style="background:#fef3c7; color:#d97706;">{$count.pending|default:0}</span>
  </a>
  <a href="{$BASE_URL}/?role=receptionist&page=appointments&status=confirmed" class="status-tab {if $cur=='confirmed'}active{/if}" style="padding-bottom: 0.5rem;">
    Đã xác nhận <span class="tab-count tab-count--blue" style="background:#dbeafe; color:#2563eb;">{$count.confirmed|default:0}</span>
  </a>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$BASE_URL}/" class="filter-bar" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
      <input type="hidden" name="role" value="receptionist">
      <input type="hidden" name="page" value="appointments">
      <input type="hidden" name="status" value="{$cur}">
      
      <div class="filter-input" style="flex: 2; min-width: 250px;">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" placeholder="Mã lịch, SĐT hoặc Tên bệnh nhân..." value="{$filter.q|default:''}" style="width: 100%;">
      </div>
      
      <div style="flex: 1; min-width: 150px;">
        <input type="date" name="date" class="form-control" value="{$filter.date|default:''}" title="Ngày hẹn">
      </div>
      
      <div style="flex: 1.5; min-width: 200px;">
        <select name="doctor_id" class="form-control">
          <option value="">-- Tất cả bác sĩ --</option>
          {foreach from=$doctors item=doc}
            <option value="{$doc._id}" {if $filter.doctor_id==$doc._id}selected{/if}>{$doc.full_name} ({$doc.specialty})</option>
          {/foreach}
        </select>
      </div>
      
      <button type="submit" class="btn-admin-secondary" style="height: 42px;">
        <i class="fa-solid fa-filter"></i> Lọc
      </button>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0" style="overflow-x: auto;">
    <table class="admin-table">
      <thead style="background: #f8fafc;">
        <tr>
          <th>Mã lịch</th>
          <th>Bệnh nhân</th>
          <th>Bác sĩ & Chuyên khoa</th>
          <th>Ngày giờ khám</th>
          <th>Nguồn</th>
          <th>Trạng thái</th>
          <th style="text-align: right;">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$appointments item=apt}
        <tr {if $apt.status=='pending'}style="background-color: #fffbeb;"{/if}>
          <td>
            <span class="code-tag" style="font-family: monospace; background:#e2e8f0; padding: 2px 6px; border-radius:4px;">{$apt.code}</span>
          </td>
          <td>
            <div class="table-user">
              <div class="table-avatar" style="background:#e0f2fe; color:#0284c7;">{$apt.patient_name|truncate:1:""}</div>
              <div>
                <strong>{$apt.patient_name}</strong>
                <small style="color:#64748b;">{$apt.patient_phone}</small>
              </div>
            </div>
          </td>
          <td>
            <span style="font-weight: 500;">{$apt.doctor_name}</span><br>
            <small class="text-muted"><i class="fa-solid fa-stethoscope" style="font-size:10px;"></i> {$apt.specialty}</small>
          </td>
          <td>
            <strong style="color: #0f172a;">{$apt.date|date_format:"%d/%m/%Y"}</strong><br>
            <span class="badge badge--neutral" style="background:#f1f5f9; color:#334155; font-size:11px; margin-top:4px;"><i class="fa-regular fa-clock"></i> {$apt.time}</span>
          </td>
          <td>
            {if $apt.type=='online'}
              <span class="badge badge--blue" style="background:#dbeafe; color:#1d4ed8;"><i class="fa-solid fa-globe"></i> App/Web</span>
            {else}
              <span class="badge badge--neutral" style="background:#f3f4f6; color:#4b5563;"><i class="fa-solid fa-phone"></i> Hotline</span>
            {/if}
          </td>
          <td>
            {if $apt.status=='pending'}
              <span class="badge badge--warning"><i class="fa-solid fa-hourglass-half"></i> Chờ xác nhận</span>
            {elseif $apt.status=='confirmed'}
              <span class="badge badge--success" style="background:#d1fae5; color:#065f46;"><i class="fa-solid fa-check-double"></i> Đã xác nhận</span>
            {elseif $apt.status=='completed'}
              <span class="badge badge--neutral"><i class="fa-solid fa-flag-checkered"></i> Hoàn thành</span>
            {elseif $apt.status=='cancelled'}
              <span class="badge badge--danger" style="background:#fee2e2; color:#991b1b;"><i class="fa-solid fa-xmark"></i> Đã hủy</span>
            {/if}
          </td>
          <td style="text-align: right;">
            <div class="table-actions" style="justify-content: flex-end;">
              
              {if $apt.status=='pending'}
              <a href="{$BASE_URL}/?role=receptionist&page=appointments&action=confirm&id={$apt._id}" class="action-btn action-btn--success" title="Xác nhận lịch hẹn">
                <i class="fa-solid fa-check"></i>
              </a>
              {/if}

              {if $apt.status=='confirmed'}
              <a href="{$BASE_URL}/?role=receptionist&page=checkin&q={$apt.code}" class="action-btn" title="Tiến hành Check-in" style="color: #0284c7; background: #e0f2fe;">
                <i class="fa-solid fa-right-to-bracket"></i>
              </a>
              {/if}

              {if $apt.status=='confirmed'}
              <a href="{$BASE_URL}/?role=receptionist&page=appointments&action=send_reminder&id={$apt._id}" class="action-btn" title="Gửi SMS nhắc lịch" onclick="return confirm('Gửi SMS nhắc lịch hẹn cho bệnh nhân này?')">
                <i class="fa-solid fa-comment-sms"></i>
              </a>
              {/if}

              {if $apt.status=='pending' || $apt.status=='confirmed'}
              <a href="{$BASE_URL}/?role=receptionist&page=appointments&action=reschedule&id={$apt._id}" class="action-btn" title="Đổi lịch">
                <i class="fa-solid fa-calendar-days"></i>
              </a>
              {/if}

              {if $apt.status != 'cancelled' && $apt.status != 'completed'}
              <a href="{$BASE_URL}/?role=receptionist&page=appointments&action=cancel&id={$apt._id}" class="action-btn action-btn--danger" title="Hủy lịch" onclick="return confirm('Bạn có chắc chắn muốn HỦY lịch hẹn này không?')">
                <i class="fa-solid fa-trash-can"></i>
              </a>
              {/if}

            </div>
          </td>
        </tr>
        {foreachelse}
        <tr>
          <td colspan="7" class="table-empty" style="padding: 3rem; text-align: center; color: #64748b;">
            <i class="fa-regular fa-calendar-xmark" style="font-size: 2.5rem; margin-bottom: 1rem; color: #cbd5e1;"></i>
            <p>Không có lịch hẹn nào khớp với điều kiện lọc.</p>
          </td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

{include file="layout/footer.tpl"}
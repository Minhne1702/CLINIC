{include file="layout/sidebar.tpl" page_title="Quản lý lịch hẹn" active_page="appointments"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-calendar-check"></i> Quản lý lịch hẹn</h2>
    <p class="page-subtitle">Theo dõi và quản lý tất cả lịch hẹn khám</p>
  </div>
  <div class="page-toolbar__right">
    <a href="/CLINIC/public/?role=admin&page=appointments&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Tạo lịch hẹn
    </a>
  </div>
</div>

<!-- Summary tabs -->
<div class="status-tabs mb-1">
  {assign var="cur_status" value=$filter.status|default:''}
  <a href="/CLINIC/public/?role=admin&page=appointments" class="status-tab {if $cur_status == ''}active{/if}">
    Tất cả <span class="tab-count">{$count.all|default:0}</span>
  </a>
  <a href="/CLINIC/public/?role=admin&page=appointments&status=pending" class="status-tab {if $cur_status == 'pending'}active{/if}">
    Chờ xác nhận <span class="tab-count tab-count--warning">{$count.pending|default:0}</span>
  </a>
  <a href="/CLINIC/public/?role=admin&page=appointments&status=confirmed" class="status-tab {if $cur_status == 'confirmed'}active{/if}">
    Đã xác nhận <span class="tab-count tab-count--blue">{$count.confirmed|default:0}</span>
  </a>
  <a href="/CLINIC/public/?role=admin&page=appointments&status=completed" class="status-tab {if $cur_status == 'completed'}active{/if}">
    Hoàn thành <span class="tab-count tab-count--success">{$count.completed|default:0}</span>
  </a>
  <a href="/CLINIC/public/?role=admin&page=appointments&status=cancelled" class="status-tab {if $cur_status == 'cancelled'}active{/if}">
    Đã hủy <span class="tab-count tab-count--danger">{$count.cancelled|default:0}</span>
  </a>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="/CLINIC/public/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="appointments">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bệnh nhân, mã lịch..." value="{$filter.q|default:''}">
        </div>
        <input type="date" name="date_from" value="{$filter.date_from|default:''}" title="Từ ngày">
        <input type="date" name="date_to"   value="{$filter.date_to|default:''}"   title="Đến ngày">
        <select name="doctor_id">
          <option value="">Tất cả bác sĩ</option>
          {foreach from=$doctors item=doc}
          <option value="{$doc._id}" {if $filter.doctor_id == $doc._id}selected{/if}>{$doc.full_name}</option>
          {/foreach}
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã lịch</th>
          <th>Bệnh nhân</th>
          <th>Bác sĩ</th>
          <th>Chuyên khoa</th>
          <th>Ngày giờ</th>
          <th>Hình thức</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$appointments item=apt}
        <tr>
          <td><span class="code-tag">{$apt.code}</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar">{$apt.patient_name|truncate:1:""}</div>
              <div>
                <strong>{$apt.patient_name}</strong>
                <small>{$apt.patient_phone}</small>
              </div>
            </div>
          </td>
          <td>{$apt.doctor_name}</td>
          <td>{$apt.specialty}</td>
          <td>
            <strong>{$apt.date|date_format:"%d/%m/%Y"}</strong>
            <small class="text-muted">{$apt.time}</small>
          </td>
          <td>
            {if $apt.type == 'online'}
              <span class="badge badge--blue"><i class="fa-solid fa-video"></i> Online</span>
            {else}
              <span class="badge badge--neutral"><i class="fa-solid fa-hospital"></i> Trực tiếp</span>
            {/if}
          </td>
          <td>
            {if $apt.status == 'pending'}   <span class="badge badge--warning">Chờ xác nhận</span>
            {elseif $apt.status == 'confirmed'} <span class="badge badge--blue">Đã xác nhận</span>
            {elseif $apt.status == 'completed'} <span class="badge badge--success">Hoàn thành</span>
            {elseif $apt.status == 'cancelled'} <span class="badge badge--danger">Đã hủy</span>
            {else}<span class="badge badge--neutral">{$apt.status}</span>{/if}
          </td>
          <td>
            <div class="table-actions">
              <a href="/CLINIC/public/?role=admin&page=appointments&action=view&id={$apt._id}" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
              {if $apt.status == 'pending'}
              <a href="/CLINIC/public/?role=admin&page=appointments&action=confirm&id={$apt._id}" class="action-btn action-btn--success" title="Xác nhận"><i class="fa-solid fa-check"></i></a>
              {/if}
              <a href="/CLINIC/public/?role=admin&page=appointments&action=cancel&id={$apt._id}" class="action-btn action-btn--danger" title="Hủy" onclick="return confirm('Hủy lịch hẹn này?')"><i class="fa-solid fa-ban"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="8" class="table-empty">Không có lịch hẹn nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

{include file="layout/footer.tpl"}

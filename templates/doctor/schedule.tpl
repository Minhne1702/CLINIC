{include file="layout/sidebar.tpl" page_title="Lịch làm việc" active_page="schedule"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-regular fa-calendar"></i> Lịch làm việc</h2>
    <p class="page-subtitle">Đăng ký và cập nhật lịch trực tuần này</p>
  </div>
</div>

{if $success_message}
  <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>
{/if}

<div class="admin-card">
  <div class="admin-card__header">
    <h3>Form đăng ký lịch</h3>
  </div>
  <div class="admin-card__body">
    
    <form action="?page=schedule" method="POST">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Thứ</th>
            <th>Ca Sáng (07:30 – 11:30)</th>
            <th>Ca Chiều (13:30 – 17:00)</th>
            <th>Ca Tối (17:30 – 20:30)</th>
            <th>Phòng khám</th>
            <th>Ghi chú</th>
          </tr>
        </thead>
        <tbody>
          {assign var="days" value=['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ nhật']}
          {foreach from=$days item=day key=idx}
          <tr>
            <td><strong>{$day}</strong></td>
            
            <td>
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="schedule[{$idx}][morning]" value="1" {if !empty($schedule[$idx].morning)}checked{/if}>
                <span class="badge {if !empty($schedule[$idx].morning)}badge--success{else}text-muted{/if}">Đăng ký Sáng</span>
              </label>
            </td>
            
            <td>
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="schedule[{$idx}][afternoon]" value="1" {if !empty($schedule[$idx].afternoon)}checked{/if}>
                <span class="badge {if !empty($schedule[$idx].afternoon)}badge--blue{else}text-muted{/if}">Đăng ký Chiều</span>
              </label>
            </td>

            <td>
              <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="schedule[{$idx}][evening]" value="1" {if !empty($schedule[$idx].evening)}checked{/if}>
                <span class="badge {if !empty($schedule[$idx].evening)}badge--warning{else}text-muted{/if}">Đăng ký Tối</span>
              </label>
            </td>
            
            <td>
              <input type="text" name="schedule[{$idx}][room]" class="form-control" style="max-width: 100px;" 
                     value="{if !empty($schedule[$idx].room)}{$schedule[$idx].room}{/if}" placeholder="VD: P.101">
            </td>
            
            <td>
              <input type="text" name="schedule[{$idx}][note]" class="form-control" style="max-width: 150px;" 
                     value="{if !empty($schedule[$idx].note)}{$schedule[$idx].note}{/if}" placeholder="Ghi chú...">
            </td>
          </tr>
          {/foreach}
        </tbody>
      </table>

      <div class="form-actions" style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; text-align: right;">
        <button type="submit" class="btn btn--primary" style="padding: 10px 20px; font-weight: bold;">
          <i class="fa-solid fa-floppy-disk"></i> Lưu lịch đăng ký
        </button>
      </div>
    </form>

  </div>
</div>

{include file="layout/footer.tpl"}
{include file="layout/sidebar.tpl" page_title="Lịch làm việc" active_page="schedule"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-regular fa-calendar"></i> Lịch làm việc</h2><p class="page-subtitle">Xem và đăng ký lịch trực</p></div>
</div>
{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
<div class="admin-card">
  <div class="admin-card__header"><h3>Lịch tuần này</h3></div>
  <div class="admin-card__body">
    <table class="admin-table">
      <thead><tr><th>Thứ</th><th>Buổi sáng</th><th>Buổi chiều</th><th>Phòng khám</th><th>Ghi chú</th></tr></thead>
      <tbody>
        {assign var="days" value=['Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7','Chủ nhật']}
        {foreach from=$days item=day key=idx}
        <tr>
          <td><strong>{$day}</strong></td>
          <td>
            {if $schedule[$idx].morning}
              <span class="badge badge--success">07:30 – 11:30</span>
            {else}
              <span class="text-muted">—</span>
            {/if}
          </td>
          <td>
            {if $schedule[$idx].afternoon}
              <span class="badge badge--blue">13:30 – 17:00</span>
            {else}
              <span class="text-muted">—</span>
            {/if}
          </td>
          <td>{$schedule[$idx].room|default:'—'}</td>
          <td><span class="text-muted" style="font-size:13px">{$schedule[$idx].note|default:'—'}</span></td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
{include file="layout/footer.tpl"}

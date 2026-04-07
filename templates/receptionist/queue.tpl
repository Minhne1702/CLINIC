{include file="layout/sidebar.tpl" page_title="Hàng chờ khám" active_page="queue"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-list-ol"></i> Hàng chờ khám</h2><p class="page-subtitle">Theo dõi và gọi số bệnh nhân real-time</p></div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="callNext()"><i class="fa-solid fa-bullhorn"></i> Gọi số tiếp theo</button>
  </div>
</div>
<div class="queue-board">
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--waiting"><i class="fa-solid fa-clock"></i> Chờ khám <span class="tab-count tab-count--warning">{$count.waiting|default:0}</span></div>
    <div class="queue-col__body">
      {foreach from=$queue item=q}
      {if $q.status == 'waiting'}
      <div class="queue-card queue-card--{$q.priority|default:'normal'}">
        <div class="queue-card__num">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p>{$q.doctor_name}</p>
          <p style="font-size:12px">{if $q.priority=='emergency'}<span class="badge badge--danger" style="font-size:11px">Cấp cứu</span>{elseif $q.priority=='elderly'}<span class="badge badge--orange" style="font-size:11px">NCT</span>{/if}</p>
        </div>
        <div class="queue-card__actions">
          <button onclick="callPatient('{$q.queue_no}','{$q.patient_name}')" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-bullhorn"></i> Gọi</button>
        </div>
      </div>
      {/if}
      {foreachelse}{/foreach}
    </div>
  </div>
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--progress"><i class="fa-solid fa-stethoscope"></i> Đang khám <span class="tab-count tab-count--blue">{$count.in_progress|default:0}</span></div>
    <div class="queue-col__body">
      {foreach from=$queue item=q}{if $q.status=='in_progress'}
      <div class="queue-card queue-card--active">
        <div class="queue-card__num" style="background:rgba(8,145,178,.15);color:var(--admin-primary)">{$q.queue_no}</div>
        <div class="queue-card__info"><strong>{$q.patient_name}</strong><p>{$q.doctor_name}</p></div>
      </div>
      {/if}{/foreach}
    </div>
  </div>
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--done"><i class="fa-solid fa-circle-check"></i> Đã khám <span class="tab-count tab-count--success">{$count.done|default:0}</span></div>
    <div class="queue-col__body">
      {foreach from=$queue item=q}{if $q.status=='done'}
      <div class="queue-card queue-card--done">
        <div class="queue-card__num" style="background:rgba(16,185,129,.1);color:var(--admin-success)">{$q.queue_no}</div>
        <div class="queue-card__info"><strong>{$q.patient_name}</strong><p style="font-size:12px">{$q.end_time}</p></div>
      </div>
      {/if}{/foreach}
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}
<script>
function callPatient(no, name) { alert('Mời bệnh nhân số ' + no + ' — ' + name + ' vào phòng khám'); }
function callNext() {
  const first = document.querySelector('.queue-card--normal, .queue-card--waiting');
  if (first) { const name = first.querySelector('strong')?.textContent; const no = first.querySelector('.queue-card__num')?.textContent; callPatient(no?.trim(), name?.trim()); }
  else alert('Không còn bệnh nhân trong hàng chờ');
}
</script>

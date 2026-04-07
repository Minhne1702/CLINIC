{include file="layout/sidebar.tpl" page_title="Hàng chờ khám" active_page="queue"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-list-ol"></i> Hàng chờ khám</h2>
    <p class="page-subtitle">Danh sách bệnh nhân chờ khám hôm nay — {$smarty.now|date_format:"%d/%m/%Y"}</p>
  </div>
  <div class="page-toolbar__right">
    <div class="filter-bar__group">
      <select class="select-sm" onchange="filterQueue(this.value)">
        <option value="all">Tất cả</option>
        <option value="waiting">Chờ khám</option>
        <option value="in_progress">Đang khám</option>
        <option value="done">Đã khám</option>
      </select>
    </div>
  </div>
</div>

<div class="queue-board">
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--waiting">
      <i class="fa-solid fa-clock"></i> Chờ khám
      <span class="tab-count tab-count--warning" id="cnt-waiting">{$count.waiting|default:0}</span>
    </div>
    <div class="queue-col__body" id="col-waiting">
      {foreach from=$queue item=q}
      {if $q.status == 'waiting'}
      <div class="queue-card queue-card--{$q.priority|default:'normal'}" data-status="waiting">
        <div class="queue-card__num">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p>{$q.patient_code} &nbsp;·&nbsp; {if $q.gender=='male'}Nam{else}Nữ{/if}, {$q.age|default:'?'} tuổi</p>
          <p style="font-size:12px;color:var(--admin-text-muted)">{$q.symptoms|truncate:50:'...'|default:'Không ghi triệu chứng'}</p>
          {if $q.priority == 'emergency'}<span class="badge badge--danger" style="font-size:11px"><i class="fa-solid fa-bolt"></i> Cấp cứu</span>
          {elseif $q.priority == 'elderly'}<span class="badge badge--orange" style="font-size:11px">NCT</span>
          {elseif $q.priority == 'child'}<span class="badge badge--blue" style="font-size:11px">Trẻ em</span>{/if}
        </div>
        <div class="queue-card__actions">
          <a href="{$base_url}/?role=doctor&page=examination&patient_id={$q.patient_id}&queue_id={$q._id}" class="btn-admin-primary" style="font-size:12px;padding:.4rem .85rem;white-space:nowrap">
            <i class="fa-solid fa-stethoscope"></i> Khám ngay
          </a>
        </div>
      </div>
      {/if}
      {foreachelse}
      {/foreach}
      {if $count.waiting == 0}
      <div class="empty-state" style="padding:2rem"><i class="fa-solid fa-couch"></i><p>Hàng chờ trống</p></div>
      {/if}
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--progress">
      <i class="fa-solid fa-stethoscope"></i> Đang khám
      <span class="tab-count tab-count--blue" id="cnt-progress">{$count.in_progress|default:0}</span>
    </div>
    <div class="queue-col__body" id="col-progress">
      {foreach from=$queue item=q}
      {if $q.status == 'in_progress'}
      <div class="queue-card queue-card--active" data-status="in_progress">
        <div class="queue-card__num" style="background:rgba(8,145,178,.15);color:var(--admin-primary)">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p>{$q.patient_code}</p>
          <p style="font-size:12px;color:var(--admin-primary)"><i class="fa-solid fa-clock"></i> Bắt đầu: {$q.start_time|default:'—'}</p>
        </div>
        <div class="queue-card__actions">
          <a href="{$base_url}/?role=doctor&page=examination&patient_id={$q.patient_id}&queue_id={$q._id}" class="btn-admin-secondary" style="font-size:12px;padding:.4rem .85rem">
            <i class="fa-solid fa-notes-medical"></i> Tiếp tục
          </a>
        </div>
      </div>
      {/if}
      {/foreach}
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--done">
      <i class="fa-solid fa-circle-check"></i> Đã khám
      <span class="tab-count tab-count--success" id="cnt-done">{$count.done|default:0}</span>
    </div>
    <div class="queue-col__body" id="col-done">
      {foreach from=$queue item=q}
      {if $q.status == 'done'}
      <div class="queue-card queue-card--done" data-status="done">
        <div class="queue-card__num" style="background:rgba(16,185,129,.1);color:var(--admin-success)">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p style="font-size:12px;color:var(--admin-text-muted)">{$q.patient_code} · Xong lúc {$q.end_time|default:'—'}</p>
        </div>
        <a href="{$base_url}/?role=doctor&page=records&patient_id={$q.patient_id}" class="action-btn" title="Xem hồ sơ"><i class="fa-solid fa-eye"></i></a>
      </div>
      {/if}
      {/foreach}
    </div>
  </div>
</div>

{include file="layout/footer.tpl"}

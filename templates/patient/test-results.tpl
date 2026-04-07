{include file="layout/sidebar.tpl" page_title="Kết quả xét nghiệm" active_page="test-results"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-flask"></i> Kết quả xét nghiệm</h2>
    <p class="page-subtitle">Tra cứu kết quả xét nghiệm và chẩn đoán hình ảnh</p>
  </div>
</div>

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$base_url}/" class="filter-bar">
    <input type="hidden" name="role" value="patient">
    <input type="hidden" name="page" value="test-results">
    <div class="filter-bar__group">
      <div class="filter-input">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" placeholder="Tên xét nghiệm, bác sĩ..." value="{$filter.q|default:''}">
      </div>
      <input type="date" name="date_from" value="{$filter.date_from|default:''}">
      <input type="date" name="date_to"   value="{$filter.date_to|default:''}">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>

{if $test_result}
{* Chi tiết kết quả *}
<a href="{$base_url}/?page=test-results" class="btn-admin-ghost" style="margin-bottom:1rem;display:inline-flex">
  <i class="fa-solid fa-arrow-left"></i> Quay lại
</a>
<div class="admin-card">
  <div class="admin-card__header">
    <h3><i class="fa-solid fa-flask"></i> {$test_result.name}</h3>
    <span class="text-muted" style="font-size:13px">{$test_result.date|date_format:"%d/%m/%Y"}</span>
  </div>
  <div class="admin-card__body">
    <div class="emr-header__grid" style="margin-bottom:1rem">
      <div><label class="section-eyebrow" style="font-size:11px">Bác sĩ chỉ định</label><p>BS. {$test_result.doctor_name}</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Ngày làm</label><p>{$test_result.date|date_format:"%d/%m/%Y"}</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Chẩn đoán</label><p>{$test_result.diagnosis|default:'—'}</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Trạng thái</label><span class="badge badge--success">Có kết quả</span></div>
    </div>
    {if $test_result.items}
    <table class="admin-table">
      <thead><tr><th>Tên chỉ số</th><th>Kết quả</th><th>Đơn vị</th><th>Chỉ số bình thường</th><th>Đánh giá</th></tr></thead>
      <tbody>
        {foreach from=$test_result.items item=item}
        <tr>
          <td>{$item.name}</td>
          <td><strong class="{if $item.status == 'normal'}text-success{elseif $item.status == 'high' || $item.status == 'low'}text-danger{/if}">{$item.value}</strong></td>
          <td class="text-muted">{$item.unit|default:'—'}</td>
          <td class="text-muted">{$item.normal_range|default:'—'}</td>
          <td>
            {if $item.status == 'normal'}<span class="badge badge--success">Bình thường</span>
            {elseif $item.status == 'high'}<span class="badge badge--danger">Cao</span>
            {elseif $item.status == 'low'}<span class="badge badge--warning">Thấp</span>
            {else}<span class="badge badge--neutral">—</span>{/if}
          </td>
        </tr>
        {/foreach}
      </tbody>
    </table>
    {/if}
    {if $test_result.files}
    <div style="margin-top:1rem;display:flex;gap:.5rem;flex-wrap:wrap">
      {foreach from=$test_result.files item=file}
      <a href="{$file.url}" target="_blank" class="btn-admin-secondary" style="font-size:13px">
        <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}"></i> {$file.name}
      </a>
      {/foreach}
    </div>
    {/if}
    {if $test_result.note}
    <div style="margin-top:1rem;padding:1rem;background:#f0f9ff;border-radius:8px;border-left:3px solid var(--admin-primary)">
      <strong style="font-size:13px">Nhận xét của bác sĩ:</strong>
      <p style="font-size:13px;margin-top:.3rem">{$test_result.note}</p>
    </div>
    {/if}
  </div>
</div>
{else}
{* Danh sách *}
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Ngày</th><th>Tên xét nghiệm</th><th>Bác sĩ chỉ định</th><th>Chẩn đoán</th><th>File đính kèm</th><th>Thao tác</th></tr></thead>
    <tbody>
      {foreach from=$test_results item=tr}
      <tr>
        <td>{$tr.date|date_format:"%d/%m/%Y"}</td>
        <td><strong>{$tr.name}</strong></td>
        <td>BS. {$tr.doctor_name}</td>
        <td>{$tr.diagnosis|default:'—'|truncate:35:'...'}</td>
        <td>
          {if $tr.file_count > 0}
            <span class="badge badge--blue">{$tr.file_count} file</span>
          {else}
            <span class="text-muted">—</span>
          {/if}
        </td>
        <td>
          <a href="{$base_url}/?page=test-results&id={$tr._id}" class="action-btn" title="Xem chi tiết">
            <i class="fa-solid fa-eye"></i>
          </a>
        </td>
      </tr>
      {foreachelse}
      <tr><td colspan="6" class="table-empty">Chưa có kết quả xét nghiệm nào</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{/if}

{include file="layout/footer.tpl"}

{include file="layout/sidebar.tpl" page_title="Hồ sơ bệnh án" active_page="records"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-folder-open"></i> Hồ sơ bệnh án</h2>
    <p class="page-subtitle">Lịch sử khám bệnh và kết quả điều trị</p>
  </div>
  {if !$record}
  <div class="page-toolbar__right">
    <div class="filter-input" style="min-width:240px">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchRecord" placeholder="Tìm chẩn đoán, bác sĩ...">
    </div>
  </div>
  {/if}
</div>

{if $record}
{* ========== CHI TIẾT HỒ SƠ ========== *}
<a href="{$base_url}/?page=records" class="btn-admin-ghost" style="margin-bottom:1rem;display:inline-flex">
  <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
</a>

<div class="emr-header admin-card" style="margin-bottom:1rem">
  <div class="admin-card__body">
    <div class="emr-header__grid">
      <div>
        <p class="section-eyebrow" style="font-size:11px">Ngày khám</p>
        <h3>{$record.date|date_format:"%d/%m/%Y"}</h3>
        <p class="text-muted" style="font-size:13px">{$record.time}</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Bác sĩ điều trị</p>
        <h3>BS. {$record.doctor_name}</h3>
        <p class="text-muted" style="font-size:13px">{$record.specialty}</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Mã lịch hẹn</p>
        <code style="font-size:14px;background:#f1f5f9;padding:4px 10px;border-radius:6px">{$record.apt_code|default:'—'}</code>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Trạng thái</p>
        <span class="badge badge--success">Đã khám</span>
      </div>
    </div>
  </div>
</div>

<div class="emr-grid">

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-notes-medical"></i> Chẩn đoán & Triệu chứng</h3></div>
    <div class="admin-card__body">
      <div class="emr-section">
        <label>Triệu chứng</label>
        <p>{$record.symptoms|default:'Không ghi nhận'}</p>
      </div>
      <div class="emr-section">
        <label>Sinh hiệu</label>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem;margin-top:.3rem">
          {if $record.blood_pressure}<div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Huyết áp</small><br><strong>{$record.blood_pressure}</strong></div>{/if}
          {if $record.pulse}<div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Mạch</small><br><strong>{$record.pulse} lần/phút</strong></div>{/if}
          {if $record.temperature}<div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Nhiệt độ</small><br><strong>{$record.temperature}°C</strong></div>{/if}
        </div>
      </div>
      <div class="emr-section">
        <label>Chẩn đoán</label>
        <p>
          {if $record.icd_code}<span class="code-tag code-tag--blue" style="margin-right:.5rem">{$record.icd_code}</span>{/if}
          <strong>{$record.diagnosis|default:'—'}</strong>
        </p>
      </div>
      {if $record.doctor_note}
      <div class="emr-section">
        <label>Lời dặn của bác sĩ</label>
        <p style="background:#f0f9ff;padding:.75rem;border-radius:8px;border-left:3px solid var(--admin-primary)">{$record.doctor_note}</p>
      </div>
      {/if}
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-prescription"></i> Đơn thuốc</h3>
      {if $record.prescription._id}
      <a href="{$base_url}/?page=prescriptions&id={$record.prescription._id}" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem">
        <i class="fa-solid fa-print"></i> In đơn
      </a>
      {/if}
    </div>
    <div class="admin-card__body p-0">
      {if $record.prescription.drugs}
      <table class="admin-table">
        <thead><tr><th>Tên thuốc</th><th>Hàm lượng</th><th>Số lượng</th><th>Liều dùng</th><th>Số ngày</th><th>Cách dùng</th></tr></thead>
        <tbody>
          {foreach from=$record.prescription.drugs item=drug}
          <tr>
            <td><strong>{$drug.name}</strong><br><small class="text-muted">{$drug.active_ingredient|default:''}</small></td>
            <td>{$drug.concentration|default:'—'}</td>
            <td><strong>{$drug.qty} {$drug.unit}</strong></td>
            <td>{$drug.dosage}</td>
            <td>{$drug.days} ngày</td>
            <td style="font-size:13px">{$drug.instruction}</td>
          </tr>
          {foreachelse}
          <tr><td colspan="6" class="table-empty">Không có đơn thuốc</td></tr>
          {/foreach}
        </tbody>
      </table>
      {if $record.prescription.prescription_note}
      <div style="padding:.75rem 1.25rem;background:#f8fafc;border-top:1px solid var(--admin-border);font-size:13px">
        <strong>Lời dặn:</strong> {$record.prescription.prescription_note}
      </div>
      {/if}
      {else}
      <div class="table-empty">Không có đơn thuốc</div>
      {/if}
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-flask"></i> Kết quả xét nghiệm</h3></div>
    <div class="admin-card__body p-0">
      {if $record.lab_results}
      <table class="admin-table">
        <thead><tr><th>Tên xét nghiệm</th><th>Kết quả</th><th>Chỉ số bình thường</th><th>Đánh giá</th></tr></thead>
        <tbody>
          {foreach from=$record.lab_results item=lab}
          <tr>
            <td>{$lab.name}</td>
            <td><strong>{$lab.value} {$lab.unit}</strong></td>
            <td class="text-muted">{$lab.normal_range|default:'—'}</td>
            <td>
              {if $lab.status == 'normal'}<span class="badge badge--success">Bình thường</span>
              {elseif $lab.status == 'high'}<span class="badge badge--danger">Cao</span>
              {elseif $lab.status == 'low'}<span class="badge badge--warning">Thấp</span>
              {else}<span class="badge badge--neutral">—</span>{/if}
            </td>
          </tr>
          {foreachelse}
          <tr><td colspan="4" class="table-empty">Không có kết quả xét nghiệm</td></tr>
          {/foreach}
        </tbody>
      </table>
      {if $record.lab_files}
      <div style="padding:.75rem 1.25rem;border-top:1px solid var(--admin-border);display:flex;gap:.5rem;flex-wrap:wrap">
        {foreach from=$record.lab_files item=file}
        <a href="{$file.url}" target="_blank" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem">
          <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}"></i> {$file.name}
        </a>
        {/foreach}
      </div>
      {/if}
      {else}
      <div class="table-empty">Không có kết quả xét nghiệm</div>
      {/if}
    </div>
  </div>

  {if $record.images}
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-file-image"></i> Hình ảnh (X-quang, CT, siêu âm...)</h3></div>
    <div class="admin-card__body">
      <div class="image-grid">
        {foreach from=$record.images item=img}
        <a href="{$img.url}" target="_blank" class="image-thumb">
          <img src="{$img.url}" alt="{$img.name}" loading="lazy">
          <span>{$img.name}</span>
        </a>
        {/foreach}
      </div>
    </div>
  </div>
  {/if}

</div>

{else}
{* ========== DANH SÁCH HỒ SƠ ========== *}
<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table" id="recordsTable">
      <thead>
        <tr>
          <th>Ngày khám</th>
          <th>Bác sĩ điều trị</th>
          <th>Chuyên khoa</th>
          <th>Chẩn đoán</th>
          <th>Đơn thuốc</th>
          <th>Xét nghiệm</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$records item=rec}
        <tr>
          <td>
            <strong>{$rec.date|date_format:"%d/%m/%Y"}</strong>
            <br><small class="text-muted">{$rec.time}</small>
          </td>
          <td>BS. {$rec.doctor_name}</td>
          <td>{$rec.specialty}</td>
          <td>
            {if $rec.icd_code}
            <span class="code-tag code-tag--blue" style="font-size:11px">{$rec.icd_code}</span>
            {/if}
            <span style="font-size:13px">{$rec.diagnosis|default:'—'|truncate:40:'...'}</span>
          </td>
          <td>
            {if $rec.has_prescription}
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có đơn</span>
            {else}
              <span class="badge badge--neutral">Không</span>
            {/if}
          </td>
          <td>
            {if $rec.lab_count > 0}
              <span class="badge badge--blue">{$rec.lab_count} XN</span>
            {/if}
            {if $rec.image_count > 0}
              <span class="badge badge--purple">{$rec.image_count} ảnh</span>
            {/if}
            {if !$rec.lab_count && !$rec.image_count}
              <span class="text-muted">—</span>
            {/if}
          </td>
          <td>
            <div class="table-actions">
              <a href="{$base_url}/?page=records&id={$rec._id}" class="action-btn" title="Xem chi tiết">
                <i class="fa-solid fa-eye"></i>
              </a>
              {if $rec.has_prescription}
              <a href="{$base_url}/?page=prescriptions&record_id={$rec._id}" class="action-btn" title="Xem đơn thuốc">
                <i class="fa-solid fa-prescription"></i>
              </a>
              {/if}
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="7" class="table-empty">Chưa có lịch sử khám bệnh nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

<script>
const searchInput = document.getElementById('searchRecord');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#recordsTable tbody tr').forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  });
}
</script>

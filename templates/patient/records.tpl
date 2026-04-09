{include file="layout/header.tpl" page_title="Hồ sơ bệnh án" active_page="records"}

<div class="page-toolbar" style="margin-top: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <div class="page-toolbar__left">
    <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a;"><i class="fa-solid fa-folder-open" style="color: #0284c7;"></i> Hồ sơ bệnh án (EMR)</h2>
    <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b;">Tra cứu lịch sử khám bệnh và chi tiết kết quả điều trị</p>
  </div>
  
  {if !isset($record) || !$record}
  <div class="page-toolbar__right">
    <div class="filter-input" style="min-width:260px; position: relative;">
      <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
      <input type="text" id="searchRecord" placeholder="Tìm tên bác sĩ, chẩn đoán..." style="width: 100%; padding: 0.6rem 1rem 0.6rem 2.5rem; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; transition: border-color 0.2s;">
    </div>
  </div>
  {/if}
</div>

{if isset($record) && $record}
{* ========== CHẾ ĐỘ XEM CHI TIẾT 1 HỒ SƠ ========== *}

<a href="{$BASE_URL}/?page=records" class="btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #475569; background: #fff; margin-bottom: 1.5rem;">
  <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
</a>

<div class="dashboard-card emr-header" style="margin-bottom: 1.5rem; background: linear-gradient(to right, #f0f9ff, #e0f2fe); border-color: #bae6fd;">
  <div class="dashboard-card__body">
    <div class="emr-header__grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
      <div>
        <p class="section-eyebrow" style="font-size:12px; color: #64748b; margin:0 0 4px 0; text-transform:uppercase; font-weight:600;">Ngày khám</p>
        <h3 style="margin:0; font-size: 1.1rem; color: #0f172a;">{$record.date|date_format:"%d/%m/%Y"}</h3>
        <p class="text-muted" style="font-size:13px; margin:2px 0 0 0; color: #475569;">{$record.time}</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:12px; color: #64748b; margin:0 0 4px 0; text-transform:uppercase; font-weight:600;">Bác sĩ điều trị</p>
        <h3 style="margin:0; font-size: 1.1rem; color: #0f172a;">BS. {$record.doctor_name}</h3>
        <p class="text-muted" style="font-size:13px; margin:2px 0 0 0; color: #475569;">{$record.specialty}</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:12px; color: #64748b; margin:0 0 4px 0; text-transform:uppercase; font-weight:600;">Mã lịch hẹn</p>
        <code style="font-size:14px; background:#fff; border: 1px solid #bae6fd; padding:4px 10px; border-radius:6px; color:#0369a1; display: inline-block;">{$record.apt_code|default:'—'}</code>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:12px; color: #64748b; margin:0 0 4px 0; text-transform:uppercase; font-weight:600;">Trạng thái</p>
        <span class="badge badge--success" style="padding: 4px 8px;"><i class="fa-solid fa-check"></i> Đã hoàn tất</span>
      </div>
    </div>
  </div>
</div>

<div class="emr-grid" style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">

  <div class="dashboard-card">
    <div class="dashboard-card__header">
      <h3 style="font-size: 1.1rem; margin: 0; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-notes-medical" style="color: #0284c7;"></i> Chẩn đoán & Lâm sàng</h3>
    </div>
    <div class="dashboard-card__body">
      
      <div class="emr-section" style="margin-bottom: 1.5rem;">
        <label style="font-weight: 600; color: #334155; display: block; margin-bottom: 0.5rem;">Triệu chứng ban đầu</label>
        <p style="margin: 0; color: #475569; line-height: 1.5;">{$record.symptoms|default:'Không ghi nhận'}</p>
      </div>
      
      <div class="emr-section" style="margin-bottom: 1.5rem;">
        <label style="font-weight: 600; color: #334155; display: block; margin-bottom: 0.5rem;">Sinh hiệu (Vitals)</label>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 1rem;">
          {if isset($record.blood_pressure) && $record.blood_pressure}
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; text-align: center;">
            <small style="color: #64748b; display: block; margin-bottom: 4px;">Huyết áp</small>
            <strong style="color: #0f172a; font-size: 1.1rem;">{$record.blood_pressure}</strong>
          </div>
          {/if}
          {if isset($record.pulse) && $record.pulse}
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; text-align: center;">
            <small style="color: #64748b; display: block; margin-bottom: 4px;">Mạch</small>
            <strong style="color: #0f172a; font-size: 1.1rem;">{$record.pulse} <span style="font-size: 0.85rem; font-weight: normal; color: #64748b;">l/p</span></strong>
          </div>
          {/if}
          {if isset($record.temperature) && $record.temperature}
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.75rem; text-align: center;">
            <small style="color: #64748b; display: block; margin-bottom: 4px;">Nhiệt độ</small>
            <strong style="color: #0f172a; font-size: 1.1rem;">{$record.temperature}°C</strong>
          </div>
          {/if}
        </div>
      </div>
      
      <div class="emr-section" style="margin-bottom: 1.5rem; background: #f1f5f9; padding: 1rem; border-radius: 8px;">
        <label style="font-weight: 600; color: #0f172a; display: block; margin-bottom: 0.5rem;">Kết luận Chẩn đoán</label>
        <p style="margin: 0; color: #0f172a; font-size: 1.05rem;">
          {if isset($record.icd_code) && $record.icd_code}
            <span class="badge badge--blue" style="margin-right: 0.5rem;">{$record.icd_code}</span>
          {/if}
          <strong>{$record.diagnosis|default:'—'}</strong>
        </p>
      </div>
      
      {if isset($record.doctor_note) && $record.doctor_note}
      <div class="emr-section">
        <label style="font-weight: 600; color: #0369a1; display: block; margin-bottom: 0.5rem;"><i class="fa-solid fa-user-doctor"></i> Lời dặn của bác sĩ</label>
        <p style="margin: 0; background: #e0f2fe; color: #0c4a6e; padding: 1rem; border-radius: 8px; border-left: 4px solid #0284c7; line-height: 1.5;">{$record.doctor_note}</p>
      </div>
      {/if}
    </div>
  </div>
  <div class="dashboard-card">
    <div class="dashboard-card__header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
      <h3 style="font-size: 1.1rem; margin: 0; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-prescription-bottle-medical" style="color: #10b981;"></i> Đơn thuốc</h3>
      {if isset($record.prescription.id) || isset($record.prescription._id)}
      <a href="{$BASE_URL}/?page=prescriptions&id={$record.prescription.id|default:$record.prescription._id}" class="btn-outline" style="font-size: 13px; padding: 0.4rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fa-solid fa-print"></i> Xem & In đơn
      </a>
      {/if}
    </div>
    <div class="dashboard-card__body p-0">
      {if isset($record.prescription.drugs) && $record.prescription.drugs|@count > 0}
      <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
          <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
            <tr>
              <th style="padding: 1rem; color: #475569;">Tên thuốc</th>
              <th style="padding: 1rem; color: #475569;">Hàm lượng</th>
              <th style="padding: 1rem; color: #475569; text-align: center;">Số lượng</th>
              <th style="padding: 1rem; color: #475569;">Cách dùng</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$record.prescription.drugs item=drug}
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 1rem;">
                <strong style="color: #0f172a; display: block;">{$drug.name}</strong>
                <small style="color: #64748b;">{$drug.active_ingredient|default:''}</small>
              </td>
              <td style="padding: 1rem; color: #334155;">{$drug.concentration|default:'—'}</td>
              <td style="padding: 1rem; text-align: center;"><strong style="color: #0284c7;">{$drug.qty} {$drug.unit}</strong></td>
              <td style="padding: 1rem; color: #475569;">
                <div style="margin-bottom: 4px;">{$drug.dosage} (x {$drug.days} ngày)</div>
                <em style="font-size: 13px;">{$drug.instruction}</em>
              </td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
      {if isset($record.prescription.prescription_note) && $record.prescription.prescription_note}
      <div style="padding: 1rem 1.25rem; background: #fffbeb; border-top: 1px solid #e2e8f0; font-size: 13px; color: #b45309;">
        <strong style="color: #92400e;">Ghi chú đơn thuốc:</strong> {$record.prescription.prescription_note}
      </div>
      {/if}
      {else}
      <div style="padding: 2rem; text-align: center; color: #94a3b8; font-style: italic;">Không có đơn thuốc cho lần khám này</div>
      {/if}
    </div>
  </div>

  <div class="dashboard-card">
    <div class="dashboard-card__header">
      <h3 style="font-size: 1.1rem; margin: 0; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-flask" style="color: #8b5cf6;"></i> Kết quả Xét nghiệm / Cận lâm sàng</h3>
    </div>
    <div class="dashboard-card__body p-0">
      {if isset($record.lab_results) && $record.lab_results|@count > 0}
      <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
          <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
            <tr>
              <th style="padding: 1rem; color: #475569;">Tên xét nghiệm</th>
              <th style="padding: 1rem; color: #475569;">Kết quả</th>
              <th style="padding: 1rem; color: #475569;">Chỉ số bình thường</th>
              <th style="padding: 1rem; color: #475569;">Đánh giá</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$record.lab_results item=lab}
            <tr style="border-bottom: 1px solid #f1f5f9;">
              <td style="padding: 1rem; color: #1e293b; font-weight: 500;">{$lab.name}</td>
              <td style="padding: 1rem;"><strong style="color: #0f172a; font-size: 15px;">{$lab.value} {$lab.unit}</strong></td>
              <td style="padding: 1rem; color: #64748b;">{$lab.normal_range|default:'—'}</td>
              <td style="padding: 1rem;">
                {if $lab.status == 'normal'}<span class="badge badge--success">Bình thường</span>
                {elseif $lab.status == 'high'}<span class="badge badge--danger">Cao <i class="fa-solid fa-arrow-up"></i></span>
                {elseif $lab.status == 'low'}<span class="badge badge--warning">Thấp <i class="fa-solid fa-arrow-down"></i></span>
                {else}<span class="badge badge--neutral">—</span>{/if}
              </td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
      {if isset($record.lab_files) && $record.lab_files|@count > 0}
      <div style="padding: 1rem 1.25rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem; flex-wrap: wrap; background: #f8fafc;">
        <span style="font-size: 13px; color: #64748b; margin-top: 5px;">File đính kèm:</span>
        {foreach from=$record.lab_files item=file}
        <a href="{$file.url}" target="_blank" class="btn-outline" style="font-size: 13px; padding: 0.4rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #0284c7; background: #fff; display: inline-flex; align-items: center; gap: 5px;">
          <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}"></i> {$file.name}
        </a>
        {/foreach}
      </div>
      {/if}
      {else}
      <div style="padding: 2rem; text-align: center; color: #94a3b8; font-style: italic;">Không có chỉ định xét nghiệm</div>
      {/if}
    </div>
  </div>

  {if isset($record.images) && $record.images|@count > 0}
  <div class="dashboard-card">
    <div class="dashboard-card__header">
      <h3 style="font-size: 1.1rem; margin: 0; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-file-image" style="color: #f59e0b;"></i> Hình ảnh (X-quang, CT, Siêu âm...)</h3>
    </div>
    <div class="dashboard-card__body">
      <div class="image-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
        {foreach from=$record.images item=img}
        <a href="{$img.url}" target="_blank" class="image-thumb" style="display: block; text-decoration: none; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; transition: transform 0.2s;">
          <div style="width: 100%; aspect-ratio: 1; background: #f1f5f9; display: flex; align-items: center; justify-content: center; overflow: hidden;">
            <img src="{$img.url}" alt="{$img.name}" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div style="padding: 0.5rem; text-align: center; font-size: 12px; color: #475569; background: #f8fafc; border-top: 1px solid #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {$img.name}
          </div>
        </a>
        {/foreach}
      </div>
    </div>
  </div>
  {/if}

</div>

{else}
{* ========== CHẾ ĐỘ XEM DANH SÁCH (TỔNG HỢP) ========== *}
<div class="dashboard-card">
  <div class="dashboard-card__body p-0">
    <div style="overflow-x: auto;">
      <table id="recordsTable" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th style="padding: 1rem; color: #475569; white-space: nowrap;">Ngày khám</th>
            <th style="padding: 1rem; color: #475569;">Bác sĩ điều trị</th>
            <th style="padding: 1rem; color: #475569;">Chuyên khoa</th>
            <th style="padding: 1rem; color: #475569;">Chẩn đoán</th>
            <th style="padding: 1rem; color: #475569; text-align: center;">Đơn thuốc</th>
            <th style="padding: 1rem; color: #475569; text-align: center;">CLS / Xét nghiệm</th>
            <th style="padding: 1rem; color: #475569; text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          {if isset($records) && $records|@count > 0}
            {foreach from=$records item=rec}
            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
              <td style="padding: 1rem; white-space: nowrap;">
                <strong style="color: #0f172a;">{$rec.date|date_format:"%d/%m/%Y"}</strong>
                <br><small style="color: #64748b;">{$rec.time}</small>
              </td>
              <td style="padding: 1rem; font-weight: 500; color: #1e293b;">BS. {$rec.doctor_name}</td>
              <td style="padding: 1rem; color: #475569;">{$rec.specialty}</td>
              <td style="padding: 1rem;">
                {if isset($rec.icd_code) && $rec.icd_code}
                <span class="badge badge--blue" style="font-size:11px; margin-right: 4px;">{$rec.icd_code}</span>
                {/if}
                <span style="color: #334155; line-height: 1.4; display: inline-block;">{$rec.diagnosis|default:'—'|truncate:50:'...'}</span>
              </td>
              <td style="padding: 1rem; text-align: center;">
                {if isset($rec.has_prescription) && $rec.has_prescription}
                  <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có đơn</span>
                {else}
                  <span class="badge badge--neutral" style="background: #f1f5f9; color: #94a3b8;">Không</span>
                {/if}
              </td>
              <td style="padding: 1rem; text-align: center; white-space: nowrap;">
                {if isset($rec.lab_count) && $rec.lab_count > 0}
                  <span class="badge badge--blue">{$rec.lab_count} XN</span>
                {/if}
                {if isset($rec.image_count) && $rec.image_count > 0}
                  <span class="badge badge--warning" style="margin-left: 4px;">{$rec.image_count} Ảnh</span>
                {/if}
                {if (!isset($rec.lab_count) || $rec.lab_count == 0) && (!isset($rec.image_count) || $rec.image_count == 0)}
                  <span style="color: #94a3b8;">—</span>
                {/if}
              </td>
              <td style="padding: 1rem; text-align: center;">
                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                  <a href="{$BASE_URL}/?page=records&id={$rec.id|default:$rec._id}" title="Xem chi tiết bệnh án" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e0f2fe; color: #0284c7; text-decoration: none; transition: background 0.2s;">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  {if isset($rec.has_prescription) && $rec.has_prescription}
                  <a href="{$BASE_URL}/?page=prescriptions&record_id={$rec.id|default:$rec._id}" title="Xem đơn thuốc" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #dcfce7; color: #16a34a; text-decoration: none; transition: background 0.2s;">
                    <i class="fa-solid fa-prescription"></i>
                  </a>
                  {/if}
                </div>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr>
              <td colspan="7" style="padding: 4rem 2rem; text-align: center;">
                <i class="fa-solid fa-folder-open" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                <p style="color: #64748b; margin: 0; font-size: 1rem;">Chưa có lịch sử khám bệnh nào được ghi nhận.</p>
              </td>
            </tr>
          {/if}
        </tbody>
      </table>
    </div>
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

<script>
{literal}
// Script xử lý ô Tìm kiếm nhanh trong danh sách EMR
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchRecord');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const query = this.value.toLowerCase().trim();
      const rows = document.querySelectorAll('#recordsTable tbody tr');
      
      rows.forEach(row => {
        // Bỏ qua dòng "Chưa có lịch sử" nếu danh sách trống
        if(row.cells.length === 1) return; 
        
        const rowText = row.textContent.toLowerCase();
        if (rowText.includes(query)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }
});
{/literal}
</script>
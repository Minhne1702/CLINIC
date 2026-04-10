{include file="layout/sidebar.tpl" page_title="Hồ sơ bệnh án" active_page="records"}

<style>
  /* --- BỐ CỤC CHUNG --- */
  .records-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }
  
  .page-toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
  .page-title { margin: 0; font-size: 1.8rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 10px; }
  .page-subtitle { margin: 0.5rem 0 0 0; color: #64748b; font-size: 0.95rem; }

  /* --- Ô TÌM KIẾM --- */
  .search-wrapper { position: relative; min-width: 280px; flex: 1; max-width: 350px; }
  .search-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
  .search-wrapper input { width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 0.95rem; transition: all 0.2s; color: #334155; }
  .search-wrapper input:focus { border-color: #0284c7; box-shadow: 0 0 0 3px #e0f2fe; }

  /* --- CARDS & UI ELEMENTS --- */
  .dashboard-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; }
  .dashboard-card__header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
  .dashboard-card__header h3 { font-size: 1.15rem; margin: 0; display: flex; align-items: center; gap: 8px; color: #0f172a; }
  .dashboard-card__body { padding: 1.5rem; }
  .dashboard-card__body.p-0 { padding: 0; }

  /* --- BADGES (Nhãn trạng thái) --- */
  .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
  .badge--success { background: #dcfce7; color: #15803d; }
  .badge--blue { background: #e0f2fe; color: #0284c7; }
  .badge--warning { background: #fef3c7; color: #d97706; }
  .badge--danger { background: #fee2e2; color: #b91c1c; }
  .badge--neutral { background: #f1f5f9; color: #64748b; }

  /* --- NÚT BẤM --- */
  .btn-outline { padding: 0.6rem 1.2rem; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 0.5rem; background: #fff; font-weight: 600; transition: all 0.2s; }
  .btn-outline:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
  .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; text-decoration: none; transition: all 0.2s; }
  .action-btn--view { background: #e0f2fe; color: #0284c7; }
  .action-btn--view:hover { background: #0284c7; color: #fff; transform: translateY(-2px); }
  .action-btn--rx { background: #dcfce7; color: #16a34a; }
  .action-btn--rx:hover { background: #16a34a; color: #fff; transform: translateY(-2px); }

  /* --- BẢNG DỮ LIỆU --- */
  .table-wrapper { overflow-x: auto; }
  .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
  .data-table th { padding: 1.25rem 1rem; color: #475569; font-weight: 600; background: #f8fafc; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
  .data-table td { padding: 1.25rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
  .data-table tr { transition: background 0.2s; }
  .data-table tr:hover { background: #f8fafc; }

  /* --- LƯỚI HÌNH ẢNH CẬN LÂM SÀNG --- */
  .image-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 1.25rem; }
  .image-thumb { display: block; text-decoration: none; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; transition: all 0.2s; background: #fff; }
  .image-thumb:hover { border-color: #bae6fd; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.1); transform: translateY(-3px); }
  .image-thumb__img { width: 100%; aspect-ratio: 1; background: #f1f5f9; display: flex; align-items: center; justify-content: center; overflow: hidden; }
  .image-thumb__img img { width: 100%; height: 100%; object-fit: cover; }
  .image-thumb__title { padding: 0.75rem; text-align: center; font-size: 0.85rem; font-weight: 500; color: #475569; background: #f8fafc; border-top: 1px solid #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

  /* --- XEM CHI TIẾT EMR --- */
  .emr-header-card { background: linear-gradient(to right, #f0f9ff, #e0f2fe); border-color: #bae6fd; }
  .emr-header-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem; }
  .emr-header-item .eyebrow { font-size: 0.8rem; color: #64748b; margin: 0 0 4px 0; text-transform: uppercase; font-weight: 600; }
  .emr-header-item h3 { margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 600; }
  .emr-header-item p { margin: 4px 0 0 0; font-size: 0.9rem; color: #475569; }
  
  .vital-signs { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem; margin-top: 0.5rem; }
  .vital-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1rem; text-align: center; }
  .vital-card small { color: #64748b; display: block; margin-bottom: 6px; font-weight: 500; }
  .vital-card strong { color: #0f172a; font-size: 1.25rem; font-weight: 700; }
</style>

<div class="records-wrapper">
  
  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-solid fa-folder-open" style="color: #0284c7;"></i> Hồ sơ bệnh án (EMR)</h2>
      <p class="page-subtitle">Tra cứu lịch sử khám bệnh và chi tiết kết quả điều trị</p>
    </div>
    
    {if !isset($record) || !$record}
    <div class="page-toolbar__right">
      <div class="search-wrapper">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="searchRecord" placeholder="Tìm tên bác sĩ, chẩn đoán...">
      </div>
    </div>
    {/if}
  </div>

  {if isset($record) && $record}
  {* ==========================================================
     CHẾ ĐỘ XEM CHI TIẾT 1 HỒ SƠ
     ========================================================== *}

  <a href="{$BASE_URL}/?page=records" class="btn-outline" style="margin-bottom: 1.5rem;">
    <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
  </a>

  <div class="dashboard-card emr-header-card">
    <div class="dashboard-card__body">
      <div class="emr-header-grid">
        <div class="emr-header-item">
          <p class="eyebrow">Ngày khám</p>
          <h3>{$record.date|date_format:"%d/%m/%Y"}</h3>
          <p>{$record.time}</p>
        </div>
        <div class="emr-header-item">
          <p class="eyebrow">Bác sĩ điều trị</p>
          <h3>BS. {$record.doctor_name}</h3>
          <p>{$record.specialty}</p>
        </div>
        <div class="emr-header-item">
          <p class="eyebrow">Mã lịch hẹn</p>
          <code style="font-size: 0.95rem; background: #fff; border: 1px solid #bae6fd; padding: 4px 10px; border-radius: 6px; color: #0369a1; display: inline-block; font-weight: 600;">{$record.apt_code|default:'—'}</code>
        </div>
        <div class="emr-header-item">
          <p class="eyebrow">Trạng thái</p>
          <span class="badge badge--success" style="margin-top: 4px;"><i class="fa-solid fa-check-circle"></i> Đã hoàn tất</span>
        </div>
      </div>
    </div>
  </div>

  <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">

    <div class="dashboard-card">
      <div class="dashboard-card__header">
        <h3><i class="fa-solid fa-notes-medical" style="color: #0284c7;"></i> Chẩn đoán & Lâm sàng</h3>
      </div>
      <div class="dashboard-card__body">
        
        <div style="margin-bottom: 1.5rem;">
          <label style="font-weight: 600; color: #334155; display: block; margin-bottom: 0.5rem;">Triệu chứng ban đầu</label>
          <p style="margin: 0; color: #475569; line-height: 1.5; font-size: 0.95rem;">{$record.symptoms|default:'Không ghi nhận'}</p>
        </div>
        
        <div style="margin-bottom: 1.5rem;">
          <label style="font-weight: 600; color: #334155; display: block; margin-bottom: 0.5rem;">Sinh hiệu (Vitals)</label>
          <div class="vital-signs">
            {if isset($record.blood_pressure) && $record.blood_pressure}
            <div class="vital-card">
              <small>Huyết áp</small>
              <strong>{$record.blood_pressure}</strong>
            </div>
            {/if}
            {if isset($record.pulse) && $record.pulse}
            <div class="vital-card">
              <small>Mạch</small>
              <strong>{$record.pulse} <span style="font-size: 0.85rem; font-weight: 500; color: #64748b;">l/p</span></strong>
            </div>
            {/if}
            {if isset($record.temperature) && $record.temperature}
            <div class="vital-card">
              <small>Nhiệt độ</small>
              <strong>{$record.temperature}°C</strong>
            </div>
            {/if}
          </div>
        </div>
        
        <div style="margin-bottom: 1.5rem; background: #f1f5f9; padding: 1.25rem; border-radius: 12px;">
          <label style="font-weight: 600; color: #0f172a; display: block; margin-bottom: 0.5rem;">Kết luận Chẩn đoán</label>
          <p style="margin: 0; color: #0f172a; font-size: 1.05rem;">
            {if isset($record.icd_code) && $record.icd_code}
              <span class="badge badge--blue" style="margin-right: 0.5rem; font-size: 0.9rem;">{$record.icd_code}</span>
            {/if}
            <strong>{$record.diagnosis|default:'—'}</strong>
          </p>
        </div>
        
        {if isset($record.doctor_note) && $record.doctor_note}
        <div>
          <label style="font-weight: 600; color: #0369a1; display: flex; align-items: center; gap: 6px; margin-bottom: 0.5rem;">
            <i class="fa-solid fa-user-doctor"></i> Lời dặn của bác sĩ
          </label>
          <p style="margin: 0; background: #e0f2fe; color: #0c4a6e; padding: 1rem 1.25rem; border-radius: 8px; border-left: 4px solid #0284c7; line-height: 1.5;">
            {$record.doctor_note}
          </p>
        </div>
        {/if}
      </div>
    </div>

    <div class="dashboard-card">
      <div class="dashboard-card__header">
        <h3><i class="fa-solid fa-prescription-bottle-medical" style="color: #10b981;"></i> Đơn thuốc</h3>
        {if isset($record.prescription.id) || isset($record.prescription._id)}
        <a href="{$BASE_URL}/?page=prescriptions&id={$record.prescription.id|default:$record.prescription._id}" class="btn-outline" style="padding: 0.4rem 0.85rem; font-size: 0.9rem;">
          <i class="fa-solid fa-print"></i> Xem & In đơn
        </a>
        {/if}
      </div>
      <div class="dashboard-card__body p-0">
        {if isset($record.prescription.drugs) && $record.prescription.drugs|@count > 0}
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th style="padding-left: 1.5rem;">Tên thuốc</th>
                <th>Hàm lượng</th>
                <th style="text-align: center;">Số lượng</th>
                <th style="padding-right: 1.5rem;">Cách dùng</th>
              </tr>
            </thead>
            <tbody>
              {foreach from=$record.prescription.drugs item=drug}
              <tr>
                <td style="padding-left: 1.5rem;">
                  <strong style="color: #0f172a; display: block; font-size: 1rem; margin-bottom: 4px;">{$drug.name}</strong>
                  <small style="color: #64748b;">{$drug.active_ingredient|default:''}</small>
                </td>
                <td style="color: #334155;">{$drug.concentration|default:'—'}</td>
                <td style="text-align: center;"><strong style="color: #0284c7; font-size: 1.05rem;">{$drug.qty} {$drug.unit}</strong></td>
                <td style="color: #475569; padding-right: 1.5rem;">
                  <div style="margin-bottom: 4px; font-weight: 500;">{$drug.dosage} (x {$drug.days} ngày)</div>
                  <em style="font-size: 0.85rem;">{$drug.instruction}</em>
                </td>
              </tr>
              {/foreach}
            </tbody>
          </table>
        </div>
        {if isset($record.prescription.prescription_note) && $record.prescription.prescription_note}
        <div style="padding: 1rem 1.5rem; background: #fffbeb; border-top: 1px solid #e2e8f0; font-size: 0.9rem; color: #b45309;">
          <strong style="color: #92400e;"><i class="fa-solid fa-circle-exclamation" style="margin-right: 4px;"></i> Ghi chú đơn thuốc:</strong> {$record.prescription.prescription_note}
        </div>
        {/if}
        {else}
        <div style="padding: 2.5rem; text-align: center; color: #94a3b8; font-style: italic;">
          Không có đơn thuốc cho lần khám này
        </div>
        {/if}
      </div>
    </div>

    <div class="dashboard-card">
      <div class="dashboard-card__header">
        <h3><i class="fa-solid fa-flask" style="color: #8b5cf6;"></i> Kết quả Xét nghiệm / Cận lâm sàng</h3>
      </div>
      <div class="dashboard-card__body p-0">
        {if isset($record.lab_results) && $record.lab_results|@count > 0}
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th style="padding-left: 1.5rem;">Tên xét nghiệm</th>
                <th>Kết quả</th>
                <th>Chỉ số bình thường</th>
                <th style="padding-right: 1.5rem;">Đánh giá</th>
              </tr>
            </thead>
            <tbody>
              {foreach from=$record.lab_results item=lab}
              <tr>
                <td style="padding-left: 1.5rem; color: #1e293b; font-weight: 500;">{$lab.name}</td>
                <td><strong style="color: #0f172a; font-size: 1rem;">{$lab.value} {$lab.unit}</strong></td>
                <td style="color: #64748b;">{$lab.normal_range|default:'—'}</td>
                <td style="padding-right: 1.5rem;">
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
        <div style="padding: 1.25rem 1.5rem; border-top: 1px solid #e2e8f0; display: flex; gap: 0.75rem; flex-wrap: wrap; background: #f8fafc; align-items: center;">
          <span style="font-size: 0.9rem; color: #64748b; font-weight: 500;">File đính kèm:</span>
          {foreach from=$record.lab_files item=file}
          <a href="{$file.url}" target="_blank" class="btn-outline" style="font-size: 0.85rem; padding: 0.4rem 0.85rem;">
            <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}" style="color: #ef4444;"></i> {$file.name}
          </a>
          {/foreach}
        </div>
        {/if}
        {else}
        <div style="padding: 2.5rem; text-align: center; color: #94a3b8; font-style: italic;">
          Không có chỉ định xét nghiệm
        </div>
        {/if}
      </div>
    </div>

    {if isset($record.images) && $record.images|@count > 0}
    <div class="dashboard-card">
      <div class="dashboard-card__header">
        <h3><i class="fa-solid fa-file-image" style="color: #f59e0b;"></i> Hình ảnh Cận lâm sàng (X-quang, CT, Siêu âm...)</h3>
      </div>
      <div class="dashboard-card__body">
        <div class="image-grid">
          {foreach from=$record.images item=img}
          <a href="{$img.url}" target="_blank" class="image-thumb">
            <div class="image-thumb__img">
              <img src="{$img.url}" alt="{$img.name}" loading="lazy">
            </div>
            <div class="image-thumb__title" title="{$img.name}">
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
  {* ==========================================================
     CHẾ ĐỘ XEM DANH SÁCH (TỔNG HỢP)
     ========================================================== *}
  <div class="dashboard-card">
    <div class="dashboard-card__body p-0">
      <div class="table-wrapper">
        <table id="recordsTable" class="data-table">
          <thead>
            <tr>
              <th style="padding-left: 1.5rem;">Ngày khám</th>
              <th>Bác sĩ điều trị</th>
              <th>Chuyên khoa</th>
              <th>Chẩn đoán</th>
              <th style="text-align: center;">Đơn thuốc</th>
              <th style="text-align: center;">CLS / Xét nghiệm</th>
              <th style="text-align: center; padding-right: 1.5rem;">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            {if isset($records) && $records|@count > 0}
              {foreach from=$records item=rec}
              <tr>
                <td style="padding-left: 1.5rem; white-space: nowrap;">
                  <strong style="color: #0f172a; font-size: 1rem;">{$rec.date|date_format:"%d/%m/%Y"}</strong>
                  <br><small style="color: #64748b;">{$rec.time}</small>
                </td>
                <td style="font-weight: 600; color: #1e293b;">BS. {$rec.doctor_name}</td>
                <td style="color: #475569;">{$rec.specialty}</td>
                <td>
                  {if isset($rec.icd_code) && $rec.icd_code}
                  <span class="badge badge--blue" style="font-size:0.75rem; margin-right: 4px;">{$rec.icd_code}</span>
                  {/if}
                  <span style="color: #334155; line-height: 1.4; display: inline-block;">{$rec.diagnosis|default:'—'|truncate:45:'...'}</span>
                </td>
                <td style="text-align: center;">
                  {if isset($rec.has_prescription) && $rec.has_prescription}
                    <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có đơn</span>
                  {else}
                    <span class="badge badge--neutral">Không</span>
                  {/if}
                </td>
                <td style="text-align: center; white-space: nowrap;">
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
                <td style="text-align: center; padding-right: 1.5rem;">
                  <div style="display: flex; gap: 0.5rem; justify-content: center;">
                    <a href="{$BASE_URL}/?page=records&id={$rec.id|default:$rec._id}" class="action-btn action-btn--view" title="Xem chi tiết bệnh án">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    {if isset($rec.has_prescription) && $rec.has_prescription}
                    <a href="{$BASE_URL}/?page=prescriptions&record_id={$rec.id|default:$rec._id}" class="action-btn action-btn--rx" title="Xem đơn thuốc">
                      <i class="fa-solid fa-prescription"></i>
                    </a>
                    {/if}
                  </div>
                </td>
              </tr>
              {/foreach}
            {else}
              <tr>
                <td colspan="7" style="padding: 5rem 2rem; text-align: center;">
                  <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1.5rem; display: block;"></i>
                  <h3 style="color: #0f172a; margin: 0 0 0.5rem 0; font-size: 1.25rem;">Danh sách trống</h3>
                  <p style="color: #64748b; margin: 0; font-size: 1rem;">Chưa có lịch sử khám bệnh nào được ghi nhận cho tài khoản này.</p>
                </td>
              </tr>
            {/if}
          </tbody>
        </table>
      </div>
    </div>
  </div>
  {/if}

</div>

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
        // Bỏ qua dòng "Danh sách trống" nếu bảng không có dữ liệu
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
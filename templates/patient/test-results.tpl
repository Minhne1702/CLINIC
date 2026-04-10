{include file="layout/sidebar.tpl" page_title="Kết quả xét nghiệm" active_page="test-results"}

<style>
  /* --- BỐ CỤC CHUNG --- */
  .test-results-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }
  
  .page-toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
  .page-title { margin: 0; font-size: 1.8rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 10px; }
  .page-subtitle { margin: 0.5rem 0 0 0; color: #64748b; font-size: 0.95rem; }

  /* --- THẺ (CARDS) --- */
  .dashboard-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; }
  .dashboard-card__header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
  .dashboard-card__header h3 { font-size: 1.2rem; margin: 0; color: #0f172a; font-weight: 600; display: flex; align-items: center; gap: 8px; }
  .dashboard-card__body { padding: 1.5rem; }
  .dashboard-card__body.p-0 { padding: 0; }

  /* --- BỘ LỌC (FILTER) --- */
  .filter-form { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
  .filter-input { position: relative; flex: 1; min-width: 250px; }
  .filter-input i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
  .filter-input input { width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 0.95rem; transition: all 0.2s; color: #334155; }
  .filter-input input:focus { border-color: #0284c7; box-shadow: 0 0 0 3px #e0f2fe; }
  .date-filter { display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap; }
  .date-filter input { padding: 0.7rem; border: 1px solid #cbd5e1; border-radius: 8px; color: #475569; outline: none; font-family: inherit; transition: all 0.2s; }
  .date-filter input:focus { border-color: #0284c7; }

  /* --- NÚT BẤM --- */
  .btn-primary { padding: 0.75rem 1.5rem; border-radius: 8px; background: #0284c7; color: #fff; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2); }
  .btn-primary:hover { background: #0369a1; transform: translateY(-2px); }
  .btn-outline { padding: 0.6rem 1.2rem; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 0.5rem; background: #fff; font-weight: 600; transition: all 0.2s; }
  .btn-outline:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
  .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; text-decoration: none; transition: all 0.2s; background: #e0f2fe; color: #0284c7; }
  .action-btn:hover { background: #0284c7; color: #fff; transform: translateY(-2px); }

  /* --- BẢNG DỮ LIỆU --- */
  .table-wrapper { overflow-x: auto; }
  .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
  .data-table th { padding: 1.25rem 1rem; color: #475569; font-weight: 600; background: #f8fafc; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
  .data-table td { padding: 1.25rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
  .data-table tr { transition: background 0.2s; }
  .data-table tr:hover { background: #f8fafc; }

  /* --- BADGES (Nhãn) --- */
  .badge { padding: 5px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; white-space: nowrap; }
  .badge--success { background: #dcfce7; color: #15803d; }
  .badge--blue { background: #e0f2fe; color: #0284c7; }
  .badge--warning { background: #fef3c7; color: #d97706; }
  .badge--danger { background: #fee2e2; color: #b91c1c; }
  .badge--neutral { background: #f1f5f9; color: #64748b; }

  /* --- CHI TIẾT KẾT QUẢ --- */
  .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; }
  .info-item label { font-size: 0.8rem; color: #64748b; text-transform: uppercase; font-weight: 600; display: block; margin-bottom: 4px; }
  .info-item p { margin: 0; color: #0f172a; font-weight: 500; font-size: 1.05rem; line-height: 1.4; }
  
  .val-high { color: #dc2626; font-weight: 700; font-size: 1rem; }
  .val-low { color: #d97706; font-weight: 700; font-size: 1rem; }
  .val-normal { color: #16a34a; font-weight: 600; font-size: 1rem; }
</style>

<div class="test-results-wrapper">

  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-solid fa-flask" style="color: #0284c7;"></i> Kết quả xét nghiệm</h2>
      <p class="page-subtitle">Tra cứu kết quả xét nghiệm sinh hóa và chẩn đoán hình ảnh (CLS)</p>
    </div>
  </div>

  {if !isset($test_result) || !$test_result}
  <div class="dashboard-card" style="padding: 1.5rem;">
    <form method="GET" action="{$BASE_URL|default:$base_url}/" class="filter-form">
      <input type="hidden" name="role" value="patient">
      <input type="hidden" name="page" value="test-results">
      
      <div class="filter-input">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" placeholder="Nhập tên xét nghiệm, tên bác sĩ..." value="{$filter.q|default:''}">
      </div>
      
      <div class="date-filter">
        <input type="date" name="date_from" value="{$filter.date_from|default:''}" title="Từ ngày">
        <span style="color: #94a3b8;">-</span>
        <input type="date" name="date_to" value="{$filter.date_to|default:''}" title="Đến ngày">
      </div>
      
      <button type="submit" class="btn-primary">
        <i class="fa-solid fa-filter"></i> Lọc kết quả
      </button>
    </form>
  </div>
  {/if}


  {if isset($test_result) && $test_result}
  {* ==========================================================
     CHẾ ĐỘ XEM CHI TIẾT 1 KẾT QUẢ XÉT NGHIỆM
     ========================================================== *}
     
  <a href="{$BASE_URL|default:$base_url}/?page=test-results" class="btn-outline" style="margin-bottom: 1.5rem;">
    <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
  </a>

  <div class="dashboard-card">
    <div class="dashboard-card__header">
      <h3><i class="fa-solid fa-flask" style="color: #8b5cf6;"></i> {$test_result.name}</h3>
      <span class="badge badge--neutral" style="background: #fff; border: 1px solid #cbd5e1;"><i class="fa-regular fa-calendar"></i> {$test_result.date|date_format:"%d/%m/%Y"}</span>
    </div>
    
    <div class="dashboard-card__body">
      <div class="info-grid">
        <div class="info-item">
          <label>Bác sĩ chỉ định</label>
          <p>BS. {$test_result.doctor_name}</p>
        </div>
        <div class="info-item">
          <label>Ngày thực hiện</label>
          <p>{$test_result.date|date_format:"%d/%m/%Y"}</p>
        </div>
        <div class="info-item">
          <label>Chẩn đoán lâm sàng</label>
          <p>{$test_result.diagnosis|default:'—'}</p>
        </div>
        <div class="info-item">
          <label>Trạng thái</label>
          <div style="margin-top: 4px;"><span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã có kết quả</span></div>
        </div>
      </div>

      {if isset($test_result.items) && $test_result.items|@count > 0}
      <div class="table-wrapper" style="margin-bottom: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
        <table class="data-table">
          <thead>
            <tr>
              <th style="padding-left: 1.5rem;">Tên chỉ số</th>
              <th>Kết quả</th>
              <th>Đơn vị</th>
              <th>Trị số tham chiếu</th>
              <th style="padding-right: 1.5rem;">Đánh giá</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$test_result.items item=item}
            <tr>
              <td style="padding-left: 1.5rem; font-weight: 500; color: #1e293b;">{$item.name}</td>
              <td>
                <span class="{if $item.status == 'high'}val-high{elseif $item.status == 'low'}val-low{else}val-normal{/if}">
                  {$item.value}
                </span>
              </td>
              <td style="color: #64748b;">{$item.unit|default:'—'}</td>
              <td style="color: #64748b;">{$item.normal_range|default:'—'}</td>
              <td style="padding-right: 1.5rem;">
                {if $item.status == 'normal'}<span class="badge badge--success">Bình thường</span>
                {elseif $item.status == 'high'}<span class="badge badge--danger">Cao <i class="fa-solid fa-arrow-up"></i></span>
                {elseif $item.status == 'low'}<span class="badge badge--warning">Thấp <i class="fa-solid fa-arrow-down"></i></span>
                {else}<span class="badge badge--neutral">—</span>{/if}
              </td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
      {/if}

      {if isset($test_result.files) && $test_result.files|@count > 0}
      <div style="margin-bottom: 1.5rem; padding: 1.25rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
        <span style="font-size: 0.9rem; color: #64748b; font-weight: 600; display: block; margin-bottom: 10px; text-transform: uppercase;">Tệp đính kèm (Ảnh/PDF):</span>
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
          {foreach from=$test_result.files item=file}
          <a href="{$file.url}" target="_blank" class="btn-outline" style="background: #fff; padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}" style="{if $file.type == 'pdf'}color: #ef4444;{else}color: #0284c7;{/if}"></i> {$file.name}
          </a>
          {/foreach}
        </div>
      </div>
      {/if}

      {if isset($test_result.note) && $test_result.note}
      <div style="padding: 1.25rem 1.5rem; background: #fffbeb; border-radius: 12px; border-left: 4px solid #f59e0b;">
        <strong style="font-size: 1rem; color: #b45309; display: flex; align-items: center; gap: 8px;">
          <i class="fa-solid fa-user-doctor"></i> Nhận xét / Kết luận của bác sĩ:
        </strong>
        <p style="font-size: 0.95rem; margin: 0.75rem 0 0 0; color: #78350f; line-height: 1.6;">{$test_result.note}</p>
      </div>
      {/if}
      
    </div>
  </div>

  {else}
  {* ==========================================================
     CHẾ ĐỘ XEM DANH SÁCH TỔNG HỢP
     ========================================================== *}
  <div class="dashboard-card">
    <div class="dashboard-card__body p-0">
      <div class="table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th style="padding-left: 1.5rem;">Ngày thực hiện</th>
              <th>Tên xét nghiệm / Cận lâm sàng</th>
              <th>Bác sĩ chỉ định</th>
              <th>Chẩn đoán lâm sàng</th>
              <th style="text-align: center;">Đính kèm</th>
              <th style="text-align: center; padding-right: 1.5rem;">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            {if isset($test_results) && $test_results|@count > 0}
              {foreach from=$test_results item=tr}
              <tr>
                <td style="padding-left: 1.5rem; white-space: nowrap; color: #0f172a; font-weight: 500;">
                  {$tr.date|date_format:"%d/%m/%Y"}
                </td>
                <td>
                  <strong style="color: #0284c7; font-size: 1rem;">{$tr.name}</strong>
                </td>
                <td style="color: #334155; font-weight: 500;">BS. {$tr.doctor_name}</td>
                <td style="color: #64748b;">{$tr.diagnosis|default:'—'|truncate:40:'...'}</td>
                <td style="text-align: center;">
                  {if isset($tr.file_count) && $tr.file_count > 0}
                    <span class="badge badge--blue">{$tr.file_count} File</span>
                  {else}
                    <span style="color: #cbd5e1;">—</span>
                  {/if}
                </td>
                <td style="text-align: center; padding-right: 1.5rem;">
                  <a href="{$BASE_URL|default:$base_url}/?page=test-results&id={$tr.id|default:$tr._id}" class="action-btn" title="Xem chi tiết kết quả">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                </td>
              </tr>
              {/foreach}
            {else}
              <tr>
                <td colspan="6" style="padding: 5rem 2rem; text-align: center;">
                  <i class="fa-solid fa-microscope" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1.5rem; display: block;"></i>
                  <h3 style="color: #0f172a; margin: 0 0 0.5rem 0; font-size: 1.25rem;">Danh sách trống</h3>
                  <p style="color: #64748b; margin: 0; font-size: 1rem;">Bạn chưa có kết quả xét nghiệm hoặc chẩn đoán hình ảnh nào.</p>
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
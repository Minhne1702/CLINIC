{include file="layout/header.tpl" page_title="Kết quả xét nghiệm" active_page="test-results"}

<div class="page-toolbar" style="margin-top: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <div class="page-toolbar__left">
    <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a;"><i class="fa-solid fa-flask" style="color: #0284c7;"></i> Kết quả xét nghiệm</h2>
    <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b;">Tra cứu kết quả xét nghiệm sinh hóa và chẩn đoán hình ảnh (CLS)</p>
  </div>
</div>

<div class="dashboard-card" style="margin-bottom: 1.5rem; padding: 1rem 1.5rem;">
  <form method="GET" action="{$BASE_URL|default:$base_url}/" style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
    <input type="hidden" name="role" value="patient">
    <input type="hidden" name="page" value="test-results">
    
    <div class="filter-input" style="position: relative; flex: 1; min-width: 250px;">
      <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
      <input type="text" name="q" placeholder="Tên xét nghiệm, bác sĩ..." value="{$filter.q|default:''}" style="width: 100%; padding: 0.6rem 1rem 0.6rem 2.5rem; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
    </div>
    
    <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
      <input type="date" name="date_from" value="{$filter.date_from|default:''}" style="padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569;" title="Từ ngày">
      <span style="color: #94a3b8;">-</span>
      <input type="date" name="date_to" value="{$filter.date_to|default:''}" style="padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; color: #475569;" title="Đến ngày">
    </div>
    
    <button type="submit" class="btn-primary" style="padding: 0.6rem 1.25rem; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
      <i class="fa-solid fa-filter"></i> Lọc
    </button>
  </form>
</div>

{if isset($test_result) && $test_result}
{* ========== CHI TIẾT 1 KẾT QUẢ XÉT NGHIỆM ========== *}
<a href="{$BASE_URL|default:$base_url}/?page=test-results" class="btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #475569; background: #fff; margin-bottom: 1.5rem;">
  <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
</a>

<div class="dashboard-card">
  <div class="dashboard-card__header" style="border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
    <h3 style="margin: 0; font-size: 1.25rem; color: #0f172a;"><i class="fa-solid fa-flask" style="color: #8b5cf6;"></i> {$test_result.name}</h3>
    <span style="font-size: 13px; color: #64748b; background: #f8fafc; padding: 4px 8px; border-radius: 4px; border: 1px solid #e2e8f0;">{$test_result.date|date_format:"%d/%m/%Y"}</span>
  </div>
  
  <div class="dashboard-card__body">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 2rem; background: #f8fafc; padding: 1rem; border-radius: 8px;">
      <div>
        <label style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600;">Bác sĩ chỉ định</label>
        <p style="margin: 4px 0 0 0; color: #0f172a; font-weight: 500;">BS. {$test_result.doctor_name}</p>
      </div>
      <div>
        <label style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600;">Ngày thực hiện</label>
        <p style="margin: 4px 0 0 0; color: #0f172a; font-weight: 500;">{$test_result.date|date_format:"%d/%m/%Y"}</p>
      </div>
      <div>
        <label style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600;">Chẩn đoán lâm sàng</label>
        <p style="margin: 4px 0 0 0; color: #0f172a; font-weight: 500;">{$test_result.diagnosis|default:'—'}</p>
      </div>
      <div>
        <label style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600;">Trạng thái</label>
        <div style="margin-top: 4px;"><span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã có kết quả</span></div>
      </div>
    </div>

    {if isset($test_result.items) && $test_result.items|@count > 0}
    <div style="overflow-x: auto; margin-bottom: 1.5rem;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead style="background: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
          <tr>
            <th style="padding: 1rem; color: #334155;">Tên chỉ số</th>
            <th style="padding: 1rem; color: #334155;">Kết quả</th>
            <th style="padding: 1rem; color: #334155;">Đơn vị</th>
            <th style="padding: 1rem; color: #334155;">Trị số tham chiếu</th>
            <th style="padding: 1rem; color: #334155;">Đánh giá</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$test_result.items item=item}
          <tr style="border-bottom: 1px solid #e2e8f0;">
            <td style="padding: 1rem; font-weight: 500; color: #1e293b;">{$item.name}</td>
            <td style="padding: 1rem;">
              <strong style="{if $item.status == 'high'}color: #dc2626;{elseif $item.status == 'low'}color: #d97706;{else}color: #16a34a;{/if} font-size: 15px;">
                {$item.value}
              </strong>
            </td>
            <td style="padding: 1rem; color: #64748b;">{$item.unit|default:'—'}</td>
            <td style="padding: 1rem; color: #64748b;">{$item.normal_range|default:'—'}</td>
            <td style="padding: 1rem;">
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
    <div style="margin-top: 1rem; display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
      <span style="font-size: 13px; color: #64748b; font-weight: 500;">Tệp đính kèm (Ảnh/PDF):</span>
      {foreach from=$test_result.files item=file}
      <a href="{$file.url}" target="_blank" class="btn-outline" style="font-size: 13px; padding: 0.4rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #0284c7; background: #f0f9ff; display: inline-flex; align-items: center; gap: 5px;">
        <i class="fa-solid fa-file-{if $file.type == 'pdf'}pdf{else}image{/if}"></i> {$file.name}
      </a>
      {/foreach}
    </div>
    {/if}

    {if isset($test_result.note) && $test_result.note}
    <div style="margin-top: 1.5rem; padding: 1rem 1.25rem; background: #fffbeb; border-radius: 8px; border-left: 4px solid #f59e0b;">
      <strong style="font-size: 14px; color: #b45309;"><i class="fa-solid fa-user-doctor"></i> Nhận xét / Kết luận của bác sĩ:</strong>
      <p style="font-size: 14px; margin: 0.5rem 0 0 0; color: #78350f; line-height: 1.5;">{$test_result.note}</p>
    </div>
    {/if}
    
  </div>
</div>

{else}
{* ========== DANH SÁCH TỔNG HỢP ========== *}
<div class="dashboard-card">
  <div class="dashboard-card__body p-0">
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th style="padding: 1rem; color: #475569; white-space: nowrap;">Ngày thực hiện</th>
            <th style="padding: 1rem; color: #475569;">Tên xét nghiệm / CLS</th>
            <th style="padding: 1rem; color: #475569;">Bác sĩ chỉ định</th>
            <th style="padding: 1rem; color: #475569;">Chẩn đoán lâm sàng</th>
            <th style="padding: 1rem; color: #475569; text-align: center;">Đính kèm</th>
            <th style="padding: 1rem; color: #475569; text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          {if isset($test_results) && $test_results|@count > 0}
            {foreach from=$test_results item=tr}
            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
              <td style="padding: 1rem; white-space: nowrap; color: #0f172a; font-weight: 500;">
                {$tr.date|date_format:"%d/%m/%Y"}
              </td>
              <td style="padding: 1rem;">
                <strong style="color: #0284c7;">{$tr.name}</strong>
              </td>
              <td style="padding: 1rem; color: #334155;">BS. {$tr.doctor_name}</td>
              <td style="padding: 1rem; color: #64748b;">{$tr.diagnosis|default:'—'|truncate:35:'...'}</td>
              <td style="padding: 1rem; text-align: center;">
                {if isset($tr.file_count) && $tr.file_count > 0}
                  <span class="badge badge--blue" style="font-size: 11px;">{$tr.file_count} File</span>
                {else}
                  <span style="color: #cbd5e1;">—</span>
                {/if}
              </td>
              <td style="padding: 1rem; text-align: center;">
                <a href="{$BASE_URL|default:$base_url}/?page=test-results&id={$tr.id|default:$tr._id}" title="Xem chi tiết kết quả" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e0f2fe; color: #0284c7; text-decoration: none; transition: background 0.2s;">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr>
              <td colspan="6" style="padding: 4rem 2rem; text-align: center;">
                <i class="fa-solid fa-microscope" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
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

{include file="layout/footer.tpl"}
{include file="layout/header.tpl" page_title="Đơn thuốc của tôi" active_page="prescriptions"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc của tôi</h2>
    <p class="page-subtitle">Lịch sử đơn thuốc đã được kê</p>
  </div>
  {if $prescription}
  <div class="page-toolbar__right">
    <a href="/CLINIC/public/?role=patient&page=prescriptions" class="btn-admin-ghost">
      <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>
    <button class="btn-admin-secondary" onclick="window.print()">
      <i class="fa-solid fa-print"></i> In đơn thuốc
    </button>
  </div>
  {/if}
</div>

{if $prescription}
{* ========== CHI TIẾT ĐƠN THUỐC ========== *}
<div class="admin-card rx-print-area">
  <div class="admin-card__body">

    <div class="rx-header">
      <div class="rx-header__clinic">
        <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.4rem">
          <div class="logo-icon" style="width:34px;height:34px;font-size:14px;background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <strong style="font-size:16px;color:var(--admin-primary)">MediCare</strong>
        </div>
        <p style="font-size:12px;color:var(--admin-text-secondary)">123 Nguyễn Thị Minh Khai, Q.1, TP.HCM</p>
        <p style="font-size:12px;color:var(--admin-text-secondary)">Hotline: 1900 xxxx</p>
      </div>
      <div class="rx-header__title">
        <h2>ĐƠN THUỐC</h2>
        <p>Mã đơn: <strong>{$prescription.code|default:'—'}</strong></p>
        <p>Ngày kê: <strong>{$prescription.date|date_format:"%d/%m/%Y"}</strong></p>
      </div>
    </div>

    <div class="rx-patient-info">
      <div class="rx-info-row"><span>Họ và tên:</span><strong>{$prescription.patient_name}</strong></div>
      <div class="rx-info-row"><span>Ngày sinh:</span><strong>{$prescription.patient_birthday|date_format:"%d/%m/%Y"|default:'—'}</strong></div>
      <div class="rx-info-row"><span>Giới tính:</span><strong>{if $prescription.patient_gender == 'male'}Nam{elseif $prescription.patient_gender == 'female'}Nữ{else}—{/if}</strong></div>
      <div class="rx-info-row"><span>Chẩn đoán:</span><strong>{$prescription.diagnosis|default:'—'}</strong></div>
    </div>

    <table class="admin-table rx-drug-table">
      <thead>
        <tr>
          <th style="width:28px">STT</th>
          <th>Tên thuốc</th>
          <th>Hoạt chất</th>
          <th>Hàm lượng</th>
          <th>Số lượng</th>
          <th>Liều dùng</th>
          <th>Số ngày</th>
          <th>Cách dùng</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$prescription.drugs item=drug name=dloop}
        <tr>
          <td style="text-align:center">{$smarty.foreach.dloop.iteration}</td>
          <td><strong>{$drug.name}</strong></td>
          <td class="text-muted">{$drug.active_ingredient|default:'—'}</td>
          <td>{$drug.concentration|default:'—'}</td>
          <td><strong>{$drug.qty} {$drug.unit}</strong></td>
          <td>{$drug.dosage}</td>
          <td>{$drug.days} ngày</td>
          <td style="font-size:13px">{$drug.instruction}</td>
        </tr>
        {foreachelse}
        <tr><td colspan="8" class="table-empty">Không có thuốc trong đơn</td></tr>
        {/foreach}
      </tbody>
    </table>

    {if $prescription.prescription_note}
    <div style="margin-top:1rem;padding:1rem;background:#f0f9ff;border-radius:8px;border-left:3px solid var(--admin-primary)">
      <strong style="font-size:13px;color:var(--admin-primary)">Lời dặn của bác sĩ:</strong>
      <p style="font-size:13px;margin-top:.3rem">{$prescription.prescription_note}</p>
    </div>
    {/if}

    <div class="rx-footer">
      <div>
        <p style="font-size:13px;color:var(--admin-text-secondary)">
          Tái khám sau: <strong>{$prescription.followup_days|default:'—'} ngày</strong>
        </p>
        <p style="font-size:12px;color:var(--admin-text-muted);margin-top:.25rem">
          Ngày tái khám: {$prescription.followup_date|date_format:"%d/%m/%Y"|default:'—'}
        </p>
      </div>
      <div style="text-align:center">
        <p style="font-size:12px;color:var(--admin-text-secondary)">Bác sĩ điều trị</p>
        <p style="margin-top:2.5rem;font-weight:600">BS. {$prescription.doctor_name}</p>
        <p style="font-size:12px;color:var(--admin-text-muted)">{$prescription.specialty}</p>
      </div>
    </div>

  </div>
</div>

{else}
{* ========== DANH SÁCH ĐƠN THUỐC ========== *}
<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th>Ngày kê</th>
          <th>Bác sĩ kê đơn</th>
          <th>Chẩn đoán</th>
          <th>Số loại thuốc</th>
          <th>Tái khám</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$prescriptions item=rx}
        <tr>
          <td><span class="code-tag">{$rx.code}</span></td>
          <td>{$rx.date|date_format:"%d/%m/%Y"}</td>
          <td>BS. {$rx.doctor_name}</td>
          <td>{$rx.diagnosis|default:'—'|truncate:40:'...'}</td>
          <td><span class="badge badge--blue">{$rx.drug_count|default:0} thuốc</span></td>
          <td>
            {if $rx.followup_date}
              <span class="badge badge--warning">{$rx.followup_date|date_format:"%d/%m/%Y"}</span>
            {else}
              <span class="text-muted">—</span>
            {/if}
          </td>
          <td>
            {if $rx.dispensed}
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã phát</span>
            {else}
              <span class="badge badge--warning">Chờ phát</span>
            {/if}
          </td>
          <td>
            <a href="/CLINIC/public/?role=patient&page=prescriptions&id={$rx._id}" class="action-btn" title="Xem & In">
              <i class="fa-solid fa-eye"></i>
            </a>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="8" class="table-empty">Chưa có đơn thuốc nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

<style media="print">
  .sidebar, .admin-topnav, .page-toolbar .page-toolbar__right,
  .admin-main { margin-left: 0 !important; }
  .admin-content { padding: 0 !important; }
  .admin-card { border: none !important; box-shadow: none !important; }
</style>

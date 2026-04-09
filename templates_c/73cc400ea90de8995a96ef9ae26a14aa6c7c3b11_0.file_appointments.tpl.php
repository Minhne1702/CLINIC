<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:57:10
  from 'file:patient/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d769e6df97b1_40788898',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73cc400ea90de8995a96ef9ae26a14aa6c7c3b11' => 
    array (
      0 => 'patient/appointments.tpl',
      1 => 1775725028,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d769e6df97b1_40788898 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Quản lý lịch hẹn",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<style>
  .booking-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1rem; }
  
  /* Thẻ lịch hẹn */
  .appt-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s; }
  .appt-card:hover { border-color: #bae6fd; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.08); }
  .appt-info { display: flex; gap: 1.5rem; align-items: center; }
  .appt-date { background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 0.5rem 1rem; text-align: center; min-width: 90px; }
  .appt-date strong { display: block; font-size: 1.8rem; color: #0284c7; line-height: 1; margin-bottom: 5px; }
  .appt-date span { font-size: 0.85rem; color: #0369a1; font-weight: 500; }
  .appt-details h4 { margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.15rem; }
  .appt-details p { margin: 0 0 0.25rem 0; color: #475569; font-size: 0.95rem; }

  /* Modal Chi tiết */
  .modal-detail { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); align-items: center; justify-content: center; backdrop-filter: blur(4px); }
  .modal-content { background: #fff; border-radius: 16px; width: 95%; max-width: 600px; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
  .modal-header { padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border-radius: 16px 16px 0 0; }
  .modal-body { padding: 2rem 1.5rem; }
  .close-btn { font-size: 1.5rem; color: #64748b; cursor: pointer; transition: color 0.2s; border: none; background: transparent; }
  .close-btn:hover { color: #ef4444; }

  /* Mã QR */
  .qr-section { text-align: center; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px dashed #cbd5e1; }
  .qr-box { display: inline-block; padding: 10px; background: #fff; border: 2px solid #e2e8f0; border-radius: 12px; margin-bottom: 1rem; }
  .qr-code { display: block; width: 160px; height: 160px; }

  /* Timeline Trạng thái */
  .tracking-wrapper { position: relative; padding: 0 10px; margin-bottom: 2rem; }
  .tracking-line { position: absolute; top: 20px; left: 40px; right: 40px; height: 4px; background: #e2e8f0; z-index: 1; border-radius: 2px; }
  .tracking-line-fill { position: absolute; top: 0; left: 0; height: 100%; background: #10b981; border-radius: 2px; transition: width 0.5s ease; }
  .tracking-steps { display: flex; justify-content: space-between; position: relative; z-index: 2; }
  .track-step { display: flex; flex-direction: column; align-items: center; width: 80px; }
  .track-icon { width: 44px; height: 44px; border-radius: 50%; background: #fff; border: 4px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #94a3b8; transition: all 0.3s; }
  .track-text { margin-top: 10px; font-size: 0.8rem; color: #64748b; font-weight: 500; text-align: center; line-height: 1.3; }
  
  .track-step.completed .track-icon { border-color: #10b981; background: #10b981; color: #fff; }
  .track-step.completed .track-text { color: #059669; }
  .track-step.active .track-icon { border-color: #0284c7; background: #fff; color: #0284c7; box-shadow: 0 0 0 4px #e0f2fe; }
  .track-step.active .track-text { color: #0284c7; font-weight: 600; }
</style>

<div class="booking-wrapper">
  <div class="page-toolbar" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-regular fa-calendar-check" style="color: #0284c7;"></i> Lịch hẹn của tôi</h2>
    </div>
    <div class="page-toolbar__right">
      <a href="<?php echo (($tmp = $_smarty_tpl->getValue('BASE_URL') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('base_url') ?? null : $tmp);?>
/?page=book" class="btn-primary" style="background: #0284c7; color: #fff; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-plus"></i> Đặt lịch mới
      </a>
    </div>
  </div>
  <div class="tabs" style="margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; display: flex; gap: 2rem;">
    <a href="?page=appointments&status=all" style="padding: 0.75rem 0; font-weight: 500; text-decoration: none; color: <?php if ($_smarty_tpl->getValue('filter')['status'] == 'all') {?>#0284c7<?php } else { ?>#64748b<?php }?>; border-bottom: 2px solid <?php if ($_smarty_tpl->getValue('filter')['status'] == 'all') {?>#0284c7<?php } else { ?>transparent<?php }?>;">Tất cả (<?php echo (($tmp = $_smarty_tpl->getValue('count')['all'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
    <a href="?page=appointments&status=pending" style="padding: 0.75rem 0; font-weight: 500; text-decoration: none; color: <?php if ($_smarty_tpl->getValue('filter')['status'] == 'pending') {?>#0284c7<?php } else { ?>#64748b<?php }?>; border-bottom: 2px solid <?php if ($_smarty_tpl->getValue('filter')['status'] == 'pending') {?>#0284c7<?php } else { ?>transparent<?php }?>;">Chờ khám (<?php echo (($tmp = $_smarty_tpl->getValue('count')['pending'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
  </div>

  <div class="appointments-list">
    <?php if ((true && ($_smarty_tpl->hasVariable('appointments') && null !== ($_smarty_tpl->getValue('appointments') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('appointments')) > 0) {?>
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
      <div class="appt-card">
        <div class="appt-info">
          <div class="appt-date">
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d");?>
</strong>
            <span>Thg <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%m");?>
</span>
          </div>
          <div class="appt-details">
            <h4>BS. <?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</h4>
            <p><i class="fa-solid fa-stethoscope" style="color: #94a3b8; width: 20px;"></i> Khoa <?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</p>
            <p><i class="fa-regular fa-clock" style="color: #94a3b8; width: 20px;"></i> <?php echo $_smarty_tpl->getValue('apt')['time'];?>
 | <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d/%m/%Y");?>
</p>
            <div style="margin-top: 0.5rem;">
                <span class="badge" style="padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; 
                    <?php if ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>background: #fef3c7; color: #d97706;
                    <?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'completed') {?>background: #dcfce7; color: #15803d;
                    <?php } else { ?>background: #e0f2fe; color: #0369a1;<?php }?>">
                    <?php echo $_smarty_tpl->getValue('apt')['status_text'];?>

                </span>
                <span class="badge" style="background:#f1f5f9; color:#475569; margin-left:5px; padding: 4px 10px; border-radius: 6px; font-size: 0.8rem;">Mã: <?php echo $_smarty_tpl->getValue('apt')['code'];?>
</span>
            </div>
          </div>
        </div>
        <div class="appt-actions">
          <button onclick="openDetailModal('<?php echo $_smarty_tpl->getValue('apt')['id'];?>
')" style="background: #0284c7; color: #fff; padding: 0.6rem 1.2rem; border-radius: 8px; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 600;">
            <i class="fa-solid fa-qrcode"></i> Xem tiến trình
          </button>
        </div>
      </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
      <div class="empty-state" style="text-align: center; padding: 4rem 1rem; background: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1;">
        <i class="fa-regular fa-calendar-xmark" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
        <h3 style="color: #334155; margin-bottom: 0.5rem;">Không có lịch hẹn nào</h3>
        <p style="color: #64748b;">Bạn chưa có lịch hẹn nào trong trạng thái này.</p>
      </div>
    <?php }?>
  </div>

  <div id="detailModal" class="modal-detail">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h3 style="margin: 0; color: #0f172a; font-size: 1.25rem;">Chi tiết lịch hẹn</h3>
          <p style="margin: 5px 0 0 0; color: #64748b; font-size: 0.9rem;">Mã lịch: <strong id="m_code" style="color: #0284c7;">—</strong></p>
        </div>
        <button class="close-btn" onclick="closeDetailModal()">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="qr-section">
          <h4 style="margin: 0 0 1rem 0; color: #334155;">Mã QR Check-in</h4>
          <div class="qr-box"><img id="m_qr_img" class="qr-code" src="" alt="QR"></div>
          <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Đưa mã này cho Lễ tân khi đến phòng khám.</p>
        </div>

        <h4 style="margin: 0 0 1.5rem 0; color: #334155;">Tiến trình khám bệnh</h4>
        <div class="tracking-wrapper">
          <div class="tracking-line"><div id="m_progress_bar" class="tracking-line-fill"></div></div>
          <div class="tracking-steps">
            <div class="track-step" id="ts_pending"><div class="track-icon"><i class="fa-solid fa-file-signature"></i></div><div class="track-text">Xác nhận</div></div>
            <div class="track-step" id="ts_waiting"><div class="track-icon"><i class="fa-solid fa-hospital-user"></i></div><div class="track-text">Chờ khám</div></div>
            <div class="track-step" id="ts_consulting"><div class="track-icon"><i class="fa-solid fa-user-doctor"></i></div><div class="track-text">Đang khám</div></div>
            <div class="track-step" id="ts_billing"><div class="track-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div><div class="track-text">Thanh toán</div></div>
            <div class="track-step" id="ts_pharmacy"><div class="track-icon"><i class="fa-solid fa-pills"></i></div><div class="track-text">Lấy thuốc</div></div>
            <div class="track-step" id="ts_completed"><div class="track-icon"><i class="fa-solid fa-check-double"></i></div><div class="track-text">Hoàn thành</div></div>
          </div>
        </div>

        <div style="background: #f8fafc; padding: 1.25rem; border-radius: 12px; border: 1px solid #f1f5f9;">
          <p style="margin: 0 0 8px 0; color: #475569;">Bác sĩ: <strong id="m_doctor" style="color: #0f172a;">—</strong></p>
          <p style="margin: 0 0 8px 0; color: #475569;">Khoa: <strong id="m_specialty" style="color: #0f172a;">—</strong></p>
          <p style="margin: 0; color: #475569;">Thời gian: <strong id="m_datetime" style="color: #0f172a;">—</strong></p>
        </div>
      </div>
    </div>
  </div>
</div> ```


<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>
// Nhận dữ liệu JSON từ Controller
const appointmentsData = <?php echo (($tmp = $_smarty_tpl->getValue('appointments_json') ?? null)===null||$tmp==='' ? '[]' ?? null : $tmp);?>
;


function openDetailModal(apptId) {
    const appt = appointmentsData.find(a => a.id === apptId);
    if (!appt) return;

    // 1. Đổ dữ liệu Text
    document.getElementById('m_code').textContent = appt.code;
    document.getElementById('m_doctor').textContent = 'BS. ' + appt.doctor_name;
    document.getElementById('m_specialty').textContent = appt.specialty;
    
    // Xử lý hiển thị ngày tháng an toàn
    const d = new Date(appt.date);
    const dateStr = d.toLocaleDateString('vi-VN');
    document.getElementById('m_datetime').textContent = `${appt.time} | Ngày ${dateStr}`;

    // 2. Tạo mã QR (API QR Server)
    document.getElementById('m_qr_img').src = `https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=${appt.code}`;

    // 3. Logic Timeline
    const steps = ['pending', 'waiting', 'consulting', 'billing', 'pharmacy', 'completed'];
    let currentIndex = steps.indexOf(appt.status);
    if (currentIndex === -1) currentIndex = 0; 

    // Reset & Update class
    steps.forEach((step, index) => {
        const el = document.getElementById('ts_' + step);
        if(!el) return;
        el.classList.remove('completed', 'active');
        if (index < currentIndex) el.classList.add('completed');
        else if (index === currentIndex) el.classList.add('active');
    });

    // Cập nhật thanh ProgressBar ngang
    const progressPercent = (currentIndex / (steps.length - 1)) * 100;
    document.getElementById('m_progress_bar').style.width = progressPercent + '%';

    // Hiển thị Modal
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetailModal() {
    document.getElementById('detailModal').style.display = 'none';
}

// Đóng modal khi click ra ngoài vùng trắng
window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) closeDetailModal();
}

<?php echo '</script'; ?>
><?php }
}

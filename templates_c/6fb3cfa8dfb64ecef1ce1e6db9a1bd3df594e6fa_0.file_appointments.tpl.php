<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:45:07
  from 'file:guest/appointments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d767138ad616_09056081',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6fb3cfa8dfb64ecef1ce1e6db9a1bd3df594e6fa' => 
    array (
      0 => 'guest/appointments.tpl',
      1 => 1775724305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d767138ad616_09056081 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\guest';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đặt lịch khám — MediCare",'active_page'=>"appointments"), (int) 0, $_smarty_current_dir);
?>

<style>
  .booking-wrapper { max-width: 1000px; margin: 3rem auto; padding: 0 1rem; }
  .booking-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 2rem; border: 1px solid #f1f5f9; }
  
  /* Timeline mini cho Guest */
  .guest-steps { display: flex; justify-content: center; gap: 2rem; margin-bottom: 2.5rem; }
  .g-step { display: flex; align-items: center; gap: 8px; color: #94a3b8; font-weight: 500; }
  .g-step.active { color: #0284c7; }
  .g-step span { width: 28px; height: 28px; border-radius: 50%; border: 2px solid currentColor; display: flex; align-items: center; justify-content: center; font-size: 14px; }

  /* Tái sử dụng Style BookingCare đã làm */
  .bc-doctor-card { display: flex; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 1.5rem; overflow: hidden; }
  .bc-doctor-left { flex: 1; padding: 1.5rem; display: flex; gap: 1rem; border-right: 1px solid #e2e8f0; background: #fcfcfc; }
  .bc-doctor-right { flex: 1.2; padding: 1.5rem; }
  .bc-time-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 8px; margin: 1rem 0; }
  .bc-time-slot { background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px; text-align: center; border-radius: 4px; cursor: pointer; font-size: 0.9rem; }
  .bc-time-slot:hover { background: #e0f2fe; color: #0284c7; border-color: #0284c7; }
</style>

<div class="booking-wrapper">
  <div class="guest-steps">
    <div class="g-step active" id="gst-1"><span>1</span> Dịch vụ</div>
    <div class="g-step" id="gst-2"><span>2</span> Bác sĩ & Giờ</div>
    <div class="g-step" id="gst-3"><span>3</span> Thông tin liên hệ</div>
  </div>

  <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" method="POST" id="guestBookingForm">
    <input type="hidden" name="action" value="guest_submit">
    <input type="hidden" name="doctor_id" id="g_doctor_id">
    <input type="hidden" name="date" id="g_date">
    <input type="hidden" name="time" id="g_time">

    <div class="booking-pane" id="step-1">
      <div class="booking-card">
        <h3 style="margin-bottom:1.5rem"><i class="fa-solid fa-stethoscope text-accent"></i> Bước 1: Chọn chuyên khoa</h3>
        <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <div class="form-group">
                <label>Chuyên khoa <span class="required">*</span></label>
                <select name="specialty" id="g_specialty" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #cbd5e1">
                    <option value="">-- Tất cả chuyên khoa --</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('specialties'), 's');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('s')['name'];?>
"><?php echo $_smarty_tpl->getValue('s')['name'];?>
</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="form-group">
                <label>Hình thức <span class="required">*</span></label>
                <select name="type" required style="width:100%; padding:12px; border-radius:8px; border:1px solid #cbd5e1">
                    <option value="offline">Khám trực tiếp tại phòng khám</option>
                    <option value="online">Tư vấn qua Video Call</option>
                </select>
            </div>
        </div>
        <div style="text-align: right">
            <button type="button" class="btn-primary" onclick="showStep(2)" style="padding: 12px 30px">Tiếp tục</button>
        </div>
      </div>
    </div>
    <div class="booking-pane" id="step-2" style="display:none">
       <h3 style="margin-bottom:1.5rem">Bước 2: Chọn bác sĩ & Thời gian</h3>
       <div id="doctor-container">
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach1DoElse = false;
?>
          <div class="bc-doctor-card">
             <div class="bc-doctor-left">
                <img src="<?php echo (($tmp = $_smarty_tpl->getValue('doc')['avatar'] ?? null)===null||$tmp==='' ? '/assets/img/default-doc.png' ?? null : $tmp);?>
" style="width:80px;height:80px;border-radius:50%">
                <div>
                   <h4 style="margin:0; color:#0284c7"><?php echo $_smarty_tpl->getValue('doc')['degree'];?>
 <?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</h4>
                   <p style="font-size:13px; color:#64748b"><?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</p>
                </div>
             </div>
             <div class="bc-doctor-right">
                <input type="date" class="g-date-picker" value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),'%Y-%m-%d');?>
" style="margin-bottom:10px">
                <div class="bc-time-grid">
                   <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('08:00','09:00','10:00','14:00','15:00'), 't');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('t')->value) {
$foreach2DoElse = false;
?>
                   <div class="bc-time-slot" onclick="pickTime('<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
', '<?php echo $_smarty_tpl->getValue('t');?>
')"><?php echo $_smarty_tpl->getValue('t');?>
</div>
                   <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </div>
             </div>
          </div>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
       </div>
       <button type="button" onclick="showStep(1)" class="btn-outline">Quay lại</button>
    </div>

    <div class="booking-pane" id="step-3" style="display:none">
      <div class="booking-card">
        <h3 style="margin-bottom:1.5rem">Bước 3: Thông tin người đặt lịch</h3>
        <div class="alert alert--info" style="margin-bottom:1.5rem">
            Bạn đang đặt lịch khám với <strong><span id="summary-doc"></span></strong> vào lúc <strong><span id="summary-time"></span></strong>.
        </div>
        
        <div class="form-row" style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem">
            <div class="form-group">
                <label>Họ và tên bệnh nhân <span class="required">*</span></label>
                <input type="text" name="full_name" required placeholder="Nhập tên chính xác trên CCCD">
            </div>
            <div class="form-group">
                <label>Số điện thoại liên hệ <span class="required">*</span></label>
                <input type="tel" name="phone" required placeholder="Dùng để nhận mã xác nhận">
            </div>
        </div>

        <div class="form-group" style="margin-top:1rem">
            <label>Email (Nhận phiếu khám điện tử)</label>
            <input type="email" name="email" placeholder="email@example.com">
        </div>

        <div class="form-group" style="margin-top:1rem">
            <label>Lý do khám / Triệu chứng</label>
            <textarea name="note" rows="3" placeholder="Mô tả tình trạng sức khỏe hiện tại..."></textarea>
        </div>

        <div style="margin-top: 2rem; display: flex; justify-content: space-between;">
            <button type="button" onclick="showStep(2)" class="btn-outline">Quay lại</button>
            <button type="submit" class="btn-primary" style="background:#10b981; border:none; padding:12px 40px">XÁC NHẬN ĐẶT LỊCH</button>
        </div>
      </div>
    </div>
  </form>
</div>

<?php echo '<script'; ?>
>

    function showStep(n) {
        document.querySelectorAll('.booking-pane').forEach(p => p.style.display = 'none');
        document.getElementById('step-' + n).style.display = 'block';
        
        document.querySelectorAll('.g-step').forEach((s, idx) => {
            s.classList.toggle('active', idx + 1 === n);
        });
    }

    function pickTime(docId, time) {
        const date = document.querySelector('.g-date-picker').value;
        document.getElementById('g_doctor_id').value = docId;
        document.getElementById('g_date').value = date;
        document.getElementById('g_time').value = time;
        
        // Cập nhật tóm tắt
        document.getElementById('summary-time').textContent = time + ' ngày ' + date;
        document.getElementById('summary-doc').textContent = 'Bác sĩ đã chọn';
        
        showStep(3);
    }

<?php echo '</script'; ?>
>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:23:30
  from 'file:patient/book.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d762021b0e17_93151382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6e689d7b886e35f7a566d9c23fb88168480c1ad9' => 
    array (
      0 => 'patient/book.tpl',
      1 => 1775704063,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d762021b0e17_93151382 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đặt lịch khám",'active_page'=>"book"), (int) 0, $_smarty_current_dir);
?>

<style>
  .booking-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1rem; }

  /* Thanh quy trình 3 bước */
  .booking-steps { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem; background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; }
  .booking-step { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: #94a3b8; font-weight: 500; font-size: 0.95rem; flex: 1; text-align: center; position: relative; }
  .booking-step span { width: 32px; height: 32px; border-radius: 50%; background: #f8fafc; display: flex; align-items: center; justify-content: center; font-weight: 600; transition: all 0.3s; z-index: 2; border: 2px solid #e2e8f0; }
  .booking-step.active { color: #0284c7; }
  .booking-step.active span { background: #0284c7; color: #fff; border-color: #0284c7; }
  .booking-step.done { color: #10b981; }
  .booking-step.done span { background: #10b981; color: #fff; border-color: #10b981; }
  .booking-step-line { height: 2px; background: #f1f5f9; flex: 2; margin: 0 10px; position: relative; top: -14px; z-index: 1; }
  
  .booking-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); border: 1px solid #e2e8f0; padding: 2rem; margin-bottom: 2rem; }
  .booking-card__title { margin: 0 0 2rem 0; font-size: 1.2rem; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem; }

  /* CSS Bước 1 */
  .type-options { display: flex; gap: 1.5rem; align-items: stretch; }
  .type-option { flex: 1; cursor: pointer; display: flex; flex-direction: column; }
  .type-option input { display: none; }
  .type-option__card { flex: 1; border: 2px solid #e2e8f0; border-radius: 10px; padding: 2rem; text-align: center; background: #fff; transition: all 0.2s; display: flex; flex-direction: column; justify-content: center; }
  .type-option__card i { font-size: 2.5rem; color: #94a3b8; margin-bottom: 1rem; }
  .type-option__card strong { display: block; font-size: 1.15rem; color: #334155; margin-bottom: 0.5rem; }
  .type-option__card p { margin: 0; color: #64748b; font-size: 0.9rem; }
  .type-option input:checked + .type-option__card { border-color: #0284c7; background: #f0f9ff; }
  .type-option input:checked + .type-option__card i, .type-option input:checked + .type-option__card strong { color: #0284c7; }

  .specialty-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
  .specialty-option { cursor: pointer; display: flex; flex-direction: column; }
  .specialty-option input { display: none; }
  .specialty-option__card { flex: 1; border: 2px solid #e2e8f0; border-radius: 10px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; background: #fff; transition: all 0.2s; }
  .specialty-option__card i { color: #94a3b8; font-size: 1.2rem; flex-shrink: 0; }
  .specialty-option__card span { color: #475569; font-weight: 500; font-size: 0.95rem; }
  .specialty-option input:checked + .specialty-option__card { border-color: #0284c7; background: #f0f9ff; }
  .specialty-option input:checked + .specialty-option__card i, .specialty-option input:checked + .specialty-option__card span { color: #0284c7; }

  /* CSS Bước 2: THẺ BÁC SĨ */
  .bc-doctor-card { display: flex; flex-wrap: wrap; border: 1px solid #e2e8f0; border-radius: 12px; background: #fff; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
  .bc-doctor-left { flex: 1; min-width: 300px; padding: 1.5rem; display: flex; gap: 1.5rem; border-right: 1px solid #e2e8f0; background: #fcfcfc; }
  .bc-doctor-avatar { width: 90px; height: 90px; border-radius: 50%; overflow: hidden; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex-shrink: 0; }
  .bc-doctor-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .bc-doctor-info h4 { margin: 0 0 0.5rem 0; font-size: 1.15rem; color: #0284c7; }
  .bc-doctor-info p { margin: 0 0 0.4rem 0; font-size: 0.9rem; color: #475569; line-height: 1.5; }
  .bc-doctor-info .location { color: #64748b; font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 5px; }

  .bc-doctor-right { flex: 1.5; min-width: 400px; padding: 1.5rem; }
  .bc-date-select { appearance: none; background: #f8fafc url('data:image/svg+xml;utf8,<svg viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg"><polyline points="30 40 70 80 110 40" stroke="%23475569" stroke-width="12" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat right 10px center/12px; padding: 8px 30px 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-weight: 600; color: #0284c7; cursor: pointer; outline: none; margin-bottom: 1rem; border-bottom: 2px solid #0284c7; border-bottom-left-radius: 0; border-bottom-right-radius: 0; }
  .bc-schedule-heading { font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }
  
  .bc-time-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 10px; margin-bottom: 1rem; }
  .bc-time-slot { background: #f1f5f9; border: 1px solid #cbd5e1; color: #334155; padding: 8px 5px; text-align: center; font-size: 0.9rem; font-weight: 500; cursor: pointer; transition: all 0.2s; border-radius: 4px; }
  .bc-time-slot:hover { background: #e0f2fe; border-color: #38bdf8; color: #0284c7; }
  
  .bc-hint { font-size: 0.85rem; color: #64748b; margin-bottom: 1.5rem; }
  .bc-address-block { border-top: 1px solid #f1f5f9; padding-top: 1rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
  .bc-address-info h5, .bc-price-info h5 { margin: 0 0 5px 0; font-size: 0.85rem; color: #64748b; font-weight: 600; }
  .bc-address-info p { margin: 0; font-size: 0.9rem; color: #334155; }
  .bc-price-info strong { color: #334155; font-size: 0.95rem; }

  @media (max-width: 768px) {
    .bc-doctor-left { border-right: none; border-bottom: 1px solid #e2e8f0; }
    .bc-doctor-right { min-width: 100%; }
  }
</style>
<div class="booking-wrapper">
  <div class="page-toolbar" style="margin-bottom: 2rem; text-align: center;">
    <h2 class="page-title" style="margin: 0; font-size: 2rem; color: #0f172a;">Đặt lịch khám</h2>
  </div>

  <div class="booking-steps">
    <div class="booking-step active" id="step-ind-1"><span>1</span> <div style="margin-top: 8px;">Dịch vụ</div></div>
    <div class="booking-step-line"></div>
    <div class="booking-step" id="step-ind-2"><span>2</span> <div style="margin-top: 8px;">Bác sĩ & Lịch khám</div></div>
    <div class="booking-step-line"></div>
    <div class="booking-step" id="step-ind-3"><span>3</span> <div style="margin-top: 8px;">Xác nhận</div></div>
  </div>

  <form action="<?php echo (($tmp = $_smarty_tpl->getValue('BASE_URL') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('base_url') ?? null : $tmp);?>
/?page=book" method="POST" id="bookingForm">
    <input type="hidden" name="action" value="submit">
    <input type="hidden" name="doctor_id" id="input_doctor_id">
    <input type="hidden" name="doctor_name" id="input_doctor_name">
    <input type="hidden" name="date" id="input_date">
    <input type="hidden" name="time" id="input_time">

    <div class="booking-pane active" id="step-1">
      <div class="booking-card">
        <h3 class="booking-card__title">Bước 1: Hình thức khám & Chuyên khoa</h3>
        
        <div class="form-group" style="margin-bottom: 2.5rem;">
          <label style="font-size:15px; font-weight:600; margin-bottom:1rem; display:block;">Hình thức khám <span style="color:#ef4444">*</span></label>
          <div class="type-options">
            <label class="type-option">
              <input type="radio" name="type" value="offline" checked>
              <div class="type-option__card">
                <i class="fa-solid fa-hospital"></i>
                <strong>Khám trực tiếp</strong>
                <p>Đến phòng khám theo lịch hẹn</p>
              </div>
            </label>
            <label class="type-option">
              <input type="radio" name="type" value="online">
              <div class="type-option__card">
                <i class="fa-solid fa-video"></i>
                <strong>Khám từ xa</strong>
                <p>Tư vấn trực tuyến qua Video</p>
              </div>
            </label>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label style="font-size:15px; font-weight:600; margin-bottom:1rem; display:block;">Chuyên khoa <span style="color:#ef4444">*</span></label>
          <div class="specialty-grid">
            <?php if ((true && ($_smarty_tpl->hasVariable('specialties') && null !== ($_smarty_tpl->getValue('specialties') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('specialties')) > 0) {?>
              <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('specialties'), 'spec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach0DoElse = false;
?>
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="<?php echo $_smarty_tpl->getValue('spec')['_id'];?>
" required>
                <div class="specialty-option__card">
                  <i class="<?php echo (($tmp = $_smarty_tpl->getValue('spec')['icon'] ?? null)===null||$tmp==='' ? 'fa-solid fa-stethoscope' ?? null : $tmp);?>
"></i>
                  <span class="spec-name"><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</span>
                </div>
              </label>
              <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
              <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array(array('id'=>'tm','name'=>'Tim mạch','icon'=>'fa-solid fa-heart-pulse'),array('id'=>'nk','name'=>'Nhi khoa','icon'=>'fa-solid fa-baby'),array('id'=>'dl','name'=>'Da liễu','icon'=>'fa-solid fa-hand-dots'),array('id'=>'nha','name'=>'Nha khoa','icon'=>'fa-solid fa-tooth'),array('id'=>'th','name'=>'Tiêu hóa','icon'=>'fa-solid fa-utensils'),array('id'=>'mat','name'=>'Mắt (Nhãn khoa)','icon'=>'fa-solid fa-eye'),array('id'=>'tk','name'=>'Thần kinh','icon'=>'fa-solid fa-brain'),array('id'=>'tmh','name'=>'Tai Mũi Họng','icon'=>'fa-solid fa-ear-listen'),array('id'=>'cxk','name'=>'Cơ xương khớp','icon'=>'fa-solid fa-bone')), 'spec');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach1DoElse = false;
?>
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="<?php echo $_smarty_tpl->getValue('spec')['id'];?>
" required>
                <div class="specialty-option__card">
                  <i class="<?php echo $_smarty_tpl->getValue('spec')['icon'];?>
"></i>
                  <span class="spec-name"><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</span>
                </div>
              </label>
              <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>
          </div>
        </div>

        <div style="text-align: right; margin-top: 2rem;">
          <button type="button" onclick="nextToStep2()" style="background-color: #0284c7; color: #fff; padding: 0.8rem 2rem; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; font-size: 1rem;">
            Tiếp theo <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="booking-pane" id="step-2" style="display: none;">
      <div style="margin-bottom: 1rem;">
        <button type="button" onclick="goToStep(1)" style="border:none; background:transparent; color:#0284c7; padding:0; font-weight:600; cursor:pointer;">
          <i class="fa-solid fa-arrow-left"></i> Quay lại chọn Chuyên khoa
        </button>
      </div>

      <div id="doctor-list-container">
        <?php if ((true && ($_smarty_tpl->hasVariable('doctors') && null !== ($_smarty_tpl->getValue('doctors') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('doctors')) > 0) {?>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach2DoElse = false;
?>
          <div class="bc-doctor-card">
            <div class="bc-doctor-left">
              <div class="bc-doctor-avatar">
                <img src="<?php echo (($tmp = $_smarty_tpl->getValue('doc')['avatar'] ?? null)===null||$tmp==='' ? 'https://ui-avatars.com/api/?name=Doctor' ?? null : $tmp);?>
" alt="Avatar">
              </div>
              <div class="bc-doctor-info">
                <h4><?php echo (($tmp = $_smarty_tpl->getValue('doc')['degree'] ?? null)===null||$tmp==='' ? 'Bác sĩ' ?? null : $tmp);?>
 <?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</h4>
                <p>Bác sĩ chuyên khoa <?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</p>
                <p>Khám cho người lớn và trẻ em trên 5 tuổi.</p>
                <div class="location"><i class="fa-solid fa-location-dot"></i> Hà Nội</div>
              </div>
            </div>
            <div class="bc-doctor-right">
              <select class="bc-date-select" id="date_picker_<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
">
                <option value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('today','%Y-%m-%d');?>
">Hôm nay - <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('today','%d/%m');?>
</option>
                <option value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('tomorrow','%Y-%m-%d');?>
">Ngày mai - <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('tomorrow','%d/%m');?>
</option>
                <option value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('+2 days','%Y-%m-%d');?>
">Ngày kia - <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('+2 days','%d/%m');?>
</option>
              </select>

              <div class="bc-schedule-heading"><i class="fa-solid fa-calendar-days"></i> LỊCH KHÁM</div>
              <div class="bc-time-grid">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('08:00 - 08:30','09:00 - 09:30','10:00 - 10:30','13:30 - 14:00','14:30 - 15:00','15:30 - 16:00'), 'slot');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('slot')->value) {
$foreach3DoElse = false;
?>
                <div class="bc-time-slot" onclick="selectTimeAndProceed('<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
', '<?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
', '<?php echo $_smarty_tpl->getValue('slot');?>
')"><?php echo $_smarty_tpl->getValue('slot');?>
</div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
              </div>
              <p class="bc-hint">Chọn <i class="fa-solid fa-hand-pointer"></i> và đặt (Phí đặt lịch 0đ)</p>

              <div class="bc-address-block">
                <div class="bc-address-info">
                  <h5>ĐỊA CHỈ KHÁM</h5>
                  <p style="font-weight:600;">Phòng khám Đa khoa MediCare</p>
                  <p>123 Đường ABC, Quận XYZ, Hà Nội</p>
                </div>
                <div class="bc-price-info">
                  <h5>GIÁ KHÁM:</h5>
                  <strong>500.000đ</strong>
                </div>
              </div>
            </div>
          </div>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <?php } else { ?>
          <div class="bc-doctor-card">
            <div class="bc-doctor-left">
              <div class="bc-doctor-avatar"><img src="https://ui-avatars.com/api/?name=Nguyen+Van+A&background=0284c7&color=fff" alt="Avatar"></div>
              <div class="bc-doctor-info">
                <h4>BS. Nguyễn Văn A (Mẫu)</h4>
                <p>Bác sĩ chuyên khoa</p>
                <div class="location"><i class="fa-solid fa-location-dot"></i> Hà Nội</div>
              </div>
            </div>
            <div class="bc-doctor-right">
              <select class="bc-date-select" id="date_picker_demo">
                <option value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('today','%Y-%m-%d');?>
">Hôm nay - <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')('today','%d/%m');?>
</option>
              </select>
              <div class="bc-schedule-heading"><i class="fa-solid fa-calendar-days"></i> LỊCH KHÁM</div>
              <div class="bc-time-grid">
                <div class="bc-time-slot" onclick="selectTimeAndProceed('doc_demo', 'BS. Nguyễn Văn A', '08:00 - 08:30')">08:00 - 08:30</div>
                <div class="bc-time-slot" onclick="selectTimeAndProceed('doc_demo', 'BS. Nguyễn Văn A', '09:00 - 09:30')">09:00 - 09:30</div>
              </div>
            </div>
          </div>
        <?php }?>
      </div>
    </div>

    <div class="booking-pane" id="step-3" style="display: none;">
      <div class="booking-card">
        <h3 class="booking-card__title">Bước 3: Xác nhận thông tin</h3>
        
        <div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 5px;">
              <span style="color: #64748b;">Hình thức:</span><strong id="conf-type">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 5px;">
              <span style="color: #64748b;">Chuyên khoa:</span><strong id="conf-specialty">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 5px;">
              <span style="color: #64748b;">Bác sĩ:</span><strong id="conf-doctor" style="color: #0284c7;">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
              <span style="color: #64748b;">Thời gian khám:</span>
              <strong style="color: #10b981;"><span id="conf-time"></span>, ngày <span id="conf-date"></span></strong>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label style="font-weight:600; margin-bottom:5px; display:block;">Lý do khám (Triệu chứng)</label>
          <textarea name="symptoms" rows="3" placeholder="Ghi chú chi tiết để bác sĩ chuẩn bị trước..." style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 2rem;">
          <button type="button" onclick="goToStep(2)" style="padding: 0.8rem 1.5rem; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer; color: #475569; font-weight: 600;">
            <i class="fa-solid fa-arrow-left"></i> Chọn lại Giờ/Bác sĩ
          </button>
          <button type="submit" style="padding: 0.8rem 2rem; border-radius: 8px; background-color: #10b981; border: none; color: white; font-weight: 600; cursor: pointer;">
            Xác nhận Đặt lịch <i class="fa-solid fa-check"></i>
          </button>
        </div>
      </div>
    </div>

  </form>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>

  function nextToStep2() {
    if (!document.querySelector('input[name="specialty_id"]:checked')) {
      alert('Vui lòng chọn Chuyên khoa để tiếp tục.');
      return;
    }
    goToStep(2);
  }

  function selectTimeAndProceed(doctorId, doctorName, timeStr) {
    const dateSelect = document.getElementById('date_picker_' + doctorId);
    const selectedDate = dateSelect.value;

    document.getElementById('input_doctor_id').value = doctorId;
    document.getElementById('input_doctor_name').value = doctorName;
    document.getElementById('input_date').value = selectedDate;
    document.getElementById('input_time').value = timeStr;

    const type = document.querySelector('input[name="type"]:checked').value;
    document.getElementById('conf-type').textContent = (type === 'online') ? 'Khám từ xa (Video)' : 'Khám trực tiếp';
    
    const specCard = document.querySelector('input[name="specialty_id"]:checked').nextElementSibling;
    document.getElementById('conf-specialty').textContent = specCard.querySelector('.spec-name').textContent;
    
    document.getElementById('conf-doctor').textContent = doctorName;
    
    const d = new Date(selectedDate);
    document.getElementById('conf-date').textContent = `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
    document.getElementById('conf-time').textContent = timeStr;

    goToStep(3);
  }

  function goToStep(n) {
    document.querySelectorAll('.booking-pane').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.booking-step').forEach((s, i) => {
      s.classList.toggle('active', i + 1 === n);
      s.classList.toggle('done', i + 1 < n); 
    }); 
    
    const targetPane = document.getElementById('step-' + n); 
    if(targetPane) {
      targetPane.style.display = 'block';
    }
    window.scrollTo({ top: 0, behavior: 'smooth' }); 
  } 

<?php echo '</script'; ?>
><?php }
}

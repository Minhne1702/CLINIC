<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:16:45
  from 'file:patient/book.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4bd6d6fafc0_55930639',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc62c24920c16e60da2f8a2acba5d94dfa12b670' => 
    array (
      0 => 'patient/book.tpl',
      1 => 1775549781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4bd6d6fafc0_55930639 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đặt lịch khám",'active_page'=>"book"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám</h2>
    <p class="page-subtitle">Chọn chuyên khoa, bác sĩ và thời gian phù hợp với bạn</p>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?>
<div class="alert alert--success">
  <i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>

  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" style="font-weight:600;margin-left:.5rem">Xem lịch hẹn →</a>
</div>
<?php }
if ($_smarty_tpl->getValue('error_message')) {?>
<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div>
<?php }?>

<div class="booking-steps">
  <div class="booking-step active" id="step-ind-1"><span>1</span> Hình thức & Chuyên khoa</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-2"><span>2</span> Chọn bác sĩ</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-3"><span>3</span> Ngày & Giờ</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-4"><span>4</span> Xác nhận</div>
</div>

<form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" method="POST" id="bookingForm">
  <input type="hidden" name="action" value="submit">

  <!-- STEP 1 -->
  <div class="booking-pane active" id="step-1">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 1: Hình thức khám & Chuyên khoa</h3></div>
      <div class="admin-card__body">
        <div class="form-group">
          <label style="font-size:14px;font-weight:600;margin-bottom:.75rem;display:block">Hình thức khám <span class="required">*</span></label>
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
                <p>Tư vấn qua video call</p>
              </div>
            </label>
          </div>
        </div>

        <div class="form-group" style="margin-top:2rem">
          <label style="font-size:14px;font-weight:600;margin-bottom:.75rem;display:block">Chuyên khoa <span class="required">*</span></label>
          <div class="specialty-grid">
            <?php if ($_smarty_tpl->getValue('specialties')) {?>
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
                  <span><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</span>
                </div>
              </label>
              <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
              <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('Tim mạch','Nhi khoa','Da liễu','Nha khoa','Thần kinh','Tiêu hóa','Mắt','Tai Mũi Họng','Cơ xương khớp','Nội tiết','Phụ khoa','Sức khỏe tâm thần'), 'sname', false, 'sidx');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('sidx')->value => $_smarty_tpl->getVariable('sname')->value) {
$foreach1DoElse = false;
?>
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="<?php echo $_smarty_tpl->getValue('sidx');?>
">
                <div class="specialty-option__card">
                  <i class="fa-solid fa-stethoscope"></i>
                  <span><?php echo $_smarty_tpl->getValue('sname');?>
</span>
                </div>
              </label>
              <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>
          </div>
        </div>

        <div class="booking-nav">
          <span></span>
          <button type="button" class="btn-admin-primary" onclick="nextStep(1)">
            Tiếp theo <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 2 -->
  <div class="booking-pane" id="step-2">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 2: Chọn bác sĩ</h3></div>
      <div class="admin-card__body">
        <div class="doctor-picker-grid">
          <?php if ($_smarty_tpl->getValue('doctors')) {?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doc');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doc')->value) {
$foreach2DoElse = false;
?>
            <label class="doctor-picker-card">
              <input type="radio" name="doctor_id" value="<?php echo $_smarty_tpl->getValue('doc')['_id'];?>
">
              <div class="doctor-picker-card__inner">
                <div class="doctor-picker-card__avatar">
                  <?php if ($_smarty_tpl->getValue('doc')['avatar']) {?><img src="<?php echo $_smarty_tpl->getValue('doc')['avatar'];?>
" alt="">
                  <?php } else { ?><i class="fa-solid fa-user-doctor"></i><?php }?>
                </div>
                <div class="doctor-picker-card__info">
                  <strong><?php echo $_smarty_tpl->getValue('doc')['full_name'];?>
</strong>
                  <p><?php echo (($tmp = $_smarty_tpl->getValue('doc')['degree'] ?? null)===null||$tmp==='' ? 'Bác sĩ' ?? null : $tmp);?>
</p>
                  <p class="text-muted" style="font-size:12px"><?php echo $_smarty_tpl->getValue('doc')['specialty'];?>
</p>
                  <span class="badge badge--warning" style="font-size:11px"><i class="fa-solid fa-star"></i> <?php echo (($tmp = $_smarty_tpl->getValue('doc')['rating'] ?? null)===null||$tmp==='' ? '5.0' ?? null : $tmp);?>
 (<?php echo (($tmp = $_smarty_tpl->getValue('doc')['review_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</span>
                </div>
              </div>
            </label>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
            <div class="empty-state" style="padding:2rem;grid-column:1/-1">
              <i class="fa-solid fa-user-doctor"></i>
              <p>Vui lòng chọn chuyên khoa ở bước 1 để xem danh sách bác sĩ</p>
            </div>
          <?php }?>
        </div>
        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(2)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="button" class="btn-admin-primary" onclick="nextStep(2)">Tiếp theo <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 3 -->
  <div class="booking-pane" id="step-3">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 3: Chọn ngày & giờ khám</h3></div>
      <div class="admin-card__body">
        <div class="form-row-2">
          <div class="form-group">
            <label>Ngày khám <span class="required">*</span></label>
            <input type="date" name="date" id="bookDate" required
              min="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),'%Y-%m-%d');?>
">
          </div>
          <div class="form-group">
            <label>Triệu chứng ban đầu <span class="text-muted" style="font-weight:400">(không bắt buộc)</span></label>
            <input type="text" name="note_brief" placeholder="VD: Đau đầu, sốt nhẹ 2 ngày...">
          </div>
        </div>

        <div class="form-group" style="margin-top:1rem">
          <label>Chọn khung giờ <span class="required">*</span></label>
          <div class="timeslot-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30'), 'slot');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('slot')->value) {
$foreach3DoElse = false;
?>
            <label class="timeslot">
              <input type="radio" name="time" value="<?php echo $_smarty_tpl->getValue('slot');?>
" required>
              <span><?php echo $_smarty_tpl->getValue('slot');?>
</span>
            </label>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </div>
        </div>

        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(3)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="button" class="btn-admin-primary" onclick="nextStep(3)">Tiếp theo <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 4 -->
  <div class="booking-pane" id="step-4">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 4: Xác nhận thông tin đặt lịch</h3></div>
      <div class="admin-card__body">

        <div class="confirm-summary">
          <div class="confirm-row"><span>Hình thức:</span><strong id="conf-type">—</strong></div>
          <div class="confirm-row"><span>Chuyên khoa:</span><strong id="conf-specialty">—</strong></div>
          <div class="confirm-row"><span>Bác sĩ:</span><strong id="conf-doctor">—</strong></div>
          <div class="confirm-row"><span>Ngày khám:</span><strong id="conf-date">—</strong></div>
          <div class="confirm-row"><span>Giờ khám:</span><strong id="conf-time">—</strong></div>
        </div>

        <div class="form-group" style="margin-top:1.5rem">
          <label>Mô tả triệu chứng chi tiết</label>
          <textarea name="symptoms" rows="4" placeholder="Mô tả chi tiết triệu chứng để bác sĩ chuẩn bị trước (không bắt buộc)..."></textarea>
        </div>

        <div class="alert alert--warning" style="margin-top:1rem">
          <i class="fa-solid fa-triangle-exclamation"></i>
          Vui lòng đến trước giờ hẹn <strong>15 phút</strong>.
          Mang theo CCCD và thẻ BHYT (nếu có).
          Có thể hủy lịch trước <strong>2 tiếng</strong>.
        </div>

        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(4)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-circle-check"></i> Xác nhận đặt lịch
          </button>
        </div>
      </div>
    </div>
  </div>

</form>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

< <?php echo '<script'; ?>
>
    function nextStep(from) {
    if (from === 1 && !document.querySelector('input[name="specialty_id"]:checked')) {
    alert('Vui lòng chọn chuyên khoa'); return;
    }
    if (from === 2 && !document.querySelector('input[name="doctor_id"]:checked')) {
    alert('Vui lòng chọn bác sĩ'); return;
    }
    if (from === 3) {
    if (!document.getElementById('bookDate').value) { alert('Vui lòng chọn ngày khám'); return; }
    if (!document.querySelector('input[name="time"]:checked')) { alert('Vui lòng chọn giờ khám'); return; }
    updateSummary();
    }
    goToStep(from + 1);
    }

    function prevStep(from) { goToStep(from - 1); }

    function goToStep(n) {
    document.querySelectorAll('.booking-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.booking-step').forEach((s, i) => {
    s.classList.toggle('active', i + 1 === n);
    s.classList.toggle('done', i + 1 < n); }); const targetPane=document.getElementById('step-' + n); if(targetPane)
      targetPane.classList.add('active'); window.scrollTo({ top: 0, behavior: 'smooth' }); } function updateSummary() {
      const type=document.querySelector('input[name="type" ]:checked'); const
      spec=document.querySelector('input[name="specialty_id" ]:checked'); const
      doc=document.querySelector('input[name="doctor_id" ]:checked'); const date=document.getElementById('bookDate');
      const time=document.querySelector('input[name="time" ]:checked');
      document.getElementById('conf-type').textContent=type ? (type.value==='online' ? 'Khám từ xa (Video)'
      : 'Khám trực tiếp' ) : '—' ; document.getElementById('conf-specialty').textContent=spec ?
      (spec.closest('label').querySelector('span')?.textContent || '—' ) : '—' ;
      document.getElementById('conf-doctor').textContent=doc ? (doc.closest('label').querySelector('strong')?.textContent
      || '—' ) : '—' ; document.getElementById('conf-date').textContent=date.value || '—' ;
      document.getElementById('conf-time').textContent=time ? time.value : '—' ; } document.querySelectorAll('.type-option
    input, .specialty-option input, .doctor-picker-card input, .timeslot input').forEach(input=> {
      input.addEventListener('change', function() {
      // Đoạn này chính là chỗ gây lỗi Fatal error nếu không có {literal}
        document.querySelectorAll(`input[name="${this.name}"]`).forEach(i => {
            const label = i.closest('label');
            if(label) label.classList.remove('selected');
        });
        this.closest('label').classList.add('selected');
        });
        });
        <?php echo '</script'; ?>
>
  {/literal}

<?php }
}

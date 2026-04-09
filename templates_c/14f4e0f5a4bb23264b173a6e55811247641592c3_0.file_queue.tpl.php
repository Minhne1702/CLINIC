<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:23:58
  from 'file:doctor/queue.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7621e212d60_98482914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14f4e0f5a4bb23264b173a6e55811247641592c3' => 
    array (
      0 => 'doctor/queue.tpl',
      1 => 1775718359,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d7621e212d60_98482914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\doctor';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Hàng chờ khám",'active_page'=>"queue"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-list-ol"></i> Hàng chờ khám</h2>
    <p class="page-subtitle">Danh sách bệnh nhân chờ khám hôm nay — <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d/%m/%Y");?>
</p>
  </div>
  <div class="page-toolbar__right">
    <div class="filter-bar__group">
      <select class="select-sm" onchange="filterQueue(this.value)">
        <option value="all">Tất cả</option>
        <option value="waiting">Chờ khám</option>
        <option value="in_progress">Đang khám</option>
        <option value="done">Đã khám</option>
      </select>
    </div>
  </div>
</div>

<div class="queue-board">
  
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--waiting">
      <i class="fa-solid fa-clock"></i> Chờ khám
      <span class="tab-count tab-count--warning" id="cnt-waiting"><?php echo (($tmp = $_smarty_tpl->getValue('count')['waiting'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
    </div>
    <div class="queue-col__body" id="col-waiting">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('queue'), 'q');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('q')->value) {
$foreach0DoElse = false;
?>
        <?php if ($_smarty_tpl->getValue('q')['status'] == 'waiting') {?>
        <div class="queue-card queue-card--<?php echo (($tmp = $_smarty_tpl->getValue('q')['priority'] ?? null)===null||$tmp==='' ? 'normal' ?? null : $tmp);?>
" data-status="waiting">
          <div class="queue-card__num"><?php echo $_smarty_tpl->getValue('q')['queue_no'];?>
</div>
          <div class="queue-card__info">
            <strong><?php echo $_smarty_tpl->getValue('q')['patient_name'];?>
</strong>
            <p><?php echo $_smarty_tpl->getValue('q')['patient_code'];?>
 &nbsp;·&nbsp; <?php if ($_smarty_tpl->getValue('q')['gender'] == 'male') {?>Nam<?php } else { ?>Nữ<?php }?>, <?php echo (($tmp = $_smarty_tpl->getValue('q')['age'] ?? null)===null||$tmp==='' ? '?' ?? null : $tmp);?>
 tuổi</p>
            <p style="font-size:12px;color:var(--admin-text-muted)"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('q')['symptoms'],50,'...') ?? null)===null||$tmp==='' ? 'Không ghi triệu chứng' ?? null : $tmp);?>
</p>
            
            <?php if ($_smarty_tpl->getValue('q')['priority'] == 'emergency') {?>
              <span class="badge badge--danger" style="font-size:11px"><i class="fa-solid fa-bolt"></i> Cấp cứu</span>
            <?php } elseif ($_smarty_tpl->getValue('q')['priority'] == 'elderly') {?>
              <span class="badge badge--orange" style="font-size:11px">NCT</span>
            <?php } elseif ($_smarty_tpl->getValue('q')['priority'] == 'child') {?>
              <span class="badge badge--blue" style="font-size:11px">Trẻ em</span>
            <?php }?>
          </div>
          <div class="queue-card__actions">
            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=examination&patient_id=<?php echo $_smarty_tpl->getValue('q')['patient_id'];?>
&queue_id=<?php echo $_smarty_tpl->getValue('q')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.4rem .85rem;white-space:nowrap">
              <i class="fa-solid fa-stethoscope"></i> Khám ngay
            </a>
          </div>
        </div>
        <?php }?>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      
      <?php if ((($tmp = $_smarty_tpl->getValue('count')['waiting'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 0) {?>
        <div class="empty-state" style="padding:2rem"><i class="fa-solid fa-couch"></i><p>Hàng chờ trống</p></div>
      <?php }?>
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--progress">
      <i class="fa-solid fa-stethoscope"></i> Đang khám
      <span class="tab-count tab-count--blue" id="cnt-progress"><?php echo (($tmp = $_smarty_tpl->getValue('count')['in_progress'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
    </div>
    <div class="queue-col__body" id="col-progress">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('queue'), 'q');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('q')->value) {
$foreach1DoElse = false;
?>
        <?php if ($_smarty_tpl->getValue('q')['status'] == 'in_progress') {?>
        <div class="queue-card queue-card--active" data-status="in_progress">
          <div class="queue-card__num" style="background:rgba(8,145,178,.15);color:var(--admin-primary)"><?php echo $_smarty_tpl->getValue('q')['queue_no'];?>
</div>
          <div class="queue-card__info">
            <strong><?php echo $_smarty_tpl->getValue('q')['patient_name'];?>
</strong>
            <p><?php echo $_smarty_tpl->getValue('q')['patient_code'];?>
</p>
            <p style="font-size:12px;color:var(--admin-primary)"><i class="fa-solid fa-clock"></i> Bắt đầu: <?php echo (($tmp = $_smarty_tpl->getValue('q')['start_time'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
          </div>
          <div class="queue-card__actions">
            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=examination&patient_id=<?php echo $_smarty_tpl->getValue('q')['patient_id'];?>
&queue_id=<?php echo $_smarty_tpl->getValue('q')['_id'];?>
" class="btn-admin-secondary" style="font-size:12px;padding:.4rem .85rem">
              <i class="fa-solid fa-notes-medical"></i> Tiếp tục
            </a>
          </div>
        </div>
        <?php }?>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      
      <?php if ((($tmp = $_smarty_tpl->getValue('count')['in_progress'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 0) {?>
        <div class="empty-state" style="padding:2rem"><i class="fa-solid fa-stethoscope"></i><p>Không có ca khám</p></div>
      <?php }?>
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--done">
      <i class="fa-solid fa-circle-check"></i> Đã khám
      <span class="tab-count tab-count--success" id="cnt-done"><?php echo (($tmp = $_smarty_tpl->getValue('count')['done'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</span>
    </div>
    <div class="queue-col__body" id="col-done">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('queue'), 'q');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('q')->value) {
$foreach2DoElse = false;
?>
        <?php if ($_smarty_tpl->getValue('q')['status'] == 'done') {?>
        <div class="queue-card queue-card--done" data-status="done">
          <div class="queue-card__num" style="background:rgba(16,185,129,.1);color:var(--admin-success)"><?php echo $_smarty_tpl->getValue('q')['queue_no'];?>
</div>
          <div class="queue-card__info">
            <strong><?php echo $_smarty_tpl->getValue('q')['patient_name'];?>
</strong>
            <p style="font-size:12px;color:var(--admin-text-muted)"><?php echo $_smarty_tpl->getValue('q')['patient_code'];?>
 · Xong lúc <?php echo (($tmp = $_smarty_tpl->getValue('q')['end_time'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
          </div>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=records&patient_id=<?php echo $_smarty_tpl->getValue('q')['patient_id'];?>
" class="action-btn" title="Xem hồ sơ">
            <i class="fa-solid fa-eye"></i>
          </a>
        </div>
        <?php }?>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      
      <?php if ((($tmp = $_smarty_tpl->getValue('count')['done'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp) == 0) {?>
        <div class="empty-state" style="padding:2rem"><i class="fa-solid fa-check-double"></i><p>Chưa có ca hoàn tất</p></div>
      <?php }?>
    </div>
  </div>

</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>
function filterQueue(status) {
    const cards = document.querySelectorAll('.queue-card');
    cards.forEach(card => {
        // Lấy trạng thái của từng thẻ từ thuộc tính data-status
        const cardStatus = card.getAttribute('data-status');
        
        // Nếu chọn 'all' hoặc trạng thái khớp với giá trị chọn thì hiện, ngược lại ẩn
        if (status === 'all' || cardStatus === status) {
            card.style.display = 'flex'; // Dùng flex để giữ nguyên layout grid/flex của thẻ
        } else {
            card.style.display = 'none';
        }
    });
}
<?php echo '</script'; ?>
><?php }
}

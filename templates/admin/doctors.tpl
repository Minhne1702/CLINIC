{include file="layout/sidebar.tpl" page_title="Quản lý bác sĩ" active_page="doctors"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-user-doctor"></i> Danh sách bác sĩ</h2>
    <p class="page-subtitle">Quản lý hồ sơ và lịch làm việc của bác sĩ</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=admin&page=doctors&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm bác sĩ
    </a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$BASE_URL}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="doctors">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bác sĩ, mã BS..." value="{$filter.q|default:''}">
        </div>
        <select name="specialty">
          <option value="">Tất cả chuyên khoa</option>
          {foreach from=$specialties item=spec}
          <option value="{$spec._id}" {if $filter.specialty == $spec._id}selected{/if}>{$spec.name}</option>
          {/foreach}
        </select>
        <select name="status">
          <option value="">Tất cả</option>
          <option value="active"   {if $filter.status == 'active'}selected{/if}>Đang làm</option>
          <option value="inactive" {if $filter.status == 'inactive'}selected{/if}>Nghỉ việc</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Bác sĩ</th>
          <th>Chuyên khoa</th>
          <th>Bằng cấp</th>
          <th>SĐT</th>
          <th>Lịch làm việc</th>
          <th>Đánh giá</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$doctors item=doc}
        <tr>
          <td>
            <div class="table-user">
              <div class="table-avatar table-avatar--img">
                {if $doc.avatar}<img src="{$doc.avatar}" alt="">{else}{$doc.full_name|truncate:1:""}{/if}
              </div>
              <div>
                <strong>{$doc.full_name}</strong>
                <small>#{$doc.doctor_code|default:'—'}</small>
              </div>
            </div>
          </td>
          <td>{$doc.specialty}</td>
          <td>{$doc.degree}</td>
          <td>{$doc.phone|default:'—'}</td>
          <td><span class="text-muted" style="font-size:12px">{$doc.schedule|default:'Chưa cấu hình'}</span></td>
          <td>
            <span class="text-warning"><i class="fa-solid fa-star" style="font-size:12px"></i> {$doc.rating|default:'5.0'}</span>
            <small class="text-muted">({$doc.review_count|default:0})</small>
          </td>
          <td>
            {if $doc.is_active}
              <span class="badge badge--success">Hoạt động</span>
            {else}
              <span class="badge badge--danger">Nghỉ</span>
            {/if}
          </td>
          <td>
            <div class="table-actions">
              <a href="{$BASE_URL}/?role=admin&page=doctors&action=view&id={$doc._id}" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=doctors&action=edit&id={$doc._id}" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=doctors&action=schedule&id={$doc._id}" class="action-btn" title="Lịch làm"><i class="fa-regular fa-calendar"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=doctors&action=delete&id={$doc._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bác sĩ này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="8" class="table-empty">Chưa có bác sĩ nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

{include file="layout/footer.tpl"}

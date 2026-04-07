{include file="layout/sidebar.tpl" page_title="Quản lý bệnh nhân" active_page="patients"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-hospital-user"></i> Danh sách bệnh nhân</h2>
    <p class="page-subtitle">Quản lý hồ sơ bệnh nhân (EMR)</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$base_url}/?role=admin&page=patients&action=create" class="btn-admin-primary">
      <i class="fa-solid fa-plus"></i> Thêm bệnh nhân
    </a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$base_url}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="patients">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên, CCCD, SĐT, mã BN..." value="{$filter.q|default:''}">
        </div>
        <select name="gender">
          <option value="">Tất cả giới tính</option>
          <option value="male"   {if $filter.gender == 'male'}selected{/if}>Nam</option>
          <option value="female" {if $filter.gender == 'female'}selected{/if}>Nữ</option>
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
        <a href="{$base_url}/?role=admin&page=patients" class="btn-admin-ghost">Xóa lọc</a>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã BN</th>
          <th>Bệnh nhân</th>
          <th>Ngày sinh</th>
          <th>Giới tính</th>
          <th>CCCD</th>
          <th>SĐT</th>
          <th>BHYT</th>
          <th>Lần khám gần nhất</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$patients item=p}
        <tr>
          <td><span class="code-tag">{$p.patient_code}</span></td>
          <td>
            <div class="table-user">
              <div class="table-avatar">{$p.full_name|truncate:1:""}</div>
              <div>
                <strong>{$p.full_name}</strong>
                <small>{$p.email|default:'—'}</small>
              </div>
            </div>
          </td>
          <td>{$p.birthday|date_format:"%d/%m/%Y"|default:'—'}</td>
          <td>{if $p.gender == 'male'}Nam{elseif $p.gender == 'female'}Nữ{else}Khác{/if}</td>
          <td>{$p.cccd|default:'—'}</td>
          <td>{$p.phone|default:'—'}</td>
          <td>
            {if $p.bhyt}
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có</span>
            {else}
              <span class="badge badge--neutral">Không</span>
            {/if}
          </td>
          <td>{$p.last_visit|date_format:"%d/%m/%Y"|default:'Chưa khám'}</td>
          <td>
            <div class="table-actions">
              <a href="{$base_url}/?role=admin&page=patients&action=view&id={$p._id}" class="action-btn" title="Xem hồ sơ"><i class="fa-solid fa-folder-open"></i></a>
              <a href="{$base_url}/?role=admin&page=patients&action=edit&id={$p._id}" class="action-btn" title="Sửa"><i class="fa-solid fa-pen"></i></a>
              <a href="{$base_url}/?role=admin&page=patients&action=history&id={$p._id}" class="action-btn" title="Lịch sử khám"><i class="fa-solid fa-clock-rotate-left"></i></a>
              <a href="{$base_url}/?role=admin&page=patients&action=delete&id={$p._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bệnh nhân này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="9" class="table-empty">Chưa có bệnh nhân nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

{include file="layout/footer.tpl"}

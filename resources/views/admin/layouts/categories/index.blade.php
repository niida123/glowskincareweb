@extends('adminlte::page')

@section('title', 'Categories Management')

@section('content_header')
    <div class="cm-page-header">
        <div class="cm-page-header-left">
            <div class="cm-page-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div>
                <h1 class="cm-page-title">Categories</h1>
                <p class="cm-page-sub">Manage your product categories</p>
            </div>
        </div>
        <button class="cm-btn cm-btn-primary" id="btnAdd">
            <i class="fas fa-plus"></i> Add Category
        </button>
    </div>
@stop

@section('css')
<style>
    /* ── VARIABLES ── */
    :root {
        --cm-accent:      #7970ac;
        --cm-accent-light:#f0eeff;
        --cm-accent-dark: #5f57a0;
        --cm-surface:     #ffffff;
        --cm-bg:          #f5f6fa;
        --cm-border:      #e8ecf2;
        --cm-text:        #1a1d2e;
        --cm-text2:       #64748b;
        --cm-text3:       #a0aec0;
        --cm-green:       #10b981;
        --cm-red:         #ef4444;
        --cm-yellow:      #f59e0b;
        --cm-radius:      12px;
        --cm-radius-sm:   8px;
        --cm-shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
    }

    /* ── PAGE HEADER ── */
    .cm-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 0 8px;
    }
    .cm-page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .cm-page-icon {
        width: 46px; height: 46px;
        background: var(--cm-accent-light);
        color: var(--cm-accent);
        border-radius: var(--cm-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .cm-page-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--cm-text) !important;
        margin: 0 !important;
        line-height: 1.2;
    }
    .cm-page-sub {
        font-size: 12.5px;
        color: var(--cm-text2);
        margin: 2px 0 0;
    }

    /* ── BUTTONS ── */
    .cm-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: var(--cm-radius-sm);
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .cm-btn-primary {
        background: var(--cm-accent);
        color: #fff;
        box-shadow: 0 4px 14px rgba(121,112,172,.35);
    }
    .cm-btn-primary:hover {
        background: var(--cm-accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(121,112,172,.45);
        color: #fff;
    }
    .cm-btn-ghost {
        background: var(--cm-bg);
        color: var(--cm-text2);
        border: 1px solid var(--cm-border);
    }
    .cm-btn-ghost:hover {
        background: var(--cm-border);
        color: var(--cm-text);
    }

    /* ── CARD ── */
    .cm-card {
        background: var(--cm-surface);
        border: 1px solid var(--cm-border);
        border-radius: var(--cm-radius);
        box-shadow: var(--cm-shadow);
        overflow: hidden;
        margin-bottom: 0;
    }
    .cm-card-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--cm-border);
        gap: 12px;
        flex-wrap: wrap;
    }
    .cm-toolbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ── SEARCH ── */
    .cm-search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--cm-bg);
        border: 1px solid var(--cm-border);
        border-radius: var(--cm-radius-sm);
        padding: 7px 13px;
        width: 220px;
        transition: border-color .15s;
    }
    .cm-search-wrap:focus-within {
        border-color: var(--cm-accent);
        background: #fff;
    }
    .cm-search-wrap input {
        border: none; background: none; outline: none;
        font-size: 13px;
        color: var(--cm-text);
        width: 100%;
        font-family: inherit;
    }
    .cm-search-wrap input::placeholder { color: var(--cm-text3); }
    .cm-search-wrap i { color: var(--cm-text3); font-size: 13px; }

    .cm-count-badge {
        background: var(--cm-accent-light);
        color: var(--cm-accent);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* ── TABLE ── */
    .cm-table-wrap { overflow-x: auto; }
    .cm-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }
    .cm-table thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--cm-text3);
        background: #fafbfc;
        border-bottom: 1px solid var(--cm-border);
        white-space: nowrap;
    }
    .cm-table tbody tr {
        border-bottom: 1px solid #f4f5f8;
        transition: background .15s;
    }
    .cm-table tbody tr:last-child { border-bottom: none; }
    .cm-table tbody tr:hover { background: #fafbff; }
    .cm-table tbody td {
        padding: 12px 16px;
        color: var(--cm-text);
        vertical-align: middle;
    }

    /* ── ROW NUMBER ── */
    .cm-row-num { font-size: 12px; color: var(--cm-text3); font-weight: 600; }

    /* ── BADGES ── */
    .cm-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .cm-badge-cyan { background: var(--cm-accent-light); color: var(--cm-accent); }
    .cm-badge-gray { background: #f1f3f7; color: #64748b; }

    /* ── CATEGORY NAME CELL ── */
    .cm-category-cell { display: flex; align-items: center; gap: 10px; }
    .cm-category-icon {
        width: 34px; height: 34px;
        background: var(--cm-accent-light);
        color: var(--cm-accent);
        border-radius: var(--cm-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }
    .cm-category-name { font-weight: 600; color: var(--cm-text); font-size: 13.5px; }
    .cm-category-desc { font-size: 11.5px; color: var(--cm-text3); margin-top: 2px; }

    /* ── ACTION BUTTONS ── */
    .cm-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }
    .cm-action-btn {
        width: 32px; height: 32px;
        border-radius: var(--cm-radius-sm);
        border: 1px solid var(--cm-border);
        background: var(--cm-bg);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: all .15s;
        color: var(--cm-text2);
    }
    .cm-action-btn:hover { transform: translateY(-1px); }
    .cm-action-btn.edit:hover { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
    .cm-action-btn.del:hover  { background: #fef2f2; border-color: #fca5a5; color: var(--cm-red); }

    /* ── EMPTY STATE ── */
    .cm-empty {
        text-align: center;
        padding: 52px 20px !important;
        color: var(--cm-text3);
    }
    .cm-empty-icon { font-size: 42px; margin-bottom: 12px; opacity: .3; }
    .cm-empty p { font-size: 14px; color: var(--cm-text2); margin: 4px 0 0; }

    /* ── FOOTER ── */
    .cm-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--cm-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .cm-footer-info { font-size: 12.5px; color: var(--cm-text3); }
    .cm-footer .pagination { margin: 0; }
    .cm-footer .page-link {
        border-radius: var(--cm-radius-sm) !important;
        border: 1px solid var(--cm-border);
        color: var(--cm-text2);
        font-size: 12.5px;
        padding: 5px 11px;
        margin: 0 2px;
        transition: all .15s;
    }
    .cm-footer .page-item.active .page-link {
        background: var(--cm-accent) !important;
        border-color: var(--cm-accent) !important;
        color: #fff !important;
    }
    .cm-footer .page-link:hover {
        background: var(--cm-accent-light);
        color: var(--cm-accent);
        border-color: var(--cm-accent);
    }

    /* ── MODAL ── */
    .cm-modal .modal-content {
        border: none;
        border-radius: var(--cm-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,.18);
        overflow: hidden;
    }
    .cm-modal .modal-header {
        background: var(--cm-accent);
        padding: 18px 22px;
        border: none;
    }
    .cm-modal .modal-title-text {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cm-modal .modal-title-icon {
        width: 32px; height: 32px;
        background: rgba(255,255,255,.18);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }
    .cm-modal .close {
        color: rgba(255,255,255,.75);
        font-size: 20px;
        opacity: 1;
        text-shadow: none;
        transition: color .15s;
    }
    .cm-modal .close:hover { color: #fff; }
    .cm-modal .modal-body { padding: 24px; background: #fff; }
    .cm-modal .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--cm-border);
        background: #fafbfc;
        gap: 8px;
    }

    /* ── FORM ── */
    .cm-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .cm-form-group:last-child { margin-bottom: 0; }
    .cm-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--cm-text2);
        letter-spacing: .3px;
    }
    .cm-label .req { color: var(--cm-red); margin-left: 2px; }
    .cm-input {
        padding: 9px 13px;
        border: 1.5px solid var(--cm-border);
        border-radius: var(--cm-radius-sm);
        font-size: 13.5px;
        color: var(--cm-text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
        font-family: inherit;
        background: #fff;
    }
    .cm-input:focus {
        border-color: var(--cm-accent);
        box-shadow: 0 0 0 3px rgba(121,112,172,.12);
    }
    .cm-input.is-invalid {
        border-color: var(--cm-red);
        box-shadow: 0 0 0 3px rgba(239,68,68,.10);
    }
    .cm-error {
        font-size: 11.5px;
        color: var(--cm-red);
        display: none;
    }
    .cm-error.show { display: block; }

    /* ── TOAST ── */
    .cm-toast-container {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }
    .cm-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--cm-text);
        color: #fff;
        padding: 13px 18px;
        border-radius: var(--cm-radius-sm);
        font-size: 13.5px;
        font-weight: 500;
        min-width: 240px;
        max-width: 340px;
        box-shadow: 0 8px 32px rgba(0,0,0,.22);
        pointer-events: all;
        animation: cm-toast-in .3s cubic-bezier(.34,1.56,.64,1) forwards;
        border-left: 4px solid transparent;
    }
    .cm-toast.success { border-left-color: var(--cm-green); }
    .cm-toast.error   { border-left-color: var(--cm-red); }
    .cm-toast.info    { border-left-color: var(--cm-accent); }
    .cm-toast.warning { border-left-color: var(--cm-yellow); }
    .cm-toast-icon { font-size: 16px; flex-shrink: 0; }
    .cm-toast.success .cm-toast-icon { color: var(--cm-green); }
    .cm-toast.error   .cm-toast-icon { color: var(--cm-red); }
    .cm-toast.info    .cm-toast-icon { color: var(--cm-accent); }
    .cm-toast.warning .cm-toast-icon { color: var(--cm-yellow); }
    .cm-toast-msg { flex: 1; }
    .cm-toast-close {
        background: none; border: none; color: rgba(255,255,255,.5);
        font-size: 14px; cursor: pointer; padding: 0; transition: color .15s;
    }
    .cm-toast-close:hover { color: #fff; }
    .cm-toast.leaving { animation: cm-toast-out .25s ease forwards; }

    @keyframes cm-toast-in {
        from { opacity: 0; transform: translateX(32px) scale(.96); }
        to   { opacity: 1; transform: translateX(0)   scale(1); }
    }
    @keyframes cm-toast-out {
        from { opacity: 1; transform: translateX(0)   scale(1); }
        to   { opacity: 0; transform: translateX(32px) scale(.96); }
    }

    @media (max-width: 640px) {
        .cm-search-wrap { width: 160px; }
    }
</style>
@stop

@section('content')

<div class="cm-card">

    {{-- TOOLBAR --}}
    <div class="cm-card-toolbar">
        <div class="cm-toolbar-left">
            <div class="cm-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search categories…">
            </div>
            <span class="cm-count-badge" id="categoryCount">— items</span>
        </div>
        <div style="display:flex;gap:8px;">
            <button class="cm-btn cm-btn-ghost" onclick="fetchCategories()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="cm-table-wrap">
        <table class="cm-table" id="categoriesTable">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th style="width:100px;text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody id="categoriesBody">
                <tr>
                    <td colspan="4" class="cm-empty">
                        <div class="cm-empty-icon"><i class="fas fa-spinner fa-spin"></i></div>
                        <strong>Loading categories…</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="cm-footer">
        <span class="cm-footer-info" id="paginationInfo"></span>
        <div id="categoriesPagination"></div>
    </div>
</div>

{{-- ── MODAL ── --}}
<div class="modal fade cm-modal" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title-text">
                    <div class="modal-title-icon"><i class="fas fa-tag" id="modalIcon"></i></div>
                    <span id="modalTitle">Add Category</span>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="categoryForm" autocomplete="off">
                    <input type="hidden" id="categoryId">

                    <div class="cm-form-group">
                        <label class="cm-label">Category Name <span class="req">*</span></label>
                        <input type="text" id="name" class="cm-input" placeholder="Enter category name">
                        <span class="cm-error" id="error-name"></span>
                    </div>

                    <div class="cm-form-group">
                        <label class="cm-label">Description</label>
                        <textarea id="description" class="cm-input" rows="3"
                            placeholder="Short description…" style="resize:vertical;"></textarea>
                        <span class="cm-error" id="error-description"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="cm-btn cm-btn-ghost" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="cm-btn cm-btn-primary" id="saveBtn">
                    <i class="fas fa-save"></i> Save Category
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ── TOAST CONTAINER ── --}}
<div class="cm-toast-container" id="toastContainer"></div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const token = '{{ csrf_token() }}';
let currentPage = 1;

/* ── TOAST ── */
const TOAST_ICONS = {
    success: 'fa-check-circle',
    error:   'fa-exclamation-circle',
    info:    'fa-info-circle',
    warning: 'fa-exclamation-triangle',
};

function showToast(message, type = 'success', duration = 3500) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `cm-toast ${type}`;
    toast.innerHTML = `
        <i class="fas ${TOAST_ICONS[type]} cm-toast-icon"></i>
        <span class="cm-toast-msg">${message}</span>
        <button class="cm-toast-close" onclick="dismissToast(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>`;
    container.appendChild(toast);
    setTimeout(() => dismissToast(toast), duration);
}

function dismissToast(toast) {
    if (!toast || toast.classList.contains('leaving')) return;
    toast.classList.add('leaving');
    setTimeout(() => toast.remove(), 260);
}

/* ── HELPERS ── */
function clearErrors() {
    ['name', 'description'].forEach(id => {
        const el  = document.getElementById(id);
        const err = document.getElementById('error-' + id);
        if (el)  el.classList.remove('is-invalid');
        if (err) { err.textContent = ''; err.classList.remove('show'); }
    });
}

function showError(field, message) {
    const el  = document.getElementById(field);
    const err = document.getElementById('error-' + field);
    if (el)  el.classList.add('is-invalid');
    if (err) { err.textContent = message; err.classList.add('show'); }
}

function openModal(title, icon = 'fa-tag') {
    clearErrors();
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalIcon').className = 'fas ' + icon;
    $('#categoryModal').modal('show');
}

/* ── FETCH ── */
async function fetchCategories(page = 1) {
    currentPage = page;
    const tbody = document.getElementById('categoriesBody');
    tbody.innerHTML = `<tr><td colspan="4" class="cm-empty">
        <div class="cm-empty-icon"><i class="fas fa-spinner fa-spin"></i></div>
        <strong>Loading…</strong></td></tr>`;

    try {
        const res  = await axios.get('{{ route('admin.categories.listAll') }}?page=' + page);
        const data = res.data;

        document.getElementById('categoryCount').textContent =
            (data.total ?? 0) + ' item' + (data.total !== 1 ? 's' : '');

        if (!data.data || data.data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4" class="cm-empty">
                <div class="cm-empty-icon"><i class="fas fa-tags"></i></div>
                <strong>No categories found</strong>
                <p>Add your first category to get started.</p>
            </td></tr>`;
            document.getElementById('categoriesPagination').innerHTML = '';
            document.getElementById('paginationInfo').textContent = '';
            return;
        }

        tbody.innerHTML = '';
        data.data.forEach((c, index) => {
            const rowNum = data.total - data.from - index + 1;
            const desc   = c.description
                ? (c.description.length > 80 ? c.description.substring(0, 80) + '…' : c.description)
                : '<span style="color:var(--cm-text3);font-size:12px;">—</span>';

            tbody.innerHTML += `
            <tr>
                <td><span class="cm-row-num">${rowNum}</span></td>
                <td>
                    <div class="cm-category-cell">
                        <div class="cm-category-icon"><i class="fas fa-tag"></i></div>
                        <div>
                            <div class="cm-category-name">${c.name}</div>
                        </div>
                    </div>
                </td>
                <td style="color:var(--cm-text2);font-size:13px;">${desc}</td>
                <td>
                    <div class="cm-actions">
                        <button class="cm-action-btn edit" onclick="editCategory(${c.id})" title="Edit">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="cm-action-btn del" onclick="deleteCategory(${c.id})" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });

        document.getElementById('paginationInfo').textContent =
            `Showing ${data.from}–${data.to} of ${data.total} categories`;

        renderPagination(data, 'categoriesPagination', fetchCategories);

    } catch (e) {
        tbody.innerHTML = `<tr><td colspan="4" class="cm-empty">
            <div class="cm-empty-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <strong>Failed to load categories</strong>
            <p>Please refresh and try again.</p>
        </td></tr>`;
    }
}

/* ── PAGINATION ── */
function renderPagination(data, containerId, fetchFn) {
    const container = document.getElementById(containerId);
    if (!data.links || data.links.length <= 3) { container.innerHTML = ''; return; }

    let html = '<nav><ul class="pagination mb-0">';
    data.links.forEach(link => {
        const active   = link.active ? 'active'   : '';
        const disabled = !link.url   ? 'disabled' : '';
        const page     = link.url ? new URL(link.url).searchParams.get('page') : null;

        html += `<li class="page-item ${active} ${disabled}">`;
        if (link.url && !link.active) {
            html += `<a class="page-link" href="#" onclick="event.preventDefault();${fetchFn.name}(${page})">${link.label}</a>`;
        } else {
            html += `<span class="page-link">${link.label}</span>`;
        }
        html += '</li>';
    });
    html += '</ul></nav>';
    container.innerHTML = html;
}

/* ── ADD ── */
document.getElementById('btnAdd').addEventListener('click', () => {
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryId').value = '';
    openModal('Add Category', 'fa-plus');
});

/* ── SAVE ── */
document.getElementById('saveBtn').addEventListener('click', saveCategory);

async function saveCategory() {
    clearErrors();

    const id      = document.getElementById('categoryId').value;
    const name    = document.getElementById('name').value.trim();
    const desc    = document.getElementById('description').value.trim();

    if (!name) {
        showError('name', 'Category name is required.');
        showToast('Please fill in all required fields.', 'warning');
        return;
    }

    const saveBtn = document.getElementById('saveBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving…';

    const payload = { name, description: desc || null };

    try {
        if (id) {
            await axios.put(`{{ url('/admin/categories') }}/${id}`, payload, { headers: { 'X-CSRF-TOKEN': token } });
            showToast('Category updated successfully!', 'success');
        } else {
            await axios.post(`{{ url('/admin/categories') }}`, payload, { headers: { 'X-CSRF-TOKEN': token } });
            showToast('Category created successfully!', 'success');
        }

        $('#categoryModal').modal('hide');
        fetchCategories(currentPage);

    } catch (e) {
        if (e.response?.status === 422) {
            Object.entries(e.response.data.errors).forEach(([f, m]) => showError(f, m.join(' ')));
            showToast('Please fix the errors below.', 'error');
        } else {
            showToast('Server error. Please try again.', 'error');
        }
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Category';
    }
}

/* ── EDIT ── */
async function editCategory(id) {
    try {
        const res = await axios.get('{{ route('admin.categories.listAll') }}');
        const c   = (res.data?.data || []).find(x => x.id === id);
        if (!c) { showToast('Category not found.', 'error'); return; }

        document.getElementById('categoryId').value   = c.id;
        document.getElementById('name').value         = c.name;
        document.getElementById('description').value  = c.description || '';

        openModal('Edit Category', 'fa-pen');
    } catch (e) {
        showToast('Could not load category. Please try again.', 'error');
    }
}

/* ── DELETE ── */
async function deleteCategory(id) {
    if (!confirm('Are you sure you want to delete this category? This action cannot be undone.')) return;
    try {
        await axios.delete(`{{ url('/admin/categories') }}/${id}`, { headers: { 'X-CSRF-TOKEN': token } });
        showToast('Category deleted.', 'info');
        fetchCategories(currentPage);
    } catch (e) {
        showToast('Failed to delete category.', 'error');
    }
}

/* ── SEARCH ── */
document.getElementById('searchInput').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#categoriesBody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

/* ── INIT ── */
fetchCategories();
</script>
@stop
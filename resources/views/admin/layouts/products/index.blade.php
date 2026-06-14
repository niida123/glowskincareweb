@extends('adminlte::page')

@section('title', 'Products Management')

@section('content_header')
    <div class="pm-page-header">
        <div class="pm-page-header-left">
            <div class="pm-page-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div>
                <h1 class="pm-page-title">Products</h1>
                <p class="pm-page-sub">Manage your product catalog</p>
            </div>
        </div>
        <button class="pm-btn pm-btn-primary" id="btnAdd">
            <i class="fas fa-plus"></i> Add Product
        </button>
    </div>
@stop

@section('css')
<style>
    /* ── VARIABLES ── */
    :root {
        --pm-accent:      #7970ac;
        --pm-accent-light:#f0eeff;
        --pm-accent-dark: #5f57a0;
        --pm-surface:     #ffffff;
        --pm-bg:          #f5f6fa;
        --pm-border:      #e8ecf2;
        --pm-text:        #1a1d2e;
        --pm-text2:       #64748b;
        --pm-text3:       #a0aec0;
        --pm-green:       #10b981;
        --pm-red:         #ef4444;
        --pm-yellow:      #f59e0b;
        --pm-radius:      12px;
        --pm-radius-sm:   8px;
        --pm-shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
        --pm-shadow-md:   0 4px 24px rgba(0,0,0,.10);
    }

    /* ── PAGE HEADER ── */
    .pm-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 0 8px;
    }

    .pm-page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .pm-page-icon {
        width: 46px; height: 46px;
        background: var(--pm-accent-light);
        color: var(--pm-accent);
        border-radius: var(--pm-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .pm-page-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--pm-text) !important;
        margin: 0 !important;
        line-height: 1.2;
    }

    .pm-page-sub {
        font-size: 12.5px;
        color: var(--pm-text2);
        margin: 2px 0 0;
    }

    /* ── BUTTONS ── */
    .pm-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: var(--pm-radius-sm);
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .pm-btn-primary {
        background: var(--pm-accent);
        color: #fff;
        box-shadow: 0 4px 14px rgba(121,112,172,.35);
    }

    .pm-btn-primary:hover {
        background: var(--pm-accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(121,112,172,.45);
        color: #fff;
    }

    .pm-btn-ghost {
        background: var(--pm-bg);
        color: var(--pm-text2);
        border: 1px solid var(--pm-border);
    }

    .pm-btn-ghost:hover {
        background: var(--pm-border);
        color: var(--pm-text);
    }

    /* ── CARD ── */
    .pm-card {
        background: var(--pm-surface);
        border: 1px solid var(--pm-border);
        border-radius: var(--pm-radius);
        box-shadow: var(--pm-shadow);
        overflow: hidden;
        margin-bottom: 0;
    }

    .pm-card-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--pm-border);
        gap: 12px;
        flex-wrap: wrap;
    }

    .pm-toolbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pm-search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--pm-bg);
        border: 1px solid var(--pm-border);
        border-radius: var(--pm-radius-sm);
        padding: 7px 13px;
        width: 220px;
        transition: border-color .15s;
    }

    .pm-search-wrap:focus-within {
        border-color: var(--pm-accent);
        background: #fff;
    }

    .pm-search-wrap input {
        border: none; background: none; outline: none;
        font-size: 13px;
        color: var(--pm-text);
        width: 100%;
        font-family: inherit;
    }

    .pm-search-wrap input::placeholder { color: var(--pm-text3); }
    .pm-search-wrap i { color: var(--pm-text3); font-size: 13px; }

    .pm-count-badge {
        background: var(--pm-accent-light);
        color: var(--pm-accent);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* ── TABLE ── */
    .pm-table-wrap { overflow-x: auto; }

    .pm-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }

    .pm-table thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--pm-text3);
        background: #fafbfc;
        border-bottom: 1px solid var(--pm-border);
        white-space: nowrap;
    }

    .pm-table tbody tr {
        border-bottom: 1px solid #f4f5f8;
        transition: background .15s;
    }

    .pm-table tbody tr:last-child { border-bottom: none; }
    .pm-table tbody tr:hover { background: #fafbff; }

    .pm-table tbody td {
        padding: 12px 16px;
        color: var(--pm-text);
        vertical-align: middle;
    }

    /* ── PRODUCT IMAGE ── */
    .pm-product-img {
        width: 48px; height: 48px;
        object-fit: cover;
        border-radius: var(--pm-radius-sm);
        border: 1px solid var(--pm-border);
    }

    .pm-img-placeholder {
        width: 48px; height: 48px;
        background: var(--pm-bg);
        border: 1px dashed var(--pm-border);
        border-radius: var(--pm-radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--pm-text3);
        font-size: 18px;
    }

    /* ── PRODUCT NAME CELL ── */
    .pm-product-cell { display: flex; align-items: center; gap: 12px; }
    .pm-product-name { font-weight: 600; color: var(--pm-text); font-size: 13.5px; }
    .pm-product-desc { font-size: 11.5px; color: var(--pm-text3); margin-top: 2px; }

    /* ── BADGES ── */
    .pm-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }

    .pm-badge-purple  { background: var(--pm-accent-light); color: var(--pm-accent); }
    .pm-badge-gray    { background: #f1f3f7; color: #64748b; }
    .pm-badge-red     { background: #fef2f2; color: var(--pm-red); }
    .pm-badge-green   { background: #ecfdf5; color: var(--pm-green); }
    .pm-badge-yellow  { background: #fffbeb; color: var(--pm-yellow); }

    /* ── STOCK INDICATOR ── */
    .pm-stock-cell { display: flex; align-items: center; gap: 8px; }
    .pm-stock-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── PRICE CELL ── */
    .pm-price { font-weight: 700; color: var(--pm-text); font-size: 14px; }
    .pm-price-final { font-weight: 700; color: var(--pm-green); font-size: 14px; }
    .pm-price-original { font-size: 11.5px; color: var(--pm-text3); text-decoration: line-through; }

    /* ── ACTION BUTTONS ── */
    .pm-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }

    .pm-action-btn {
        width: 32px; height: 32px;
        border-radius: var(--pm-radius-sm);
        border: 1px solid var(--pm-border);
        background: var(--pm-bg);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: all .15s;
        color: var(--pm-text2);
    }

    .pm-action-btn:hover { transform: translateY(-1px); }
    .pm-action-btn.edit:hover  { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
    .pm-action-btn.del:hover   { background: #fef2f2; border-color: #fca5a5; color: var(--pm-red); }

    /* ── EMPTY STATE ── */
    .pm-empty {
        text-align: center;
        padding: 52px 20px !important;
        color: var(--pm-text3);
    }

    .pm-empty-icon {
        font-size: 42px;
        margin-bottom: 12px;
        opacity: .3;
    }

    .pm-empty p { font-size: 14px; color: var(--pm-text2); margin: 4px 0 0; }

    /* ── PAGINATION ── */
    .pm-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--pm-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pm-footer-info { font-size: 12.5px; color: var(--pm-text3); }

    .pm-footer .pagination { margin: 0; }
    .pm-footer .page-link {
        border-radius: var(--pm-radius-sm) !important;
        border: 1px solid var(--pm-border);
        color: var(--pm-text2);
        font-size: 12.5px;
        padding: 5px 11px;
        margin: 0 2px;
        transition: all .15s;
    }

    .pm-footer .page-item.active .page-link {
        background: var(--pm-accent) !important;
        border-color: var(--pm-accent) !important;
        color: #fff !important;
    }

    .pm-footer .page-link:hover {
        background: var(--pm-accent-light);
        color: var(--pm-accent);
        border-color: var(--pm-accent);
    }

    /* ── MODAL ── */
    .pm-modal .modal-content {
        border: none;
        border-radius: var(--pm-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,.18);
        overflow: hidden;
    }

    .pm-modal .modal-header {
        background: var(--pm-accent);
        padding: 18px 22px;
        border: none;
    }

    .pm-modal .modal-title-text {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pm-modal .modal-title-icon {
        width: 32px; height: 32px;
        background: rgba(255,255,255,.18);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }

    .pm-modal .close {
        color: rgba(255,255,255,.75);
        font-size: 20px;
        opacity: 1;
        text-shadow: none;
        transition: color .15s;
    }

    .pm-modal .close:hover { color: #fff; }

    .pm-modal .modal-body {
        padding: 24px;
        background: #fff;
    }

    .pm-modal .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--pm-border);
        background: #fafbfc;
        gap: 8px;
    }

    /* ── FORM ── */
    .pm-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .pm-form-grid .pm-form-full { grid-column: 1 / -1; }

    .pm-form-group { display: flex; flex-direction: column; gap: 6px; }

    .pm-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--pm-text2);
        letter-spacing: .3px;
    }

    .pm-label .req { color: var(--pm-red); margin-left: 2px; }

    .pm-input {
        padding: 9px 13px;
        border: 1.5px solid var(--pm-border);
        border-radius: var(--pm-radius-sm);
        font-size: 13.5px;
        color: var(--pm-text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
        font-family: inherit;
        background: #fff;
    }

    .pm-input:focus {
        border-color: var(--pm-accent);
        box-shadow: 0 0 0 3px rgba(121,112,172,.12);
    }

    .pm-input.is-invalid {
        border-color: var(--pm-red);
        box-shadow: 0 0 0 3px rgba(239,68,68,.10);
    }

    .pm-error {
        font-size: 11.5px;
        color: var(--pm-red);
        margin-top: 2px;
        display: none;
    }

    .pm-error.show { display: block; }

    /* Image preview */
    .pm-img-preview-wrap {
        margin-top: 10px;
    }

    .pm-img-preview-wrap img {
        width: 72px; height: 72px;
        object-fit: cover;
        border-radius: var(--pm-radius-sm);
        border: 2px solid var(--pm-border);
    }

    /* File input */
    .pm-file-input-wrap {
        position: relative;
    }

    .pm-file-label {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 13px;
        border: 1.5px dashed var(--pm-border);
        border-radius: var(--pm-radius-sm);
        cursor: pointer;
        transition: border-color .15s, background .15s;
        background: var(--pm-bg);
        font-size: 13px;
        color: var(--pm-text2);
    }

    .pm-file-label:hover {
        border-color: var(--pm-accent);
        background: var(--pm-accent-light);
        color: var(--pm-accent);
    }

    .pm-file-label i { font-size: 15px; }

    input[type="file"].pm-file-hidden {
        position: absolute;
        opacity: 0;
        inset: 0;
        cursor: pointer;
        width: 100%;
    }

    /* Row number */
    .pm-row-num {
        font-size: 12px;
        color: var(--pm-text3);
        font-weight: 600;
    }

    @media (max-width: 640px) {
        .pm-form-grid { grid-template-columns: 1fr; }
        .pm-search-wrap { width: 160px; }
    }
</style>
@stop

@section('content')

<div class="pm-card">

    {{-- TOOLBAR --}}
    <div class="pm-card-toolbar">
        <div class="pm-toolbar-left">
            <div class="pm-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search products…">
            </div>
            <span class="pm-count-badge" id="productCount">— items</span>
        </div>
        <div style="display:flex;gap:8px;">
            <button class="pm-btn pm-btn-ghost" onclick="fetchProducts(currentPage)">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="pm-table-wrap">
        <table class="pm-table" id="productsTable">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Code</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Final Price</th>
                    <th style="width:70px;text-align:center;">Image</th>
                    <th>Stock</th>
                    <th style="width:100px;text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody id="productsBody">
                <tr>
                    <td colspan="10" class="pm-empty">
                        <div class="pm-empty-icon"><i class="fas fa-boxes"></i></div>
                        <strong>Loading products…</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="pm-footer">
        <span class="pm-footer-info" id="paginationInfo"></span>
        <div id="productsPagination"></div>
    </div>
</div>

{{-- ── MODAL ── --}}
<div class="modal fade pm-modal" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title-text">
                    <div class="modal-title-icon"><i class="fas fa-box" id="modalIcon"></i></div>
                    <span id="modalTitle">Add Product</span>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="productForm" autocomplete="off">
                    <input type="hidden" id="productId">

                    <div class="pm-form-grid">

                        {{-- Code --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Product Code <span class="req">*</span></label>
                            <input type="text" id="code" class="pm-input" placeholder="e.g. SKU-001">
                            <span class="pm-error" id="error-code"></span>
                        </div>

                        {{-- Name --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Product Name <span class="req">*</span></label>
                            <input type="text" id="name" class="pm-input" placeholder="Enter product name">
                            <span class="pm-error" id="error-name"></span>
                        </div>

                        {{-- Category --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Category</label>
                            <select id="category_id" class="pm-input">
                                <option value="">— None —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <span class="pm-error" id="error-category_id"></span>
                        </div>

                        {{-- Stock --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Stock <span class="req">*</span></label>
                            <input type="number" id="stock" class="pm-input" placeholder="0" min="0">
                            <span class="pm-error" id="error-stock"></span>
                        </div>

                        {{-- Price --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Price ($) <span class="req">*</span></label>
                            <input type="number" step="0.01" id="price" class="pm-input" placeholder="0.00" min="0">
                            <span class="pm-error" id="error-price"></span>
                        </div>

                        {{-- Discount --}}
                        <div class="pm-form-group">
                            <label class="pm-label">Discount (%)</label>
                            <input type="number" step="0.01" id="discount" class="pm-input" placeholder="0" min="0" max="100">
                            <span class="pm-error" id="error-discount"></span>
                        </div>

                        {{-- Description --}}
                        <div class="pm-form-group pm-form-full">
                            <label class="pm-label">Description</label>
                            <textarea id="description" class="pm-input" rows="3" placeholder="Short product description…" style="resize:vertical;"></textarea>
                        </div>

                        {{-- Image --}}
                        <div class="pm-form-group pm-form-full">
                            <label class="pm-label">Product Image</label>
                            <div class="pm-file-input-wrap">
                                <label class="pm-file-label" for="image">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span id="fileLabel">Click to upload image</span>
                                </label>
                                <input type="file" id="image" class="pm-file-hidden" accept="image/*"
                                    onchange="handleFileChange(this)">
                            </div>
                            <span class="pm-error" id="error-image"></span>
                            <div class="pm-img-preview-wrap" id="imagePreview"></div>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="pm-btn pm-btn-ghost" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="pm-btn pm-btn-primary" id="saveBtn">
                    <i class="fas fa-save"></i> Save Product
                </button>
            </div>

        </div>
    </div>
</div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const token = '{{ csrf_token() }}';
let currentPage = 1;

/* ── HELPERS ── */
function formatCurrency(v) {
    return '$' + Number(v || 0).toFixed(2);
}

function clearErrors() {
    ['code','name','category_id','price','discount','stock','image'].forEach(id => {
        const el = document.getElementById(id);
        const err = document.getElementById('error-' + id);
        if (el) el.classList.remove('is-invalid');
        if (err) { err.textContent = ''; err.classList.remove('show'); }
    });
}

function showError(field, message) {
    const el = document.getElementById(field);
    const err = document.getElementById('error-' + field);
    if (el) el.classList.add('is-invalid');
    if (err) { err.textContent = message; err.classList.add('show'); }
}

function handleFileChange(input) {
    const label = document.getElementById('fileLabel');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').innerHTML =
                `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/* ── FETCH PRODUCTS ── */
async function fetchProducts(page = 1) {
    currentPage = page;
    const tbody = document.getElementById('productsBody');
    tbody.innerHTML = `<tr><td colspan="10" class="pm-empty">
        <div class="pm-empty-icon"><i class="fas fa-spinner fa-spin"></i></div>
        <strong>Loading…</strong></td></tr>`;

    try {
        const res = await axios.get('{{ route('admin.products.list') }}?page=' + page);
        const data = res.data;

        // Update count badge
        document.getElementById('productCount').textContent =
            (data.total ?? 0) + ' item' + (data.total !== 1 ? 's' : '');

        if (!data.data || data.data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="10" class="pm-empty">
                <div class="pm-empty-icon"><i class="fas fa-box-open"></i></div>
                <strong>No products found</strong>
                <p>Add your first product to get started.</p>
            </td></tr>`;
            document.getElementById('productsPagination').innerHTML = '';
            document.getElementById('paginationInfo').textContent = '';
            return;
        }

        tbody.innerHTML = '';
        data.data.forEach((p, index) => {
            const finalPrice = p.price - (p.price * (p.discount ?? 0) / 100);
            const rowNum = data.total - data.from - index + 1;

            let stockBadgeClass = 'pm-badge-green';
            let stockDotColor = '#10b981';
            if (p.stock <= 10) { stockBadgeClass = 'pm-badge-red'; stockDotColor = '#ef4444'; }
            else if (p.stock <= 50) { stockBadgeClass = 'pm-badge-yellow'; stockDotColor = '#f59e0b'; }

            const imageCell = p.image
                ? `<img src="/storage/${p.image}" class="pm-product-img" alt="${p.name}">`
                : `<div class="pm-img-placeholder"><i class="fas fa-image"></i></div>`;

            tbody.innerHTML += `
            <tr>
                <td><span class="pm-row-num">${rowNum}</span></td>
                <td><span class="pm-badge pm-badge-purple">${p.code ?? 'N/A'}</span></td>
                <td>
                    <div class="pm-product-cell">
                        ${imageCell}
                        <div>
                            <div class="pm-product-name">${p.name}</div>
                            <div class="pm-product-desc">${(p.description ?? '').substring(0, 45)}${(p.description ?? '').length > 45 ? '…' : ''}</div>
                        </div>
                    </div>
                </td>
                <td>
                    ${p.category?.name
                        ? `<span class="pm-badge pm-badge-gray">${p.category.name}</span>`
                        : `<span style="color:var(--pm-text3);font-size:12px;">—</span>`}
                </td>
                <td><span class="pm-price">${formatCurrency(p.price)}</span></td>
                <td>
                    ${p.discount > 0
                        ? `<span class="pm-badge pm-badge-red">−${p.discount}%</span>`
                        : `<span style="color:var(--pm-text3);font-size:12px;">—</span>`}
                </td>
                <td>
                    <span class="pm-price-final">${formatCurrency(finalPrice)}</span>
                    ${p.discount > 0 ? `<div class="pm-price-original">${formatCurrency(p.price)}</div>` : ''}
                </td>
                <td style="text-align:center;">${imageCell}</td>
                <td>
                    <div class="pm-stock-cell">
                        <div class="pm-stock-dot" style="background:${stockDotColor};"></div>
                        <span class="pm-badge ${stockBadgeClass}">${p.stock ?? 0} units</span>
                    </div>
                </td>
                <td>
                    <div class="pm-actions">
                        <button class="pm-action-btn edit" onclick="editProduct(${p.id})" title="Edit">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="pm-action-btn del" onclick="deleteProduct(${p.id})" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });

        // Pagination info
        document.getElementById('paginationInfo').textContent =
            `Showing ${data.from}–${data.to} of ${data.total} products`;

        renderPagination(data, 'productsPagination', fetchProducts);

    } catch (e) {
        tbody.innerHTML = `<tr><td colspan="10" class="pm-empty">
            <div class="pm-empty-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <strong>Failed to load products</strong>
            <p>Please refresh the page and try again.</p>
        </td></tr>`;
    }
}

/* ── PAGINATION ── */
function renderPagination(data, containerId, fetchFn) {
    const container = document.getElementById(containerId);
    if (!data.links || data.links.length <= 3) { container.innerHTML = ''; return; }

    let html = '<nav><ul class="pagination mb-0">';
    data.links.forEach(link => {
        const active   = link.active   ? 'active'   : '';
        const disabled = !link.url     ? 'disabled' : '';
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

/* ── OPEN MODAL ── */
function openModal(title, icon = 'fa-box') {
    clearErrors();
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalIcon').className = 'fas ' + icon;
    $('#productModal').modal('show');
}

/* ── ADD ── */
document.getElementById('btnAdd').addEventListener('click', () => {
    document.getElementById('productForm').reset();
    document.getElementById('productId').value = '';
    document.getElementById('imagePreview').innerHTML = '';
    document.getElementById('fileLabel').textContent = 'Click to upload image';
    openModal('Add Product', 'fa-plus');
});

/* ── SAVE ── */
document.getElementById('saveBtn').addEventListener('click', saveProduct);

async function saveProduct() {
    clearErrors();

    const formData = new FormData();
    formData.append('code',        document.getElementById('code').value        || '');
    formData.append('name',        document.getElementById('name').value        || '');
    formData.append('category_id', document.getElementById('category_id').value || '');
    formData.append('description', document.getElementById('description').value || '');
    formData.append('price',       document.getElementById('price').value       || '');
    formData.append('discount',    document.getElementById('discount').value    || '0');
    formData.append('stock',       document.getElementById('stock').value       || '');

    const imageInput = document.getElementById('image');
    if (imageInput?.files?.length) formData.append('image', imageInput.files[0]);

    const id = document.getElementById('productId').value;

    const saveBtn = document.getElementById('saveBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving…';

    try {
        if (id) {
            formData.append('_method', 'PUT');
            await axios.post(`/admin/products/${id}`, formData, { headers: { 'X-CSRF-TOKEN': token } });
        } else {
            await axios.post('/admin/products', formData, { headers: { 'X-CSRF-TOKEN': token } });
        }

        $('#productModal').modal('hide');
        fetchProducts(currentPage);

    } catch (e) {
        if (e.response?.status === 422) {
            Object.entries(e.response.data.errors).forEach(([f, m]) => showError(f, m.join(' ')));
        } else {
            alert('Server error. Please try again.');
        }
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Product';
    }
}

/* ── EDIT ── */
async function editProduct(id) {
    try {
        const res = await axios.get('{{ route('admin.products.list') }}');
        const p = (res.data?.data || []).find(x => x.id == id);
        if (!p) return;

        document.getElementById('productId').value    = p.id          ?? '';
        document.getElementById('code').value         = p.code        ?? '';
        document.getElementById('name').value         = p.name        ?? '';
        document.getElementById('category_id').value  = p.category_id ?? '';
        document.getElementById('description').value  = p.description ?? '';
        document.getElementById('price').value        = p.price       ?? '';
        document.getElementById('discount').value     = p.discount    ?? '0';
        document.getElementById('stock').value        = p.stock       ?? '';

        document.getElementById('image').value = '';
        document.getElementById('fileLabel').textContent = p.image ? 'Image already uploaded' : 'Click to upload image';
        document.getElementById('imagePreview').innerHTML = p.image
            ? `<img src="/storage/${p.image}" alt="Current image">`
            : '';

        openModal('Edit Product', 'fa-pen');
    } catch (e) {
        alert('Could not load product. Please try again.');
    }
}

/* ── DELETE ── */
async function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete this product? This action cannot be undone.')) return;
    try {
        await axios.delete(`/admin/products/${id}`, { headers: { 'X-CSRF-TOKEN': token } });
        fetchProducts(currentPage);
    } catch (e) {
        alert('Failed to delete product.');
    }
}

/* ── SEARCH (client-side filter on current page) ── */
document.getElementById('searchInput').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#productsBody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

/* ── INIT ── */
fetchProducts();
</script>
@stop
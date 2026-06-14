@extends('adminlte::page')

@section('title', 'Orders Management')

@section('content_header')
    <div class="om-page-header">
        <div class="om-page-header-left">
            <div class="om-page-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div>
                <h1 class="om-page-title">Orders</h1>
                <p class="om-page-sub">Manage and track customer orders</p>
            </div>
        </div>
        <button class="om-btn om-btn-primary" id="btnAddOrder">
            <i class="fas fa-plus"></i> Add Order
        </button>
    </div>
@stop

@section('css')
<style>
    /* ── VARIABLES (mirror product palette) ── */
    :root {
        --om-accent:      #7970ac;
        --om-accent-light:#f0eeff;
        --om-accent-dark: #5f57a0;
        --om-surface:     #ffffff;
        --om-bg:          #f5f6fa;
        --om-border:      #e8ecf2;
        --om-text:        #1a1d2e;
        --om-text2:       #64748b;
        --om-text3:       #a0aec0;
        --om-green:       #10b981;
        --om-red:         #ef4444;
        --om-yellow:      #f59e0b;
        --om-blue:        #3b82f6;
        --om-radius:      12px;
        --om-radius-sm:   8px;
        --om-shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
        --om-shadow-md:   0 4px 24px rgba(0,0,0,.10);
    }

    /* ── PAGE HEADER ── */
    .om-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 0 8px;
    }
    .om-page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .om-page-icon {
        width: 46px; height: 46px;
        background: var(--om-accent-light);
        color: var(--om-accent);
        border-radius: var(--om-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .om-page-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--om-text) !important;
        margin: 0 !important;
        line-height: 1.2;
    }
    .om-page-sub {
        font-size: 12.5px;
        color: var(--om-text2);
        margin: 2px 0 0;
    }

    /* ── BUTTONS ── */
    .om-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: var(--om-radius-sm);
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .om-btn-primary {
        background: var(--om-accent);
        color: #fff;
        box-shadow: 0 4px 14px rgba(121,112,172,.35);
    }
    .om-btn-primary:hover {
        background: var(--om-accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(121,112,172,.45);
        color: #fff;
    }
    .om-btn-ghost {
        background: var(--om-bg);
        color: var(--om-text2);
        border: 1px solid var(--om-border);
    }
    .om-btn-ghost:hover {
        background: var(--om-border);
        color: var(--om-text);
    }

    /* ── CARD ── */
    .om-card {
        background: var(--om-surface);
        border: 1px solid var(--om-border);
        border-radius: var(--om-radius);
        box-shadow: var(--om-shadow);
        overflow: hidden;
        margin-bottom: 0;
    }
    .om-card-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--om-border);
        gap: 12px;
        flex-wrap: wrap;
    }
    .om-toolbar-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ── SEARCH ── */
    .om-search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--om-bg);
        border: 1px solid var(--om-border);
        border-radius: var(--om-radius-sm);
        padding: 7px 13px;
        width: 220px;
        transition: border-color .15s;
    }
    .om-search-wrap:focus-within {
        border-color: var(--om-accent);
        background: #fff;
    }
    .om-search-wrap input {
        border: none; background: none; outline: none;
        font-size: 13px;
        color: var(--om-text);
        width: 100%;
        font-family: inherit;
    }
    .om-search-wrap input::placeholder { color: var(--om-text3); }
    .om-search-wrap i { color: var(--om-text3); font-size: 13px; }

    .om-count-badge {
        background: var(--om-accent-light);
        color: var(--om-accent);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* ── FILTER TABS ── */
    .om-filter-tabs {
        display: flex;
        gap: 6px;
    }
    .om-filter-tab {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        border: 1px solid var(--om-border);
        background: var(--om-bg);
        color: var(--om-text2);
        cursor: pointer;
        transition: all .15s;
    }
    .om-filter-tab:hover,
    .om-filter-tab.active {
        background: var(--om-accent);
        color: #fff;
        border-color: var(--om-accent);
    }

    /* ── TABLE ── */
    .om-table-wrap { overflow-x: auto; }
    .om-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }
    .om-table thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--om-text3);
        background: #fafbfc;
        border-bottom: 1px solid var(--om-border);
        white-space: nowrap;
    }
    .om-table tbody tr {
        border-bottom: 1px solid #f4f5f8;
        transition: background .15s;
    }
    .om-table tbody tr:last-child { border-bottom: none; }
    .om-table tbody tr:hover { background: #fafbff; }
    .om-table tbody td {
        padding: 12px 16px;
        color: var(--om-text);
        vertical-align: middle;
    }

    /* ── BADGES ── */
    .om-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .om-badge-purple  { background: var(--om-accent-light); color: var(--om-accent); }
    .om-badge-gray    { background: #f1f3f7; color: #64748b; }
    .om-badge-green   { background: #ecfdf5; color: var(--om-green); }
    .om-badge-red     { background: #fef2f2; color: var(--om-red); }
    .om-badge-yellow  { background: #fffbeb; color: var(--om-yellow); }
    .om-badge-blue    { background: #eff6ff; color: var(--om-blue); }

    /* ── STATUS SELECT ── */
    .om-status-select {
        appearance: none;
        -webkit-appearance: none;
        padding: 5px 28px 5px 10px;
        border-radius: 20px;
        border: 1.5px solid var(--om-border);
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%23a0aec0'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 9px center;
        transition: all .15s;
        outline: none;
        font-family: inherit;
    }
    .om-status-select.s-pending    { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
    .om-status-select.s-processing { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .om-status-select.s-completed  { background-color: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
    .om-status-select.s-cancelled  { background-color: #fef2f2; color: #991b1b; border-color: #fecaca; }
    .om-status-select:focus { box-shadow: 0 0 0 3px rgba(121,112,172,.15); }

    /* ── CUSTOMER CELL ── */
    .om-customer-name { font-weight: 600; color: var(--om-text); font-size: 13.5px; }
    .om-customer-email { font-size: 11.5px; color: var(--om-text3); margin-top: 2px; }

    /* ── AMOUNT ── */
    .om-amount { font-weight: 700; color: var(--om-text); font-size: 14px; }

    /* ── ACTION BUTTONS ── */
    .om-actions { display: flex; align-items: center; gap: 6px; justify-content: center; }
    .om-action-btn {
        width: 32px; height: 32px;
        border-radius: var(--om-radius-sm);
        border: 1px solid var(--om-border);
        background: var(--om-bg);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: all .15s;
        color: var(--om-text2);
    }
    .om-action-btn:hover { transform: translateY(-1px); }
    .om-action-btn.view:hover  { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
    .om-action-btn.edit:hover  { background: #fffbeb; border-color: #fde68a; color: #b45309; }
    .om-action-btn.del:hover   { background: #fef2f2; border-color: #fca5a5; color: var(--om-red); }

    /* ── EMPTY / LOADING STATE ── */
    .om-empty {
        text-align: center;
        padding: 52px 20px !important;
        color: var(--om-text3);
    }
    .om-empty-icon { font-size: 42px; margin-bottom: 12px; opacity: .3; }
    .om-empty p { font-size: 14px; color: var(--om-text2); margin: 4px 0 0; }

    /* ── FOOTER / PAGINATION ── */
    .om-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--om-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .om-footer-info { font-size: 12.5px; color: var(--om-text3); }

    /* ── MODAL ── */
    .om-modal .modal-content {
        border: none;
        border-radius: var(--om-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,.18);
        overflow: hidden;
    }
    .om-modal .modal-header {
        background: var(--om-accent);
        padding: 18px 22px;
        border: none;
    }
    .om-modal .modal-title-text {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .om-modal .modal-title-icon {
        width: 32px; height: 32px;
        background: rgba(255,255,255,.18);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }
    .om-modal .close {
        color: rgba(255,255,255,.75);
        font-size: 20px;
        opacity: 1;
        text-shadow: none;
        transition: color .15s;
    }
    .om-modal .close:hover { color: #fff; }
    .om-modal .modal-body { padding: 24px; background: #fff; }
    .om-modal .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--om-border);
        background: #fafbfc;
        gap: 8px;
    }

    /* ── FORM ── */
    .om-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .om-form-grid .om-form-full { grid-column: 1 / -1; }
    .om-form-group { display: flex; flex-direction: column; gap: 6px; }
    .om-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--om-text2);
        letter-spacing: .3px;
    }
    .om-label .req { color: var(--om-red); margin-left: 2px; }
    .om-input {
        padding: 9px 13px;
        border: 1.5px solid var(--om-border);
        border-radius: var(--om-radius-sm);
        font-size: 13.5px;
        color: var(--om-text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
        font-family: inherit;
        background: #fff;
    }
    .om-input:focus {
        border-color: var(--om-accent);
        box-shadow: 0 0 0 3px rgba(121,112,172,.12);
    }
    .om-input.is-invalid {
        border-color: var(--om-red);
        box-shadow: 0 0 0 3px rgba(239,68,68,.10);
    }
    .om-error {
        font-size: 11.5px;
        color: var(--om-red);
        margin-top: 2px;
        display: none;
    }
    .om-error.show { display: block; }

    /* ── ORDER ITEMS (in modal) ── */
    .om-section-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--om-text3);
        margin: 20px 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .om-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--om-border);
    }
    .om-item-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 40px;
        gap: 10px;
        align-items: end;
        background: var(--om-bg);
        border: 1px solid var(--om-border);
        border-radius: var(--om-radius-sm);
        padding: 12px;
        margin-bottom: 10px;
        transition: border-color .15s;
    }
    .om-item-row:hover { border-color: var(--om-accent); }
    .om-remove-btn {
        width: 32px; height: 32px;
        border-radius: var(--om-radius-sm);
        border: 1px solid #fca5a5;
        background: #fef2f2;
        color: var(--om-red);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        font-size: 12px;
        transition: all .15s;
    }
    .om-remove-btn:hover { background: var(--om-red); color: #fff; border-color: var(--om-red); }

    /* ── VIEW ORDER (details modal) ── */
    .om-detail-card {
        background: var(--om-bg);
        border: 1px solid var(--om-border);
        border-radius: var(--om-radius-sm);
        padding: 16px 20px;
        margin-bottom: 20px;
    }
    .om-detail-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        color: var(--om-text);
        padding: 5px 0;
    }
    .om-detail-row i { color: var(--om-accent); width: 16px; text-align: center; flex-shrink: 0; }
    .om-detail-label { font-weight: 600; color: var(--om-text2); min-width: 80px; }

    .om-items-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .om-items-table thead th {
        padding: 9px 12px;
        background: #fafbfc;
        border-bottom: 1px solid var(--om-border);
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        color: var(--om-text3);
    }
    .om-items-table tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #f4f5f8;
        vertical-align: middle;
    }
    .om-items-table tfoot td {
        padding: 10px 12px;
        font-weight: 700;
        font-size: 14px;
        border-top: 2px solid var(--om-border);
        background: var(--om-bg);
    }
    .om-product-thumb {
        width: 44px; height: 44px;
        object-fit: cover;
        border-radius: var(--om-radius-sm);
        border: 1px solid var(--om-border);
    }
    .om-thumb-placeholder {
        width: 44px; height: 44px;
        background: var(--om-bg);
        border: 1px dashed var(--om-border);
        border-radius: var(--om-radius-sm);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--om-text3);
        font-size: 16px;
    }

    /* ── TOAST ── */
    .om-toast-container {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }
    .om-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--om-text);
        color: #fff;
        padding: 13px 18px;
        border-radius: var(--om-radius-sm);
        font-size: 13.5px;
        font-weight: 500;
        min-width: 240px;
        max-width: 340px;
        box-shadow: 0 8px 32px rgba(0,0,0,.22);
        pointer-events: all;
        animation: om-toast-in .3s cubic-bezier(.34,1.56,.64,1) forwards;
        border-left: 4px solid transparent;
    }
    .om-toast.success { border-left-color: var(--om-green); }
    .om-toast.error   { border-left-color: var(--om-red); }
    .om-toast.info    { border-left-color: var(--om-blue); }
    .om-toast.warning { border-left-color: var(--om-yellow); }
    .om-toast-icon { font-size: 16px; flex-shrink: 0; }
    .om-toast.success .om-toast-icon { color: var(--om-green); }
    .om-toast.error   .om-toast-icon { color: var(--om-red); }
    .om-toast.info    .om-toast-icon { color: var(--om-blue); }
    .om-toast.warning .om-toast-icon { color: var(--om-yellow); }
    .om-toast-msg { flex: 1; }
    .om-toast-close {
        background: none; border: none; color: rgba(255,255,255,.5);
        font-size: 14px; cursor: pointer; padding: 0; transition: color .15s;
    }
    .om-toast-close:hover { color: #fff; }
    .om-toast.leaving { animation: om-toast-out .25s ease forwards; }

    @keyframes om-toast-in {
        from { opacity: 0; transform: translateX(32px) scale(.96); }
        to   { opacity: 1; transform: translateX(0)   scale(1); }
    }
    @keyframes om-toast-out {
        from { opacity: 1; transform: translateX(0)   scale(1); }
        to   { opacity: 0; transform: translateX(32px) scale(.96); }
    }

    /* ── ROW NUMBER ── */
    .om-row-num { font-size: 12px; color: var(--om-text3); font-weight: 600; }

    @media (max-width: 640px) {
        .om-form-grid { grid-template-columns: 1fr; }
        .om-search-wrap { width: 160px; }
        .om-filter-tabs { display: none; }
        .om-item-row { grid-template-columns: 1fr 1fr; }
    }
</style>
@stop

@section('content')

<div class="om-card">

    {{-- TOOLBAR --}}
    <div class="om-card-toolbar">
        <div class="om-toolbar-left">
            <div class="om-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search orders…">
            </div>
            <span class="om-count-badge" id="orderCount">— orders</span>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <div class="om-filter-tabs" id="statusFilterTabs">
                <button class="om-filter-tab active" data-status="">All</button>
                <button class="om-filter-tab" data-status="pending">Pending</button>
                <button class="om-filter-tab" data-status="processing">Processing</button>
                <button class="om-filter-tab" data-status="completed">Completed</button>
                <button class="om-filter-tab" data-status="cancelled">Cancelled</button>
            </div>
            <button class="om-btn om-btn-ghost" onclick="fetchOrders()">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="om-table-wrap">
        <table class="om-table" id="ordersTable">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th style="width:90px;">Order ID</th>
                    <th>Customer</th>
                    <th style="width:70px;text-align:center;">Items</th>
                    <th style="width:120px;">Total</th>
                    <th style="width:160px;">Status</th>
                    <th style="width:130px;">Date</th>
                    <th style="width:110px;text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody id="ordersBody">
                <tr>
                    <td colspan="8" class="om-empty">
                        <div class="om-empty-icon"><i class="fas fa-spinner fa-spin"></i></div>
                        <strong>Loading orders…</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="om-footer">
        <span class="om-footer-info" id="orderFooterInfo"></span>
        <div id="ordersPagination"></div>
    </div>
</div>

{{-- ── ADD / EDIT MODAL ── --}}
<div class="modal fade om-modal" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title-text">
                    <div class="modal-title-icon"><i class="fas fa-shopping-bag" id="modalIcon"></i></div>
                    <span id="modalTitle">Add Order</span>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="orderForm" autocomplete="off">
                    <input type="hidden" id="orderId">

                    <div class="om-form-grid">
                        {{-- User ID --}}
                        <div class="om-form-group">
                            <label class="om-label">User ID <span class="req">*</span></label>
                            <input type="number" id="user_id" class="om-input" placeholder="Enter user ID">
                            <span class="om-error" id="error-user_id"></span>
                        </div>

                        {{-- Status --}}
                        <div class="om-form-group">
                            <label class="om-label">Status <span class="req">*</span></label>
                            <select id="status" class="om-input">
                                <option value="pending">⏳ Pending</option>
                                <option value="processing">🔄 Processing</option>
                                <option value="completed">✅ Completed</option>
                                <option value="cancelled">❌ Cancelled</option>
                            </select>
                            <span class="om-error" id="error-status"></span>
                        </div>

                        {{-- Total --}}
                        <div class="om-form-group om-form-full">
                            <label class="om-label">Total Amount ($) <span class="req">*</span></label>
                            <input type="number" step="0.01" id="total" class="om-input" placeholder="0.00" min="0">
                            <span class="om-error" id="error-total"></span>
                        </div>
                    </div>

                    <div class="om-section-label">Order Items</div>

                    <div id="itemsContainer"></div>

                    <button type="button" class="om-btn om-btn-ghost" id="addItemBtn" style="margin-top:4px;">
                        <i class="fas fa-plus"></i> Add Item
                    </button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="om-btn om-btn-ghost" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="om-btn om-btn-primary" id="saveOrderBtn">
                    <i class="fas fa-save"></i> Save Order
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ── VIEW MODAL ── --}}
<div class="modal fade om-modal" id="viewOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title-text">
                    <div class="modal-title-icon"><i class="fas fa-receipt"></i></div>
                    <span>Order Details</span>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body" id="orderDetails"></div>

            <div class="modal-footer">
                <button type="button" class="om-btn om-btn-ghost" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ── TOAST CONTAINER ── --}}
<div class="om-toast-container" id="toastContainer"></div>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
const token = '{{ csrf_token() }}';
let activeStatusFilter = '';

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
    toast.className = `om-toast ${type}`;
    toast.innerHTML = `
        <i class="fas ${TOAST_ICONS[type]} om-toast-icon"></i>
        <span class="om-toast-msg">${message}</span>
        <button class="om-toast-close" onclick="dismissToast(this.parentElement)">
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
function formatCurrency(v) {
    return '$' + Number(v || 0).toFixed(2);
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}

function statusClass(s) {
    return { pending: 's-pending', processing: 's-processing', completed: 's-completed', cancelled: 's-cancelled' }[s] || '';
}

function statusBadgeClass(s) {
    return { pending: 'om-badge-yellow', processing: 'om-badge-blue', completed: 'om-badge-green', cancelled: 'om-badge-red' }[s] || 'om-badge-gray';
}

function statusIcon(s) {
    return { pending: '⏳', processing: '🔄', completed: '✅', cancelled: '❌' }[s] || '';
}

function clearErrors() {
    ['user_id', 'status', 'total'].forEach(id => {
        const el = document.getElementById(id);
        const err = document.getElementById('error-' + id);
        if (el)  el.classList.remove('is-invalid');
        if (err) { err.textContent = ''; err.classList.remove('show'); }
    });
}

function showError(field, message) {
    const el = document.getElementById(field);
    const err = document.getElementById('error-' + field);
    if (el)  el.classList.add('is-invalid', 'om-input');
    if (err) { err.textContent = message; err.classList.add('show'); }
}

/* ── FETCH & RENDER ── */
async function fetchOrders() {
    const tbody = document.getElementById('ordersBody');
    tbody.innerHTML = `<tr><td colspan="8" class="om-empty">
        <div class="om-empty-icon"><i class="fas fa-spinner fa-spin"></i></div>
        <strong>Loading…</strong></td></tr>`;

    try {
        const res = await axios.get('{{ route('admin.orders.list') }}');
        let orders = res.data;

        // Filter by active status tab
        if (activeStatusFilter) {
            orders = orders.filter(o => o.status === activeStatusFilter);
        }

        document.getElementById('orderCount').textContent =
            orders.length + ' order' + (orders.length !== 1 ? 's' : '');

        if (orders.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="om-empty">
                <div class="om-empty-icon"><i class="fas fa-shopping-bag"></i></div>
                <strong>No orders found</strong>
                <p>No orders match the current filter.</p>
            </td></tr>`;
            document.getElementById('orderFooterInfo').textContent = '';
            return;
        }

        tbody.innerHTML = '';
        orders.forEach((o, index) => {
            tbody.innerHTML += `
            <tr>
                <td><span class="om-row-num">${orders.length - index}</span></td>
                <td><span class="om-badge om-badge-purple">#${o.id}</span></td>
                <td>
                    <div class="om-customer-name">${o.user?.name ?? 'N/A'}</div>
                    <div class="om-customer-email">${o.user?.email ?? ''}</div>
                </td>
                <td style="text-align:center;">
                    <span class="om-badge om-badge-gray">${o.items?.length ?? 0}</span>
                </td>
                <td><span class="om-amount">${formatCurrency(o.total)}</span></td>
                <td>
                    <select class="om-status-select ${statusClass(o.status)}"
                        data-order-id="${o.id}"
                        onchange="quickUpdateStatus(${o.id}, this)">
                        <option value="pending"    ${o.status === 'pending'    ? 'selected' : ''}>⏳ Pending</option>
                        <option value="processing" ${o.status === 'processing' ? 'selected' : ''}>🔄 Processing</option>
                        <option value="completed"  ${o.status === 'completed'  ? 'selected' : ''}>✅ Completed</option>
                        <option value="cancelled"  ${o.status === 'cancelled'  ? 'selected' : ''}>❌ Cancelled</option>
                    </select>
                </td>
                <td style="color:var(--om-text3);font-size:12.5px;">
                    <i class="far fa-calendar-alt" style="margin-right:5px;"></i>${formatDate(o.created_at)}
                </td>
                <td>
                    <div class="om-actions">
                        <button class="om-action-btn view" onclick="viewOrder(${o.id})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="om-action-btn edit" onclick="editOrder(${o.id})" title="Edit Order">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="om-action-btn del" onclick="deleteOrder(${o.id})" title="Delete Order">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });

        document.getElementById('orderFooterInfo').textContent =
            `Showing ${orders.length} of ${res.data.length} orders`;

    } catch (e) {
        tbody.innerHTML = `<tr><td colspan="8" class="om-empty">
            <div class="om-empty-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <strong>Failed to load orders</strong>
            <p>Please refresh the page and try again.</p>
        </td></tr>`;
    }
}

/* ── STATUS FILTER TABS ── */
document.getElementById('statusFilterTabs').addEventListener('click', function (e) {
    const btn = e.target.closest('.om-filter-tab');
    if (!btn) return;
    this.querySelectorAll('.om-filter-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    activeStatusFilter = btn.dataset.status;
    fetchOrders();
});

/* ── MODAL HELPERS ── */
function openModal(title, icon = 'fa-shopping-bag') {
    clearErrors();
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalIcon').className = 'fas ' + icon;
    $('#orderModal').modal('show');
}

/* ── ADD ── */
document.getElementById('btnAddOrder').addEventListener('click', () => {
    document.getElementById('orderForm').reset();
    document.getElementById('orderId').value = '';
    document.getElementById('itemsContainer').innerHTML = '';
    openModal('Add Order', 'fa-plus');
});

/* ── ADD ITEM ROW ── */
function addItemRow(data = {}) {
    const container = document.getElementById('itemsContainer');
    const row = document.createElement('div');
    row.className = 'om-item-row';
    row.innerHTML = `
        <div class="om-form-group">
            <label class="om-label">Product ID</label>
            <input type="number" class="om-input product_id" placeholder="e.g. 12" value="${data.product_id ?? ''}">
        </div>
        <div class="om-form-group">
            <label class="om-label">Quantity</label>
            <input type="number" class="om-input quantity" min="1" placeholder="1" value="${data.quantity ?? 1}">
        </div>
        <div class="om-form-group">
            <label class="om-label">Unit Price ($)</label>
            <input type="number" step="0.01" class="om-input price" placeholder="0.00" value="${data.price ?? ''}">
        </div>
        <button type="button" class="om-remove-btn" onclick="this.closest('.om-item-row').remove()">
            <i class="fas fa-trash-alt"></i>
        </button>`;
    container.appendChild(row);
}

document.getElementById('addItemBtn').addEventListener('click', () => addItemRow());

/* ── SAVE ── */
document.getElementById('saveOrderBtn').addEventListener('click', saveOrder);

async function saveOrder() {
    clearErrors();

    const user_id = document.getElementById('user_id').value;
    const status  = document.getElementById('status').value;
    const total   = document.getElementById('total').value;
    const id      = document.getElementById('orderId').value;

    if (!user_id || !status || !total) {
        if (!user_id) showError('user_id', 'User ID is required.');
        if (!total)   showError('total', 'Total amount is required.');
        showToast('Please fill in all required fields.', 'warning');
        return;
    }

    const saveBtn = document.getElementById('saveOrderBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving…';

    const data = { user_id, status, total: parseFloat(total) };

    try {
        if (id) {
            await axios.put(`/admin/orders/${id}`, data, { headers: { 'X-CSRF-TOKEN': token } });
            showToast('Order updated successfully!', 'success');
        } else {
            await axios.post('/admin/orders', data, { headers: { 'X-CSRF-TOKEN': token } });
            showToast('Order created successfully!', 'success');
        }

        $('#orderModal').modal('hide');
        fetchOrders();

    } catch (e) {
        if (e.response?.status === 422) {
            Object.entries(e.response.data.errors).forEach(([f, m]) => showError(f, m.join(' ')));
            showToast('Please fix the errors below.', 'error');
        } else {
            showToast('Server error. Please try again.', 'error');
        }
    } finally {
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<i class="fas fa-save"></i> Save Order';
    }
}

/* ── VIEW ── */
async function viewOrder(id) {
    try {
        const res = await axios.get(`/admin/orders/${id}`);
        const o = res.data;

        let itemsHtml = `
        <div class="om-section-label" style="margin-top:0;">Order Items</div>
        <table class="om-items-table">
            <thead>
                <tr>
                    <th style="width:54px;">Image</th>
                    <th>Product</th>
                    <th style="width:70px;text-align:center;">Qty</th>
                    <th style="width:90px;">Price</th>
                    <th style="width:90px;">Discount</th>
                    <th style="width:100px;text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>`;

        o.items?.forEach(item => {
            const thumb = item.product?.image
                ? `<img src="/storage/${item.product.image}" class="om-product-thumb" alt="${item.product?.name ?? ''}">`
                : `<div class="om-thumb-placeholder"><i class="fas fa-image"></i></div>`;
            const disc = item.discount_percent > 0
                ? `<span class="om-badge om-badge-red">−${Number(item.discount_percent).toFixed(1)}%</span>`
                : `<span style="color:var(--om-text3);">—</span>`;
            itemsHtml += `
                <tr>
                    <td>${thumb}</td>
                    <td><strong>${item.product?.name ?? 'Product #' + item.product_id}</strong></td>
                    <td style="text-align:center;"><span class="om-badge om-badge-gray">${item.quantity}</span></td>
                    <td>${formatCurrency(item.price)}</td>
                    <td>${disc}</td>
                    <td style="text-align:right;font-weight:700;color:var(--om-green);">${formatCurrency(item.price * item.quantity)}</td>
                </tr>`;
        });

        itemsHtml += `</tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right;color:var(--om-text2);">Total</td>
                    <td style="text-align:right;color:var(--om-green);">${formatCurrency(o.total)}</td>
                </tr>
            </tfoot>
        </table>`;

        document.getElementById('orderDetails').innerHTML = `
        <div class="om-detail-card">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                <div>
                    <div class="om-detail-row"><i class="fas fa-hashtag"></i><span class="om-detail-label">Order ID</span><span class="om-badge om-badge-purple">#${o.id}</span></div>
                    <div class="om-detail-row"><i class="fas fa-user"></i><span class="om-detail-label">Customer</span>${o.user?.name ?? 'N/A'}</div>
                    <div class="om-detail-row"><i class="fas fa-envelope"></i><span class="om-detail-label">Email</span>${o.user?.email ?? 'N/A'}</div>
                </div>
                <div>
                    <div class="om-detail-row"><i class="fas fa-info-circle"></i><span class="om-detail-label">Status</span><span class="om-badge ${statusBadgeClass(o.status)}">${statusIcon(o.status)} ${o.status.charAt(0).toUpperCase() + o.status.slice(1)}</span></div>
                    <div class="om-detail-row"><i class="fas fa-calendar-alt"></i><span class="om-detail-label">Date</span>${formatDate(o.created_at)}</div>
                    <div class="om-detail-row"><i class="fas fa-box"></i><span class="om-detail-label">Items</span><span class="om-badge om-badge-gray">${o.items?.length ?? 0} items</span></div>
                </div>
            </div>
        </div>
        ${itemsHtml}`;

        $('#viewOrderModal').modal('show');
    } catch (e) {
        showToast('Could not load order details.', 'error');
    }
}

/* ── EDIT ── */
async function editOrder(id) {
    try {
        const res = await axios.get(`/admin/orders/${id}`);
        const o = res.data;

        document.getElementById('orderId').value  = o.id;
        document.getElementById('user_id').value  = o.user_id;
        document.getElementById('status').value   = o.status;
        document.getElementById('total').value    = o.total;

        const container = document.getElementById('itemsContainer');
        container.innerHTML = '';
        o.items?.forEach(item => addItemRow({
            product_id: item.product_id,
            quantity:   item.quantity,
            price:      item.price,
        }));

        openModal('Edit Order', 'fa-pen');
    } catch (e) {
        showToast('Could not load order. Please try again.', 'error');
    }
}

/* ── DELETE ── */
async function deleteOrder(id) {
    if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) return;
    try {
        await axios.delete(`/admin/orders/${id}`, { headers: { 'X-CSRF-TOKEN': token } });
        showToast('Order deleted.', 'info');
        fetchOrders();
    } catch (e) {
        showToast('Failed to delete order.', 'error');
    }
}

/* ── QUICK STATUS ── */
async function quickUpdateStatus(orderId, selectEl) {
    const newStatus = selectEl.value;
    try {
        const res = await axios.get(`/admin/orders/${orderId}`);
        await axios.put(`/admin/orders/${orderId}`, {
            status: newStatus,
            total: res.data.total
        }, { headers: { 'X-CSRF-TOKEN': token } });

        // Update select style instantly
        selectEl.className = `om-status-select ${statusClass(newStatus)}`;
        showToast(`Status updated to "${newStatus}".`, 'success');
    } catch (e) {
        showToast('Failed to update status.', 'error');
        fetchOrders();
    }
}

/* ── SEARCH (client-side filter) ── */
document.getElementById('searchInput').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#ordersBody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

/* ── INIT ── */
fetchOrders();
</script>
@stop
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="db-page-header">
        <div class="db-page-header-left">
            <div class="db-page-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div>
                <h1 class="db-page-title">Dashboard</h1>
                <p class="db-page-sub">Welcome back! Here's your store overview.</p>
            </div>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="/admin/products/create" class="db-btn db-btn-primary">
                <i class="fas fa-plus"></i> New Product
            </a>
            <a href="/admin/orders" class="db-btn db-btn-ghost">
                <i class="fas fa-list"></i> All Orders
            </a>
        </div>
    </div>
@stop

@section('css')
<style>
    /* ── VARIABLES ── */
    :root {
        --db-accent:      #7970ac;
        --db-accent-light:#f0eeff;
        --db-accent-dark: #5f57a0;
        --db-surface:     #ffffff;
        --db-bg:          #f5f6fa;
        --db-border:      #e8ecf2;
        --db-text:        #1a1d2e;
        --db-text2:       #64748b;
        --db-text3:       #a0aec0;
        --db-green:       #10b981;
        --db-red:         #ef4444;
        --db-yellow:      #f59e0b;
        --db-blue:        #3b82f6;
        --db-radius:      12px;
        --db-radius-sm:   8px;
        --db-shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
        --db-shadow-md:   0 4px 24px rgba(0,0,0,.10);
    }

    /* ── PAGE HEADER ── */
    .db-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 0 8px;
        flex-wrap: wrap;
    }
    .db-page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .db-page-icon {
        width: 46px; height: 46px;
        background: var(--db-accent-light);
        color: var(--db-accent);
        border-radius: var(--db-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .db-page-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--db-text) !important;
        margin: 0 !important;
        line-height: 1.2;
    }
    .db-page-sub {
        font-size: 12.5px;
        color: var(--db-text2);
        margin: 2px 0 0;
    }

    /* ── BUTTONS ── */
    .db-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: var(--db-radius-sm);
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .db-btn-primary {
        background: var(--db-accent);
        color: #fff;
        box-shadow: 0 4px 14px rgba(121,112,172,.35);
    }
    .db-btn-primary:hover {
        background: var(--db-accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(121,112,172,.45);
        color: #fff;
    }
    .db-btn-ghost {
        background: var(--db-bg);
        color: var(--db-text2);
        border: 1px solid var(--db-border);
    }
    .db-btn-ghost:hover {
        background: var(--db-border);
        color: var(--db-text);
    }

    /* ── STAT CARDS ── */
    .db-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }
    @media (max-width: 1100px) { .db-stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px)  { .db-stats-grid { grid-template-columns: 1fr; } }

    .db-stat-card {
        background: var(--db-surface);
        border: 1px solid var(--db-border);
        border-radius: var(--db-radius);
        box-shadow: var(--db-shadow);
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        position: relative;
        overflow: hidden;
        transition: transform .2s, box-shadow .2s;
        text-decoration: none;
    }
    .db-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--db-shadow-md);
        text-decoration: none;
    }
    .db-stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: var(--db-radius) var(--db-radius) 0 0;
    }
    .db-c1::before { background: linear-gradient(90deg, #7970ac, #a78bfa); }
    .db-c2::before { background: linear-gradient(90deg, #10b981, #34d399); }
    .db-c3::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
    .db-c4::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

    .db-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .db-stat-icon-wrap {
        width: 42px; height: 42px;
        border-radius: var(--db-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .db-c1 .db-stat-icon-wrap { background: #f0eeff; color: #7970ac; }
    .db-c2 .db-stat-icon-wrap { background: #ecfdf5; color: #10b981; }
    .db-c3 .db-stat-icon-wrap { background: #eff6ff; color: #3b82f6; }
    .db-c4 .db-stat-icon-wrap { background: #fffbeb; color: #f59e0b; }

    .db-stat-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--db-text);
        letter-spacing: -1px;
        line-height: 1;
        margin-bottom: 4px;
    }
    .db-stat-label {
        font-size: 12.5px;
        color: var(--db-text2);
        font-weight: 500;
    }
    .db-stat-footer {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid var(--db-border);
        font-size: 12px;
        font-weight: 600;
        color: var(--db-accent);
        display: flex;
        align-items: center;
        gap: 5px;
        transition: gap .15s;
    }
    .db-stat-card:hover .db-stat-footer { gap: 8px; }

    /* ── CARD ── */
    .db-card {
        background: var(--db-surface);
        border: 1px solid var(--db-border);
        border-radius: var(--db-radius);
        box-shadow: var(--db-shadow);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .db-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--db-border);
        gap: 12px;
    }
    .db-card-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--db-text);
    }
    .db-card-sub {
        font-size: 12px;
        color: var(--db-text3);
        margin-top: 2px;
    }
    .db-card-body { padding: 20px; }
    .db-view-link {
        font-size: 12.5px;
        color: var(--db-accent);
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        transition: gap .15s;
    }
    .db-view-link:hover { color: var(--db-accent-dark); gap: 8px; }

    /* ── TABLE ── */
    .db-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }
    .db-table thead th {
        padding: 10px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--db-text3);
        background: #fafbfc;
        border-bottom: 1px solid var(--db-border);
        white-space: nowrap;
    }
    .db-table tbody tr {
        border-bottom: 1px solid #f4f5f8;
        transition: background .15s;
    }
    .db-table tbody tr:last-child { border-bottom: none; }
    .db-table tbody tr:hover { background: #fafbff; }
    .db-table tbody td {
        padding: 11px 16px;
        color: var(--db-text);
        vertical-align: middle;
    }

    /* ── CUSTOMER CELL ── */
    .db-customer-cell { display: flex; align-items: center; gap: 9px; }
    .db-avatar {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: var(--db-accent-light);
        color: var(--db-accent);
        font-size: 11px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 1px solid rgba(121,112,172,.2);
    }
    .db-order-id {
        font-weight: 700;
        font-size: 13px;
    }
    .db-date { color: var(--db-text3); font-size: 12.5px; }
    .db-price { font-weight: 700; color: var(--db-text); }
    .db-product-name {
        font-weight: 500;
        color: var(--db-text);
        max-width: 160px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ── BADGES ── */
    .db-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .db-badge::before {
        content: '';
        width: 5px; height: 5px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .db-badge-completed  { background: #ecfdf5; color: #065f46; }
    .db-badge-completed::before  { background: var(--db-green); }
    .db-badge-pending    { background: #fffbeb; color: #92400e; }
    .db-badge-pending::before    { background: var(--db-yellow); }
    .db-badge-processing { background: var(--db-accent-light); color: var(--db-accent-dark); }
    .db-badge-processing::before { background: var(--db-accent); }
    .db-badge-cancelled  { background: #fef2f2; color: #991b1b; }
    .db-badge-cancelled::before  { background: var(--db-red); }
    .db-badge-shipped    { background: #eff6ff; color: #1e40af; }
    .db-badge-shipped::before    { background: var(--db-blue); }
    .db-badge-count      { background: var(--db-accent-light); color: var(--db-accent); }

    /* ── EMPTY STATE ── */
    .db-empty {
        text-align: center;
        padding: 36px 20px !important;
        color: var(--db-text3);
    }
    .db-empty i { display: block; font-size: 32px; margin-bottom: 10px; opacity: .3; }
    .db-empty span { font-size: 13px; color: var(--db-text2); }

    /* ── QUICK ACTIONS ── */
    .db-quick-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
    }
    @media (max-width: 992px) { .db-quick-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 576px) { .db-quick-grid { grid-template-columns: repeat(2, 1fr); } }

    .db-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 18px 12px;
        border-radius: var(--db-radius);
        background: var(--db-bg);
        border: 1px solid var(--db-border);
        text-decoration: none;
        color: var(--db-text2);
        font-size: 12.5px;
        font-weight: 600;
        text-align: center;
        transition: all .2s;
    }
    .db-action-btn:hover {
        background: #fff;
        border-color: var(--db-accent);
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(121,112,172,.15);
        color: var(--db-accent);
        text-decoration: none;
    }
    .db-action-icon {
        width: 42px; height: 42px;
        border-radius: var(--db-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
        transition: transform .2s;
    }
    .db-action-btn:hover .db-action-icon { transform: scale(1.1); }

    /* ── SUMMARY ROW ── */
    .db-summary-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    @media (max-width: 768px) { .db-summary-row { grid-template-columns: 1fr; } }

    /* ── TOAST ── */
    .db-toast-container {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }
    .db-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--db-text);
        color: #fff;
        padding: 13px 18px;
        border-radius: var(--db-radius-sm);
        font-size: 13.5px;
        font-weight: 500;
        min-width: 240px;
        max-width: 340px;
        box-shadow: 0 8px 32px rgba(0,0,0,.22);
        pointer-events: all;
        animation: db-toast-in .3s cubic-bezier(.34,1.56,.64,1) forwards;
        border-left: 4px solid transparent;
    }
    .db-toast.success { border-left-color: var(--db-green); }
    .db-toast.error   { border-left-color: var(--db-red); }
    .db-toast.info    { border-left-color: var(--db-accent); }
    .db-toast.warning { border-left-color: var(--db-yellow); }
    .db-toast-icon { font-size: 16px; flex-shrink: 0; }
    .db-toast.success .db-toast-icon { color: var(--db-green); }
    .db-toast.error   .db-toast-icon { color: var(--db-red); }
    .db-toast.info    .db-toast-icon { color: #a78bfa; }
    .db-toast.warning .db-toast-icon { color: var(--db-yellow); }
    .db-toast-msg { flex: 1; }
    .db-toast-close {
        background: none; border: none; color: rgba(255,255,255,.5);
        font-size: 14px; cursor: pointer; padding: 0; transition: color .15s;
    }
    .db-toast-close:hover { color: #fff; }
    .db-toast.leaving { animation: db-toast-out .25s ease forwards; }

    @keyframes db-toast-in {
        from { opacity: 0; transform: translateX(32px) scale(.96); }
        to   { opacity: 1; transform: translateX(0)   scale(1); }
    }
    @keyframes db-toast-out {
        from { opacity: 1; transform: translateX(0) scale(1); }
        to   { opacity: 0; transform: translateX(32px) scale(.96); }
    }
</style>
@stop

@section('content')

    {{-- ── STAT CARDS ── --}}
    <div class="db-stats-grid">

        <a href="/admin/products" class="db-stat-card db-c1">
            <div class="db-stat-top">
                <div class="db-stat-icon-wrap"><i class="fas fa-boxes"></i></div>
            </div>
            <div class="db-stat-value">{{ $productsCount ?? 0 }}</div>
            <div class="db-stat-label">Total Products</div>
            <div class="db-stat-footer">View all products <i class="fas fa-arrow-right fa-xs"></i></div>
        </a>

        <a href="/admin/categories" class="db-stat-card db-c2">
            <div class="db-stat-top">
                <div class="db-stat-icon-wrap"><i class="fas fa-tags"></i></div>
            </div>
            <div class="db-stat-value">{{ $categoriesCount ?? 0 }}</div>
            <div class="db-stat-label">Categories</div>
            <div class="db-stat-footer">Manage categories <i class="fas fa-arrow-right fa-xs"></i></div>
        </a>

        <a href="/admin/orders" class="db-stat-card db-c3">
            <div class="db-stat-top">
                <div class="db-stat-icon-wrap"><i class="fas fa-shopping-bag"></i></div>
            </div>
            <div class="db-stat-value">{{ $ordersCount ?? 0 }}</div>
            <div class="db-stat-label">Total Orders</div>
            <div class="db-stat-footer">View all orders <i class="fas fa-arrow-right fa-xs"></i></div>
        </a>

        <a href="/admin/users" class="db-stat-card db-c4">
            <div class="db-stat-top">
                <div class="db-stat-icon-wrap"><i class="fas fa-users"></i></div>
            </div>
            <div class="db-stat-value">{{ $usersCount ?? 0 }}</div>
            <div class="db-stat-label">Registered Users</div>
            <div class="db-stat-footer">Manage users <i class="fas fa-arrow-right fa-xs"></i></div>
        </a>

    </div>

    {{-- ── RECENT ORDERS + TOP PRODUCTS ── --}}
    <div class="db-summary-row">

        {{-- Recent Orders --}}
        <div class="db-card" style="margin-bottom:0;">
            <div class="db-card-header">
                <div>
                    <div class="db-card-title">Recent Orders</div>
                    <div class="db-card-sub">Latest customer purchases</div>
                </div>
                <a href="/admin/orders" class="db-view-link">View all <i class="fas fa-arrow-right fa-xs"></i></a>
            </div>
            <div style="overflow-x:auto;">
                <table class="db-table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td><span class="db-order-id">#{{ $order->id }}</span></td>
                                <td>
                                    <div class="db-customer-cell">
                                        <div class="db-avatar">{{ strtoupper(substr($order->user->name ?? 'N', 0, 1)) }}</div>
                                        <span style="font-weight:500;">{{ $order->user->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusMap = [
                                            'processing' => 'db-badge-processing',
                                            'completed'  => 'db-badge-completed',
                                            'cancelled'  => 'db-badge-cancelled',
                                            'pending'    => 'db-badge-pending',
                                            'shipped'    => 'db-badge-shipped',
                                        ];
                                        $sc = $statusMap[$order->status ?? 'pending'] ?? 'db-badge-pending';
                                    @endphp
                                    <span class="db-badge {{ $sc }}">{{ ucfirst($order->status ?? 'pending') }}</span>
                                </td>
                                <td class="db-date">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="db-empty">
                                    <i class="fas fa-inbox"></i>
                                    <span>No orders yet</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="db-card" style="margin-bottom:0;">
            <div class="db-card-header">
                <div>
                    <div class="db-card-title">Top Products</div>
                    <div class="db-card-sub">Best selling items</div>
                </div>
                <a href="/admin/products" class="db-view-link">View all <i class="fas fa-arrow-right fa-xs"></i></a>
            </div>
            <div style="overflow-x:auto;">
                <table class="db-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th style="text-align:center;">Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts ?? [] as $product)
                            <tr>
                                <td><div class="db-product-name">{{ $product->name }}</div></td>
                                <td class="db-price">${{ number_format($product->price, 2) }}</td>
                                <td style="text-align:center;">
                                    <span class="db-badge db-badge-count">{{ $product->order_items_count }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="db-empty">
                                    <i class="fas fa-box-open"></i>
                                    <span>No products yet</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- ── QUICK ACTIONS ── --}}
    <div class="db-card">
        <div class="db-card-header">
            <div>
                <div class="db-card-title">Quick Actions</div>
                <div class="db-card-sub">Shortcuts to common tasks</div>
            </div>
        </div>
        <div class="db-card-body">
            <div class="db-quick-grid">

                <a href="/admin/products/create" class="db-action-btn" onclick="showToast('Opening Add Product…','info')">
                    <div class="db-action-icon" style="background:#f0eeff;color:#7970ac;">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    Add Product
                </a>

                <a href="/admin/categories" class="db-action-btn" onclick="showToast('Opening Categories…','info')">
                    <div class="db-action-icon" style="background:#ecfdf5;color:#10b981;">
                        <i class="fas fa-folder-plus"></i>
                    </div>
                    Add Category
                </a>

                <a href="/admin/orders" class="db-action-btn" onclick="showToast('Opening Orders…','info')">
                    <div class="db-action-icon" style="background:#fffbeb;color:#f59e0b;">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    View Orders
                </a>

                <a href="/admin/users" class="db-action-btn" onclick="showToast('Opening Users…','info')">
                    <div class="db-action-icon" style="background:#eff6ff;color:#3b82f6;">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    Manage Users
                </a>

                <a href="/admin/products" class="db-action-btn" onclick="showToast('Opening Inventory…','info')">
                    <div class="db-action-icon" style="background:#f0eeff;color:#7970ac;">
                        <i class="fas fa-boxes"></i>
                    </div>
                    Inventory
                </a>

                <a href="/admin/settings" class="db-action-btn" onclick="showToast('Opening Settings…','info')">
                    <div class="db-action-icon" style="background:#ecfdf5;color:#10b981;">
                        <i class="fas fa-cog"></i>
                    </div>
                    Settings
                </a>

            </div>
        </div>
    </div>

    {{-- ── TOAST CONTAINER ── --}}
    <div class="db-toast-container" id="toastContainer"></div>

@stop

@section('js')
<script>
    /* ── TOAST ── */
    const TOAST_ICONS = {
        success: 'fa-check-circle',
        error:   'fa-exclamation-circle',
        info:    'fa-info-circle',
        warning: 'fa-exclamation-triangle',
    };

    function showToast(message, type = 'success', duration = 3000) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `db-toast ${type}`;
        toast.innerHTML = `
            <i class="fas ${TOAST_ICONS[type]} db-toast-icon"></i>
            <span class="db-toast-msg">${message}</span>
            <button class="db-toast-close" onclick="dismissToast(this.parentElement)">
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

    /* ── WELCOME TOAST ── */
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => showToast('Dashboard loaded successfully!', 'success', 3000), 500);
    });
</script>
@stop
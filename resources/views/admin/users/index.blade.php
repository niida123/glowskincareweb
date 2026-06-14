@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <div class="um-page-header">
        <div class="um-page-header-left">
            <div class="um-page-icon">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h1 class="um-page-title">Users</h1>
                <p class="um-page-sub">Manage accounts and permissions</p>
            </div>
        </div>
        <button class="um-btn um-btn-primary" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-user-plus"></i> Add User
        </button>
    </div>
@stop

@section('css')
<style>
    /* ── VARIABLES ── */
    :root {
        --um-accent:      #7970ac;
        --um-accent-light:#f0eeff;
        --um-accent-dark: #5f57a0;
        --um-surface:     #ffffff;
        --um-bg:          #f5f6fa;
        --um-border:      #e8ecf2;
        --um-text:        #1a1d2e;
        --um-text2:       #64748b;
        --um-text3:       #a0aec0;
        --um-green:       #10b981;
        --um-red:         #ef4444;
        --um-yellow:      #f59e0b;
        --um-blue:        #3b82f6;
        --um-radius:      12px;
        --um-radius-sm:   8px;
        --um-shadow:      0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
        --um-shadow-md:   0 4px 24px rgba(0,0,0,.10);
    }

    /* ── PAGE HEADER ── */
    .um-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 4px 0 8px;
        flex-wrap: wrap;
    }
    .um-page-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .um-page-icon {
        width: 46px; height: 46px;
        background: var(--um-accent-light);
        color: var(--um-accent);
        border-radius: var(--um-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .um-page-title {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: var(--um-text) !important;
        margin: 0 !important;
        line-height: 1.2;
    }
    .um-page-sub {
        font-size: 12.5px;
        color: var(--um-text2);
        margin: 2px 0 0;
    }

    /* ── BUTTONS ── */
    .um-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        border-radius: var(--um-radius-sm);
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .um-btn-primary {
        background: var(--um-accent);
        color: #fff;
        box-shadow: 0 4px 14px rgba(121,112,172,.35);
    }
    .um-btn-primary:hover {
        background: var(--um-accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(121,112,172,.45);
        color: #fff;
    }
    .um-btn-ghost {
        background: var(--um-bg);
        color: var(--um-text2);
        border: 1px solid var(--um-border);
    }
    .um-btn-ghost:hover {
        background: var(--um-border);
        color: var(--um-text);
    }

    /* ── INFO BANNER ── */
    .um-info-banner {
        background: var(--um-surface);
        border: 1px solid var(--um-border);
        border-radius: var(--um-radius);
        box-shadow: var(--um-shadow);
        padding: 14px 18px;
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .um-info-icon {
        width: 30px; height: 30px;
        background: var(--um-accent-light);
        color: var(--um-accent);
        border-radius: var(--um-radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .um-info-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 6px 24px;
    }
    .um-info-item {
        font-size: 12.5px;
        color: var(--um-text2);
    }
    .um-info-item strong { color: var(--um-text); font-weight: 600; }

    /* ── CARD ── */
    .um-card {
        background: var(--um-surface);
        border: 1px solid var(--um-border);
        border-radius: var(--um-radius);
        box-shadow: var(--um-shadow);
        overflow: hidden;
    }
    .um-card-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--um-border);
        gap: 12px;
        flex-wrap: wrap;
    }
    .um-toolbar-left { display: flex; align-items: center; gap: 10px; }

    /* ── SEARCH ── */
    .um-search-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--um-bg);
        border: 1px solid var(--um-border);
        border-radius: var(--um-radius-sm);
        padding: 7px 13px;
        width: 220px;
        transition: border-color .15s;
    }
    .um-search-wrap:focus-within { border-color: var(--um-accent); background: #fff; }
    .um-search-wrap input {
        border: none; background: none; outline: none;
        font-size: 13px; color: var(--um-text); width: 100%; font-family: inherit;
    }
    .um-search-wrap input::placeholder { color: var(--um-text3); }
    .um-search-wrap i { color: var(--um-text3); font-size: 13px; }

    .um-count-badge {
        background: var(--um-accent-light);
        color: var(--um-accent);
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    /* ── TABLE ── */
    .um-table-wrap { overflow-x: auto; }
    .um-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }
    .um-table thead th {
        padding: 11px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--um-text3);
        background: #fafbfc;
        border-bottom: 1px solid var(--um-border);
        white-space: nowrap;
    }
    .um-table tbody tr {
        border-bottom: 1px solid #f4f5f8;
        transition: background .15s;
    }
    .um-table tbody tr:last-child { border-bottom: none; }
    .um-table tbody tr:hover { background: #fafbff; }
    .um-table tbody td {
        padding: 12px 16px;
        color: var(--um-text);
        vertical-align: middle;
    }

    /* ── ROW NUMBER ── */
    .um-row-num { font-size: 12px; color: var(--um-text3); font-weight: 600; }

    /* ── USER CELL ── */
    .um-user-cell { display: flex; align-items: center; gap: 11px; }
    .um-avatar {
        width: 38px; height: 38px;
        border-radius: 50%;
        background: var(--um-accent-light);
        color: var(--um-accent);
        font-size: 13px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 1.5px solid rgba(121,112,172,.2);
        text-transform: uppercase;
        overflow: hidden;
    }
    .um-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .um-user-name { font-weight: 600; color: var(--um-text); font-size: 13.5px; }
    .um-user-desc { font-size: 11.5px; color: var(--um-text3); margin-top: 2px; }
    .um-email { font-size: 13px; color: var(--um-text2); }

    /* ── ROLE BADGES ── */
    .um-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 9px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .um-badge-super  { background: #f3e8ff; color: #7e22ce; }
    .um-badge-admin  { background: var(--um-accent-light); color: var(--um-accent); }
    .um-badge-manager{ background: #eff6ff; color: #1d4ed8; }
    .um-badge-seller { background: #fffbeb; color: #92400e; }
    .um-badge-customer{ background: #f1f3f7; color: #64748b; }

    /* ── DASHBOARD ACCESS ── */
    .um-access-yes { color: var(--um-green); font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 5px; }
    .um-access-no  { color: var(--um-text3); font-size: 13px; display: flex; align-items: center; gap: 5px; }

    /* ── ACTION BUTTONS ── */
    .um-actions { display: flex; align-items: center; gap: 6px; }
    .um-action-btn {
        width: 32px; height: 32px;
        border-radius: var(--um-radius-sm);
        border: 1px solid var(--um-border);
        background: var(--um-bg);
        display: inline-flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 13px;
        transition: all .15s;
        color: var(--um-text2);
    }
    .um-action-btn:hover { transform: translateY(-1px); }
    .um-action-btn.edit:hover { background: #eff6ff; border-color: #93c5fd; color: #2563eb; }
    .um-action-btn.del:hover  { background: #fef2f2; border-color: #fca5a5; color: var(--um-red); }

    /* ── EMPTY STATE ── */
    .um-empty {
        text-align: center;
        padding: 52px 20px !important;
        color: var(--um-text3);
    }
    .um-empty-icon { font-size: 42px; margin-bottom: 12px; opacity: .3; }
    .um-empty p { font-size: 14px; color: var(--um-text2); margin: 4px 0 0; }

    /* ── FOOTER / PAGINATION ── */
    .um-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--um-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .um-footer-info { font-size: 12.5px; color: var(--um-text3); }
    .um-footer .pagination { margin: 0; }
    .um-footer .page-link {
        border-radius: var(--um-radius-sm) !important;
        border: 1px solid var(--um-border);
        color: var(--um-text2);
        font-size: 12.5px;
        padding: 5px 11px;
        margin: 0 2px;
        transition: all .15s;
    }
    .um-footer .page-item.active .page-link {
        background: var(--um-accent) !important;
        border-color: var(--um-accent) !important;
        color: #fff !important;
    }
    .um-footer .page-link:hover {
        background: var(--um-accent-light);
        color: var(--um-accent);
        border-color: var(--um-accent);
    }

    /* ── MODAL ── */
    .um-modal .modal-content {
        border: none;
        border-radius: var(--um-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,.18);
        overflow: hidden;
    }
    .um-modal .modal-header {
        background: var(--um-accent);
        padding: 18px 22px;
        border: none;
    }
    .um-modal .modal-title-text {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .um-modal .modal-title-icon {
        width: 32px; height: 32px;
        background: rgba(255,255,255,.18);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }
    .um-modal .close {
        color: rgba(255,255,255,.75);
        font-size: 20px;
        opacity: 1;
        text-shadow: none;
        transition: color .15s;
    }
    .um-modal .close:hover { color: #fff; }
    .um-modal .modal-body { padding: 24px; background: #fff; }
    .um-modal .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid var(--um-border);
        background: #fafbfc;
        gap: 8px;
    }

    /* ── FORM ── */
    .um-form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .um-form-group:last-child { margin-bottom: 0; }
    .um-label {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--um-text2);
        letter-spacing: .3px;
    }
    .um-label .req { color: var(--um-red); margin-left: 2px; }
    .um-label .opt { color: var(--um-text3); font-weight: 400; margin-left: 4px; font-size: 11px; }
    .um-input {
        padding: 9px 13px;
        border: 1.5px solid var(--um-border);
        border-radius: var(--um-radius-sm);
        font-size: 13.5px;
        color: var(--um-text);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
        font-family: inherit;
        background: #fff;
    }
    .um-input:focus {
        border-color: var(--um-accent);
        box-shadow: 0 0 0 3px rgba(121,112,172,.12);
    }

    /* ── ROLE PILLS ── */
    .um-role-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .um-role-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        border-radius: 20px;
        border: 1.5px solid var(--um-border);
        background: var(--um-bg);
        cursor: pointer;
        transition: all .15s;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--um-text2);
        user-select: none;
    }
    .um-role-pill input[type="radio"] { display: none; }
    .um-role-pill:hover { border-color: var(--um-accent); background: var(--um-accent-light); color: var(--um-accent); }
    .um-role-pill input:checked + .um-role-pill-label { color: inherit; }
    .um-role-pill:has(input:checked) {
        border-color: var(--um-accent);
        background: var(--um-accent-light);
        color: var(--um-accent);
    }
    .um-role-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    /* ── SECTION DIVIDER ── */
    .um-section-label {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--um-text3);
        margin: 20px 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .um-section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--um-border);
    }

    /* ── TOAST ── */
    .um-toast-container {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    }
    .um-toast {
        display: flex;
        align-items: center;
        gap: 12px;
        background: var(--um-text);
        color: #fff;
        padding: 13px 18px;
        border-radius: var(--um-radius-sm);
        font-size: 13.5px;
        font-weight: 500;
        min-width: 240px;
        max-width: 340px;
        box-shadow: 0 8px 32px rgba(0,0,0,.22);
        pointer-events: all;
        animation: um-toast-in .3s cubic-bezier(.34,1.56,.64,1) forwards;
        border-left: 4px solid transparent;
    }
    .um-toast.success { border-left-color: var(--um-green); }
    .um-toast.error   { border-left-color: var(--um-red); }
    .um-toast.info    { border-left-color: var(--um-accent); }
    .um-toast.warning { border-left-color: var(--um-yellow); }
    .um-toast-icon { font-size: 16px; flex-shrink: 0; }
    .um-toast.success .um-toast-icon { color: var(--um-green); }
    .um-toast.error   .um-toast-icon { color: var(--um-red); }
    .um-toast.info    .um-toast-icon { color: #a78bfa; }
    .um-toast.warning .um-toast-icon { color: var(--um-yellow); }
    .um-toast-msg { flex: 1; }
    .um-toast-close {
        background: none; border: none;
        color: rgba(255,255,255,.5); font-size: 14px;
        cursor: pointer; padding: 0; transition: color .15s;
    }
    .um-toast-close:hover { color: #fff; }
    .um-toast.leaving { animation: um-toast-out .25s ease forwards; }

    @keyframes um-toast-in {
        from { opacity: 0; transform: translateX(32px) scale(.96); }
        to   { opacity: 1; transform: translateX(0)   scale(1); }
    }
    @keyframes um-toast-out {
        from { opacity: 1; transform: translateX(0) scale(1); }
        to   { opacity: 0; transform: translateX(32px) scale(.96); }
    }

    @media (max-width: 640px) {
        .um-search-wrap { width: 160px; }
    }
</style>
@stop

@section('content')

@php
    $roleMeta = [
        'super_admin' => ['label' => 'Super Admin', 'class' => 'um-badge-super',   'dot' => '#7e22ce', 'desc' => 'Full system control'],
        'admin'       => ['label' => 'Admin',       'class' => 'um-badge-admin',   'dot' => '#7970ac', 'desc' => 'All admin tools'],
        'manager'     => ['label' => 'Manager',     'class' => 'um-badge-manager', 'dot' => '#3b82f6', 'desc' => 'Ops: orders & stock'],
        'seller'      => ['label' => 'Seller',      'class' => 'um-badge-seller',  'dot' => '#f59e0b', 'desc' => 'Own catalog only'],
        'customer'    => ['label' => 'Customer',    'class' => 'um-badge-customer','dot' => '#a0aec0', 'desc' => 'Shopper access'],
    ];
@endphp

{{-- SESSION TOASTS --}}
@if(session('status'))
    <div id="sessionToast" data-type="success" data-msg="{{ session('status') }}"></div>
@endif
@if($errors->any())
    <div id="sessionToast" data-type="error" data-msg="{{ $errors->first() }}"></div>
@endif

{{-- ── INFO BANNER ── --}}
<div class="um-info-banner">
    <div class="um-info-icon"><i class="fas fa-info"></i></div>
    <div class="um-info-grid">
        @foreach($roleMeta as $key => $meta)
            <div class="um-info-item">
                <strong>{{ $meta['label'] }}:</strong> {{ $meta['desc'] }}
            </div>
        @endforeach
    </div>
</div>

{{-- ── MAIN CARD ── --}}
<div class="um-card">

    {{-- TOOLBAR --}}
    <div class="um-card-toolbar">
        <div class="um-toolbar-left">
            <div class="um-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Search users…">
            </div>
            <span class="um-count-badge">{{ $users->total() }} user{{ $users->total() !== 1 ? 's' : '' }}</span>
        </div>
        <button class="um-btn um-btn-ghost" onclick="window.location.reload()">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>

    {{-- TABLE --}}
    <div class="um-table-wrap">
        <table class="um-table" id="usersTable">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th style="width:130px;">Role</th>
                    <th style="width:120px;">Dashboard</th>
                    <th style="width:90px;text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                    @php
                        $meta      = $roleMeta[$user->role] ?? $roleMeta['customer'];
                        $initials  = collect(explode(' ', $user->name))->map(fn($p) => mb_substr($p,0,1))->join('');
                        $dashboard = in_array($user->role, ['admin','super_admin','manager','seller']);
                        $rowNumber = $users->total() - $users->firstItem() - $index + 1;
                    @endphp
                    <tr>
                        <td><span class="um-row-num">{{ $rowNumber }}</span></td>
                        <td>
                            <div class="um-user-cell">
                                <div class="um-avatar">
                                    @if(!empty($user->profile_image))
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}">
                                    @else
                                        {{ $initials }}
                                    @endif
                                </div>
                                <div>
                                    <div class="um-user-name">{{ $user->name }}</div>
                                    <div class="um-user-desc">{{ $meta['desc'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="um-email">{{ $user->email }}</span></td>
                        <td>
                            <span class="um-badge {{ $meta['class'] }}">
                                <span style="width:6px;height:6px;border-radius:50%;background:{{ $meta['dot'] }};display:inline-block;flex-shrink:0;"></span>
                                {{ $meta['label'] }}
                            </span>
                        </td>
                        <td>
                            @if($dashboard)
                                <div class="um-access-yes"><i class="fas fa-check-circle"></i> Yes</div>
                            @else
                                <div class="um-access-no"><i class="fas fa-minus-circle"></i> No</div>
                            @endif
                        </td>
                        <td>
                            <div class="um-actions" style="justify-content:center;">
                                <button class="um-action-btn edit"
                                    data-toggle="modal"
                                    data-target="#editUserModal-{{ $user->id }}"
                                    title="Edit user">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirmDelete(event, '{{ addslashes($user->name) }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="um-action-btn del" title="Delete user">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="um-empty">
                            <div class="um-empty-icon"><i class="fas fa-user-slash"></i></div>
                            <strong>No users found</strong>
                            <p>Add your first user to get started.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="um-footer">
        <span class="um-footer-info">
            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
        </span>
        <div>{{ $users->links('pagination::bootstrap-4') }}</div>
    </div>
</div>

{{-- ── EDIT MODALS ── --}}
@foreach($users as $user)
    @php $meta = $roleMeta[$user->role] ?? $roleMeta['customer']; @endphp
    <div class="modal fade um-modal" id="editUserModal-{{ $user->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="modal-title-text">
                        <div class="modal-title-icon"><i class="fas fa-pen"></i></div>
                        <span>Edit User</span>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data"
                      onsubmit="showToast('Saving changes…','info')">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="um-section-label" style="margin-top:0;">Account Info</div>

                        <div class="um-form-group">
                            <label class="um-label">Full Name <span class="req">*</span></label>
                            <input type="text" name="name" class="um-input" value="{{ $user->name }}" required placeholder="Enter full name">
                        </div>
                        <div class="um-form-group">
                            <label class="um-label">Email Address <span class="req">*</span></label>
                            <input type="email" name="email" class="um-input" value="{{ $user->email }}" required placeholder="Enter email">
                        </div>
                        <div class="um-form-group">
                            <label class="um-label">Profile Image <span class="opt">(optional)</span></label>
                            <input type="file" name="profile_image" class="um-input" accept="image/*">
                        </div>

                        <div class="um-section-label">Change Password</div>

                        <div class="um-form-group">
                            <label class="um-label">New Password <span class="opt">(leave blank to keep)</span></label>
                            <input type="password" name="password" class="um-input" placeholder="New password">
                        </div>
                        <div class="um-form-group">
                            <label class="um-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="um-input" placeholder="Confirm new password">
                        </div>

                        <div class="um-section-label">Role</div>

                        <div class="um-role-grid">
                            @foreach($roleMeta as $key => $option)
                                <label class="um-role-pill">
                                    <input type="radio" name="role" value="{{ $key }}" {{ $user->role === $key ? 'checked' : '' }}>
                                    <span class="um-role-dot" style="background:{{ $option['dot'] }};"></span>
                                    {{ $option['label'] }}
                                </label>
                            @endforeach
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="um-btn um-btn-ghost" data-dismiss="modal">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="um-btn um-btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- ── ADD USER MODAL ── --}}
<div class="modal fade um-modal" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title-text">
                    <div class="modal-title-icon"><i class="fas fa-user-plus"></i></div>
                    <span>Add New User</span>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
                  onsubmit="showToast('Creating user…','info')">
                @csrf
                <div class="modal-body">

                    <div class="um-section-label" style="margin-top:0;">Account Info</div>

                    <div class="um-form-group">
                        <label class="um-label">Full Name <span class="req">*</span></label>
                        <input type="text" name="name" class="um-input" required placeholder="Enter full name">
                    </div>
                    <div class="um-form-group">
                        <label class="um-label">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="um-input" required placeholder="Enter email">
                    </div>
                    <div class="um-form-group">
                        <label class="um-label">Profile Image <span class="opt">(optional)</span></label>
                        <input type="file" name="profile_image" class="um-input" accept="image/*">
                    </div>

                    <div class="um-section-label">Password</div>

                    <div class="um-form-group">
                        <label class="um-label">Password <span class="req">*</span></label>
                        <input type="password" name="password" class="um-input" required placeholder="Set a password">
                    </div>
                    <div class="um-form-group">
                        <label class="um-label">Confirm Password <span class="req">*</span></label>
                        <input type="password" name="password_confirmation" class="um-input" required placeholder="Confirm password">
                    </div>

                    <div class="um-section-label">Role</div>

                    <div class="um-role-grid">
                        @foreach($roleMeta as $key => $option)
                            <label class="um-role-pill">
                                <input type="radio" name="role" value="{{ $key }}" {{ $key === 'customer' ? 'checked' : '' }}>
                                <span class="um-role-dot" style="background:{{ $option['dot'] }};"></span>
                                {{ $option['label'] }}
                            </label>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="um-btn um-btn-ghost" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="um-btn um-btn-primary">
                        <i class="fas fa-user-plus"></i> Create User
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- ── TOAST CONTAINER ── --}}
<div class="um-toast-container" id="toastContainer"></div>

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

    function showToast(message, type = 'success', duration = 3500) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `um-toast ${type}`;
        toast.innerHTML = `
            <i class="fas ${TOAST_ICONS[type]} um-toast-icon"></i>
            <span class="um-toast-msg">${message}</span>
            <button class="um-toast-close" onclick="dismissToast(this.parentElement)">
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

    /* ── SESSION TOASTS ── */
    window.addEventListener('DOMContentLoaded', () => {
        const el = document.getElementById('sessionToast');
        if (el) showToast(el.dataset.msg, el.dataset.type);
    });

    /* ── DELETE CONFIRM ── */
    function confirmDelete(e, name) {
        if (!confirm(`Are you sure you want to delete "${name}"? This action cannot be undone.`)) {
            e.preventDefault();
            return false;
        }
        showToast(`Deleting user "${name}"…`, 'warning');
        return true;
    }

    /* ── CLIENT-SIDE SEARCH ── */
    document.getElementById('searchInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#usersTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
</script>
@stop
@extends('admindashboard.layout')

@section('title', 'Staff')

@section('content')

<div class="staff-list-page">

    {{-- Page Header --}}
    <div class="staff-page-header">
        <div>
            <h1 class="page-title">Staff Management</h1>
            <p class="page-subtitle">
                Manage staff accounts and their information.
            </p>
        </div>

        <a href="{{ route('admin.staff.create') }}" class="add-staff-btn">
            <i class="bi bi-person-plus"></i>
            Add Staff
        </a>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Staff Card --}}
    <div class="staff-table-card">

        <div class="staff-table-header">
            <div>
                <h5>All Staff</h5>
                <p>View and manage staff members.</p>
            </div>

            <span class="staff-count">
                <i class="bi bi-people"></i>
                Staff List
            </span>
        </div>

        {{-- Search --}}
        <div class="staff-search-section">
            <form action="{{ route('admin.staff') }}"
                  method="GET"
                  class="staff-search-form">

                <div class="staff-search-input">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by name or email..."
                        value="{{ $search ?? request('search') }}"
                    >
                </div>

                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                    Search
                </button>

                <a href="{{ route('admin.staff') }}" class="reset-btn">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </a>
            </form>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="staff-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Staff Member</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($staffs as $staff)

                        <tr>
                            <td>
                                <span class="staff-id">
                                    {{ $staff->id }}
                                </span>
                            </td>

                            <td>
                                <div class="staff-member">
                                    @if ($staff->image)
                                        <img
                                            src="{{ asset('storage/' . $staff->image) }}"
                                            alt="Staff Image"
                                            class="staff-avatar"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('img/images.png') }}"
                                            alt="Default Image"
                                            class="staff-avatar"
                                        >
                                    @endif

                                    <div class="staff-member-info">
                                        <span class="staff-name">
                                            {{ $staff->name }}
                                        </span>
                                        <span class="staff-role">
                                            Staff Member
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="staff-email">
                                    {{ $staff->email }}
                                </span>
                            </td>

                            <td>
                                <span class="staff-phone">
                                    {{ $staff->phone ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <div class="staff-actions">

                                    <a
                                        href="{{ route('admin.staff.edit', $staff->id) }}"
                                        class="action-btn edit-btn"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.staff.destroy', $staff->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this staff member?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn delete-btn">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h6>No staff records found</h6>

                                    <p>
                                        @if (request('search'))
                                            No staff matched your search.
                                        @else
                                            No staff records are available yet.
                                        @endif
                                    </p>

                                    @if (request('search'))
                                        <a href="{{ route('admin.staff') }}"
                                           class="reset-empty-btn">
                                            Clear Search
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if ($staffs->hasPages())
            <div class="staff-pagination">
                {{ $staffs->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</div>

<style>
    .staff-list-page {
        padding: 24px;
        color: #1f2937;
    }

    .staff-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 25px;
    }

    .staff-list-page .page-title {
        font-size: 27px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 7px;
    }

    .staff-list-page .page-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .add-staff-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 7px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    .add-staff-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .staff-table-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
        overflow: hidden;
    }

    .staff-table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 22px 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .staff-table-header h5 {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        margin: 0 0 5px;
    }

    .staff-table-header p {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    .staff-count {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .staff-search-section {
        padding: 18px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: #fcfcfd;
    }

    .staff-search-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .staff-search-input {
        position: relative;
        flex: 1;
        min-width: 0;
    }

    .staff-search-input > i {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }

    .staff-search-input .form-control {
        height: 43px;
        padding: 10px 12px 10px 38px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        box-shadow: none;
    }

    .staff-search-input .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .search-btn,
    .reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 43px;
        padding: 0 16px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .search-btn {
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #fff;
    }

    .search-btn:hover {
        background: #1d4ed8;
    }

    .reset-btn {
        color: #374151;
        background: #fff;
        border: 1px solid #d1d5db;
    }

    .reset-btn:hover {
        background: #f3f4f6;
        color: #111827;
    }

    .staff-table {
        width: 100%;
        border-collapse: collapse;
        white-space: nowrap;
    }

    .staff-table thead th {
        padding: 15px 20px;
        background: #f9fafb;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #e5e7eb;
    }

    .staff-table tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #f0f1f3;
        vertical-align: middle;
        font-size: 13px;
    }

    .staff-table tbody tr:last-child td {
        border-bottom: none;
    }

    .staff-table tbody tr:hover {
        background: #fafcff;
    }

    .staff-id {
        color: #6b7280;
        font-weight: 600;
    }

    .staff-member {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .staff-avatar {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        object-fit: cover;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background: #f3f4f6;
    }

    .staff-member-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .staff-name {
        color: #111827;
        font-weight: 600;
        font-size: 14px;
    }

    .staff-role {
        color: #9ca3af;
        font-size: 12px;
    }

    .staff-email {
        color: #374151;
    }

    .staff-phone {
        color: #4b5563;
    }

    .staff-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .edit-btn {
        color: #92400e;
        background: #fffbeb;
        border: 1px solid #fde68a;
    }

    .edit-btn:hover {
        color: #78350f;
        background: #fef3c7;
    }

    .delete-btn {
        color: #b91c1c;
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .delete-btn:hover {
        color: #991b1b;
        background: #fee2e2;
    }

    .empty-state {
        padding: 45px 15px;
        text-align: center;
        white-space: normal;
    }

    .empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #f3f4f6;
        color: #9ca3af;
        font-size: 25px;
    }

    .empty-state h6 {
        color: #374151;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 13px;
        margin-bottom: 0;
    }

    .reset-empty-btn {
        display: inline-block;
        margin-top: 14px;
        color: #2563eb;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .staff-pagination {
        padding: 18px 24px;
        border-top: 1px solid #e5e7eb;
        overflow-x: auto;
    }

    .staff-pagination nav {
        display: flex;
        justify-content: flex-end;
    }

    .staff-pagination p {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .staff-list-page {
            padding: 18px 12px;
        }

        .staff-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .staff-table-header {
            padding: 18px;
        }

        .staff-search-section {
            padding: 15px;
        }

        .staff-search-form {
            flex-wrap: wrap;
        }

        .staff-search-input {
            flex-basis: 100%;
        }

        .search-btn,
        .reset-btn {
            flex: 1;
        }

        .staff-table thead th,
        .staff-table tbody td {
            padding: 13px 15px;
        }

        .staff-pagination {
            padding: 15px;
        }
    }

    @media (max-width: 400px) {
        .staff-list-page .page-title {
            font-size: 23px;
        }

        .staff-table-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection

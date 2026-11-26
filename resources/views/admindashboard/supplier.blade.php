
@extends('admindashboard.layout')

@section('title', 'Suppliers')

@section('content')

<style>
    .supplier-page {
        padding: 24px;
        background: #f5f7fb;
        min-height: 100vh;
    }

    .supplier-page * {
        box-sizing: border-box;
    }

    .supplier-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 24px;
    }

    .supplier-heading h1 {
        font-size: 27px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .supplier-heading p {
        color: #64748b;
        margin: 6px 0 0;
        font-size: 14px;
    }

    .supplier-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
    }

    .supplier-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 16px;
        border-bottom: 1px solid #edf0f5;
    }

    .supplier-card-header h3 {
        font-size: 19px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .supplier-card-header p {
        font-size: 13px;
        color: #64748b;
        margin: 5px 0 0;
    }

    .supplier-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 19px;
    }

    .supplier-form-group {
        min-width: 0;
    }

    .supplier-form-group.full-width {
        grid-column: 1 / -1;
    }

    .supplier-form-group label {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .supplier-form-group label span {
        color: #dc2626;
    }

    .supplier-form-group input,
    .supplier-form-group select,
    .supplier-form-group textarea {
        width: 100%;
        min-height: 43px;
        padding: 10px 13px;
        background: #fff;
        border: 1px solid #dce2ea;
        border-radius: 7px;
        outline: none;
        color: #334155;
        font-size: 14px;
        transition: .2s ease;
    }

    .supplier-form-group textarea {
        min-height: 95px;
        resize: vertical;
    }

    .supplier-form-group input:focus,
    .supplier-form-group select:focus,
    .supplier-form-group textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .supplier-form-actions {
        margin-top: 23px;
        display: flex;
        justify-content: flex-end;
    }

    .supplier-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        padding: 9px 17px;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
        white-space: nowrap;
    }

    .supplier-btn-primary {
        background: #2563eb;
        color: #fff;
    }

    .supplier-btn-primary:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .supplier-btn-secondary {
        background: #e9eef5;
        color: #334155;
    }

    .supplier-btn-secondary:hover {
        background: #dbe3ed;
        color: #1e293b;
    }

    .supplier-btn-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .supplier-btn-warning:hover {
        background: #fde68a;
        color: #78350f;
    }

    .supplier-btn-success {
        background: #dcfce7;
        color: #166534;
    }

    .supplier-btn-success:hover {
        background: #bbf7d0;
        color: #14532d;
    }

    .supplier-btn-sm {
        padding: 7px 11px;
        font-size: 12px;
    }

    .supplier-alert {
        padding: 13px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .supplier-alert-success {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .supplier-alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .supplier-alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .supplier-search {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .supplier-search input {
        flex: 1;
        min-width: 220px;
        max-width: 420px;
        height: 41px;
        padding: 9px 13px;
        border: 1px solid #dce2ea;
        border-radius: 7px;
        outline: none;
        font-size: 13px;
    }

    .supplier-search input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .supplier-table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #edf0f5;
        border-radius: 9px;
    }

    .supplier-table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
        background: #fff;
    }

    .supplier-table thead th {
        background: #f8fafc;
        color: #475569;
        padding: 14px 13px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        border-bottom: 1px solid #e5eaf1;
        white-space: nowrap;
    }

    .supplier-table tbody td {
        padding: 14px 13px;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #edf0f5;
        white-space: nowrap;
    }

    .supplier-table tbody tr:last-child td {
        border-bottom: none;
    }

    .supplier-table tbody tr:hover {
        background: #f8fafc;
    }

    .supplier-code {
        color: #2563eb !important;
        font-weight: 700;
    }

    .supplier-company {
        color: #1e293b !important;
        font-weight: 600;
    }

    .supplier-status {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .supplier-status-active {
        color: #15803d;
        background: #dcfce7;
    }

    .supplier-status-inactive {
        color: #b91c1c;
        background: #fee2e2;
    }

    .supplier-operation {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .supplier-operation form {
        margin: 0;
    }

    .supplier-empty {
        text-align: center !important;
        padding: 35px !important;
        color: #94a3b8 !important;
    }

    .supplier-pagination {
        margin-top: 22px;
        display: flex;
        justify-content: flex-end;
    }

    .supplier-pagination nav {
        display: flex;
        justify-content: flex-end;
    }

    .supplier-pagination p {
        margin: 0;
    }

    @media (max-width: 768px) {
        .supplier-page {
            padding: 14px;
        }

        .supplier-card {
            padding: 17px;
        }

        .supplier-heading h1 {
            font-size: 23px;
        }

        .supplier-form-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .supplier-form-group.full-width {
            grid-column: auto;
        }

        .supplier-search {
            align-items: stretch;
        }

        .supplier-search input {
            max-width: 100%;
            min-width: 100%;
        }

        .supplier-search .supplier-btn {
            flex: 1;
        }

        .supplier-form-actions .supplier-btn {
            width: 100%;
        }

        .supplier-pagination {
            justify-content: center;
            overflow-x: auto;
        }
    }
</style>


<div class="supplier-page">

    {{-- Page Heading --}}
    <div class="supplier-heading">
        <div>
            <h1>Supplier Management</h1>
            <p>Manage and organize your business suppliers.</p>
        </div>
    </div>


    {{-- Success Message --}}
    @if (session('success'))
        <div class="supplier-alert supplier-alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if (session('error'))
        <div class="supplier-alert supplier-alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="supplier-alert supplier-alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Add Supplier Form --}}
    <div class="supplier-card">

        <div class="supplier-card-header">
            <div>
                <h3>Add New Supplier</h3>
                <p>Enter supplier information below.</p>
            </div>
        </div>


        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf

            <div class="supplier-form-grid">

                <div class="supplier-form-group">
                    <label for="supplier_code">
                        Supplier Code <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="supplier_code"
                        name="supplier_code"
                        value="{{ old('supplier_code') }}"
                        placeholder="e.g. SUP001"
                        required
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="company_name">
                        Company Name <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        value="{{ old('company_name') }}"
                        placeholder="Enter company name"
                        required
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="contact_person">Contact Person</label>

                    <input
                        type="text"
                        id="contact_person"
                        name="contact_person"
                        value="{{ old('contact_person') }}"
                        placeholder="Enter contact person"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="phone">
                        Phone Number <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="Enter phone number"
                        maxlength="20"
                        required
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@gmail.com"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="gst_number">GST Number</label>

                    <input
                        type="text"
                        id="gst_number"
                        name="gst_number"
                        value="{{ old('gst_number') }}"
                        placeholder="Enter GST number"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="city">City</label>

                    <input
                        type="text"
                        id="city"
                        name="city"
                        value="{{ old('city') }}"
                        placeholder="Enter city"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="state">State</label>

                    <input
                        type="text"
                        id="state"
                        name="state"
                        value="{{ old('state') }}"
                        placeholder="Enter state"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="pincode">Pincode</label>

                    <input
                        type="text"
                        id="pincode"
                        name="pincode"
                        value="{{ old('pincode') }}"
                        placeholder="Enter pincode"
                        maxlength="10"
                    >
                </div>


                <div class="supplier-form-group">
                    <label for="status">
                        Status <span>*</span>
                    </label>

                    <select id="status" name="status" required>

                        <option value="active"
                            {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>


                <div class="supplier-form-group full-width">
                    <label for="address">Address</label>

                    <textarea
                        id="address"
                        name="address"
                        rows="3"
                        placeholder="Enter supplier address"
                    >{{ old('address') }}</textarea>
                </div>

            </div>


            <div class="supplier-form-actions">
                <button type="submit" class="supplier-btn supplier-btn-primary">
                    + Save Supplier
                </button>
            </div>

        </form>

    </div>



    {{-- Suppliers List --}}
    <div class="supplier-card">

        <div class="supplier-card-header">
            <div>
                <h3>All Suppliers</h3>
                <p>View, search and manage your registered suppliers.</p>
            </div>
        </div>


        {{-- Search Form --}}
        <form
            action="{{ route('admin.suppliers') }}"
            method="GET"
            class="supplier-search"
        >

            <input
                type="text"
                name="search"
                value="{{ $search ?? request('search') }}"
                placeholder="Search supplier code, company or phone..."
            >

            <button type="submit" class="supplier-btn supplier-btn-primary">
                Search
            </button>

            <a
                href="{{ route('admin.suppliers') }}"
                class="supplier-btn supplier-btn-secondary"
            >
                Reset
            </a>

        </form>



        {{-- Supplier Table --}}
        <div class="supplier-table-wrapper">

            <table class="supplier-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Code</th>
                        <th>Contact Person</th>
                        <th>Company Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse ($suppliers as $supplier)

                        <tr>

                            <td>{{ $supplier->id }}</td>

                            <td class="supplier-code">
                                {{ $supplier->supplier_code }}
                            </td>

                            <td>
                                {{ $supplier->contact_person ?? 'N/A' }}
                            </td>

                            <td class="supplier-company">
                                {{ $supplier->company_name }}
                            </td>

                            <td>
                                {{ $supplier->phone }}
                            </td>

                            <td>
                                {{ $supplier->email ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $supplier->city ?? 'N/A' }}
                            </td>

                            <td>
                                @if ($supplier->status == 'active')

                                    <span class="supplier-status supplier-status-active">
                                        Active
                                    </span>

                                @else

                                    <span class="supplier-status supplier-status-inactive">
                                        Inactive
                                    </span>

                                @endif
                            </td>


                            {{-- Operations --}}
                            <td>

                                <div class="supplier-operation">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                        class="supplier-btn supplier-btn-primary supplier-btn-sm"
                                    >
                                        Edit
                                    </a>


                                    {{-- Activate / Deactivate --}}
                                    <form
                                        action="{{ route('admin.suppliers.status', $supplier->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="supplier-btn supplier-btn-sm {{ $supplier->status == 'active' ? 'supplier-btn-warning' : 'supplier-btn-success' }}"
                                        >
                                            {{ $supplier->status == 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="supplier-empty">
                                No suppliers found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if (method_exists($suppliers, 'links'))
            <div class="supplier-pagination">
                {{ $suppliers->appends(request()->query())->links() }}
            </div>
        @endif

    </div>

</div>

@endsection

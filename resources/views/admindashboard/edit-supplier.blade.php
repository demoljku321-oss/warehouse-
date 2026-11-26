
@extends('admindashboard.layout')

@section('title', 'Edit Supplier')

@section('content')

<style>
    .supplier-page {
        padding: 5px 0 25px;
    }

    .supplier-page .page-title {
        font-size: 27px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .supplier-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .supplier-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    .supplier-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .supplier-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 11px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .supplier-card-header h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px;
    }

    .supplier-card-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .supplier-form-body {
        padding: 24px;
    }

    .supplier-section-title {
        font-size: 15px;
        font-weight: 700;
        color: #334155;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .supplier-form .form-label {
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .supplier-form .form-control,
    .supplier-form .form-select {
        min-height: 43px;
        border: 1px solid #dbe2ea;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        color: #334155;
        box-shadow: none;
    }

    .supplier-form textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .supplier-form .form-control:focus,
    .supplier-form .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.10);
    }

    .supplier-form .form-control::placeholder {
        color: #a0aab8;
    }

    .supplier-form .required {
        color: #dc2626;
    }

    .supplier-form .alert {
        border-radius: 9px;
        font-size: 14px;
    }

    .supplier-form-footer {
        padding: 18px 24px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .supplier-form-footer .btn {
        min-height: 42px;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .supplier-form-footer .btn-primary {
        background: #4f46e5;
        border-color: #4f46e5;
    }

    .supplier-form-footer .btn-primary:hover {
        background: #4338ca;
        border-color: #4338ca;
    }

    .supplier-form-footer .btn-secondary {
        background: #fff;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .supplier-form-footer .btn-secondary:hover {
        background: #f1f5f9;
    }

    @media (max-width: 576px) {
        .supplier-page .page-title {
            font-size: 23px;
        }

        .supplier-card-header,
        .supplier-form-body {
            padding: 17px;
        }

        .supplier-form-footer {
            padding: 16px;
        }

        .supplier-form-footer .btn {
            flex: 1;
        }
    }
</style>

<div class="supplier-page">

    <h1 class="page-title">Edit Supplier</h1>

    <p class="supplier-subtitle">
        Update supplier information and contact details.
    </p>

    <div class="supplier-card">

        <div class="supplier-card-header">

            <div class="supplier-header-icon">
                <i class="bi bi-building"></i>
            </div>

            <div>
                <h3>Supplier Information</h3>
                <p>Edit the details below and save your changes.</p>
            </div>

        </div>

        <form
            action="{{ route('admin.suppliers.update', $supplier->id) }}"
            method="POST"
            class="supplier-form"
        >
            @csrf
            @method('PUT')

            <div class="supplier-form-body">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <strong>Please fix the following errors:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Basic Information --}}
                <h4 class="supplier-section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Basic Information
                </h4>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Supplier Code <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="supplier_code"
                            class="form-control"
                            placeholder="Enter supplier code"
                            value="{{ old('supplier_code', $supplier->supplier_code) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Company Name <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            class="form-control"
                            placeholder="Enter company name"
                            value="{{ old('company_name', $supplier->company_name) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Person</label>

                        <input
                            type="text"
                            name="contact_person"
                            class="form-control"
                            placeholder="Enter contact person"
                            value="{{ old('contact_person', $supplier->contact_person) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Status <span class="required">*</span>
                        </label>

                        <select name="status" class="form-select" required>
                            <option value="active"
                                {{ old('status', $supplier->status) === 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ old('status', $supplier->status) === 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                </div>

                {{-- Contact Information --}}
                <h4 class="supplier-section-title">
                    <i class="bi bi-telephone me-2"></i>
                    Contact Information
                </h4>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Phone <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            maxlength="20"
                            placeholder="Enter phone number"
                            value="{{ old('phone', $supplier->phone) }}"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email address"
                            value="{{ old('email', $supplier->email) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">GST Number</label>

                        <input
                            type="text"
                            name="gst_number"
                            class="form-control"
                            placeholder="Enter GST number"
                            value="{{ old('gst_number', $supplier->gst_number) }}"
                        >
                    </div>

                </div>

                {{-- Address Information --}}
                <h4 class="supplier-section-title">
                    <i class="bi bi-geo-alt me-2"></i>
                    Address Information
                </h4>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">City</label>

                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            placeholder="Enter city"
                            value="{{ old('city', $supplier->city) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">State</label>

                        <input
                            type="text"
                            name="state"
                            class="form-control"
                            placeholder="Enter state"
                            value="{{ old('state', $supplier->state) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pincode</label>

                        <input
                            type="text"
                            name="pincode"
                            class="form-control"
                            maxlength="10"
                            placeholder="Enter pincode"
                            value="{{ old('pincode', $supplier->pincode) }}"
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Full Address</label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="3"
                            placeholder="Enter supplier address"
                        >{{ old('address', $supplier->address) }}</textarea>
                    </div>

                </div>

            </div>

            <div class="supplier-form-footer">

                <a
                    href="{{ route('admin.suppliers') }}"
                    class="btn btn-secondary"
                >
                    <i class="bi bi-arrow-left"></i>
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Update Supplier
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

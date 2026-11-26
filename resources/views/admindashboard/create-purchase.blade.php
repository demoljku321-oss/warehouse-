
@extends('admindashboard.layout')

@section('title', 'Add Purchase')

@section('content')

<style>
    .purchase-container {
        padding: 20px;
        max-width: 1100px;
        margin: 0 auto;
    }

    .purchase-header {
        margin-bottom: 25px;
    }

    .purchase-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .purchase-header p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .purchase-card {
        background: #fff;
        border-radius: 12px;
        padding: 28px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.07);
        border: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .purchase-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .required {
        color: #dc2626;
    }

    .purchase-container .form-control {
        width: 100%;
        min-height: 44px;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        background-color: #fff;
        color: #1f2937;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .purchase-container .form-control:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .purchase-container textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .purchase-section {
        margin-top: 28px;
    }

    .purchase-alert {
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .purchase-alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .purchase-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .purchase-actions .btn {
        min-height: 42px;
        padding: 10px 20px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .purchase-actions .btn-primary {
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #fff;
    }

    .purchase-actions .btn-primary:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
    }

    .purchase-actions .btn-secondary {
        background: #f3f4f6;
        border: 1px solid #d1d5db;
        color: #374151;
    }

    .purchase-actions .btn-secondary:hover {
        background: #e5e7eb;
    }

    @media (max-width: 700px) {
        .purchase-container {
            padding: 12px;
        }

        .purchase-card {
            padding: 18px;
        }

        .purchase-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .full-width {
            grid-column: auto;
        }

        .purchase-actions {
            flex-direction: column;
        }

        .purchase-actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="purchase-container">

    <div class="purchase-header">
        <h1>Add Purchase</h1>
        <p>Enter supplier, invoice and product purchase details.</p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger purchase-alert">
            <strong>Please correct the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="purchase-card">

        <form action="{{ route('admin.purchases.store') }}" method="POST">
            @csrf

            {{-- Purchase Information --}}
            <h3 class="section-title">Purchase Information</h3>

            <div class="purchase-grid">

                <div class="form-group">
                    <label for="supplier_id">
                        Supplier <span class="required">*</span>
                    </label>

                    <select
                        name="supplier_id"
                        id="supplier_id"
                        class="form-control"
                        required
                    >
                        <option value="">Select Supplier</option>

                        @foreach ($suppliers as $supplier)
                            <option
                                value="{{ $supplier->id }}"
                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                            >
                                {{ $supplier->company_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="bill_number">
                        Invoice Number <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="bill_number"
                        id="bill_number"
                        class="form-control"
                        value="{{ old('bill_number', 'PUR-' . now()->format('YmdHis')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="purchase_date">
                        Purchase Date <span class="required">*</span>
                    </label>

                    <input
                        type="date"
                        name="purchase_date"
                        id="purchase_date"
                        class="form-control"
                        value="{{ old('purchase_date', now()->toDateString()) }}"
                        required
                    >
                </div>

            </div>

            {{-- Product Information --}}
            <div class="purchase-section">
                <h3 class="section-title">Product Information</h3>

                <div class="purchase-grid">

                    <div class="form-group full-width">
                        <label for="product_id">
                            Product <span class="required">*</span>
                        </label>

                        <select
                            name="items[0][product_id]"
                            id="product_id"
                            class="form-control"
                            required
                        >
                            <option value="">Select Product</option>

                            @foreach ($products as $product)
                                <option
                                    value="{{ $product->id }}"
                                    {{ old('items.0.product_id') == $product->id ? 'selected' : '' }}
                                >
                                    {{ $product->product_name }} - {{ $product->product_code }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">
                            Quantity <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="items[0][quantity]"
                            id="quantity"
                            class="form-control"
                            min="1"
                            value="{{ old('items.0.quantity', 1) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="purchase_price">
                            Purchase Price <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="items[0][purchase_price]"
                            id="purchase_price"
                            class="form-control"
                            min="0"
                            step="0.01"
                            value="{{ old('items.0.purchase_price', 0) }}"
                            required
                        >
                    </div>

                </div>
            </div>

            {{-- Additional Information --}}
            <div class="purchase-section">
                <h3 class="section-title">Additional Information</h3>

                <div class="form-group">
                    <label for="notes">Notes</label>

                    <textarea
                        name="notes"
                        id="notes"
                        class="form-control"
                        placeholder="Enter any additional purchase notes..."
                    >{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="purchase-actions">

                <a
                    href="{{ route('admin.purchases') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Save Purchase
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

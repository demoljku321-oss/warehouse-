
@extends('staffdashboard/layout')

@section('title', 'Edit Product')

@section('content')

<style>
    .edit-product-page {
        max-width: 1100px;
        margin: 0 auto;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .product-form-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .required-star {
        color: #dc2626;
    }

    .product-form-card .form-control {
        width: 100%;
        min-height: 44px;
        padding: 11px 13px;
        font-size: 14px;
        color: #1f2937;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .product-form-card .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .product-form-card textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .product-form-card select.form-control {
        cursor: pointer;
    }

    .form-help {
        display: block;
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    .form-error-box {
        padding: 15px 18px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 4px solid #dc2626;
        border-radius: 8px;
        color: #991b1b;
        margin-bottom: 22px;
    }

    .form-error-box h4 {
        font-size: 15px;
        margin-bottom: 8px;
    }

    .form-error-box ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .form-error-box li {
        font-size: 13px;
        margin-bottom: 4px;
    }

    .form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 10px;
        padding-top: 22px;
        border-top: 1px solid #e5e7eb;
    }

    .form-actions .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 43px;
        padding: 11px 20px;
        border: none;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-update {
        background: #198754;
        color: #ffffff;
    }

    .btn-update:hover {
        background: #157347;
        color: #ffffff;
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #d1d5db;
        color: #111827;
    }

    .product-id-badge {
        display: inline-block;
        margin-bottom: 20px;
        padding: 7px 12px;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .product-form-card {
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .product-form-card {
            padding: 15px;
        }

        .page-title {
            font-size: 21px;
        }
    }
</style>

<div class="edit-product-page">

    <h1 class="page-title">Edit Product</h1>

    <p class="page-subtitle">
        Update product information, pricing, stock and warehouse details.
    </p>

    <div class="product-id-badge">
        <i class="bi bi-box-seam"></i>
        Product ID: #{{ $product->id }}
    </div>

    <div class="product-form-card">

        @if($errors->any())
            <div class="form-error-box">
                <h4>
                    <i class="bi bi-exclamation-circle-fill"></i>
                    Please correct the following errors:
                </h4>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('staffdashboard.product.update', $product->id) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <!-- BASIC INFORMATION -->
            <h3 class="form-section-title">
                <i class="bi bi-info-circle"></i>
                Basic Information
            </h3>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Product Name <span class="required-star">*</span>
                        </label>

                        <input
                            type="text"
                            name="product_name"
                            class="form-control"
                            value="{{ old('product_name', $product->product_name) }}"
                            placeholder="Enter product name"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Product Code / SKU <span class="required-star">*</span>
                        </label>

                        <input
                            type="text"
                            name="product_code"
                            class="form-control"
                            value="{{ old('product_code', $product->product_code) }}"
                            placeholder="Enter product code"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Category</label>

                        <input
                            type="text"
                            name="category"
                            class="form-control"
                            value="{{ old('category', $product->category) }}"
                            placeholder="Enter category"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Sub Category</label>

                        <input
                            type="text"
                            name="sub_category"
                            class="form-control"
                            value="{{ old('sub_category', $product->sub_category) }}"
                            placeholder="Enter sub category"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Supplier</label>

                        <input
                            type="text"
                            name="supplier"
                            class="form-control"
                            value="{{ old('supplier', $product->supplier) }}"
                            placeholder="Enter supplier name"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Unit <span class="required-star">*</span>
                        </label>

                        <input
                            type="text"
                            name="unit"
                            class="form-control"
                            value="{{ old('unit', $product->unit) }}"
                            placeholder="e.g. Pieces, Kg, Box"
                            required
                        >
                    </div>
                </div>

            </div>

            <!-- PRICING -->
            <h3 class="form-section-title">
                <i class="bi bi-currency-rupee"></i>
                Pricing Information
            </h3>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Purchase Price (₹) <span class="required-star">*</span>
                        </label>

                        <input
                            type="number"
                            name="purchase_price"
                            class="form-control"
                            value="{{ old('purchase_price', $product->purchase_price) }}"
                            min="0"
                            step="0.01"
                            placeholder="Enter purchase price"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Selling Price (₹) <span class="required-star">*</span>
                        </label>

                        <input
                            type="number"
                            name="selling_price"
                            class="form-control"
                            value="{{ old('selling_price', $product->selling_price) }}"
                            min="0"
                            step="0.01"
                            placeholder="Enter selling price"
                            required
                        >
                    </div>
                </div>

            </div>

            <!-- STOCK INFORMATION -->
            <h3 class="form-section-title">
                <i class="bi bi-boxes"></i>
                Stock Information
            </h3>

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Quantity <span class="required-star">*</span>
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            class="form-control"
                            value="{{ old('quantity', $product->quantity) }}"
                            min="0"
                            step="1"
                            placeholder="Enter available quantity"
                            required
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Minimum Stock <span class="required-star">*</span>
                        </label>

                        <input
                            type="number"
                            name="minimum_stock"
                            class="form-control"
                            value="{{ old('minimum_stock', $product->minimum_stock) }}"
                            min="0"
                            step="1"
                            placeholder="Enter minimum stock level"
                            required
                        >

                        <small class="form-help">
                            Used to identify products with low stock.
                        </small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Warehouse Location</label>

                        <input
                            type="text"
                            name="warehouse_location"
                            class="form-control"
                            value="{{ old('warehouse_location', $product->warehouse_location) }}"
                            placeholder="Enter warehouse location"
                        >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">
                            Status <span class="required-star">*</span>
                        </label>

                        <select name="status" class="form-control" required>
                            <option value="active"
                                {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- DESCRIPTION -->
            <h3 class="form-section-title">
                <i class="bi bi-card-text"></i>
                Product Description
            </h3>

            <div class="form-group">
                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Enter product description"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- ACTIONS -->
            <div class="form-actions">

                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check-circle"></i>
                    Update Product
                </button>

                <a
                    href="{{ route('staffdashboard.product') }}"
                    class="btn btn-cancel"
                >
                    <i class="bi bi-x-circle"></i>
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection

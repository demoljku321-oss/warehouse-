@extends('admindashboard.layout')

@section('title', 'Edit Product')

@section('content')

<div class="edit-product-page">

    <div class="page-heading">
        <div>
            <h1>Edit Product</h1>
            <p>Update your warehouse product information.</p>
        </div>

        <a href="{{ route('admin.adminproducts') }}" class="btn btn-back">
            ← Back to Products
        </a>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">

        <form
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label>Product Code *</label>
                    <input
                        type="text"
                        name="product_code"
                        value="{{ old('product_code', $product->product_code) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Product Name *</label>
                    <input
                        type="text"
                        name="product_name"
                        value="{{ old('product_name', $product->product_name) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <input
                        type="text"
                        name="category"
                        value="{{ old('category', $product->category) }}"
                    >
                </div>

                <div class="form-group">
                    <label>Sub Category</label>
                    <input
                        type="text"
                        name="sub_category"
                        value="{{ old('sub_category', $product->sub_category) }}"
                    >
                </div>

                <!-- <div class="form-group">
                    <label>Supplier</label>
                    <input
                        type="text"
                        name="supplier"
                        value="{{ old('supplier', $product->supplier) }}"
                    >
                </div> -->

                <div class="form-group">
                    <label>Unit *</label>
                    <input
                        type="text"
                        name="unit"
                        value="{{ old('unit', $product->unit) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Purchase Price (₹) *</label>
                    <input
                        type="number"
                        name="purchase_price"
                        value="{{ old('purchase_price', $product->purchase_price) }}"
                        min="0"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Selling Price (₹) *</label>
                    <input
                        type="number"
                        name="selling_price"
                        value="{{ old('selling_price', $product->selling_price) }}"
                        min="0"
                        step="0.01"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Quantity *</label>
                    <input
                        type="number"
                        name="quantity"
                        value="{{ old('quantity', $product->quantity) }}"
                        min="0"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Minimum Stock *</label>
                    <input
                        type="number"
                        name="minimum_stock"
                        value="{{ old('minimum_stock', $product->minimum_stock) }}"
                        min="0"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Warehouse Location</label>
                    <input
                        type="text"
                        name="warehouse_location"
                        value="{{ old('warehouse_location', $product->warehouse_location) }}"
                    >
                </div>

                <div class="form-group">
                    <label>Status *</label>
                    <select name="status" required>
                        <option value="active"
                            {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea
                        name="description"
                        rows="4"
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label>Current Product Image</label>

                    @if ($product->image)
                        <div class="current-image">
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->product_name }}"
                            >
                        </div>
                    @else
                        <p class="no-image">No image uploaded.</p>
                    @endif
                </div>

                <div class="form-group full-width">
                    <label>Change Product Image (Optional)</label>
                    <input
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                    <small>Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.</small>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.adminproducts') }}" class="btn btn-cancel">
                    Cancel
                </a>

                <button type="submit" class="btn btn-save">
                    Update Product
                </button>
            </div>

        </form>

    </div>

</div>

<style>
.edit-product-page{color:#1f2937}
.page-heading{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px}
.page-heading h1{font-size:28px;font-weight:700;margin:0 0 6px}
.page-heading p{color:#6b7280;margin:0}
.form-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:25px;box-shadow:0 2px 8px #0f172a08}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.form-group{display:flex;flex-direction:column;gap:8px}
.form-group label{font-size:14px;font-weight:600;color:#374151}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:11px 12px;border:1px solid #d1d5db;border-radius:7px;font-size:14px;background:#fff;color:#1f2937;box-sizing:border-box}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{outline:none;border-color:#1473f9;box-shadow:0 0 0 3px #1473f920}
.full-width{grid-column:1/-1}
.form-group small{color:#6b7280;font-size:12px}
.current-image img{width:120px;height:120px;object-fit:contain;border:1px solid #e5e7eb;border-radius:8px;padding:5px}
.no-image{color:#6b7280;margin:0}
.form-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:25px;padding-top:20px;border-top:1px solid #e5e7eb}
.btn{display:inline-block;border:0;border-radius:7px;padding:11px 16px;text-decoration:none;cursor:pointer;font-size:14px;font-weight:600}
.btn-back,.btn-cancel{background:#f3f4f6;color:#374151}
.btn-save{background:#1473f9;color:#fff}
.alert-error{padding:14px 18px;margin-bottom:18px;background:#fee2e2;color:#991b1b;border-radius:8px}
.alert-error ul{margin:8px 0 0;padding-left:22px}
@media(max-width:700px){.page-heading{align-items:flex-start;flex-direction:column}.form-grid{grid-template-columns:1fr}.full-width{grid-column:auto}.form-card{padding:16px}}
</style>

@endsection

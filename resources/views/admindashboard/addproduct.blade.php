@extends('admindashboard.layout')

@section('title', 'Add Product')

@section('content')
<div class="product-form-page">

    <div class="page-heading">
        <div>
            <h1>Add Product</h1>
            <p>Add multiple products to your warehouse inventory.</p>
        </div>

        <a href="{{ route('admin.adminproducts') }}" class="btn btn-light">
            ← Back to Products
        </a>
    </div>

    @if ($errors->any())
        <div class="notice error">
            <strong>Please fix these errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="form-card">

        @csrf

        <div id="products-container">

            @php
                $oldProducts = old('products', [[]]);
            @endphp

            @foreach ($oldProducts as $index => $oldProduct)

                <div class="product-entry">

                    <div class="product-entry-header">
                        <h3>Product <span class="product-number">{{ $loop->iteration }}</span></h3>

                        <button type="button"
                                class="btn btn-remove"
                                onclick="removeProduct(this)"
                                @if ($loop->first) style="display:none" @endif>
                            Remove
                        </button>
                    </div>

                    <div class="form-grid">

                        <div class="field">
                            <label>Product Code *</label>
                            <input name="products[{{ $index }}][product_code]"
                                   value="{{ $oldProduct['product_code'] ?? '' }}"
                                   required maxlength="100">
                        </div>

                        <div class="field">
                            <label>Product Name *</label>
                            <input name="products[{{ $index }}][product_name]"
                                   value="{{ $oldProduct['product_name'] ?? '' }}"
                                   required maxlength="255">
                        </div>

                        <div class="field">
                            <label>Category</label>
                            <input name="products[{{ $index }}][category]"
                                   value="{{ $oldProduct['category'] ?? '' }}">
                        </div>

                        <div class="field">
                            <label>Sub Category</label>
                            <input name="products[{{ $index }}][sub_category]"
                                   value="{{ $oldProduct['sub_category'] ?? '' }}">
                        </div>

                      

                        <div class="field">
                            <label>Unit *</label>
                            <select name="products[{{ $index }}][unit]" required>
                                @foreach (['Piece', 'Box', 'Kg', 'Litre', 'Packet'] as $unit)
                                    <option value="{{ $unit }}"
                                        @selected(($oldProduct['unit'] ?? 'Piece') === $unit)>
                                        {{ $unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label>Purchase Price *</label>
                            <input type="number"
                                   name="products[{{ $index }}][purchase_price]"
                                   step="0.01" min="0"
                                   value="{{ $oldProduct['purchase_price'] ?? 0 }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>Selling Price *</label>
                            <input type="number"
                                   name="products[{{ $index }}][selling_price]"
                                   step="0.01" min="0"
                                   value="{{ $oldProduct['selling_price'] ?? 0 }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>Quantity *</label>
                            <input type="number"
                                   name="products[{{ $index }}][quantity]"
                                   min="0"
                                   value="{{ $oldProduct['quantity'] ?? 0 }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>Minimum Stock *</label>
                            <input type="number"
                                   name="products[{{ $index }}][minimum_stock]"
                                   min="0"
                                   value="{{ $oldProduct['minimum_stock'] ?? 0 }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>Warehouse Location</label>
                            <input name="products[{{ $index }}][warehouse_location]"
                                   value="{{ $oldProduct['warehouse_location'] ?? '' }}"
                                   placeholder="e.g. Rack A-01">
                        </div>

                        <div class="field">
                            <label>Status *</label>
                            <select name="products[{{ $index }}][status]" required>
                                <option value="active"
                                    @selected(($oldProduct['status'] ?? 'active') === 'active')>
                                    Active
                                </option>
                                <option value="inactive"
                                    @selected(($oldProduct['status'] ?? '') === 'inactive')>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <div class="field full">
                            <label>Description</label>
                            <textarea name="products[{{ $index }}][description]"
                                      rows="4">{{ $oldProduct['description'] ?? '' }}</textarea>
                        </div>

                        <div class="field full">
                            <label>Product Image (optional, max 2 MB)</label>
                            <input type="file"
                                   name="products[{{ $index }}][image]"
                                   accept=".jpg,.jpeg,.png,.webp">
                        </div>

                    </div>
                </div>

            @endforeach

        </div>

        <div class="add-product-action">
            <button type="button" class="btn btn-add" onclick="addProduct()">
                + Add Another Product
            </button>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.adminproducts') }}" class="btn btn-light">
                Cancel
            </a>

            <button type="submit" class="btn btn-primary">
                Save All Products
            </button>
        </div>

    </form>
</div>

<style>
.product-form-page{max-width:1200px;margin:auto;color:#1f2937}
.page-heading{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px}
.page-heading h1{font-size:28px;margin:0 0 6px;font-weight:700}
.page-heading p{margin:0;color:#6b7280}
.form-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;box-shadow:0 4px 16px #0f172a0b;overflow:hidden}
.product-entry{padding:24px;border-bottom:1px solid #e5e7eb}
.product-entry-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
.product-entry-header h3{margin:0;font-size:19px;font-weight:700}
.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.field{display:flex;flex-direction:column;gap:7px}
.field label{font-weight:600;font-size:14px}
.field input,.field select,.field textarea{width:100%;padding:11px 12px;border:1px solid #d1d5db;border-radius:7px;background:#fff;font:inherit;box-sizing:border-box}
.field input:focus,.field select:focus,.field textarea:focus{outline:2px solid #c7d2fe;border-color:#6366f1}
.field.full{grid-column:1/-1}
.form-actions{display:flex;justify-content:flex-end;gap:10px;padding:18px 25px;background:#f9fafb;border-top:1px solid #e5e7eb}
.add-product-action{padding:18px 25px}
.btn{display:inline-block;border:0;border-radius:7px;padding:10px 15px;text-decoration:none;cursor:pointer;font-weight:600}
.btn-primary{background:#1473f9;color:#fff}
.btn-light{background:#e5e7eb;color:#111827}
.btn-add{background:#dcfce7;color:#166534}
.btn-remove{background:#fee2e2;color:#991b1b}
.notice{padding:14px 18px;border-radius:8px;margin-bottom:18px}
.notice ul{margin:8px 0 0 20px}
.notice.error{background:#fee2e2;color:#991b1b}
@media(max-width:700px){.page-heading{align-items:flex-start;flex-direction:column}.form-grid{grid-template-columns:1fr}.field.full{grid-column:auto}.product-entry{padding:17px}.form-actions{padding:15px}}
</style>

<script>
let productIndex = {{ count($oldProducts) }};

function addProduct() {
    const container = document.getElementById('products-container');
    const firstProduct = container.querySelector('.product-entry');
    const newProduct = firstProduct.cloneNode(true);

    newProduct.querySelectorAll('input, textarea').forEach(function(field) {
        field.value = '';
    });

    newProduct.querySelectorAll('select').forEach(function(field) {
        field.selectedIndex = 0;
    });

    newProduct.querySelectorAll('[name]').forEach(function(field) {
        field.name = field.name.replace(
            /products\[\d+\]/,
            'products[' + productIndex + ']'
        );
    });

    newProduct.querySelector('.btn-remove').style.display = 'inline-block';

    container.appendChild(newProduct);
    productIndex++;

    updateProductNumbers();
}

function removeProduct(button) {
    const container = document.getElementById('products-container');

    if (container.querySelectorAll('.product-entry').length <= 1) {
        return;
    }

    button.closest('.product-entry').remove();
    updateProductNumbers();
}

function updateProductNumbers() {
    document.querySelectorAll('.product-entry').forEach(function(product, index) {
        product.querySelector('.product-number').textContent = index + 1;
        product.querySelector('.btn-remove').style.display =
            index === 0 ? 'none' : 'inline-block';
    });
}
</script>
@endsection

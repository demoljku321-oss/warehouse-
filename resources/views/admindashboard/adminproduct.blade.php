@extends('admindashboard.layout')

@section('title', 'Products')

@section('content')
<div class="products-page">
    <div class="page-heading">
        <div>
            <h1>Products</h1>
            <p>Manage products saved in your warehouse inventory.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>

    @if (session('success'))
        <div class="notice success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="summary-row">
        <div class="summary-card">
            <span>Total Products</span>
            <strong>{{ $data->count() }}</strong>
        </div>

        <div class="summary-card">
            <span>Active Products</span>
            <strong>{{ $data->where('status', 'active')->count() }}</strong>
        </div>

        <div class="summary-card">
            <span>Low Stock</span>
            <strong>{{ $data->filter(fn($p) => (int) $p->quantity <= (int) $p->minimum_stock)->count() }}</strong>
        </div>
    </div>

    <div class="table-card">
        <div class="table-heading">
            <h2>Saved Products</h2>
        </div>

        @if ($data->isEmpty())
            <div class="empty-state">
                <h3>No products yet</h3>
                <p>Click “Add Product” to create your first product.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Purchase Price</th>
                            <th>Selling Price</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($data as $product)
                        <tr>
                            <td>
                                <div class="product-name">
                                    @if ($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->product_name }}"
                                        >
                                    @else
                                        <div class="image-placeholder">□</div>
                                    @endif

                                    <strong>{{ $product->product_name }}</strong>
                                </div>
                            </td>

                            <td>{{ $product->product_code }}</td>

                            <td>{{ $product->category ?: '—' }}</td>

                            <td>
                                {{ $product->quantity }} {{ $product->unit }}

                                @if ((int) $product->quantity <= (int) $product->minimum_stock)
                                    <small class="low-stock">Low stock</small>
                                @endif
                            </td>

                            <td>₹{{ number_format((float) $product->purchase_price, 2) }}</td>

                            <td>₹{{ number_format((float) $product->selling_price, 2) }}</td>

                            <td>{{ $product->warehouse_location ?: '—' }}</td>

                            <td>
                                <span class="status {{ $product->status === 'active' ? 'active' : 'inactive' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="action-buttons">

                                    {{-- Edit Product --}}
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-edit"
                                    >
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    {{-- Active / Inactive --}}
                                    <form
                                        action="{{ route('admin.products.status', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to change this product status?');"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="status"
                                            class="status-select"
                                            aria-label="Change product status"
                                            onchange="this.form.requestSubmit()"
                                        >
                                            <option value="active"
                                                {{ $product->status === 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="inactive"
                                                {{ $product->status === 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </form>

                                    {{-- Delete Product --}}
                                    <form
                                        action="{{ route('admin.products.destroy', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this product?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
.products-page{color:#1f2937}
.page-heading{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:22px}
.page-heading h1{font-size:28px;font-weight:700;margin:0 0 6px}
.page-heading p{color:#6b7280;margin:0}
.btn{display:inline-block;border:0;border-radius:7px;padding:9px 12px;text-decoration:none;cursor:pointer;font-size:13px;font-weight:600;white-space:nowrap}
.btn-primary{background:#1473f9;color:white}
.btn-edit{background:#dbeafe;color:#1d4ed8}
.btn-delete{background:#fee2e2;color:#b91c1c}
.notice{padding:13px 16px;border-radius:8px;margin-bottom:18px}
.notice.success{background:#dcfce7;color:#166534}
.notice.error{background:#fee2e2;color:#991b1b}
.summary-row{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:22px}
.summary-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;padding:18px;box-shadow:0 2px 8px #0f172a08}
.summary-card span{display:block;color:#6b7280;font-size:13px;margin-bottom:8px}
.summary-card strong{font-size:25px}
.table-card{background:#fff;border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px #0f172a08}
.table-heading{padding:18px 20px;border-bottom:1px solid #e5e7eb}
.table-heading h2{font-size:17px;margin:0}
.table-scroll{overflow-x:auto}
table{width:100%;border-collapse:collapse;white-space:nowrap}
th,td{text-align:left;padding:13px 15px;border-bottom:1px solid #eef0f3;font-size:13px}
th{background:#f9fafb;color:#4b5563;font-weight:700}
tbody tr:hover{background:#fafafa}
.product-name{display:flex;align-items:center;gap:10px}
.product-name img,.image-placeholder{width:40px;height:40px;object-fit:cover;border-radius:7px;border:1px solid #e5e7eb}
.image-placeholder{display:grid;place-items:center;background:#f3f4f6;color:#9ca3af;font-size:20px}
.status{display:inline-block;padding:5px 8px;border-radius:20px;font-size:12px}
.status.active{background:#dcfce7;color:#166534}
.status.inactive{background:#f3f4f6;color:#4b5563}
.low-stock{display:block;color:#b45309;font-size:11px;margin-top:4px}
.action-buttons{display:flex;align-items:center;gap:7px}
.action-buttons form{margin:0}
.status-select{border:1px solid #d1d5db;border-radius:7px;padding:8px;font-size:12px;background:#fff;cursor:pointer}
.empty-state{text-align:center;padding:45px 20px}
.empty-state h3{margin:0 0 8px}
.empty-state p{color:#6b7280;margin-bottom:18px}
@media(max-width:700px){
    .page-heading{align-items:flex-start;flex-direction:column}
    .summary-row{grid-template-columns:1fr}
}
</style>
@endsection

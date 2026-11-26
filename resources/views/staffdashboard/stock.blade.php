
@extends('staffdashboard/layout')

@section('title', 'Stock')

@section('content')

<h1 class="page-title">Stock</h1>

<div class="table-card">

    <div class="table-header"
         style="display:flex; justify-content:space-between;
                align-items:center; gap:10px; flex-wrap:wrap;">

        <h3>Current Stock</h3>

        <span>
            Total Products: {{ $products->count() }}
        </span>

    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div style="background:#dcfce7; color:#166534;
                    padding:12px; margin:15px 0; border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b;
                    padding:12px; margin:15px 0; border-radius:5px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Search --}}
    <form action="{{ route('staffdashboard.stock') }}"
          method="GET"
          style="display:flex; gap:10px; flex-wrap:wrap;
                 margin:20px 0;">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search product, SKU, category or location..."
            style="flex:1; min-width:220px; padding:10px;
                   border:1px solid #ccc; border-radius:5px;"
        >

        <button type="submit"
                style="padding:10px 20px; background:#2563eb;
                       color:white; border:0; border-radius:5px;
                       cursor:pointer;">
            Search
        </button>

        <a href="{{ route('staffdashboard.stock') }}"
           style="padding:10px 20px; background:#e5e7eb;
                  color:#111827; text-decoration:none;
                  border-radius:5px;">
            Reset
        </a>

    </form>

    {{-- Stock Table --}}
    <div style="width:100%; overflow-x:auto;">

        <table style="width:100%; min-width:1000px;
                      border-collapse:collapse;">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Warehouse Location</th>
                    <th>Quantity</th>
                    <th>Minimum Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($products as $product)

                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>{{ $product->product_name }}</td>

                        <td>{{ $product->product_code }}</td>

                        <td>
                            {{ $product->warehouse_location ?: 'Not assigned' }}
                        </td>

                        {{-- Only Quantity and Minimum Stock are editable --}}
                        <form
                            id="stock-form-{{ $product->id }}"
                            action="{{ route('staffdashboard.stock.update', $product->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <td>
                                <input
                                    type="number"
                                    name="quantity"
                                    value="{{ $product->quantity }}"
                                    min="0"
                                    step="1"
                                    required
                                    aria-label="Quantity for {{ $product->product_name }}"
                                    style="width:90px; padding:7px;
                                           border:1px solid #ccc;
                                           border-radius:4px;"
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="minimum_stock"
                                    value="{{ $product->minimum_stock }}"
                                    min="0"
                                    step="1"
                                    required
                                    aria-label="Minimum stock for {{ $product->product_name }}"
                                    style="width:100px; padding:7px;
                                           border:1px solid #ccc;
                                           border-radius:4px;"
                                >
                            </td>
                        </form>

                        {{-- Stock Status --}}
                        <td>
                            @if (strtolower($product->status) !== 'active')
                                <span class="badge badge-danger">
                                    Inactive
                                </span>
                            @elseif ($product->quantity <= 0)
                                <span class="badge badge-danger">
                                    Out of Stock
                                </span>
                            @elseif ($product->quantity <= $product->minimum_stock)
                                <span class="badge badge-warning">
                                    Low Stock
                                </span>
                            @else
                                <span class="badge badge-success">
                                    In Stock
                                </span>
                            @endif
                        </td>

                        {{-- Save Button --}}
                        <td>
                            <button
                                type="submit"
                                form="stock-form-{{ $product->id }}"
                                style="padding:8px 14px;
                                       background:#16a34a;
                                       color:white; border:0;
                                       border-radius:5px; cursor:pointer;"
                            >
                                Save
                            </button>
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="8"
                            style="text-align:center; padding:20px;">
                            @if ($search)
                                No products found for "{{ $search }}".
                            @else
                                No products available.
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div style="margin-top:20px;">
        {{ $products->links() }}
    </div>

</div>

@endsection

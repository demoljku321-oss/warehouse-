
@extends('staffdashboard/layout')

@section('title', 'Products')

@section('content')

<h1 class="page-title">Products</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        Please check the product details.
    </div>
@endif

<style>
    .product-search {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        max-width: 650px;
    }

    .product-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .product-table-wrapper table {
        width: 100%;
        min-width: 1150px;
        border-collapse: collapse;
    }

    .product-table-wrapper th,
    .product-table-wrapper td {
        padding: 12px;
        text-align: left;
        white-space: nowrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .product-table-wrapper th {
        font-weight: 600;
    }

    .stock-status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
    }

    .in-stock {
        background: #d1fae5;
        color: #065f46;
    }

    .low-stock {
        background: #fef3c7;
        color: #92400e;
    }

    .out-stock {
        background: #fee2e2;
        color: #991b1b;
    }

    .inactive-stock {
        background: #e5e7eb;
        color: #374151;
    }
</style>

{{-- Search Products --}}
<form method="GET"
      action="{{ route('staffdashboard.product') }}"
      class="product-search">

    <input
        type="text"
        name="search"
        class="form-control"
        placeholder="Search product, SKU, category or supplier..."
        value="{{ $search ?? request('search') }}"
    >

    <button type="submit" class="btn btn-primary">
        Search
    </button>

    <a href="{{ route('staffdashboard.product') }}"
       class="btn btn-secondary">
        Reset
    </a>

</form>

{{-- Products Table --}}
<div class="table-card">

    <div class="product-table-wrapper">
        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <!-- <th>Supplier</th> -->
                    
                    <th>Selling Price</th>
                    <th>Available Stock</th>
                    <th>Warehouse Location</th>
                    <th>Stock Status</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>{{ $product->product_name }}</td>

                        <td>{{ $product->product_code }}</td>

                        <td>{{ $product->category ?: '-' }}</td>

                        <!-- <td>{{ $product->supplier ?: '-' }}</td> -->

                     
                        <td>
                            ₹{{ number_format($product->selling_price, 2) }}
                        </td>

                        <td>
                            {{ $product->quantity }} {{ $product->unit }}
                        </td>

                        <td>
                            {{ $product->warehouse_location ?: 'Not assigned' }}
                        </td>

                        <td>
                            @if($product->status !== 'active')
                                <span class="stock-status inactive-stock">
                                    Inactive
                                </span>
                            @elseif($product->quantity <= 0)
                                <span class="stock-status out-stock">
                                    Out of Stock
                                </span>
                            @elseif($product->quantity <= $product->minimum_stock)
                                <span class="stock-status low-stock">
                                    Low Stock
                                </span>
                            @else
                                <span class="stock-status in-stock">
                                    In Stock
                                </span>
                            @endif
                        </td>

                        <!-- <td>
                            <a
                                href="{{ route('staffdashboard.product.edit', $product->id) }}"
                                class="btn btn-warning"
                            >
                                Edit
                            </a>
                        </td> -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" style="text-align: center;">
                            No products found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div style="margin-top: 20px;">
       
    </div>

</div>

@endsection

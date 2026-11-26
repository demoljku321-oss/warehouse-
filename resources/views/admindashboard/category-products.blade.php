
@extends('admindashboard.layout')

@section('title', 'Category Products')

@section('content')

<style>
    .category-product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .category-product-placeholder {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        color: #6b7280;
        border-radius: 8px;
        font-size: 11px;
    }
</style>

<h1 class="page-title">{{ $category }} Products</h1>

<div class="table-card">

    <div class="table-header">
        <h3>All {{ $category }} Products</h3>

        <a href="{{ route('admin.categories') }}"
           class="btn btn-secondary">
            Back to Categories
        </a>
    </div>

    {{-- Search --}}
    <form
        action="{{ route('admin.categories.products', ['category' => $category]) }}"
        method="GET"
        class="d-flex gap-2 mb-3"
    >
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search product..."
            value="{{ request('search') }}"
        >

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        <a
            href="{{ route('admin.categories.products', ['category' => $category]) }}"
            class="btn btn-secondary"
        >
            Reset
        </a>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    @php
                        $productName =
                            $product->name
                            ?? $product->product_name
                            ?? $product->title
                            ?? null;

                        $productImage =
                            $product->image
                            ?? $product->product_image
                            ?? $product->image_path
                            ?? $product->photo
                            ?? null;

                        $productPrice =
                            $product->price
                            ?? $product->product_price
                            ?? $product->selling_price
                            ?? $product->sale_price
                            ?? null;

                        $imageUrl = null;

                        if ($productImage) {
                            if (\Illuminate\Support\Str::startsWith(
                                $productImage,
                                ['http://', 'https://']
                            )) {
                                $imageUrl = $productImage;
                            } else {
                                $imageUrl = asset(
                                    'storage/' . ltrim($productImage, '/')
                                );
                            }
                        }
                    @endphp

                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>
                            @if($imageUrl)
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $productName ?? 'Product' }}"
                                    class="category-product-image"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >

                                <div
                                    class="category-product-placeholder"
                                    style="display:none;"
                                >
                                    No Image
                                </div>
                            @else
                                <div class="category-product-placeholder">
                                    No Image
                                </div>
                            @endif
                        </td>

                        <td>
                            {{ $productName ?: 'Name not available' }}
                        </td>

                        <td>{{ $product->category }}</td>

                        <td>
                            @if($productPrice !== null && $productPrice !== '')
                                ₹{{ number_format((float) $productPrice, 2) }}
                            @else
                                Price not available
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            No products found in this category.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>

@endsection

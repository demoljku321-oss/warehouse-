
@extends('admindashboard.layout')

@section('title', 'Categories')

@section('content')

<style>
    .categories-page {
        padding: 10px 0;
    }

    .categories-page .page-title {
        font-size: 26px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    .categories-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
    }

    .categories-header {
        margin-bottom: 20px;
    }

    .categories-header h3 {
        font-size: 19px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .categories-search {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .categories-search input {
        flex: 1;
        min-width: 200px;
        height: 40px;
    }

    .categories-search .btn {
        height: 40px;
        padding: 8px 16px;
    }

    .categories-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .categories-table th {
        background: #f8f9fa;
        color: #444;
        font-size: 13px;
        font-weight: 600;
        padding: 13px 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .categories-table td {
        padding: 13px 15px;
        font-size: 14px;
        color: #555;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .categories-table tbody tr:hover {
        background: #fafafa;
    }

    .categories-table tbody tr:last-child td {
        border-bottom: none;
    }

    .categories-table .btn {
        padding: 5px 13px;
        font-size: 13px;
    }

    .categories-empty {
        text-align: center;
        padding: 25px !important;
        color: #777 !important;
    }

    .categories-pagination {
        margin-top: 18px;
    }

    @media (max-width: 576px) {
        .categories-card {
            padding: 12px;
        }

        .categories-search input {
            flex-basis: 100%;
        }

        .categories-search .btn {
            flex: 1;
        }
    }
</style>

<div class="categories-page">

    <h1 class="page-title">Categories</h1>

    <div class="categories-card">

        <div class="categories-header">
            <h3>All Categories</h3>
        </div>

        {{-- Search --}}
        <form action="{{ route('admin.categories') }}"
              method="GET"
              class="categories-search">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search category..."
                value="{{ $search ?? request('search', '') }}"
            >

            <button type="submit" class="btn btn-primary">
                Search
            </button>

            <a href="{{ route('admin.categories') }}"
               class="btn btn-secondary">
                Reset
            </a>

        </form>

        {{-- Categories Table --}}
        <div class="table-responsive">

            <table class="categories-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Total Products</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $d)
                        <tr>
                            <td>
                                {{ $data->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $d->category }}
                            </td>

                            <td>
                                {{ $d->total_products }}
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.categories.products', ['category' => $d->category]) }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    View
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="categories-empty">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="categories-pagination">
            {{ $data->appends(request()->query())->links() }}
        </div>

    </div>

</div>

@endsection


@extends('public.layout')

@section('title', 'Products - Warehouse Management System')

@section('content')

<style>
    .catalogue-section {
        background: #f6f8fb;
        min-height: 80vh;
    }

    .product-card {
        border: 1px solid #e8edf3;
        border-radius: 16px;
        overflow: hidden;
        transition: all .25s ease;
        background: #fff;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(20, 40, 70, .10);
    }

    .product-image {
        height: 220px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .image-placeholder {
        color: #94a3b8;
        text-align: center;
    }

    .category-pill {
        background: #eef2ff;
        color: #4338ca;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .product-title {
        font-size: 17px;
        font-weight: 700;
        color: #172033;
    }

    .product-price {
        font-size: 22px;
        font-weight: 800;
        color: #111827;
    }

    .product-meta {
        font-size: 13px;
        color: #64748b;
        line-height: 1.7;
    }

    .stock-badge {
        font-size: 12px;
        padding: 6px 10px;
        border-radius: 20px;
        font-weight: 700;
    }

    .in-stock {
        background: #dcfce7;
        color: #166534;
    }

    .out-stock {
        background: #fee2e2;
        color: #991b1b;
    }

    .interest-btn {
        border-radius: 9px;
        font-weight: 600;
        padding: 10px;
    }

    .interest-modal {
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(5px);
    }

    .interest-modal .modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
    }

    .interest-modal .modal-header {
        background: #172554;
        color: white;
        padding: 20px 24px;
    }

    .interest-modal .btn-close {
        filter: brightness(0) invert(1);
    }

    .form-control {
        border-radius: 9px;
        padding: 11px 12px;
    }

    .form-label {
        font-size: 14px;
        font-weight: 600;
    }
</style>

<section class="catalogue-section py-5">
    <div class="container py-3">

        <div class="text-center mb-5">
            <span class="category-pill">OUR CATALOGUE</span>

            <h1 class="display-5 fw-bold mt-3 mb-2">
                Explore Our Products
            </h1>

            <p class="text-secondary mb-0">
                Discover product details and let us know what interests you.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please check the form details.</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">

            @forelse($data as $d)

                <div class="col-sm-6 col-lg-4 col-xl-3">

                    <div class="card product-card h-100">

                        <div class="product-image">

                            @if($d->image)
                                <img
                                    src="{{ asset('storage/' . $d->image) }}"
                                    alt="{{ $d->product_name }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="image-placeholder">
                                    <i class="bi bi-box-seam"
                                        style="font-size: 55px;"></i>

                                    <p class="small mb-0 mt-2">
                                        No image available
                                    </p>
                                </div>
                            @endif

                        </div>

                        <div class="card-body d-flex flex-column p-4">

                            @if($d->category)
                                <span class="category-pill align-self-start mb-3">
                                    {{ $d->category }}
                                </span>
                            @endif

                            <h5 class="product-title mb-2">
                                {{ $d->product_name }}
                            </h5>

                            <div class="product-price mb-3">
                                ₹{{ number_format($d->selling_price, 2) }}

                                <span class="text-secondary fs-6 fw-normal">
                                    / {{ $d->unit }}
                                </span>
                            </div>

                            <div class="product-meta mb-3">

                                @if($d->sub_category)
                                    <div>
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $d->sub_category }}
                                    </div>
                                @endif

                                @if($d->description)
                                    <p class="mt-2 mb-2">
                                        {{ \Illuminate\Support\Str::limit($d->description, 100) }}
                                    </p>
                                @endif

                            </div>

                            <div class="mb-3">

                                @if($d->quantity > 0)
                                    <span class="stock-badge in-stock">
                                        <i class="bi bi-check-circle me-1"></i>
                                        In Stock
                                    </span>
                                @else
                                    <span class="stock-badge out-stock">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Out of Stock
                                    </span>
                                @endif

                            </div>

                            <div class="mt-auto">

                                @if($d->quantity > 0)
                                    <button
                                        type="button"
                                        class="btn btn-primary w-100 interest-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#interestModal"
                                        data-product-id="{{ $d->id }}"
                                        data-product-name="{{ $d->product_name }}"
                                    >
                                        <i class="bi bi-hand-index-thumb me-1"></i>
                                        I'm Interested
                                    </button>
                                @else
                                    <button
                                        type="button"
                                        class="btn btn-secondary w-100 interest-btn"
                                        disabled
                                    >
                                        Currently Unavailable
                                    </button>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>

            @empty

                <div class="col-12 text-center py-5">
                    <i class="bi bi-box-seam text-secondary"
                        style="font-size: 60px;"></i>

                    <h4 class="mt-3">No Products Available</h4>

                    <p class="text-secondary">
                        Please check again later.
                    </p>
                </div>

            @endforelse

        </div>
    </div>
</section>

<div
    class="modal fade interest-modal"
    id="interestModal"
    tabindex="-1"
    aria-labelledby="interestModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold" id="interestModalLabel">
                        Product Enquiry
                    </h5>

                    <small class="text-white-50">
                        Share your contact details with us
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body p-4">

                <div class="bg-light rounded-3 p-3 mb-4">
                    <small class="text-secondary">Selected Product</small>

                    <div class="fw-bold mt-1" id="selectedProductName">
                        Product
                    </div>
                </div>

                <form action="{{ route('customer.interest.store') }}"
                    method="POST">

                    @csrf

                    <input
                        type="hidden"
                        name="product_id"
                        id="selectedProductId"
                        value="{{ old('product_id') }}"
                    >

                    <div class="mb-3">
                        <label class="form-label">Full Name *</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address *</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number *</label>

                        <input
                            type="tel"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone') }}"
                            placeholder="Enter your phone number"
                            maxlength="20"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>

                        <textarea
                            name="address"
                            class="form-control"
                            rows="2"
                            placeholder="Enter your address"
                        >{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message (Optional)</label>

                        <textarea
                            name="message"
                            class="form-control"
                            rows="2"
                            placeholder="Tell us what you need"
                        >{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                        class="btn btn-primary w-100 interest-btn">

                        <i class="bi bi-send me-2"></i>
                        Submit Enquiry

                    </button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const interestModal = document.getElementById('interestModal');

    if (interestModal) {

        interestModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            if (!button) return;

            document.getElementById('selectedProductId').value =
                button.getAttribute('data-product-id');

            document.getElementById('selectedProductName').textContent =
                button.getAttribute('data-product-name');

        });
    }

    @if($errors->any() && old('product_id'))

        const modalElement = document.getElementById('interestModal');

        if (modalElement && window.bootstrap) {

            document.getElementById('selectedProductId').value =
                @json(old('product_id'));

            document.getElementById('selectedProductName').textContent =
                @json(\App\Models\Product::find(old('product_id'))?->product_name ?? 'Selected Product');

            bootstrap.Modal.getOrCreateInstance(modalElement).show();
        }

    @endif

});
</script>

@endsection

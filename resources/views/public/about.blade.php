@extends('public.layout')

@section('title', 'About Us - Warehouse Management System')

@section('content')

<section class="py-5 bg-white">
    <div class="container py-4">


    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">About Our Warehouse</h1>
        <p class="text-secondary mx-auto" style="max-width: 700px;">
            We provide a simple and efficient Warehouse Management System
            to help businesses manage products, inventory, suppliers and
            warehouse operations with ease.
        </p>
    </div>

<!-- About WMS -->
<div class="row align-items-stretch g-4 mb-5">

    <!-- Left Box -->
    <div class="col-lg-6">
        <div class="card feature-card h-100">
            <div class="card-body p-4 p-md-5">

                <span class="badge bg-primary mb-3">About WMS</span>

                <h2 class="fw-bold mb-3">
                    Smart & Simple Warehouse Management
                </h2>

                <p class="text-secondary">
                    Our Warehouse Management System helps businesses
                    organize and manage their warehouse activities from
                    one central platform.
                </p>

                <p class="text-secondary mb-0">
                    From managing products and categories to monitoring
                    stock and handling suppliers, our system makes
                    warehouse management faster, easier and more
                    organized.
                </p>

            </div>
        </div>
    </div>

    <!-- Right Box -->
    <div class="col-lg-6">
        <div class="card feature-card h-100">
            <div class="card-body p-4 p-md-5">

                <div class="mb-4">
                    <i class="bi bi-box-seam fs-1 text-primary"></i>
                </div>

                <h4 class="fw-bold mb-3">
                    Complete Warehouse Solution
                </h4>

                <p class="text-secondary mb-0">
                    Manage your warehouse products, stock,
                    categories, suppliers and daily operations
                    efficiently using one simple system.
                </p>

            </div>
        </div>
    </div>

</div>

    <!-- Features -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">What We Provide</h2>
        <p class="text-secondary">
            Everything you need to manage your warehouse efficiently.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-sm-6 col-lg-4">
            <div class="card feature-card h-100">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-boxes fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Product Management</h5>
                    <p class="text-secondary mb-0">
                        Easily manage products, SKUs, prices and
                        product information.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card feature-card h-100">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-stack fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Inventory Management</h5>
                    <p class="text-secondary mb-0">
                        Keep track of available stock and identify
                        low-stock and out-of-stock products.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card feature-card h-100">
                <div class="card-body p-4 text-center">
                    <i class="bi bi-truck fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Supplier Management</h5>
                    <p class="text-secondary mb-0">
                        Manage supplier information and keep your
                        warehouse operations organized.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- Why Choose Us -->
    <div class="mt-5 pt-4">
        <div class="card feature-card">
            <div class="card-body p-4 p-md-5 text-center">

                <h2 class="fw-bold mb-3">
                    Why Choose Our WMS?
                </h2>

                <p class="text-secondary mx-auto mb-4" style="max-width: 700px;">
                    Our system is designed with simplicity, efficiency
                    and easy warehouse management in mind.
                </p>

                <div class="row g-4">

                    <div class="col-6 col-md-3">
                        <i class="bi bi-speedometer2 fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-2">Fast</h6>
                        <p class="small text-secondary mb-0">
                            Quick and efficient operations.
                        </p>
                    </div>

                    <div class="col-6 col-md-3">
                        <i class="bi bi-shield-check fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-2">Secure</h6>
                        <p class="small text-secondary mb-0">
                            Safe and organized data.
                        </p>
                    </div>

                    <div class="col-6 col-md-3">
                        <i class="bi bi-phone fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-2">Responsive</h6>
                        <p class="small text-secondary mb-0">
                            Works across different devices.
                        </p>
                    </div>

                    <div class="col-6 col-md-3">
                        <i class="bi bi-bar-chart-line fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-2">Efficient</h6>
                        <p class="small text-secondary mb-0">
                            Better warehouse control.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


</section>

@endsection

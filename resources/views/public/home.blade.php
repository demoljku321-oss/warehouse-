@extends('public.layout')

@section('title', 'Warehouse Management System - Manage Inventory, Purchases and Sales')

@section('content')

<style>
    .wms-home {
        --primary: #2563eb;
        --dark: #0f172a;
        --muted: #64748b;
        overflow: hidden;
    }

    .wms-home .hero {
        background: linear-gradient(120deg, #0f172a, #172554, #1e40af);
        color: #fff;
    }

    .wms-home .hero-copy {
        max-width: 650px;
    }

    .wms-home .hero h1 {
        letter-spacing: -1.5px;
    }

    .wms-home .hero-description {
        max-width: 560px;
        color: #cbd5e1;
    }

    .wms-home .overview-card {
        border: 1px solid rgba(255,255,255,.35);
        box-shadow: 0 24px 60px rgba(2,6,23,.22);
    }

    .wms-home .overview-item {
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px;
        background: #f8fafc;
    }

    .wms-home .section-space {
        padding: 76px 0;
    }

    .wms-home .section-heading {
        max-width: 720px;
        margin: 0 auto 42px;
    }

    .wms-home .section-heading p {
        max-width: 640px;
        margin: 12px auto 0;
    }

    .wms-home .feature-card,
    .wms-home .about-card {
        height: 100%;
        border: 1px solid #e8edf5;
        border-radius: 18px;
        transition: .2s ease;
    }

    .wms-home .feature-card:hover,
    .wms-home .about-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 34px rgba(15,23,42,.09);
    }

    .wms-home .feature-card .card-body {
        padding: 26px;
    }

    .wms-home .feature-icon {
        width: 52px;
        height: 52px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.4rem;
    }

    .wms-home .stats-section {
        background: #f8fafc;
    }

    .wms-home .stat-box {
        height: 100%;
        padding: 22px 12px;
        border: 1px solid #e8edf5;
        border-radius: 16px;
        background: #fff;
    }

    .wms-home .stat-box .number {
        color: var(--primary);
        font-size: 2rem;
        font-weight: 800;
    }

    .wms-home .stat-box .label {
        margin-top: 7px;
        color: var(--muted);
        font-weight: 600;
    }

    .wms-home .about-icon {
        width: 54px;
        height: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 54px;
        border-radius: 14px;
        font-size: 1.45rem;
    }

    .wms-home .cta-section {
        background: linear-gradient(120deg, #172554, #1d4ed8);
    }

    @media (max-width: 767.98px) {
        .wms-home .section-space {
            padding: 54px 0;
        }

        .wms-home .hero h1 {
            font-size: clamp(2.2rem, 10vw, 3.2rem);
        }

        .wms-home .hero-actions .btn {
            width: 100%;
        }

        .wms-home .section-heading {
            margin-bottom: 30px;
        }
    }
</style>

<div class="wms-home">

    {{-- HERO SECTION --}}

    <section class="hero py-5">
        <div class="container py-lg-5 py-3">

            <div class="row align-items-center g-4 g-lg-5">

                <div class="col-lg-7">

                    <div class="hero-copy">

                        <span class="badge rounded-pill bg-primary px-3 py-2 mb-3">
                            <i class="bi bi-box-seam me-1"></i>
                            Warehouse Management System
                        </span>

                        <h1 class="display-4 fw-bold lh-sm mb-3">
                            Smart Warehouse Management
                        </h1>

                        <p class="fs-5 fw-semibold text-light mb-3">
                            Manage Inventory, Purchases and Sales Easily
                        </p>

                        <p class="hero-description mb-4">
                            A simple and powerful warehouse management system
                            designed to help businesses manage products, stock,
                            purchases and sales efficiently.
                        </p>

                        <div class="hero-actions d-flex flex-wrap gap-3">

                            <a href="{{ url('/productview') }}"
                               class="btn btn-light btn-lg fw-semibold px-4">
                                <i class="bi bi-box me-2"></i>
                                Explore Products
                            </a>

                            <a href="{{ url('/login') }}"
                               class="btn btn-primary btn-lg fw-semibold px-4">
                                <i class="bi bi-person-badge me-2"></i>
                                Staff Login
                            </a>

                        </div>

                    </div>

                </div>

                {{-- INVENTORY OVERVIEW --}}

                <div class="col-lg-5">

                    <div class="overview-card bg-white text-dark rounded-4 p-3 p-md-4">

                        <div class="d-flex align-items-center gap-2 mb-4">

                            <i class="bi bi-boxes text-primary fs-3"></i>

                            <h2 class="h5 fw-bold mb-0">
                                Inventory at a Glance
                            </h2>

                        </div>

                        {{-- PRODUCTS --}}

                        <div class="overview-item mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Active Products</span>

                                <span class="badge bg-success">
                                    In Stock
                                </span>
                            </div>

                            <div class="fs-4 fw-bold">
                                {{ number_format($activeProducts ?? 0) }}
                            </div>

                            <div class="small text-secondary">
                                Real-time stock tracking
                            </div>

                        </div>

                        {{-- PURCHASES --}}

                        <div class="overview-item mb-3">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Purchases</span>

                                <span class="badge bg-primary">
                                    {{ number_format($totalPurchases ?? 0) }}
                                </span>
                            </div>

                            <div class="fw-bold">
                                Automatic stock increase
                            </div>

                            <div class="small text-secondary">
                                Record and track purchases
                            </div>

                        </div>

                        {{-- SALES --}}

                        <div class="overview-item">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Sales</span>

                                <span class="badge bg-danger">
                                    {{ number_format($totalSales ?? 0) }}
                                </span>
                            </div>

                            <div class="fw-bold">
                                Automatic stock decrease
                            </div>

                            <div class="small text-secondary">
                                Keep stock records up to date
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- FEATURES SECTION --}}

    <section class="section-space bg-white">

        <div class="container">

            <div class="section-heading text-center">

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-2">
                    Features
                </span>

                <h2 class="display-6 fw-bold">
                    Everything You Need to Run Your Warehouse
                </h2>

                <p class="text-secondary">
                    A complete set of tools to manage your inventory,
                    suppliers, customers and daily transactions.
                </p>

            </div>

            @php

                $features = [

                    [
                        'bi-box',
                        'bg-primary text-white',
                        'Inventory Management',
                        'Manage products and monitor current stock levels in one place.'
                    ],

                    [
                        'bi-cart-plus',
                        'bg-success text-white',
                        'Purchase Management',
                        'Record purchases and keep stock quantities updated.'
                    ],

                    [
                        'bi-receipt',
                        'bg-danger text-white',
                        'Sales Management',
                        'Create sales and track outgoing stock.'
                    ],

                    [
                        'bi-boxes',
                        'bg-warning text-dark',
                        'Stock Monitoring',
                        'Monitor current, low-stock and out-of-stock products.'
                    ],

                    [
                        'bi-truck',
                        'bg-info text-dark',
                        'Supplier Management',
                        'Maintain supplier information for purchase records.'
                    ],

                    [
                        'bi-person-badge',
                        'bg-secondary text-white',
                        'Customer Management',
                        'Maintain customer information for sales records.'
                    ],

                ];

            @endphp

            <div class="row g-4">

                @foreach($features as [$icon, $color, $title, $desc])

                    <div class="col-sm-6 col-lg-4">

                        <div class="card feature-card">

                            <div class="card-body">

                                <span class="feature-icon {{ $color }} mb-3">
                                    <i class="bi {{ $icon }}"></i>
                                </span>

                                <h3 class="h5 fw-bold mb-2">
                                    {{ $title }}
                                </h3>

                                <p class="text-secondary mb-0">
                                    {{ $desc }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- STATISTICS SECTION --}}

    <section class="section-space stats-section">

        <div class="container">

            <div class="section-heading text-center mb-4">

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-2">
                    Our Numbers
                </span>

                <h2 class="display-6 fw-bold mb-0">
                    Warehouse at a Glance
                </h2>

            </div>

            @php

                $statistics = [

                    ['120', 'Products'],
                    ['15', 'Categories'],
                    ['25', 'Suppliers'],
                    ['80', 'Customers'],
                    ['45', 'Purchases'],
                    ['78', 'Sales'],

                ];

            @endphp

            <div class="row g-3">

                @foreach($statistics as [$number, $label])

                    <div class="col-6 col-md-4 col-xl-2">

                        <div class="stat-box text-center">

                            <div class="number">
                                {{ $number }}
                            </div>

                            <div class="label">
                                {{ $label }}
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- ABOUT WMS SECTION --}}

    <section class="section-space bg-white">

        <div class="container">

            <div class="section-heading text-center">

                <span class="badge rounded-pill bg-primary-subtle text-primary px-3 py-2 mb-2">
                    About WMS
                </span>

                <h2 class="display-6 fw-bold">
                    Everything You Need to Manage Your Warehouse
                </h2>

                <p class="text-secondary">
                    WMS helps you manage products, inventory, purchases,
                    sales, suppliers and customers from one simple system.
                </p>

            </div>

            @php

                $aboutItems = [

                    [
                        'bi-box-seam',
                        'bg-primary text-white',
                        'Product Tracking',
                        'Keep a complete catalogue of every product and easily manage product information.'
                    ],

                    [
                        'bi-arrow-down-up',
                        'bg-success text-white',
                        'Accurate Stock',
                        'Purchases increase stock and sales decrease stock automatically.'
                    ],

                    [
                        'bi-receipt',
                        'bg-danger text-white',
                        'Transaction Records',
                        'Maintain clear records of purchases, sales and warehouse transactions.'
                    ],

                    [
                        'bi-exclamation-triangle',
                        'bg-warning text-dark',
                        'Low Stock Alerts',
                        'Identify products with low stock and know when they need restocking.'
                    ],

                ];

            @endphp

            <div class="row g-4">

                @foreach($aboutItems as [$icon, $color, $title, $desc])

                    <div class="col-md-6">

                        <div class="card about-card">

                            <div class="card-body p-4">

                                <div class="d-flex align-items-start gap-3">

                                    <span class="about-icon {{ $color }}">
                                        <i class="bi {{ $icon }}"></i>
                                    </span>

                                    <div>

                                        <h3 class="h5 fw-bold mb-2">
                                            {{ $title }}
                                        </h3>

                                        <p class="text-secondary mb-0">
                                            {{ $desc }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- CALL TO ACTION SECTION --}}

    <section class="cta-section section-space">

        <div class="container text-center">

            <h2 class="display-6 fw-bold text-white mb-3">
                Ready to Manage Your Warehouse Better?
            </h2>

            <p class="text-light mx-auto mb-4"
               style="max-width:560px;">

                Access your WMS system and manage your warehouse
                operations efficiently.

            </p>

            <a href="{{ url('/login') }}"
               class="btn btn-light btn-lg fw-semibold px-4">

                <i class="bi bi-person-badge me-2"></i>
                Staff Login

            </a>

        </div>

    </section>

</div>
<script src='https://cdn.jotfor.ms/agent/embedjs/01a2126556e8700089c3a220c824acb63ef2/embed.js'>
</script>
@endsection
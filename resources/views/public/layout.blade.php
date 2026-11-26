<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Stockora | Warehouse Management System')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    @stack('styles')

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
            background: #f8fafc;
        }

        main {
            flex: 1;
        }

        .navbar {
            background: #111827;
            padding: 14px 0;
        }

        .navbar-brand {
            font-size: 21px;
            letter-spacing: .3px;
        }

        .navbar .nav-link {
            color: #d1d5db;
            margin-left: 10px;
            transition: .2s;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link:focus {
            color: #ffffff;
        }

        .login-nav-link {
            background: #2563eb;
            color: #ffffff !important;
            border-radius: 8px;
            padding: 9px 18px !important;
            margin-left: 16px;
            text-align: center;
        }

        .login-nav-link:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .footer {
            background: #111827;
            color: #ffffff;
            margin-top: 50px;
        }

        .footer-heading {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .footer-description {
            color: #9ca3af;
            line-height: 1.8;
            font-size: 14px;
        }

        .footer-link {
            display: inline-block;
            color: #9ca3af;
            text-decoration: none;
            margin-bottom: 12px;
            transition: .2s;
        }

        .footer-link:hover {
            color: #ffffff;
            padding-left: 4px;
        }

        .footer-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: #2563eb;
            color: #ffffff;
            border-radius: 10px;
            font-size: 21px;
        }

        .footer-action {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            margin-bottom: 18px;
        }

        .footer-action:hover .footer-action-title {
            color: #93c5fd;
        }

        .footer-action-title {
            color: #ffffff;
            font-weight: 600;
            display: block;
        }

        .footer-action-description {
            color: #9ca3af;
            font-size: 12px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border: 1px solid #4b5563;
            border-radius: 50%;
            color: #d1d5db;
            text-decoration: none;
            transition: .2s;
        }

        .social-link:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
        }

        @media (max-width: 991px) {
            .login-nav-link {
                margin-left: 0;
                margin-top: 8px;
            }

            .navbar .nav-link {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand fw-bold"
               href="{{ route('public.home') }}">
                <i class="bi bi-box-seam me-2 text-primary"></i>
                Stockora
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('public.home') }}">
                            <i class="bi bi-house me-1"></i> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ url('productview') }}">
                            <i class="bi bi-box-seam me-1"></i> Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('public.about') }}">
                            About
                        </a>
                    </li>

                    

                    <!-- Shared Login Page -->
                    <li class="nav-item">
                        <a class="nav-link login-nav-link"
                           href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- PROFESSIONAL FOOTER -->
    <footer class="footer">

        <div class="container py-5">
            <div class="row g-4">

                <!-- Brand Information -->
                <div class="col-lg-4 col-md-6">

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="footer-icon">
                            <i class="bi bi-box-seam"></i>
                        </span>

                        <div>
                            <h5 class="fw-bold mb-1">Stockora</h5>
                            <small class="text-secondary">
                                Warehouse Management System
                            </small>
                        </div>
                    </div>

                    <p class="footer-description">
                        A simple warehouse management system designed
                        to help manage products, inventory, purchases,
                        sales and suppliers efficiently.
                    </p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-link"
                           aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#" class="social-link"
                           aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#" class="social-link"
                           aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-heading">Quick Links</h6>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a class="footer-link"
                               href="{{ route('public.home') }}">
                                <i class="bi bi-chevron-right me-1"></i>
                                Home
                            </a>
                        </li>

                        <li>
                            <a class="footer-link"
                               href="{{ url('productview') }}">
                                <i class="bi bi-chevron-right me-1"></i>
                                Products
                            </a>
                        </li>

                        <li>
                            <a class="footer-link"
                               href="{{ route('public.about') }}">
                                <i class="bi bi-chevron-right me-1"></i>
                                About
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-heading">Warehouse Services</h6>

                    <ul class="list-unstyled footer-description mb-0">
                        <li class="mb-3">
                            <i class="bi bi-box me-2 text-primary"></i>
                            Product Management
                        </li>

                        <li class="mb-3">
                            <i class="bi bi-boxes me-2 text-primary"></i>
                            Inventory Management
                        </li>

                        <li class="mb-3">
                            <i class="bi bi-cart-plus me-2 text-primary"></i>
                            Purchase Management
                        </li>

                        <li class="mb-3">
                            <i class="bi bi-receipt me-2 text-primary"></i>
                            Sales Management
                        </li>

                        <li>
                            <i class="bi bi-truck me-2 text-primary"></i>
                            Supplier Management
                        </li>
                    </ul>
                </div>

                <!-- Access & Contact -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="footer-heading">Access & Contact</h6>

                    <a href="{{ route('login') }}"
                       class="footer-action">

                        <span class="footer-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <span>
                            <span class="footer-action-title">
                                Admin Login
                            </span>

                            <span class="footer-action-description">
                                Access the admin dashboard
                            </span>
                        </span>
                    </a>

                    <a href="{{ route('login') }}"
                       class="footer-action">

                        <span class="footer-icon"
                              style="background:#059669;">
                            <i class="bi bi-person-badge"></i>
                        </span>

                        <span>
                            <span class="footer-action-title">
                                Staff Login
                            </span>

                            <span class="footer-action-description">
                                Access the staff dashboard
                            </span>
                        </span>
                    </a>

                    <div class="footer-description mb-2">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        support@wms.com
                    </div>

                    <div class="footer-description">
                        <i class="bi bi-telephone me-2 text-primary"></i>
                        +91 00000 00000
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container py-3">
                <div class="row align-items-center">

                    <div class="col-md-6 text-center text-md-start">
                        <small class="text-secondary">
                            &copy; {{ date('Y') }}
                            <span class="text-white fw-semibold">
                                Stockora
                            </span>.
                            All rights reserved.
                        </small>
                    </div>

                    <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                        <span class="text-secondary small">
                            Warehouse Management System
                        </span>
                    </div>

                </div>
            </div>
        </div>

    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>

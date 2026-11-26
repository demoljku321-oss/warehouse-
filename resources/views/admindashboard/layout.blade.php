<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Panel') - WMS
    </title>
    <!-- Bootstrap Icons: Dashboard and Sidebar Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

   
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #1f2937;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 255px;
            background: #20252a;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
        }

        .logo {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid #30363b;
        }

        .logo-icon {
            margin-right: 12px;
            font-size: 24px;
        }

        .sidebar-content {
            padding: 15px 16px;
        }

        .menu-section {
            margin-top: 22px;
        }

        .menu-title {
            color: #737b84;
            font-size: 12px;
            text-transform: uppercase;
            margin: 0 8px 10px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #d4d8dc;
            padding: 11px 14px;
            border-radius: 6px;
            margin-bottom: 4px;
            font-size: 16px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #30363b;
            color: white;
        }

        .menu-item.active {
            background: #1473f9;
            color: white;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        .sidebar-bottom {
            border-top: 1px solid #30363b;
            margin-top: 15px;
            padding-top: 15px;
        }

        .logout {
            color: #ff3b45;
        }

        .logout:hover {
            background: #302326;
            color: #ff3b45;
        }

        /* ================= MAIN ================= */

        .main-content {
            margin-left: 255px;
            width: calc(100% - 255px);
            min-height: 100vh;
        }

        .topbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: flex-end;

            padding: 0 30px;
        }

        .admin-info {
            text-align: right;
        }

        .admin-name {
            font-size: 14px;
            color: #777;
        }

        .role-badge {
            display: inline-block;
            margin-top: 3px;
            background: #1473f9;
            color: white;
            font-size: 12px;
            padding: 3px 9px;
            border-radius: 5px;
        }

        .content {
            padding: 30px;
        }

        .page-title {
            font-size: 28px;
            margin-bottom: 25px;
        }

        /* ================= CARDS ================= */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border-radius: 7px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .stat-card {
            border-left: 4px solid #1473f9;
        }

        .stat-title {
            color: #777;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 25px;
            font-weight: bold;
        }

        /* ================= TABLE ================= */

        .table-card {
            background: white;
            border-radius: 7px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 25px;
        }

        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #ddd;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 17px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            font-weight: bold;
            background: #fafafa;
        }

        /* ================= BADGE ================= */

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            font-size: 12px;
        }

        .badge-success {
            background: #d1e7dd;
            color: #0f5132;
        }

        .badge-warning {
            background: #fff3cd;
            color: #664d03;
        }

        .badge-danger {
            background: #f8d7da;
            color: #842029;
        }

        .badge-info {
            background: #cff4fc;
            color: #055160;
        }

        /* ================= BUTTON ================= */

        .btn {
            border: none;
            padding: 9px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-primary {
            background: #1473f9;
            color: white;
        }

        .btn-success {
            background: #198754;
            color: white;
        }

        /* ================= PROFILE ================= */

        .profile-card {
            max-width: 700px;
        }

        .profile-row {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .profile-label {
            width: 180px;
            color: #777;
        }

        .profile-value {
            font-weight: 500;
        }

        .btn-warning {
            background: #ffc107;
            color: #222;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media(max-width: 768px) {

            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .content {
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<div class="admin-wrapper">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="logo">

            <span class="logo-icon">
                ▣
            </span>

            Stockora

        </div>


        <div class="sidebar-content">


            <!-- Dashboard -->

            <a href="{{ route('admindashboard.admindashboard') }}"
               class="menu-item {{ request()->routeIs('admindashboard.admindashboard') ? 'active' : '' }}">

                <span class="menu-icon">
                    ◉
                </span>

                Dashboard

            </a>


            <!-- Inventory -->

            <div class="menu-section">

                <div class="menu-title">
                    Inventory
                </div>


                <!-- Manage Staff -->

                <a href="{{ route('admin.staff') }}"
                   class="menu-item {{ request()->routeIs('admin.staff') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ♙
                    </span>

                    Manage Staff

                </a>


                <!-- Categories -->

                <a href="{{ route('admin.categories') }}"
                   class="menu-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ◇
                    </span>

                    Categories

                </a>


                <!-- Products -->

                <a href="{{ route('admin.adminproducts') }}"
                   class="menu-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">

                    <span class="menu-icon">
                        □
                    </span>

                    Products

                </a>


                <!-- Suppliers -->

                <a href="{{ route('admin.suppliers') }}"
                   class="menu-item {{ request()->routeIs('admin.suppliers') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ▣
                    </span>

                    Suppliers

                </a>


                <!-- Customers -->

                <a href="{{ route('admin.internalCustomer') }}"
                   class="menu-item {{ request()->routeIs('admin.internalCustomer') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ♙
                    </span>

                    Customers

                </a>

            </div>


            <!-- Transactions -->

            <div class="menu-section">

                <div class="menu-title">
                    Transactions
                </div>


                <!-- Purchases -->

                <a href="{{ route('admin.purchases') }}"
                   class="menu-item {{ request()->routeIs('admin.purchases') ? 'active' : '' }}">

                    <span class="menu-icon">
                        🛒
                    </span>

                    Purchases

                </a>


                <!-- Sales -->

                <a href="{{ route('admin.sales') }}"
                   class="menu-item {{ request()->routeIs('admin.sales') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ▤
                    </span>

                    Sales

                </a>


                <!-- Stock -->

                <a href="{{ route('admin.stock') }}"
                   class="menu-item {{ request()->routeIs('admin.stock') ? 'active' : '' }}">

                    <span class="menu-icon">
                        ♧
                    </span>

                    Stock

                </a>

            </div>


           


            <!-- Bottom -->

            <div class="sidebar-bottom">


                <!-- Profile -->

                    


                <!-- Logout -->

                <a href="{{ route('public.home') }}"
x
                   class="menu-item logout">

                    <span class="menu-icon">
                        ↪
                    </span>

                    Logout

                </a>


            </div>


        </div>

    </aside>


    <!-- ================= MAIN ================= -->

    <main class="main-content">

        <div class="topbar">

            <div class="admin-info">

                <div class="admin-name">

                    {{ auth()->user()->name ?? 'Admin' }}

                </div>

                <span class="role-badge">
                    Admin
                </span>

            </div>

        </div>


        <div class="content">

            @yield('content')

        </div>


    </main>

</div>

</body>

</html> 
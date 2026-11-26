
@extends('admindashboard.layout')

@section('title', 'Admin Dashboard')

@section('content')

<style>
    .admin-dashboard {
        color: #172b4d;
        padding-bottom: 25px;
    }

    .admin-dashboard * {
        box-sizing: border-box;
    }

    .admin-dashboard .welcome-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .admin-dashboard .welcome-title {
        font-size: 27px;
        font-weight: 750;
        margin: 0 0 6px;
        color: #102a56;
    }

    .admin-dashboard .muted {
        color: #718096;
        font-size: 13px;
        margin: 0;
    }

    .admin-dashboard .date-chip {
        background: #fff;
        border: 1px solid #e2eaf5;
        padding: 12px 16px;
        border-radius: 10px;
        font-size: 13px;
        color: #1769e0;
        box-shadow: 0 3px 12px rgba(28, 65, 120, .04);
    }

    .admin-dashboard .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .admin-dashboard .metric-card {
        background: #fff;
        border: 1px solid #e8eef7;
        border-radius: 13px;
        padding: 19px;
        min-width: 0;
        box-shadow: 0 4px 15px rgba(35, 65, 110, .045);
        transition: transform .2s, box-shadow .2s;
    }

    .admin-dashboard .metric-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(35, 65, 110, .09);
    }

    .admin-dashboard .metric-top {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .admin-dashboard .metric-icon {
        width: 47px;
        height: 47px;
        min-width: 47px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .admin-dashboard .blue { background: #e8f1ff; color: #1769e0; }
    .admin-dashboard .green { background: #e0f8ee; color: #079669; }
    .admin-dashboard .purple { background: #f0e9ff; color: #8153df; }
    .admin-dashboard .orange { background: #fff0df; color: #ec8b18; }
    .admin-dashboard .red { background: #ffe7e9; color: #e54859; }
    .admin-dashboard .teal { background: #dff7f7; color: #079b9b; }

    .admin-dashboard .metric-label {
        color: #65758e;
        font-size: 12px;
        margin-bottom: 6px;
    }

    .admin-dashboard .metric-number {
        color: #17345f;
        font-size: 25px;
        font-weight: 750;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .metric-foot {
        color: #8795a9;
        font-size: 11px;
        margin-top: 13px;
    }

    .admin-dashboard .metric-foot i {
        color: #09a879;
        margin-right: 4px;
    }

    .admin-dashboard .finance-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 23px;
    }

    .admin-dashboard .finance-card {
        background: #fff;
        border: 1px solid #e8eef7;
        border-radius: 12px;
        padding: 18px;
        box-shadow: 0 4px 15px rgba(35, 65, 110, .04);
    }

    .admin-dashboard .finance-label {
        font-size: 12px;
        color: #718096;
    }

    .admin-dashboard .finance-value {
        font-size: 23px;
        font-weight: 750;
        margin-top: 9px;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .finance-note {
        font-size: 11px;
        color: #8b98aa;
        margin-top: 7px;
    }

    .admin-dashboard .chart-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 23px;
    }

    .admin-dashboard .panel {
        background: #fff;
        border: 1px solid #e5edf7;
        border-radius: 13px;
        box-shadow: 0 4px 15px rgba(35, 65, 110, .045);
        min-width: 0;
        overflow: hidden;
    }

    .admin-dashboard .panel-heading {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .admin-dashboard .panel-heading h3 {
        font-size: 14px;
        font-weight: 750;
        color: #17345f;
        margin: 0;
    }

    .admin-dashboard .panel-body {
        padding: 18px;
    }

    .admin-dashboard .view-link {
        font-size: 12px;
        text-decoration: none;
        color: #1769e0;
        font-weight: 600;
        white-space: nowrap;
    }

    .admin-dashboard .view-link:hover {
        text-decoration: underline;
    }

    .admin-dashboard .legend {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 11px;
        color: #65758e;
    }

    .admin-dashboard .legend span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .admin-dashboard .legend-dot {
        width: 8px;
        height: 8px;
        display: inline-block;
        border-radius: 50%;
    }

    .admin-dashboard .chart-svg {
        display: block;
        width: 100%;
        height: auto;
    }

    .admin-dashboard .category-content {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .admin-dashboard .donut {
        width: 145px;
        height: 145px;
        min-width: 145px;
        border-radius: 50%;
        position: relative;
        margin: auto;
        background: #e8eef7;
    }

    .admin-dashboard .donut-hole {
        position: absolute;
        inset: 27px;
        border-radius: 50%;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .admin-dashboard .donut-total {
        font-size: 22px;
        font-weight: 750;
        color: #17345f;
    }

    .admin-dashboard .donut-caption {
        font-size: 10px;
        color: #718096;
    }

    .admin-dashboard .category-legend {
        flex: 1;
        min-width: 130px;
    }

    .admin-dashboard .category-legend-row {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        padding: 7px 0;
        font-size: 11px;
        border-bottom: 1px solid #f0f3f8;
    }

    .admin-dashboard .category-name {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #50627d;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .category-count {
        color: #263f63;
        white-space: nowrap;
    }

    .admin-dashboard .stock-bar-row {
        margin-bottom: 18px;
    }

    .admin-dashboard .stock-bar-label {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        font-size: 11px;
        margin-bottom: 7px;
        color: #62738c;
    }

    .admin-dashboard .stock-track {
        height: 9px;
        background: #edf2f8;
        border-radius: 20px;
        overflow: hidden;
    }

    .admin-dashboard .stock-fill {
        height: 100%;
        border-radius: 20px;
    }

    .admin-dashboard .table-panel {
        margin-bottom: 22px;
    }

    .admin-dashboard .table-wrap {
        overflow-x: auto;
        width: 100%;
    }

    .admin-dashboard table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px;
        margin: 0;
    }

    .admin-dashboard table thead th {
        padding: 13px 16px;
        background: #f7f9fc;
        color: #667790;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #e8eef6;
        text-align: left;
    }

    .admin-dashboard table tbody td {
        padding: 13px 16px;
        color: #435775;
        font-size: 12px;
        border-bottom: 1px solid #edf1f7;
        vertical-align: middle;
    }

    .admin-dashboard table tbody tr:last-child td {
        border-bottom: none;
    }

    .admin-dashboard table tbody tr:hover {
        background: #f9fbff;
    }

    .admin-dashboard .invoice {
        font-weight: 700;
        color: #1769e0;
        white-space: nowrap;
    }

    .admin-dashboard .amount {
        font-weight: 700;
        color: #17345f;
        white-space: nowrap;
    }

    .admin-dashboard .status-pill {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .admin-dashboard .status-low {
        color: #a86700;
        background: #fff0c7;
    }

    .admin-dashboard .status-out {
        color: #bd2636;
        background: #ffe1e4;
    }

    .admin-dashboard .empty-row {
        text-align: center;
        color: #8996a9;
        padding: 28px 15px !important;
    }

    .admin-dashboard .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media(max-width: 1200px) {
        .admin-dashboard .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-dashboard .finance-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-dashboard .chart-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-dashboard .chart-panel:first-child {
            grid-column: 1 / -1;
        }
    }

    @media(max-width: 700px) {
        .admin-dashboard .stats-grid,
        .admin-dashboard .finance-grid,
        .admin-dashboard .chart-grid,
        .admin-dashboard .bottom-grid {
            grid-template-columns: 1fr;
        }

        .admin-dashboard .chart-panel:first-child {
            grid-column: auto;
        }

        .admin-dashboard .welcome-title {
            font-size: 23px;
        }

        .admin-dashboard .metric-number {
            font-size: 22px;
        }

        .admin-dashboard .category-content {
            justify-content: center;
        }
    }
</style>

<div class="admin-dashboard">

    {{-- PAGE HEADER --}}
    <div class="welcome-row">
        <div>
            <h1 class="welcome-title">
                <i class="bi bi-grid-1x2-fill" style="color:#1769e0;"></i>
                Welcome back, Admin!
            </h1>
            <p class="muted">Here's your warehouse performance and inventory overview.</p>
        </div>

        <div class="date-chip">
            <i class="bi bi-calendar3"></i>
            {{ now()->format('D, d M Y') }}
        </div>
    </div>

    {{-- MAIN KPI CARDS --}}
    <div class="stats-grid">

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon blue"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="metric-label">Total Staff</div>
                    <div class="metric-number">{{ number_format($totalStaff) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-check-circle-fill"></i> Registered staff</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon green"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div class="metric-label">Total Products</div>
                    <div class="metric-number">{{ number_format($totalProducts) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-database-check"></i> Products in inventory</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon purple"><i class="bi bi-grid-fill"></i></div>
                <div>
                    <div class="metric-label">Categories</div>
                    <div class="metric-number">{{ number_format($totalCategories) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-tags-fill"></i> Distinct categories</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon orange"><i class="bi bi-truck"></i></div>
                <div>
                    <div class="metric-label">Suppliers</div>
                    <div class="metric-number">{{ number_format($totalSuppliers) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-building"></i> Registered suppliers</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon red"><i class="bi bi-person-lines-fill"></i></div>
                <div>
                    <div class="metric-label">Customers</div>
                    <div class="metric-number">{{ number_format($totalCustomers) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-people"></i> Unique customer details</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon teal"><i class="bi bi-receipt"></i></div>
                <div>
                    <div class="metric-label">Purchases</div>
                    <div class="metric-number">{{ number_format($totalPurchases) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-journal-check"></i> Purchase invoices</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon purple"><i class="bi bi-graph-up-arrow"></i></div>
                <div>
                    <div class="metric-label">Sales</div>
                    <div class="metric-number">{{ number_format($totalSales) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-cart-check"></i> Sales records</div>
        </div>

        <div class="metric-card">
            <div class="metric-top">
                <div class="metric-icon blue"><i class="bi bi-database-fill"></i></div>
                <div>
                    <div class="metric-label">Current Stock</div>
                    <div class="metric-number">{{ number_format($currentStock) }}</div>
                </div>
            </div>
            <div class="metric-foot"><i class="bi bi-boxes"></i> Total available units</div>
        </div>

    </div>

    {{-- FINANCIAL AND STOCK SUMMARY --}}
    <div class="finance-grid">

        <div class="finance-card" style="border-left:4px solid #079669;">
            <div class="finance-label"><i class="bi bi-wallet2"></i> Total Purchase Value</div>
            <div class="finance-value" style="color:#079669;">
                ₹{{ number_format((float)$purchaseValue, 2) }}
            </div>
            <div class="finance-note">Recorded purchase invoices</div>
        </div>

        <div class="finance-card" style="border-left:4px solid #1769e0;">
            <div class="finance-label"><i class="bi bi-currency-rupee"></i> Total Sales Value</div>
            <div class="finance-value" style="color:#1769e0;">
                ₹{{ number_format((float)$salesValue, 2) }}
            </div>
            <div class="finance-note">Recorded sales transactions</div>
        </div>

        <div class="finance-card" style="border-left:4px solid #e9a008;">
            <div class="finance-label"><i class="bi bi-exclamation-triangle"></i> Low Stock Alerts</div>
            <div class="finance-value" style="color:#bd8000;">
                {{ number_format($lowStockProducts->count()) }}
            </div>
            <div class="finance-note">Products at minimum stock level or below</div>
        </div>

        <div class="finance-card" style="border-left:4px solid #e54859;">
            <div class="finance-label"><i class="bi bi-box2"></i> Out of Stock</div>
            <div class="finance-value" style="color:#e54859;">
                {{ number_format($outOfStock) }}
            </div>
            <div class="finance-note">Products with zero quantity</div>
        </div>

    </div>

    {{-- CHARTS --}}
    <div class="chart-grid">

        {{-- SALES VS PURCHASES CHART --}}
        <div class="panel chart-panel">
            <div class="panel-heading">
                <h3>Sales &amp; Purchases Overview</h3>
                <div class="legend">
                    <span><i class="legend-dot" style="background:#1769e0;"></i> Sales</span>
                    <span><i class="legend-dot" style="background:#08a879;"></i> Purchases</span>
                </div>
            </div>

            <div class="panel-body">
                @php
                    $maxFinance = max((float)$salesValue, (float)$purchaseValue, 1);
                    $salesY = 155 - (((float)$salesValue / $maxFinance) * 110);
                    $purchaseY = 155 - (((float)$purchaseValue / $maxFinance) * 110);
                @endphp

                <svg class="chart-svg" viewBox="0 0 460 220" role="img" aria-label="Sales and purchases total value comparison">
                    @foreach([45, 80, 115, 150, 185] as $y)
                        <line x1="42" y1="{{ $y }}" x2="445" y2="{{ $y }}" stroke="#eaf0f8" stroke-width="1"/>
                    @endforeach

                    <text x="4" y="49" fill="#8493a9" font-size="10">100%</text>
                    <text x="10" y="84" fill="#8493a9" font-size="10">75%</text>
                    <text x="10" y="119" fill="#8493a9" font-size="10">50%</text>
                    <text x="10" y="154" fill="#8493a9" font-size="10">25%</text>
                    <text x="20" y="189" fill="#8493a9" font-size="10">0%</text>

                    <path d="M42 185 L42 {{ $salesY }} L445 {{ $salesY }} L445 185 Z" fill="#1769e0" opacity=".08"/>
                    <line x1="42" y1="{{ $salesY }}" x2="445" y2="{{ $salesY }}" stroke="#1769e0" stroke-width="3" stroke-linecap="round"/>
                    <line x1="42" y1="{{ $purchaseY }}" x2="445" y2="{{ $purchaseY }}" stroke="#08a879" stroke-width="3" stroke-linecap="round" stroke-dasharray="6 5"/>

                    <circle cx="42" cy="{{ $salesY }}" r="4" fill="#1769e0"/>
                    <circle cx="445" cy="{{ $salesY }}" r="4" fill="#1769e0"/>
                    <circle cx="42" cy="{{ $purchaseY }}" r="4" fill="#08a879"/>
                    <circle cx="445" cy="{{ $purchaseY }}" r="4" fill="#08a879"/>

                    <text x="42" y="207" fill="#8493a9" font-size="10">Purchases</text>
                    <text x="445" y="207" fill="#8493a9" font-size="10" text-anchor="end">Sales</text>
                </svg>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:8px;">
                    <div style="background:#f0f6ff;border-radius:9px;padding:12px;">
                        <div class="muted">Sales Value</div>
                        <strong style="color:#1769e0;">₹{{ number_format((float)$salesValue, 2) }}</strong>
                    </div>
                    <div style="background:#ecfaf4;border-radius:9px;padding:12px;">
                        <div class="muted">Purchase Value</div>
                        <strong style="color:#079669;">₹{{ number_format((float)$purchaseValue, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCT CATEGORIES --}}
        <div class="panel chart-panel">
            <div class="panel-heading">
                <h3>Product Categories</h3>
                <a class="view-link" href="{{ route('admin.categories') }}">View All</a>
            </div>

            <div class="panel-body">
                @php
                    $categoryCounts = \App\Models\Product::query()
                        ->whereNotNull('category')
                        ->where('category', '!=', '')
                        ->select('category')
                        ->selectRaw('COUNT(*) as total')
                        ->groupBy('category')
                        ->orderByDesc('total')
                        ->take(5)
                        ->get();

                    $categoryColors = ['#1769e0', '#08a879', '#f59e0b', '#b64be0', '#88a1c2'];
                    $categoryTotal = (int) $categoryCounts->sum('total');
                    $categoryGradientParts = [];
                    $categoryOffset = 0;

                    foreach ($categoryCounts as $index => $categoryItem) {
                        $percent = $categoryTotal > 0
                            ? ($categoryItem->total / $categoryTotal) * 100
                            : 0;

                        $nextOffset = $categoryOffset + $percent;
                        $categoryGradientParts[] =
                            $categoryColors[$index] . ' ' .
                            $categoryOffset . '% ' . $nextOffset . '%';

                        $categoryOffset = $nextOffset;
                    }

                    $categoryGradient = count($categoryGradientParts)
                        ? 'conic-gradient(' . implode(', ', $categoryGradientParts) . ')'
                        : '#e8eef7';
                @endphp

                <div class="category-content">
                    <div class="donut" style="background:{{ $categoryGradient }};">
                        <div class="donut-hole">
                            <div class="donut-total">{{ number_format($totalProducts) }}</div>
                            <div class="donut-caption">Products</div>
                        </div>
                    </div>

                    <div class="category-legend">
                        @forelse($categoryCounts as $index => $categoryItem)
                            <div class="category-legend-row">
                                <span class="category-name">
                                    <i class="legend-dot" style="background:{{ $categoryColors[$index] }};"></i>
                                    {{ $categoryItem->category }}
                                </span>
                                <span class="category-count">{{ $categoryItem->total }}</span>
                            </div>
                        @empty
                            <p class="muted">No categories available.</p>
                        @endforelse
                    </div>
                </div>

                <p class="muted" style="margin-top:18px;">
                    Showing the top 5 categories by product count.
                </p>
            </div>
        </div>

        {{-- STOCK OVERVIEW --}}
        <div class="panel chart-panel">
            <div class="panel-heading">
                <h3>Stock Overview</h3>
                <a class="view-link" href="{{ route('admin.stock') }}">Manage</a>
            </div>

            <div class="panel-body">
                @php
                    $inStockProducts = \App\Models\Product::where('quantity', '>', 0)
                        ->whereColumn('quantity', '>', 'minimum_stock')
                        ->count();

                    $lowStockCount = \App\Models\Product::where('quantity', '>', 0)
                        ->whereColumn('quantity', '<=', 'minimum_stock')
                        ->count();

                    $maxStockCount = max($totalProducts, 1);

                    $inStockPercent = min(100, ($inStockProducts / $maxStockCount) * 100);
                    $lowStockPercent = min(100, ($lowStockCount / $maxStockCount) * 100);
                    $outStockPercent = min(100, ($outOfStock / $maxStockCount) * 100);
                @endphp

                <div style="margin:12px 0 23px;">
                    <div style="display:flex;justify-content:space-between;gap:8px;margin-bottom:10px;">
                        <span style="font-size:12px;color:#62738c;">Stock distribution</span>
                        <span style="font-size:12px;font-weight:700;">{{ number_format($totalProducts) }} products</span>
                    </div>

                    <div style="height:15px;display:flex;background:#edf2f8;border-radius:20px;overflow:hidden;">
                        <div style="width:{{ $inStockPercent }}%;background:#08a879;" title="In stock"></div>
                        <div style="width:{{ $lowStockPercent }}%;background:#f59e0b;" title="Low stock"></div>
                        <div style="width:{{ $outStockPercent }}%;background:#e54859;" title="Out of stock"></div>
                    </div>
                </div>

                <div class="stock-bar-row">
                    <div class="stock-bar-label">
                        <span><i class="legend-dot" style="background:#08a879;"></i> In Stock</span>
                        <strong>{{ number_format($inStockProducts) }}</strong>
                    </div>
                    <div class="stock-track">
                        <div class="stock-fill" style="width:{{ $inStockPercent }}%;background:#08a879;"></div>
                    </div>
                </div>

                <div class="stock-bar-row">
                    <div class="stock-bar-label">
                        <span><i class="legend-dot" style="background:#f59e0b;"></i> Low Stock</span>
                        <strong>{{ number_format($lowStockCount) }}</strong>
                    </div>
                    <div class="stock-track">
                        <div class="stock-fill" style="width:{{ $lowStockPercent }}%;background:#f59e0b;"></div>
                    </div>
                </div>

                <div class="stock-bar-row">
                    <div class="stock-bar-label">
                        <span><i class="legend-dot" style="background:#e54859;"></i> Out of Stock</span>
                        <strong>{{ number_format($outOfStock) }}</strong>
                    </div>
                    <div class="stock-track">
                        <div class="stock-fill" style="width:{{ $outStockPercent }}%;background:#e54859;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- RECENT PURCHASES --}}
    <div class="panel table-panel">
        <div class="panel-heading">
            <h3><i class="bi bi-receipt" style="color:#1769e0;"></i> Recent Purchases</h3>
            <a class="view-link" href="{{ route('admin.purchases') }}">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Supplier</th>
                        <th>Purchase Date</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPurchases as $purchase)
                        <tr>
                            <td class="invoice">{{ $purchase->bill_number }}</td>
                            <td>{{ $purchase->supplier->company_name ?? 'N/A' }}</td>
                            <td>
                                {{ $purchase->purchase_date
                                    ? \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y')
                                    : 'N/A' }}
                            </td>
                            <td class="amount">₹{{ number_format((float)$purchase->grand_total, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-row">No purchase records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RECENT SALES --}}
    <div class="panel table-panel">
        <div class="panel-heading">
            <h3><i class="bi bi-graph-up-arrow" style="color:#08a879;"></i> Recent Sales</h3>
            <a class="view-link" href="{{ route('admin.sales') }}">View All <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSales as $sale)
                        <tr>
                            <td class="invoice">{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->customer_name ?? $sale->customer->name ?? 'N/A' }}</td>
                            <td>{{ $sale->product->product_name ?? 'N/A' }}</td>
                            <td>{{ number_format($sale->quantity) }}</td>
                            <td>{{ $sale->created_at?->format('d M Y') ?? 'N/A' }}</td>
                            <td class="amount">₹{{ number_format((float)$sale->total_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-row">No sales records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- INVENTORY ALERTS --}}
    <div class="panel table-panel">
        <div class="panel-heading">
            <h3><i class="bi bi-exclamation-triangle" style="color:#e9a008;"></i> Low Stock Products</h3>
            <a class="view-link" href="{{ route('admin.stock') }}">Manage Stock <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Product Code</th>
                        <th>Category</th>
                        <th>Available Quantity</th>
                        <th>Minimum Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockProducts as $product)
                        <tr>
                            <td style="font-weight:700;color:#17345f;">{{ $product->product_name }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->category ?: 'Uncategorized' }}</td>
                            <td>{{ number_format($product->quantity) }}</td>
                            <td>{{ number_format($product->minimum_stock) }}</td>
                            <td>
                                @if($product->quantity == 0)
                                    <span class="status-pill status-out">Out of Stock</span>
                                @else
                                    <span class="status-pill status-low">Low Stock</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-row">All products have sufficient stock.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;padding:10px 2px;color:#8996a9;font-size:11px;">
        <span>© {{ now()->year }} Stockora Warehouse Management System</span>
        <span>Inventory overview · Business records · Stock alerts</span>
    </div>

</div>

@endsection

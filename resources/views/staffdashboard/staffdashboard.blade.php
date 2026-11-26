@extends('staffdashboard/layout')

@section('title', 'Staff Dashboard')

@section('content')

<h1 class="page-title">Staff Dashboard</h1>

<div class="cards">

    <div class="card stat-card">
        <div class="stat-title">Total Products</div>
        <div class="stat-number">{{ $totalProducts }}</div>
    </div>

    <div class="card stat-card">
        <div class="stat-title">Categories</div>
        <div class="stat-number">{{ $totalCategories }}</div>
    </div>

    <div class="card stat-card">
        <div class="stat-title">Suppliers</div>
        <div class="stat-number">{{ $totalSuppliers }}</div>
    </div>

    <div class="card stat-card">
        <div class="stat-title">Customers</div>
        <div class="stat-number">{{ $totalCustomers }}</div>
    </div>

    <div class="card stat-card">
        <div class="stat-title">Current Stock</div>
        <div class="stat-number">{{ number_format($currentStock) }}</div>
    </div>

    <!-- <div class="card stat-card">
        <div class="stat-title">Stock In</div>
        <div class="stat-number">{{ number_format($stockIn) }}</div>
    </div> -->

    <div class="card stat-card">
        <div class="stat-title">Stock Out</div>
        <div class="stat-number">{{ number_format($stockOut) }}</div>
    </div>

    <div class="card stat-card">
        <div class="stat-title">Low Stock</div>
        <div class="stat-number">{{ $lowStock }}</div>
    </div>

</div>

<div class="table-card">

    <div class="table-header">
        <h3>Recent Purchases</h3>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Supplier</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($recentPurchases as $purchase)
                    <tr>
                        <td>{{ $purchase->bill_number }}</td>

                        <td>
                            {{ $purchase->supplier->company_name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $purchase->purchase_date
                                ? \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y')
                                : 'N/A' }}
                        </td>

                        <td>
                            ₹{{ number_format((float) $purchase->grand_total, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; padding:20px;">
                            No purchase records available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
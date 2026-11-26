@extends('admindashboard/layout')

@section('title', 'Sales')

@section('content')

<h1 class="page-title">Sales</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-card">

    <div class="table-header">
        <h3>Sales Records</h3>
    </div>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>

                        <td>{{ $sale->invoice_number }}</td>

                        <td>{{ $sale->customer_name }}</td>

                        <td>{{ $sale->customer_email ?? 'N/A' }}</td>

                        <td>{{ $sale->customer_phone ?? 'N/A' }}</td>

                        <td>{{ $sale->product_id }}</td>

                        <td>
                            {{ $sale->product?->product_name ?? 'Product unavailable' }}
                        </td>

                        <td>{{ $sale->quantity }}</td>

                        <td>
                            ₹{{ number_format($sale->unit_price, 2) }}
                        </td>

                        <td>
                            ₹{{ number_format($sale->total_amount, 2) }}
                        </td>

                        <td>
                            {{ $sale->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <span class="badge badge-success">
                                {{ $sale->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" style="text-align: center;">
                            No sales records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $sales->links() }}
    </div>

</div>

@endsection

@extends('admindashboard/layout')

@section('title', 'Purchases')

@section('content')

<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
    }

    .table-card {
        width: 100%;
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        overflow-x: auto;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
        flex-wrap: wrap;
    }

    .table-header h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 700;
        color: #1e293b;
    }

    .btn {
        display: inline-block;
        padding: 9px 17px;
        border: none;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .btn-primary {
        background: #2563eb;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: #1d4ed8;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* SUCCESS MESSAGE CSS */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        margin: 0 0 22px 0;
        background: #ecfdf3;
        color: #166534;
        border: 1px solid #86efac;
        border-left: 5px solid #16a34a;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(22, 163, 74, 0.08);
        animation: successSlide 0.35s ease-out;
    }

    .alert-success::before {
        content: "✓";
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 26px;
        height: 26px;
        background: #16a34a;
        color: #ffffff;
        border-radius: 50%;
        font-size: 16px;
        font-weight: bold;
    }

    /* ERROR MESSAGE CSS */
    .alert-danger {
        padding: 16px 20px;
        margin-bottom: 22px;
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-left: 5px solid #dc2626;
        border-radius: 10px;
        font-size: 14px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    @keyframes successSlide {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* TABLE CSS */
    .table-card table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .table-card table thead {
        background: #f1f5f9;
    }

    .table-card table th {
        padding: 15px 16px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border-bottom: 2px solid #e2e8f0;
        white-space: nowrap;
    }

    .table-card table td {
        padding: 16px;
        font-size: 14px;
        color: #334155;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .table-card table tbody tr:hover {
        background: #f8fafc;
    }

    .table-card table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-card table td:nth-child(2) {
        font-weight: 600;
        color: #2563eb;
    }

    .table-card table td:nth-child(5) {
        font-weight: 700;
        color: #15803d;
        white-space: nowrap;
    }

    /* STATUS BADGE */
    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    /* PAGINATION */
    .table-card nav {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 23px;
        }

        .table-card {
            padding: 16px;
        }

        .table-header h3 {
            font-size: 18px;
        }

        .table-card table th,
        .table-card table td {
            padding: 12px;
        }
    }

    @media (max-width: 480px) {
        .table-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .table-header .btn {
            width: 100%;
        }

        .alert-success,
        .alert-danger {
            padding: 12px 14px;
            font-size: 13px;
        }
    }
</style>

<h1 class="page-title">
    Purchases
</h1>

<div class="table-card">

    <div class="table-header">
        <h3>Purchase Records</h3>

        <a href="{{ route('admin.purchases.create') }}"
           class="btn btn-primary">
            + New Purchase
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Invoice</th>
                <th>Supplier</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($Purchasesview as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>

                    <td>{{ $purchase->bill_number }}</td>

                    <td>
                        {{ $purchase->supplier->company_name ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $purchase->purchase_date
                            ? $purchase->purchase_date->format('d M Y')
                            : 'N/A' }}
                    </td>

                    <td>
                        ₹{{ number_format((float) $purchase->grand_total, 2) }}
                    </td>

                    <td>
                        <span class="badge badge-success">
                            Completed
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        No purchase invoices found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if(method_exists($Purchasesview, 'links'))
        <div style="margin-top: 20px;">
            {{ $Purchasesview->links() }}
        </div>
    @endif

</div>

@endsection

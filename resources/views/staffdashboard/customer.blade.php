
@extends('staffdashboard/layout')

@section('title', 'Customers')

@section('content')

<h1 class="page-title">Customers</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="table-card">

    <div class="table-header">
        <h3>All Customers</h3>
    </div>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Message</th>
                    <th>Enquiry Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->product_id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address ?: 'N/A' }}</td>
                        <td>{{ $customer->message ?: 'N/A' }}</td>
                        <td>{{ $customer->created_at?->format('d-m-Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">
                            No customer enquiries found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $customers->links() }}
    </div>

</div>

@endsection

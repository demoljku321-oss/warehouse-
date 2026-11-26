@extends('staffdashboard/layout')

@section('title', 'Purchases')

@section('content')

<h1 class="page-title">
    Purchases
</h1>

<div class="table-card">

    <div class="table-header">

        <h3>Purchase Records</h3>

        <!-- <a href="#" class="btn btn-primary">
            + New Purchase
        </a> -->

    </div>

    <table>

        <thead>
            <tr>
                <th>Id</th>
                <th>Invoice</th>
                <th>Supplier</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>INV-001</td>
                <td>ABC Suppliers</td>
                <td>25 Aug 2026</td>
                <td>₹55,000</td>
                <td>
                    <span class="badge badge-success">
                        Completed
                    </span>
                </td>
                <td>
                    <a href="#" class="btn btn-primary">View</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>INV-002</td>
                <td>Tech World</td>
                <td>24 Aug 2026</td>
                <td>₹32,500</td>
                <td>
                    <span class="badge badge-success">
                        Completed
                    </span>
                </td>
                <td>
                    <a href="#" class="btn btn-primary">View</a>
                </td>
            </tr>

        </tbody>

    </table>

</div>

@endsection
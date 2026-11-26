@extends('admindashboard/layout')

@section('title', 'Stock')

@section('content')

<h1 class="page-title">
    Stock / Inventory
</h1>

<div class="table-card">

    <div class="table-header">

        <h3>Current Stock</h3>

    </div>

    <table>

        <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Quantity</th>
                <th>Minimum Stock</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($Stockview as $stock)

            <tr>
                <td>{{ $stock->id }}</td>

                <td>{{ $stock->product_name }}</td>

                <td>{{ $stock->product_code }}</td>

                <td>{{ $stock->quantity }}</td>

                <td>{{ $stock->minimum_stock }}</td>

                <td>
                    @if($stock->quantity <= 0)

                        <span class="badge badge-danger">
                            Out of Stock
                        </span>

                    @elseif($stock->quantity <= $stock->minimum_stock)

                        <span class="badge badge-warning">
                            Few Left
                        </span>

                    @else

                        <span class="badge badge-success">
                            In Stock
                        </span>

                    @endif
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection

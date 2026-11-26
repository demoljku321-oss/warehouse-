@extends('staffdashboard/layout')

@section('title', 'Categories')

@section('content')

<h1 class="page-title">
    Categories
</h1>


<div class="table-card">

    <div class="table-header">

        <h3>
            All Categories
        </h3>

    </div>


    <table>

        <thead>

            <tr>

                <th>Id</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Status</th>

            </tr>

        </thead>


        <tbody>

            <tr>

                <td>1</td>

                <td>
                    Electronics
                </td>

                <td>
                    Electronic Products
                </td>

                <td>

                    <span class="badge badge-success">
                        Active
                    </span>

                </td>

            </tr>


            <tr>

                <td>2</td>

                <td>
                    Furniture
                </td>

                <td>
                    Office Furniture
                </td>

                <td>

                    <span class="badge badge-success">
                        Active
                    </span>

                </td>

            </tr>

        </tbody>

    </table>

</div>

@endsection
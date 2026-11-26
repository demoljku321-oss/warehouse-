
@extends('staffdashboard/layout')

@section('title', 'Suppliers')

@section('content')

<h1 class="page-title">Suppliers</h1>

<div class="table-card">

    <div class="table-header"
         style="display: flex; justify-content: space-between;
                align-items: center; gap: 15px; flex-wrap: wrap;">

        <h3>All Suppliers</h3>

        <span>
            
        </span>

    </div>

    {{-- Search Form --}}
    <form action="{{ route('staffdashboard.supplier') }}"
          method="GET"
          style="display: flex; gap: 10px; margin: 20px 0;
                 flex-wrap: wrap;">

        <input
            type="text"
            name="search"
            value="{{ $search }}"
            placeholder="Search code, company, phone, email, city..."
            style="flex: 1; min-width: 220px; padding: 10px;
                   border: 1px solid #ccc; border-radius: 5px;"
        >

        <button
            type="submit"
            style="padding: 10px 20px; border: none;
                   border-radius: 5px; cursor: pointer;
                   background: #2563eb; color: white;">
            Search
        </button>

        <a
            href="{{ route('staffdashboard.supplier') }}"
            style="padding: 10px 20px; border-radius: 5px;
                   background: #e5e7eb; color: #111827;
                   text-decoration: none;">
            Reset
        </a>

    </form>

    {{-- Supplier Details Table --}}
    <div style="width: 100%; overflow-x: auto;">

        <table style="width: 100%; min-width: 1200px;
                      border-collapse: collapse;">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier Code</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>GST Number</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($suppliers as $supplier)

                    <tr>
                        <td>{{ $supplier->id }}</td>

                        <td>{{ $supplier->supplier_code }}</td>

                        <td>{{ $supplier->company_name }}</td>

                        <td>
                            {{ $supplier->contact_person ?: 'N/A' }}
                        </td>

                        <td>{{ $supplier->phone }}</td>

                        <td>{{ $supplier->email ?: 'N/A' }}</td>

                        <td>{{ $supplier->gst_number ?: 'N/A' }}</td>

                        <td>{{ $supplier->city ?: 'N/A' }}</td>

                        <td>{{ $supplier->state ?: 'N/A' }}</td>

                        <td>{{ $supplier->pincode ?: 'N/A' }}</td>

                        <td>{{ $supplier->address ?: 'N/A' }}</td>

                        <td>
                            @if (strtolower($supplier->status) === 'active')
                                <span style="color: green; font-weight: bold;">
                                    Active
                                </span>
                            @else
                                <span style="color: red; font-weight: bold;">
                                    {{ ucfirst($supplier->status) }}
                                </span>
                            @endif
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="12"
                            style="text-align: center; padding: 20px;">
                            @if ($search)
                                No suppliers found for "{{ $search }}".
                            @else
                                No suppliers available.
                            @endif
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
 
    </div>

</div>

@endsection

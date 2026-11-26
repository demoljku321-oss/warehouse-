@extends('staffdashboard/layout')

@section('title', 'Sales')

@section('content')

<h1 class="page-title">Sales</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Sell Product --}}
<div class="table-card" style="padding: 20px; margin-bottom: 25px;">

    <div class="table-header">
        <h3>Sell Product</h3>
    </div>

    <form action="{{ route('staffdashboard.sales.store') }}" method="POST">
        @csrf

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">

            {{-- Customer --}}
            <div>
                <label for="customer_id">Customer</label>

                <select name="customer_id"
                        id="customer_id"
                        required
                        style="width: 100%; padding: 10px;">

                    <option value="">Select Customer</option>

                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} - {{ $customer->phone }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Enquiry Product --}}
            <div>
                <label for="product_id">Enquiry Product</label>

                <select name="product_id"
                        id="product_id"
                        required
                        disabled
                        style="width: 100%; padding: 10px;">

                    <option value="">First Select Customer</option>
                </select>

                <div id="product_details"
                     style="margin-top: 10px; font-size: 14px; line-height: 1.8;">
                </div>
            </div>

            {{-- Quantity --}}
            <div>
                <label for="quantity">Quantity</label>

                <input type="number"
                       name="quantity"
                       id="quantity"
                       min="1"
                       value="{{ old('quantity', 1) }}"
                       required
                       style="width: 100%; padding: 10px;">

                <small id="stock_message"
                       style="display: block; margin-top: 5px; color: #64748b;">
                </small>
            </div>

        </div>

        {{-- Total Bill --}}
        <div id="total_bill"
             style="margin-top: 20px; padding: 15px; background: #f0fdf4;
                    border: 1px solid #bbf7d0; border-radius: 8px;
                    font-size: 22px; font-weight: bold; color: #166534;">
            Total Bill: ₹0.00
        </div>

        <button type="submit"
                class="btn btn-primary"
                style="margin-top: 20px;">
            Complete Sale
        </button>

    </form>
</div>

{{-- Sales Records --}}
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
                    <th>Customer</th>
                    <th>Product ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->invoice_number }}</td>

                        <td>
                            {{ $sale->customer_name }}<br>
                            <small>{{ $sale->customer_phone }}</small>
                        </td>

                        <td>{{ $sale->product_id }}</td>

                        <td>
                            {{ $sale->product?->product_name ?? 'Product unavailable' }}
                        </td>

                        <td>{{ $sale->quantity }}</td>

                        <td>₹{{ number_format($sale->unit_price, 2) }}</td>

                        <td>₹{{ number_format($sale->total_amount, 2) }}</td>

                        <td>{{ $sale->created_at->format('d M Y') }}</td>

                        <td>
                            <span class="badge badge-success">
                                {{ $sale->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="text-align: center;">
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const customerSelect = document.getElementById('customer_id');
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const productDetails = document.getElementById('product_details');
    const stockMessage = document.getElementById('stock_message');
    const totalBill = document.getElementById('total_bill');

    let requestNumber = 0;

    function formatRupees(amount) {
        return Number(amount).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function calculateTotalBill() {

        const selectedOption =
            productSelect.options[productSelect.selectedIndex];

        if (!selectedOption || !selectedOption.value) {
            totalBill.textContent = 'Total Bill: ₹0.00';
            return;
        }

        const price = Number(selectedOption.dataset.price);
        const stock = Number(selectedOption.dataset.stock);
        const quantity = Number(quantityInput.value);

        if (
            !Number.isFinite(price) ||
            !Number.isFinite(quantity) ||
            quantity < 1 ||
            quantity > stock
        ) {
            totalBill.textContent = 'Total Bill: ₹0.00';
            return;
        }

        const total = price * quantity;

        totalBill.textContent =
            'Total Bill: ₹' + formatRupees(total);
    }

    async function loadCustomerProducts(
        customerId,
        selectedProductId = ''
    ) {

        const currentRequest = ++requestNumber;

        productSelect.innerHTML =
            '<option value="">Loading enquiry products...</option>';

        productSelect.disabled = true;
        productDetails.textContent = '';
        stockMessage.textContent = '';
        totalBill.textContent = 'Total Bill: ₹0.00';
        quantityInput.removeAttribute('max');

        if (!customerId) {
            productSelect.innerHTML =
                '<option value="">First Select Customer</option>';
            return;
        }

        try {

            const response = await fetch(
                `/staffsales/customer/${encodeURIComponent(customerId)}/products`,
                {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                throw new Error('Unable to load products.');
            }

            const products = await response.json();

            if (currentRequest !== requestNumber) {
                return;
            }

            productSelect.innerHTML =
                '<option value="">Select Enquiry Product</option>';

            if (!Array.isArray(products) || products.length === 0) {

                productSelect.innerHTML =
                    '<option value="">No available enquiry products</option>';

                return;
            }

            products.forEach(function (product) {

                const option = document.createElement('option');

                option.value = product.id;

                option.textContent =
                    'ID: ' + product.id +
                    ' - ' + product.product_name +
                    ' | ₹' + formatRupees(product.selling_price) +
                    ' | Stock: ' + product.quantity;

                option.dataset.price = product.selling_price;
                option.dataset.stock = product.quantity;

                if (
                    String(product.id) === String(selectedProductId)
                ) {
                    option.selected = true;
                }

                productSelect.appendChild(option);
            });

            productSelect.disabled = false;

            if (selectedProductId) {
                productSelect.dispatchEvent(
                    new Event('change')
                );
            }

        } catch (error) {

            if (currentRequest !== requestNumber) {
                return;
            }

            productSelect.innerHTML =
                '<option value="">Could not load products</option>';

            productDetails.textContent =
                'Products load nathi thaya. Route ane controller check karo.';

            totalBill.textContent = 'Total Bill: ₹0.00';

            console.error(error);
        }
    }

    customerSelect.addEventListener('change', function () {

        loadCustomerProducts(this.value);

    });

    productSelect.addEventListener('change', function () {

        const selectedOption =
            this.options[this.selectedIndex];

        productDetails.textContent = '';
        stockMessage.textContent = '';
        quantityInput.removeAttribute('max');

        if (!selectedOption || !selectedOption.value) {
            calculateTotalBill();
            return;
        }

        const price = Number(selectedOption.dataset.price);
        const stock = Number(selectedOption.dataset.stock);

        const priceLine = document.createElement('div');
        priceLine.textContent =
            'Selling Price: ₹' + formatRupees(price);

        const stockLine = document.createElement('div');
        stockLine.textContent =
            'Available Stock: ' + stock;

        productDetails.appendChild(priceLine);
        productDetails.appendChild(stockLine);

        quantityInput.max = stock;

        if (Number(quantityInput.value) > stock) {
            quantityInput.value = stock;
        }

        if (!quantityInput.value || Number(quantityInput.value) < 1) {
            quantityInput.value = 1;
        }

        stockMessage.textContent =
            'Maximum available quantity: ' + stock;

        calculateTotalBill();

    });

    quantityInput.addEventListener('input', function () {

        const selectedOption =
            productSelect.options[productSelect.selectedIndex];

        if (!selectedOption || !selectedOption.value) {
            calculateTotalBill();
            return;
        }

        const stock = Number(selectedOption.dataset.stock);
        const quantity = Number(this.value);

        if (quantity > stock) {
            stockMessage.textContent =
                'Only ' + stock + ' units are available.';
        } else {
            stockMessage.textContent =
                'Maximum available quantity: ' + stock;
        }

        calculateTotalBill();

    });

    // Restore selection after validation errors.
    const oldCustomerId = @json(old('customer_id'));
    const oldProductId = @json(old('product_id'));

    if (oldCustomerId) {
        loadCustomerProducts(oldCustomerId, oldProductId);
    }

});
</script>

@endsection

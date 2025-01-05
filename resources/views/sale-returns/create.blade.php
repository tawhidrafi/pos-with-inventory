@extends('layouts.mainLayout')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Sale Return</h1>

    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="text-red-600">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sale-returns.store') }}" method="POST">
        @csrf

        <!-- Customer Information -->
        <div class="mb-4">
            <label for="customer" class="block text-gray-700">Customer</label>
            <p class="form-input border border-gray-300 p-2 w-full bg-gray-100" readonly>
                {{ $sale->customer->name }}
            </p>
        </div>

        <!-- Products Section -->
        <h2 class="text-xl font-bold mb-2">Products</h2>
        <div id="product-container">
            @foreach ($sale->saleItems as $saleItem)
            <div class="product-row grid grid-cols-6 gap-4 mb-4" data-row-id="{{ $loop->iteration }}">
                <!-- Product -->
                <div class="col-span-2">
                    <label for="product_{{ $loop->iteration }}" class="block text-gray-700">Product</label>
                    <input type="text"
                        name="products[{{ $loop->iteration }}][name]"
                        value="{{ $saleItem->product ? $saleItem->product->name : ($saleItem->variant->variant_name ?? '') }}"
                        class="form-input border border-gray-300 p-2 w-full bg-gray-100"
                        readonly>
                    <input type="hidden"
                        name="products[{{ $loop->iteration }}][product_id]"
                        value="{{ $saleItem->product_id }}">
                    <input type="hidden"
                        name="products[{{ $loop->iteration }}][variant_id]"
                        value="{{ $saleItem->variant_id }}">
                </div>

                <!-- Product Code -->
                <div class="col-span-1">
                    <label for="product_code_{{ $loop->iteration }}" class="block text-gray-700">Code</label>
                    <input type="text"
                        name="products[{{ $loop->iteration }}][product_code]"
                        value="{{ $saleItem->product_code }}"
                        class="form-input border border-gray-300 p-2 w-full bg-gray-100"
                        readonly>
                </div>

                <!-- Unit Cost -->
                <div class="col-span-1">
                    <label for="unit_cost_{{ $loop->iteration }}" class="block text-gray-700">Unit Cost</label>
                    <input type="number"
                        name="products[{{ $loop->iteration }}][unit_price]"
                        value="{{ $saleItem->unit_price }}"
                        class="form-input border border-gray-300 p-2 w-full bg-gray-100"
                        readonly>
                </div>

                <!-- Quantity -->
                <div class="col-span-1">
                    <label for="product_qty_{{ $loop->iteration }}" class="block text-gray-700">Quantity</label>
                    <input type="number"
                        name="products[{{ $loop->iteration }}][product_qty]"
                        value="{{ $saleItem->product_qty }}"
                        class="form-input border border-gray-300 p-2 w-full product-qty"
                        min="0"
                        max="{{ $saleItem->product_qty }}">
                </div>

                <!-- Subtotal -->
                <div class="col-span-1">
                    <label for="subtotal_{{ $loop->iteration }}" class="block text-gray-700">Subtotal</label>
                    <input type="number"
                        name="products[{{ $loop->iteration }}][subtotal]"
                        value="{{ $saleItem->subtotal }}"
                        class="form-input border border-gray-300 p-2 w-full product-subtotal"
                        readonly>
                </div>

                <!-- Remove Button -->
                <div class="col-span-1">
                    <button type="button"
                        class="bg-red-500 text-white px-4 py-2 mt-4 remove-product"
                        data-row-id="{{ $loop->iteration }}">Remove</button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Final Total -->
        <div class="grid grid-cols-2 gap-4">
            <div class="mt-4">
                <label for="final_total" class="block text-gray-700">Final Total</label>
                <input type="number"
                    id="final-total"
                    class="form-input border border-gray-300 p-2 w-full bg-gray-100"
                    name="total"
                    value="{{ $sale->total }}"
                    readonly>
            </div>
            <!-- Status Selections -->
            <div class="mt-4">
                <label for="delivery_status" class="block text-gray-700">Delivery Status</label>
                <select name="status" class="form-select border border-gray-300 p-2 w-full" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="sale_id" value="{{ $sale->id }}">
        <input type="hidden" name="created_by" value="{{ auth()->id() }}">

        <!-- Submit Button -->
        <button type="submit" class="bg-green-500 text-white px-8 py-2 mt-4">Submit Return</button>
    </form>
</div>

<script>
    // Dynamic quantity and subtotal updates
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('product-qty')) {
            const row = e.target.closest('.product-row');
            const unitPrice = parseFloat(row.querySelector('[name$="[unit_price]"]').value) || 0;
            const qty = parseFloat(e.target.value) || 0;
            const subtotal = unitPrice * qty;

            // Update subtotal
            row.querySelector('[name$="[subtotal]"]').value = subtotal.toFixed(2);

            // Update final total
            let finalTotal = 0;
            document.querySelectorAll('[name$="[subtotal]"]').forEach(subInput => {
                finalTotal += parseFloat(subInput.value) || 0;
            });
            document.getElementById('final-total').value = finalTotal.toFixed(2);
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-product')) {
            const rowId = e.target.getAttribute('data-row-id');
            const row = document.querySelector(`.product-row[data-row-id="${rowId}"]`);

            // Remove the row from the DOM
            if (row) {
                row.remove();

                // Recalculate final total after removal
                let finalTotal = 0;
                document.querySelectorAll('.product-subtotal').forEach(subInput => {
                    finalTotal += parseFloat(subInput.value) || 0;
                });
                document.getElementById('final-total').value = finalTotal.toFixed(2);
            }
        }
    });
</script>
@endsection
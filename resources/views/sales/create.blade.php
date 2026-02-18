@extends('layouts.app')

@section('content')

    <h1 class="text-2xl font-bold mb-6">POS Sales</h1>

    <form method="POST" action="{{ route('sales.store') }}">
        @csrf

        <div class="grid grid-cols-3 gap-6">

            <!-- LEFT SIDE PRODUCTS -->
            <div class="col-span-2 bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Products</h2>

                <div class="grid grid-cols-4 gap-3">
                    @foreach($products as $product)
                        <button type="button" onclick='addToCart(
                                    {{ $product->id }},
                                    @json($product->name),
                                    {{ $product->selling_price }},
                                    {{ $product->stock_quantity }}
                                )' class="bg-gray-100 hover:bg-gray-200 p-3 rounded text-center border">
                            <p class="font-bold">{{ $product->name }}</p>
                            <p>{{ $product->selling_price }}</p>
                            <p class="text-sm text-gray-500">Stock: {{ $product->stock_quantity }}</p>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT SIDE CART -->
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-bold mb-4">Cart</h2>

                <table class="w-full text-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart-body"></tbody>
                </table>

                <hr class="my-4">

                <h3 class="text-lg font-bold">
                    Total: <span id="grand-total">0</span>
                </h3>

                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

                <button class="bg-green-600 text-white w-full mt-4 py-2 rounded">
                    Complete Sale
                </button>
            </div>

        </div>

    </form>

    <script>

        let cart = {};

        function addToCart(id, name, price, stock) {

            if (!cart[id]) {
                cart[id] = { name: name, price: price, qty: 1, stock: stock };
            } else {
                if (cart[id].qty + 1 > stock) {
                    alert("Not enough stock!");
                    return;
                }
                cart[id].qty++;
            }

            renderCart();
        }

        function removeItem(id) {
            delete cart[id];
            renderCart();
        }

        function renderCart() {

            let body = document.getElementById('cart-body');
            body.innerHTML = "";

            let total = 0;

            Object.keys(cart).forEach(id => {

                let item = cart[id];
                let itemTotal = item.qty * item.price;
                total += itemTotal;

                body.innerHTML += `
                            <tr>
                                <td>${item.name}</td>
                                <td>
                                    <input type="number" min="1" max="${item.stock}"
                                           value="${item.qty}"
                                           onchange="updateQty(${id}, this.value)"
                                           class="w-16 border rounded text-center">
                                </td>
                                <td>${itemTotal}</td>
                                <td>
                                    <button type="button"
                                            onclick="removeItem(${id})"
                                            class="text-red-500">X</button>
                                </td>
                            </tr>

                            <input type="hidden" name="products[${id}]" value="${item.qty}">
                            `;
            });

            document.getElementById('grand-total').innerText = total;
        }

        function updateQty(id, qty) {

            qty = parseInt(qty);

            if (qty > cart[id].stock) {
                alert("Stock exceeded!");
                return;
            }

            cart[id].qty = qty;
            renderCart();
        }

    </script>

@endsection
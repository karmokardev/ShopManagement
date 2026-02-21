<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mini Shop Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-[#d8e1e8]">

    <div class="flex">

        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-900 text-gray-200 flex flex-col p-6 shadow-xl">

            <!-- Logo / Title -->
            <h2 class="text-2xl font-bold mb-8 text-white tracking-wide">
                <i class="fa-solid fa-store mr-2 text-teal-400"></i>
                Mini Shop
            </h2>

            <!-- Navigation -->
            <ul class="gap-2 flex-1">

                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg transition duration-200
                        {{ request()->routeIs('dashboard') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-gauge"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('products.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg  transition duration-200
                        {{ request()->routeIs('products.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-box"></i>
                        Products
                    </a>
                </li>

                <li>
                    <a href="{{ route('sales.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg  transition duration-200
                        {{ request()->routeIs('sales.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Sales
                    </a>
                </li>

                <li>
                    <a href="{{ route('purchases.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg  transition duration-200
                        {{ request()->routeIs('purchases.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-truck"></i>
                        Purchases
                    </a>
                </li>

                <li>
                    <a href="{{ route('customers.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg transition duration-200
                        {{ request()->routeIs('customers.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-users"></i>
                        Customers
                    </a>
                </li>

                <li>
                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg transition duration-200
                        {{ request()->routeIs('suppliers.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-user-tie"></i>
                        Suppliers
                    </a>
                </li>

                <li>
                    <a href="{{ route('expenses.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg transition duration-200
                        {{ request()->routeIs('expenses.index') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        Expenses
                    </a>
                </li>

                <li>
                    <a href="{{ route('financial.report') }}"
                        class="flex items-center gap-3 p-3 rounded-lg transition duration-200
                        {{ request()->routeIs('financial.report') ? 'bg-teal-500 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <i class="fa-solid fa-chart-line"></i>
                        Financial Report
                    </a>
                </li>

            </ul>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 
                       transition duration-200 px-4 py-3 rounded-lg w-full text-white font-semibold">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>

        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>

    </div>

</body>

</html>
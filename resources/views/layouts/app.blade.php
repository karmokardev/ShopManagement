<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini Shop Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <div class="w-64 h-screen bg-gray-900 text-white p-5">
        <h2 class="text-2xl font-bold mb-6">Mini Shop</h2>

        <ul class="space-y-3">
            <li><a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-700 rounded">Dashboard</a></li>
            <li><a href="{{ route('products.index') }}" class="block p-2 hover:bg-gray-700 rounded">Products</a></li>
            <li><a href="#" class="block p-2 hover:bg-gray-700 rounded">Sales</a></li>
            <li><a href="#" class="block p-2 hover:bg-gray-700 rounded">Purchases</a></li>
            <li><a href="#" class="block p-2 hover:bg-gray-700 rounded">Customers</a></li>
            <li><a href="#" class="block p-2 hover:bg-gray-700 rounded">Expenses</a></li>
        </ul>

        <form method="POST" action="{{ route('logout') }}" class="mt-10">
            @csrf
            <button class="bg-red-500 px-4 py-2 rounded w-full">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>

</div>

</body>
</html>

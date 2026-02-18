@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-gray-500">Total Products</h2>
        <p class="text-2xl font-bold mt-2">0</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-gray-500">Total Sales</h2>
        <p class="text-2xl font-bold mt-2">0 ৳</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-gray-500">Total Purchases</h2>
        <p class="text-2xl font-bold mt-2">0 ৳</p>
    </div>

    <div class="bg-white p-5 rounded shadow">
        <h2 class="text-gray-500">Total Profit</h2>
        <p class="text-2xl font-bold mt-2">0 ৳</p>
    </div>

</div>

@endsection

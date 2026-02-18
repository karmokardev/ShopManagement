@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Add supplier</h1>

<form method="POST" action="{{ route('suppliers.store') }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Phone</label>
        <input type="text" name="phone" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Address</label>
        <textarea name="address" class="w-full border p-2 rounded"></textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Save supplier
    </button>

</form>

@endsection

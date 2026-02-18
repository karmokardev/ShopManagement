@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit Customer</h1>

<form method="POST" action="{{ route('customers.update', $customer) }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" value="{{ $customer->name }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $customer->phone }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Address</label>
        <textarea name="address" class="w-full border p-2 rounded">{{ $customer->address }}</textarea>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update Customer
    </button>

</form>

@endsection

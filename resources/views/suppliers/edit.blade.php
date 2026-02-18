@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Edit supplier</h1>

<form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="bg-white p-6 rounded shadow w-1/2">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" value="{{ $supplier->name }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ $supplier->phone }}" class="w-full border p-2 rounded">
    </div>

    <div class="mb-4">
        <label>Address</label>
        <textarea name="address" class="w-full border p-2 rounded">{{ $supplier->address }}</textarea>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update supplier
    </button>

</form>

@endsection

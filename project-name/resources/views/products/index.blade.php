{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'All Products')

@section('content')
        <h1>All Products</h1>

        {{-- Prikaz proizvoda --}}
        @forelse ($products as $product)
            <p>{{ $product->name }}</p>
            {{-- Dodajte ostale informacije o proizvodu koje želite prikazati --}}
        @empty
            <p>No products available.</p>
        @endforelse

        {{-- Paginacija --}}
        {{ $products->links() }}
@endsection

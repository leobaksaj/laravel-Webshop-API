{{-- resources/views/products/indexByCategory.blade.php --}}
@extends('layouts.app')

@section('title', 'Products in Category: ' . $category->name)

@section('content')
    <div class="container">
        <h1>Products in Category: {{ $category->name }}</h1>

        {{-- Prikaz proizvoda --}}
        @forelse ($products as $product)
            <p>{{ $product->name }}</p>
            {{-- Dodajte ostale informacije o proizvodu koje želite prikazati --}}
        @empty
            <p>No products available in this category.</p>
        @endforelse

        {{-- Paginacija --}}
        {{ $products->links() }}
    </div>
@endsection

{{-- resources/views/products/indexByCategory.blade.php --}}
@extends('layouts.app')

@section('title', 'Proizvodi u kategoriji: ' . $category->name)

@section('content')
    <div class="container">
        <h1>Proizvodi u kategoriji: {{ $category->name }}</h1>

        @forelse ($products as $product)
            <p>{{ $product->name }}</p>
        @empty
            <p>No products available in this category.</p>
        @endforelse

        {{ $products->links() }}
    </div>
@endsection

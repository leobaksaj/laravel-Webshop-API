{{-- resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Svi proizvodi')

@section('content')
        <h1>Svi proizvodi</h1>

        @forelse ($products as $product)
            <p>{{ $product->name }}</p>
        @empty
            <p>Nema proizvoda.</p>
        @endforelse

        {{ $products->links() }}
@endsection

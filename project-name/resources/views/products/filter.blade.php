{{-- resources/views/products/filter.blade.php --}}
@extends('layouts.app')

@section('title', 'Filter proizvoda')

@section('content')
    <div class="container">
        <h1>Filter proizvoda</h1>
        <form action="{{ route('products.filter') }}" method="GET">
            <label for="min_price">Min cijena:</label>
            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="Min Price">

            <label for="max_price">Max cijena:</label>
            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="Max Price">

            <label for="name">Ime:</label>
            <input type="text" name="name" id="name" value="{{ request('name') }}" placeholder="Product Name">

            <label for="category_name">Kategorija:</label>
            <input type="text" name="category_name" id="category_name" value="{{ request('category_name') }}" placeholder="Category Name">

            <label for="price_sort">Sortiraj po cijeni:</label>
            <select name="price_sort" id="price_sort">
                <option value="">Bez sortiranja</option>
                <option value="asc" {{ request('price_sort') == 'asc' ? 'selected' : '' }}>Uzlazno</option>
                <option value="desc" {{ request('price_sort') == 'desc' ? 'selected' : '' }}>Silazno</option>
            </select>

            <label for="name_sort">Sortiraj po nazivu:</label>
            <select name="name_sort" id="name_sort">
            <option value="">Bez sortiranja</option>
                <option value="asc" {{ request('name_sort') == 'asc' ? 'selected' : '' }}>Uzlazno</option>
                <option value="desc" {{ request('name_sort') == 'desc' ? 'selected' : '' }}>Silazno</option>
            </select>

            <input type="submit" value="Filter and Sort">
        </form>

        <div style="display: flex; justify-content: center; align-items: center; flex-direction: column; text-align: center;">

            @forelse ($products as $product)
            <div style="display: flex;">
                <p>{{ $product->name }}</p>
                <p style="margin-left: 10px;">Cijena: {{ $product->price }}</p>
            </div>
            
            @empty
            <h1>Nema rezultata za vaš filter</h1>
            @endforelse
            
        </div>

        {{ $products->links() }}
    </div>
@endsection

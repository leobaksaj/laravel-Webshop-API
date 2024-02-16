{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <p>Description: {{ $product->description }}</p>
        <p>Price: {{ $product->price }}</p>
        {{-- Dodajte ostale informacije o proizvodu koje želite prikazati --}}

    </div>
@endsection

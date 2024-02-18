{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>

        <p>Opis: {{ $product->description }}</p>
        <p>Cijena: {{ $product->price }}</p>
       
    </div>
@endsection

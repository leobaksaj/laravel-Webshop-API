@extends('layouts.app')

<div class="container">
    <h1>Narudžba #{{ $order->id }}</h1>

    @if ($order->discount > 0)
    <p>Originalna cijena: €{{ $order->total_price + $order->discount }}</p>
    <p>Popust: €{{ $order->discount }}</p>
    <p>Konačna cijena: €{{ $order->total_price }}</p>
@else
    <p>Ukupna cijena: €{{ $order->total_price }}</p>
@endif

    <h2>Stavke narudžbe:</h2>
    <ul>
        @foreach ($orderItems as $item)
            <li>{{ $item->product->name }} - Količina: {{ $item->quantity }} - Cijena: {{ $item->price }}€</li>
        @endforeach
    </ul>
</div>


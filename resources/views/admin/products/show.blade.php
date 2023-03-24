@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">{{ $shop->shop_name }}</div>
        <div class="card-body">
            <p><strong>Shop Name: </strong>{{ $shop->shop_name }}</p>
            <p><strong>Shop Address: </strong>{{ $shop->address }}</p>
            <p><strong>Shop Email: </strong>{{ $shop->email }}</p>
            <p><strong>Shop Image: </strong></p>
            <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->shop_name }}" style="max-width: 300px">
            <p><strong>Products: </strong></p>
            @if(count($shop->products) > 0)
                <ul>
                    @foreach($shop->products as $product)
                        <li><a href="{{ route('products.show', $product->id) }}">{{ $product->product_name }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No products found for this shop.</p>
            @endif
        </div>
    </div>
@endsection

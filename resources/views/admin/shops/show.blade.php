@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $shop->shop_name }}</div>
        <div class="card-body">
            <p><strong>Shop Name: </strong>{{ $shop->shop_name }}</p>
            <p><strong>Shop Address: </strong>{{ $shop->address }}</p>
            <p><strong>Shop Email: </strong>{{ $shop->email }}</p>
            <p><strong>Shop Image: </strong></p>
            <img src="{{ asset('storage/images/' . $shop->image) }}" alt="{{ $shop->image }}" style="max-width: 300px">
            <p><strong>Products: </strong></p>
            @if (count($shop->products) > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Stock</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shop->products as $product)
                            <tr>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No products found for this shop.</p>
            @endif

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
                        <a href="{{ route('shops.index') }}" class="btn btn-primary mb-3">List Shops</a>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Shop</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->shop->shop_name }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                class="btn btn-primary btn-sm mr-2">Edit</a>
                                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST"
                                                class="d-inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Product') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('products.update', $product->id) }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-group row">
                                <label for="product_name" class="col-md-4 col-form-label text-md-right">Product Name</label>

                                <div class="col-md-6">
                                    <input id="product_name" type="text" class="form-control" name="product_name"
                                        value="{{ $product->product_name }}" required autofocus>

                                    @if ($errors->has('product_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('product_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price"
                                        value="{{ $product->price }}" required>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock" class="col-md-4 col-form-label text-md-right">Stock</label>

                                <div class="col-md-6">
                                    <input id="stock" type="number" class="form-control" name="stock"
                                        value="{{ $product->stock }}" required>

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shop_id" class="col-md-4 control-label">Shop</label>
                                <div class="col-md-6">
                                    <select id="shop_id" class="form-control" name="shop_id">
                                        @foreach ($shops as $shop)
                                            <option value="{{ $shop->id }}"
                                                {{ $shop->id == $product->shop_id ? 'selected' : '' }}>
                                                {{ $shop->shop_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('shop_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('shop_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="video" class="col-md-4 control-label">Video</label>
                                <div class="col-md-6">
                                    <input id="video" type="file" class="form-control" name="video">
                                    @if ($errors->has('video'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('video') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Product
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

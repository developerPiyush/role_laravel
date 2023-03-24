@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Shop List</div>

                    <div class="panel-body">
                        <a href="{{ route('shops.create') }}" class="btn btn-primary">Create Shop</a>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create Products</a>
                        <br><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Shop Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $shop)
                                    <tr>
                                        <td>{{ $shop->shop_name }}</td>
                                        <td>{{ $shop->address }}</td>
                                        <td>{{ $shop->email }}</td>
                                        <td>
                                            <a href="{{ route('shops.show', ['shop' => $shop->id]) }}"
                                                class="btn btn-info">Show</a>
                                            <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('shops.destroy', ['shop' => $shop->id]) }}"
                                                method="POST" style="display: inline-block;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this shop?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $shops->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

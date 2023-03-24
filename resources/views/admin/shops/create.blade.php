@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Shop') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('shops.store') }}"
                            enctype="multipart/form-data" id="createShopForm">
                            {{ csrf_field() }}

                            <div class="form-group row pt-2">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Shop Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row pt-2">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                        value="{{ old('address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row pt-2">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row pt-2">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Shop Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image">

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group pt-2">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Shop
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#createShopForm').validate({
                rules: {
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    image: {
                        required: true,
                        extension: "jpeg|png|jpg|gif"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter the shop name"
                    },
                    address: {
                        required: "Please enter the shop address"
                    },
                    email: {
                        required: "Please enter the email",
                        email: "Please enter a valid email address"
                    },
                    image: {
                        required: "Please upload an image",
                        extension: "Please upload only jpeg, png, jpg, or gif images"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

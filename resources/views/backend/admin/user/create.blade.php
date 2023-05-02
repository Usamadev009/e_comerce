@extends('backend.admin.layouts.common')

@section('title', 'Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-body">
                        <h2>Add New User</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{ route('user.store') }}" class="" method ="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Mobile</label>
                                    <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control address" placeholder="Address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>User Role</label>
                                    <select class="form-control" name="role">
                                        <option disabled selected>Select Role</option>
                                        <option value="Vendor">Vendor</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select class="form-control user_status" name="status">
                                        <option selected value="Unblock">Unblock</option>
                                        <option value="Block">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mt-4">
                                        <label>Image</label>
                                        <input type="file" class="product_image form-control" name="image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img id="image" src="" class="mt-2" width="150px" height="150px"/>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="register" class="btn add-new" value="register"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

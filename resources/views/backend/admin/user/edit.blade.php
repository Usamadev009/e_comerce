@extends('backend.admin.layouts.common')

@section('title', 'Category')

@section('header')
    @parent
@endsection

@section('content')
    <div class="admin-content-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2>Users</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{route('user.update', [$user->id])}}" class="" method ="POST" enctype="multipart/form-data">
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
                                <input id="name" value="{{$user->name}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input id="email" value="{{$user->email}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <input type="phone" value="{{$user->mobile}}" name="mobile" class="form-control mobile" placeholder="Mobile" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input type="text" value="{{$user->address}}" name="address" class="form-control address" placeholder="Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>User Role</label>
                                <select class="form-control" name="role">
                                    <option selected>{{$user->role}}</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="User">User</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select class="form-control user_status" name="status">
                                    <option selected value="0" {{(($user->status=='0')? 'selected' : '')}}>Unblock</option>
                                    <option value="1" {{(($user->status=='1')? 'selected' : '')}}>Block</option>
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
                                    <img id="image" src="{{asset($user->image)}}" class="mt-2" width="150px" height="150px"/>
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

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
                        <h2>Users</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-4">
                                    <label>Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name }}" required autocomplete="name" autofocus disabled>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <img id="image" src="{{asset($user->image)}}" class="mt-2" width="150px" height="150px"/>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" value="{{$user->mobile}}" requried disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control address" placeholder="Address" value="{{$user->mobile}}" requried disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>User Role</label>
                                <select class="form-control" name="role" disabled>
                                    <option disabled selected>{{$user->role}}</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

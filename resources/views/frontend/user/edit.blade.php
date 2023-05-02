@extends('layouts.common')

@section('title', 'User Profile')

@section('header')
    @parent
@endsection
@php
$user = App\Models\User::get();
@endphp
@section('content')
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2>My Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card  mb-3">
                        <div class="card-body">
                            <form action="{{url('my-profile-update')}}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>First Name</b></label>
                                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Last Name</b></label>
                                            <input type="text" name="lname" class="form-control" value="{{Auth::user()->lname}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Email</b></label>
                                            <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Address</b></label>
                                            <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>City</b></label>
                                            <input type="text" name="city" class="form-control" value="{{Auth::user()->city}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>State</b></label>
                                            <input type="text" name="state" class="form-control" value="{{Auth::user()->state}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Pincode / Zipcode</b></label>
                                            <input type="text" name="pincode" class="form-control" value="{{Auth::user()->pincode}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label><b>Phone</b></label>
                                            <input type="text" name="mobile" class="form-control" value="{{Auth::user()->mobile}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label><b>Profile Image</b></label>
                                            <input type="file" class="profile_image form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img id="image" src="{{ asset(Auth::user()->image) }}" class="w-50 h-50 mt-2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div col-md-4>
                                        <div class="form-group">
                                            <button type="submit" class="modify-btn btn ml-3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

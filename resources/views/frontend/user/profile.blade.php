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
                    <div class="card  mb-3">
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>First Name</b></label>
                                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Last Name</b></label>
                                        <input type="text" name="lname" class="form-control" value="{{Auth::user()->lname}}" readonly>
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
                                        <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>City</b></label>
                                        <input type="text" name="city" class="form-control" value="{{Auth::user()->city}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>State</b></label>
                                        <input type="text" name="state" class="form-control" value="{{Auth::user()->state}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Pincode / Zipcode</b></label>
                                        <input type="text" name="pincode" class="form-control" value="{{Auth::user()->pincode}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><b>Phone</b></label>
                                        <input type="text" name="mobile" class="form-control" value="{{Auth::user()->mobile}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group w-70 h-90">
                                        <img src="{{ asset(Auth::user()->image) }}" style="width:100px; height:100px" alt="User Profile" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a class="modify-btn btn ml-3" href="{{url('profile-edit')}}">Modify Details</a>
                                {{-- <a class="modify-btn btn ml-2" href="{{url('change_password')}}">Change Password</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

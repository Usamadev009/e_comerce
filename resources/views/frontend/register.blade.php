@extends('layouts.common')

@section('title', 'Register')

@section('header')
    @parent
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->
                <form action="{{ route('register') }}" class="signup_form" method ="POST" >
                @csrf
                    <h2>register here</h2>
                    <div class="form-group">
                        <label>Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" requried />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control address" placeholder="Address" requried>
                    </div>
                    <input type="submit" name="register" class="btn" value="register"/>
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
@endsection
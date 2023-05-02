@extends('layouts.common')

@section('content')
<div class="">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
        <div class="modal-body">
          <!-- Form -->
          <form method="POST" action="{{ route('user_login') }}">
          @csrf
            <div class="customer_login">
              <h2>login here</h2>
                <div class="form-group">
                  <label>Username</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                  <div class="col-md-6 offset-md-4" style="margin-left: -3px;">
                      <div class="form-check">
                          <input class="form-check-input" style="margin-left:20px;margin-top: 17px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                          <label class="form-check-label" for="remember">
                              {{ __('Remember Me') }}
                          </label>
                      </div>
                  </div>
                </div>
                  <input type="submit" name="login" class="btn" value="login"/>
                    <span>Don't Have an Account <a href="{{url('register')}}">Register</a></span>
            </div>
          </form>
          <!-- /Form -->
        </div>
      </div>
    </div>
  </div>
@endsection

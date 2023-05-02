<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
           <title>Admin</title>
   
        <link href="{{url('https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('admin/css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{url('css/style.css')}}">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                 <!-- <div class="col-md-3"></div>  -->
                <div class="col-md-offset-3 col-md-6">
                    <div class="login-form">
                        <h1 class="logo">Online Shop</h1>
                        <!-- Form -->
                        <form action="{{route('user_login')}}" method ="POST">
                            @csrf 
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
                                <input type="submit" name="login" class="btn" value="login"/>
                        </form>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/admin_actions.js')}}"></script>
    </body>
</html>

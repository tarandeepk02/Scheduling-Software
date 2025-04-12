@extends('admin.includes.loginbase')
@section('content')
<!DOCTYPE html>
<html dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin_assets/images/favicon.png')}}">
<title>{{ env('APP_NAME') }}</title>
<link type="text/css" href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="bg-blue">
<div class="main-wrapper">
  <div class="preloader">
  <div class="loader">
    <div class="m-t-30"><i class="fa fa-cube font-25"></i></div>
    <p>Please wait...</p>
  </div>
</div>
  <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('admin_assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
  <div class="auth-box">
  <div id="loginform">
    <div class="logo"> <span class="db"><img src="{{ asset('admin_assets/images/logo-dark.png')}}" alt="logo" width="150" /></span>
    </div>
    <!-- Form -->
    <div class="row mt-4">
      <div class="col-12">
        <form class="form-horizontal m-t-20" id="loginform" action="{{ url('/admin/login') }}" method="post">
		{{ csrf_field() }}
          <div class="input-group mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> </div>
            <input type="email" class="form-control form-control-lg" placeholder="Email ID" aria-label="Email ID" aria-describedby="basic-addon1" name="email" value="{{ old('email') }}">
            @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span> </div>
            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
            @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
          <div class="form-group row">
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <div class="col-xs-12 p-b-20">
              <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>
@endsection
@section('scripts')
<script src="{{ asset('admin_assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('admin_assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>
@endsection
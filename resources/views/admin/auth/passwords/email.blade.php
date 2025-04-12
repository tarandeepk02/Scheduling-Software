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
<title>M&S Truck Repair Ltd.</title>
<link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<div class="main-wrapper">
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('admin_assets/images/admin_banner.jpg')}}) no-repeat center center;">
    <div class="auth-box on-sidebar">
      <div id="loginform">
        <div class="logo"> <span class="db"><img src="{{ asset('admin_assets/images/logo-dark.png')}}" alt="logo" /></span> </div>
        <!-- Form -->
        <div class="row">
          <div class="col-12"> @if (session('status'))
            <div class="alert alert-success"> {{ session('status') }} </div>
            @endif
            <form class="form-horizontal m-t-20" id="loginform" action="{{ url('/admin/password/email') }}" method="post">
              {{ csrf_field() }}
              <div class="input-group mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span> </div>
                <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" autofocus>
                @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
              <div class="form-group text-center">
                <div class="col-xs-12 p-b-20">
                  <button class="btn btn-block btn-lg btn-info" type="submit">Send Password Reset Link</button>
                </div>
              </div>
              <div class="form-group m-b-0 m-t-10">
                <!--<div class="col-sm-12 text-center"> Don't have an account? <a href="signup" class="text-info m-l-5"><b>Sign Up</b></a> </div>-->
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
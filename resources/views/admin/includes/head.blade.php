<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin_assets/images/favicon.png') }}">
<title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link type="text/css" href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
<link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet">
<link href="{{ asset('admin_assets/libs/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" />
<link href="{{ asset('admin_assets/extra-libs/calendar/calendar.css')}}" rel="stylesheet" />
<link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/buttons.dataTables.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/libs/select2/dist/css/select2.min.css') }}">
<link href="{{ asset('admin_assets/custom.css') }}" type="text/css" rel="stylesheet"/>
<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- This Page CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/libs/daterangepicker/daterangepicker.css') }}">
<link href="{{ asset('admin_assets/libs/datatables.net-bs4/css/buttons.dataTables.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
.table td
{
padding:5px 10px!important;
vertical-align:middle;
white-space: nowrap;
}
.table .btn-group-sm>.btn, .btn-sm {
    padding: 2px 10px;
	font-size:11px;
}
tbody tr
{
    line-height: 2px;
}
</style>
</head>
<body>
<div class="preloader">
  <div class="loader">
    <div class="m-t-30"><i class="fa fa-cube font-25"></i></div>
    <p>Please wait...</p>
  </div>
</div>
<div id="main-wrapper">
<header class="topbar">
  <nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header"> <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"> <i class="ti-menu ti-close"></i> </a> <a class="navbar-brand" href="{{ url('admin/home') }}"> @if(Route::current()->getName()=='admin.task.schedule') <img src="{{ asset('admin_assets/images/logo-small.png')}}" alt="homepage" class="light-logo" /> @else <img src="{{ asset('admin_assets/images/logo-light.png')}}" alt="homepage" class="light-logo" width="150" /> @endif </a> <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="ti-more"></i> </a> </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <ul class="navbar-nav float-left mr-auto">
        <li class="nav-item d-none d-md-block"> <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"> <i class="sl-icon-menu font-20"></i> </a> </li>
      </ul>
      <ul class="navbar-nav float-right">
        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @if(isset(Auth::guard('admin')->user()->picture)) <img src="{{ url('storage/'.Auth::guard('admin')->user()->picture) }}" class="rounded-circle" width="31"> @else <img src="{{ asset('admin_assets/images/user-icon.png') }}" alt="user" class="rounded-circle" width="31"> @endif <span class="">{{ Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name }}</span> <i class="ti-angle-down"></i> </a>
          <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY"> <span class="with-arrow"> <span class="bg-primary"></span> </span>
            <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
              <div class=""> @if(isset(Auth::guard('admin')->user()->picture)) <img src="{{ url('storage/'.Auth::guard('admin')->user()->picture) }}" class="img-circle" width="60"> @else <img src="{{ asset('admin_assets/images/user-icon.png') }}" alt="user" class="img-circle" width="60"> @endif </div>
              <div class="m-l-10">
                <h4 class="m-b-0">{{ Auth::guard('admin')->user()->first_name.' '.Auth::guard('admin')->user()->last_name }}</h4>
                <p class=" m-b-0">{{ Auth::guard('admin')->user()->email }}</p>
              </div>
            </div>
            <a class="dropdown-item" href="{{route('admin.profile')}}"> <i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('admin.password')}}"> <i class="ti-lock m-r-5 m-l-5"></i> Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('/admin/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"> <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout </a>
            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>

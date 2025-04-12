@extends('admin.includes.base')
@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="m-b-0"><i class="fa fa-cube"></i> Welcome back!</h3>
            <span>{{ date('l, d F Y') }}</span> </div>
        </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <h3>Admin Dashboard</h3>
  </div>
</div>
</div>
@endsection 
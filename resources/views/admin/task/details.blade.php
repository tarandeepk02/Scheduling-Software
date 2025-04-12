@extends('admin.includes.base')
@section('content')
<div class="page-wrapper">
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title"></h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Employee</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Employee Detail</h4>
          </div>
          <hr class="m-t-0">
          <form class="form-horizontal r-separator">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Name</label>
                    <div class="col-sm-9">
                      <label for="inputEmail3" class="col-sm-6 text-left control-label col-form-label">{{ $employee->first_name.' '.$employee->last_name }}</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Email</label>
                    <div class="col-sm-9">
                      <label for="inputEmail3" class="col-sm-6 text-left control-label col-form-label">{{ $employee->email }}</label>
                    </div>
                  </div>
                </div>
				<div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Cell</label>
                    <div class="col-sm-9">
                      <label for="inputEmail3" class="col-sm-6 text-left control-label col-form-label">{{ $employee->cell }}</label>
                    </div>
                  </div>
                </div>
				<div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Alternate Cell</label>
                    <div class="col-sm-9">
                      <label for="inputEmail3" class="col-sm-6 text-left control-label col-form-label">{{ $employee->alternate_cell ?? '-' }}</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Address</label>
                    <div class="col-sm-9">
                      <label for="inputEmail3" class="col-sm-6 text-left control-label col-form-label">{{ $employee->address }}</label>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                  <div class="form-group group_form row">
                    <label for="inputEmail3" class="col-sm-3 text-left control-label col-form-label title_pro">Photo</label>
                    <div class="col-sm-9">
                      <img src="{{ ($employee->picture) ? url('storage/'.$employee->picture) : noimg() }}" width="100" height="100"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
	
	
  </div>
</div>
@endsection
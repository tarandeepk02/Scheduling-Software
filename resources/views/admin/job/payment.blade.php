@extends('admin.includes.base')
@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Professionals</h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="dashboard">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Payments</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('common.notify')
  <div class="container-fluid">
  	<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Add Payment</h4>
          </div>
          <hr class="m-t-0">
          <form class="form-horizontal r-separator" action="{{url('admin/professional/payment')}}" method="POST" enctype="multipart/form-data" role="form">
            {{csrf_field()}}
			<input type="hidden" name="professional_id" value="{{ Request::segment(4) }}">
			<div class="card-body bg-light">
            <div class="row">
			  <div class="col-12">
                <div class="form-group">
                  <label for="inputEmail3" class="control-label col-form-label">Trial Period</label>
                  <select class="form-control" name="triall" onchange="trialfunc()" id="trial">
				 	<option value="No">No</option>
					<option value="Yes">Yes</option> 
				  </select>
                </div>
              </div>
              <div class="col-12" style="display:block;" id="amountdiv">
                <div class="form-group">
                  <label for="inputEmail3" class="control-label col-form-label">Amount</label>
                  <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                </div>
              </div>
			  <div class="col-12">
                <div class="form-group">
                  <label for="inputEmail3" class="control-label col-form-label">Expiry Date</label>
                  <input type="text" class="form-control mydatepicker" name="expiry" value="{{ date('Y-m-d',strtotime('+1 month')) }}">
                </div>
              </div>
            </div>
			</div>
            <div class="card-body">
              <div class="form-group m-b-0 text-right">
                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-light">
          <div class="card-body">
            <div class="d-flex m-b-30 no-block">
              <h5 class="card-title m-b-0 align-self-center">View Payments </h5>
              <div class="ml-auto">
                <div class="dl">
                  <div class="col-3 align-self-center">  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table bg-white table-bordered nowrap display file_export ">
                <thead>
                  <tr>
                    <th>Sr No.</th>
					<th>Professional</th>
					<th>Trial</th>
                    <th>Amount</th>
					<th>Expiry Date</th>
                      <th>Date</th>
					  <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($payment as $index => $cat)
                <tr>
                  <td>{{ $index + 1 }}</td>
				  <td><a href="mailto:{{ $cat->professional->email }}">{{ $cat->professional->email }}</a></td>
				  <td>{{ $cat->triall }}</td>
                  <td>{{ $cat->amount }}</td>
				  <td>{{ $cat->expiry }}</td>
                  <td>{{ $cat->created_at }}</td>
				  <td>{{ $cat->status }}</td>
                </tr>
                @endforeach
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
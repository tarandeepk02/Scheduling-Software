@extends('admin.includes.base')
@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Employees</h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Employees</li>
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
      <div class="col-lg-12">
        <div class="card bg-light">
          <div class="card-body">
            <div class="d-flex m-b-30 no-block">
              <h5 class="card-title m-b-0 align-self-center">View Employees</h5>
              <div class="ml-auto">
                <div class="dl">
                  <div class="col-3 align-self-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon-Add"></i> Add Employee</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table bg-white table-bordered nowrap display file_export">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
					<th>Email</th>
                    <th>Phone</th>
                    <th>Joined On</th>
                    <th>Status</th>
                    <th class="noExport">Actions</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($employees as $index => $employee)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $employee->name }}</td>
                  <td><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></td>
                  <td>{{ $employee->phone }}</td>
                  <td>{{ date('d/m/Y',strtotime($employee->created_at)) }}</td>
                  <td>@if($employee->status=='1') <a href="{{ route('admin.employee.uptStatus', ['id'=>$employee->employee_id,'status'=>'0']) }}" class="label label-success">Active</a> @else <a href="{{ route('admin.employee.uptStatus', ['id'=>$employee->employee_id,'status'=>'1']) }}" class="label label-danger">Inactive</a> @endif</td>
                  <td><form action="{{ route('admin.employee.destroy', $employee->employee_id) }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
					  <button type="button" class="btn btn-info btn-sm editRecord" data-id="{{ $employee->employee_id }}"><i class="fa fa-edit"></i> Edit</button>
                      <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete</button>
                    </form></td>
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

<div class="modal" tabindex="-1" role="dialog" id="myModal" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
        <form class="form-horizontal r-separator" action="{{route('admin.employee.store')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
          {{csrf_field()}}
		  <input type="hidden" name="employee_id" value="" />
          <div class="row">
            <div class="col-12">
              <div class="form-group has-feedback">
                <label>Name<span class="asterrisk">*</span></label>
                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" autocomplete="off">
                <span class="help-block" id="nameError"></span> </div>
            </div>
            <div class="col-12">
              <div class="form-group has-feedback">
                <label>Email<span class="asterrisk">*</span></label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off">
                <span class="help-block" id="emailError"></span> </div>
            </div>
            <div class="col-12">
              <div class="form-group has-feedback">
                <label>Phone<span class="asterrisk">*</span></label>
                <input type="number" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone') }}" maxlength="14" autocomplete="off">
                <span class="help-block" id="phoneError"></span> </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="ajaxSubmit">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

         $(document).ready(function(){
		 
            $('#ajaxSubmit').click(function(e){
			
			var btn = $(this);
			var old_html = btn.html();
			btn.html('Please wait...');
            btn.attr('disabled', true);
			
			//alert('click');
			$('#form span.help-block').text(' ');
			
			var myObject = new Object();
			var other_data = $('#form').serializeArray();
			$.each(other_data,function(key,input){
				myObject[input.name] = input.value;
			});
			
			
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
			  var employee_id = $('input[name="employee_id"]').val();

			  if(employee_id!='')
			  {
			  var url = "{{ url('/')}}/admin/employee/"+employee_id;
			  var method = 'PATCH';
			  }
			  else
			  {
			  var url = "{{route('admin.employee.store')}}";
			  var method = 'post';
			  }
			  //alert(url+" "+method);
               jQuery.ajax({
                  url: url,
                  method: method,   				  
				  data: myObject,
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						toastr.success(result.message);
						
						window.setTimeout(function() {
							$('#open').hide();
                  			$('#myModal').modal('hide');
							window.location.href = "{{ url('admin/employee') }}";
						}, 2000);
						
                  		
                  	}
					btn.html(old_html);
                    btn.attr('disabled', false);
                  },
				  error: function(err){
				  alert(JSON.stringify(err));
				  }  
				  });
               });
			   
			   
			   /*Load Model Popup*/
			   
			   $('body').on('click', '.addRecord', function (event) {
					$('#form').trigger('reset');
					$('.modal-title').text("Add Employee");
					$('#ajaxSubmit').text("Add");
					$('#myModal').modal('show');
				});
			   
			   
			   
			   $('body').on('click', '.editRecord', function (event) {

					event.preventDefault();
					var id = $(this).data('id');
					$.get('employee/'+id+'/edit', function (data) {
						var success = data.success;
						if(success==1)
						{
						$('input[name="employee_id"]').val(data.employee.employee_id);
						$('input[name="name"]').val(data.employee.name);
						$('input[name="email"]').val(data.employee.email);
						$('input[name="phone"]').val(data.employee.phone);
						$('.modal-title').text("Edit Employee");
						$('#ajaxSubmit').text("Update");
						$('#myModal').modal('show');
						}
					 });
				});
			   
			   /*Load Model Popup*/
			   
			   
            });
      </script>
@endpush

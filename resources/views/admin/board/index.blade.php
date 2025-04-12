@extends('admin.includes.base')
@push('styles')
<style>
.pac-container { z-index: 100000!important; }
.col-half
{
    width: 155px!important;
}
.last-input
{
border-top-right-radius: 15px!important;
border-bottom-right-radius: 15px!important;
}
</style>
@endpush
@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Job Boards</h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Job Boards</li>
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
              <h5 class="card-title m-b-0 align-self-center">View Job Boards</h5>
              <div class="ml-auto">
                <div class="dl">
                  <div class="col-3 align-self-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon-Add"></i> Add Job Board</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table bg-white table-bordered nowrap display file_export">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Added On</th>
                    <th class="noExport">Actions</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($boards as $index => $board)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $board->title }}</td>
                  <td>{{ date('d/m/Y',strtotime($board->created_at)) }}</td>
                  <td><form action="{{ route('admin.board.destroy', $board->board_id) }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="button" class="btn btn-info btn-sm editRecord" data-id="{{ $board->board_id }}"><i class="fa fa-edit"></i> Edit</button>
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
        <h5 class="modal-title">Add Job Board</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
        <form class="form-horizontal r-separator" action="{{route('admin.board.store')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
          {{csrf_field()}}
          <input type="hidden" name="board_id" value="" />
          <div class="row">
            
            <div class="col-12">
              <div class="form-group has-feedback">
                <label>Title<span class="asterrisk">*</span></label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}" autocomplete="off">
                <span class="help-block" id="titleError"></span> </div>
            </div>
			</div>
			<div class="row">
			<div class="col-4">
              <div class="form-group has-feedback">
                <label>Color<span class="asterrisk">*</span></label>
                <input type="color" class="form-control" placeholder="Color" name="color" value="{{ old('color','#563d7c') }}" autocomplete="off" id="example-color-input">
                <span class="help-block" id="colorError"></span> </div>
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
			  var board_id = $('input[name="board_id"]').val();

			  if(board_id!='')
			  {
			  var url = "{{ url('/')}}/admin/board/"+board_id;
			  var method = 'PATCH';
			  }
			  else
			  {
			  var url = "{{route('admin.board.store')}}";
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
							window.location.href = "{{ url('admin/board') }}";
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
					$('.modal-title').text("Add Board");
					$('#ajaxSubmit').text("Add");
					$('#myModal').modal('show');
				});
			   
			   
			   
			   $('body').on('click', '.editRecord', function (event) {

					event.preventDefault();
					var id = $(this).data('id');
					$.get('board/'+id+'/edit', function (data) {
						var success = data.success;
						if(success==1)
						{
						$('input[name="board_id"]').val(data.client.board_id);
						$('input[name="title"]').val(data.client.title);	
						$('input[name="color"]').val(data.client.color);	
						
						$('.modal-title').text("Edit Board");
						$('#ajaxSubmit').text("Update");
						$('#myModal').modal('show');
						}
					 });
				});
			   
			   /*Load Model Popup*/
			   
			   
            });
      </script>

@endpush 
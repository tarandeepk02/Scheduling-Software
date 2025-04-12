@extends('admin.includes.base')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="https://rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.css">
<style>
.last-input
{
border-top-right-radius: 15px!important;
border-bottom-right-radius: 15px!important;
}
.card-body-cus
{
min-height:425px;
border-radius:0px 0px 15px 15px;
}
.multiselect-container 
{
    width: 100%!important;
    min-width: 320px!important;
    margin-left: 0px!important;
    padding-left: 0px!important;
    left: auto!important;
    width: 100%!important;
    top: 25px!important;
	height: 200px!important;
    overflow-x: hidden!important;
	overflow-y: scroll!important;
}
.multiselect-search
{
line-height:1.5;
}
.multiselect-filter .input-group-btn, .multiselect-filter .input-group-addon, .multiselect-filter .multiselect-clear-filter
{
border-radius:0px!important;
background-color: #eaeaea!important;
color:#222!important;
border-color: #eaeaea!important;
padding:10px;
}
.multiselect-filter .multiselect-clear-filter
{
padding:0px!important;
}
.multiselect-container>li>a>label
{
padding:3px 20px 3px 20px;
}
.multiselect-native-select .multiselect
{
background-color: #F9F9F9;
    border: 1px solid #eaeaea;
	line-height: 2.5;
    color: #5E6278;
	padding: 0.375rem 0.75rem;
    font-size: 13px;
	    font-weight: 600;
}
.radio input
{
display:none!important;
}
.multiselect-container>li:nth-child(2)
{
display:none!important;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
@endpush
@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Jobs</h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Jobs</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('common.notify')
  <div class="container-fluid">
    <form class="form-horizontal" action="{{route('admin.job.update', $job->job_id )}}" method="POST" enctype="multipart/form-data" role="form">
      {{csrf_field()}}
      <input type="hidden" name="_method" value="PATCH">
      <div class="row">
        <div class="col-8">
          <div class="card">
            <div class="card-body padd-10">
              <h4 class="card-title">Add Job</h4>
            </div>
            <div class="card-body bg-light">
              <div class="row m-t-10">
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Client<span class="asterrisk">*</span></label>
                    <select class="form-control multiselect-single" id="client" name="client_id">
                      <option value="">Select Client</option>
                      
                            
                      
					  @if(!empty($clients))
					  @foreach($clients as $client)
                      
                      
                            
                      <option value="{{ $client->client_id }}" @if($job->client_id==$client->client_id) selected="selected" @endif>{{ $client->first_name.' '.$client->last_name }}</option>
                      
                            
                      
					  @endforeach
					  @endif
                     
                    
                    
                          
                    </select>
                    @if ($errors->has('client')) <span class="help-block"> <strong>{{ $errors->first('client') }}</strong> </span> @endif </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Job Title<span class="asterrisk">*</span></label>
                    <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ $job->title }}" placeholder="Job Title">
                    @if ($errors->has('title')) <span class="help-block"> <strong>{{ $errors->first('title') }}</strong> </span> @endif </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Instructions</label>
                    <textarea type="text" class="form-control" id="inputEmail3" name="instructions" placeholder="Instructions">{{ $job->instructions }}</textarea>
                    @if ($errors->has('instructions')) <span class="help-block"> <strong>{{ $errors->first('instructions') }}</strong> </span> @endif </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Employees<span class="asterrisk">*</span></label>
					@php $se_employees = explode(',',$job->employees); @endphp
                    <select class="multiselect-ui form-control" multiple="multiple" style="width: 100%;" data-placeholder="Employees" name="employees[]">
                      
                            
                      
					  @if(!empty($employees))
					  @foreach($employees as $employee)
                      
                      
                            
                      <option value="{{ $employee->employee_id }}" @if(in_array($employee->employee_id,$se_employees)) selected="selected" @endif>{{ $employee->name }}</option>
                      
                            
                      
					  @endforeach
					  @endif
                    
                    
                          
                    </select>
                    @if ($errors->has('employees')) <span class="help-block"> <strong>{{ $errors->first('employees') }}</strong> </span> @endif </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Board<span class="asterrisk">*</span></label>
                    <select class="form-control" id="board" name="board">
					<option value="">--Select--</option>
					@if(!empty($boards))
					@foreach($boards as $board)
                      <option value="{{ $board->title }}" @if($job->board==$board->title) selected="selected" @endif>{{ $board->title }}</option>
					  @endforeach
					  @endif
                    </select>
                    @if ($errors->has('board')) <span class="help-block"> <strong>{{ $errors->first('board') }}</strong> </span> @endif </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group m-b-0 text-right">
                <button type="submit" class="btn btn-info waves-effect waves-light">Save Job</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <div class="card-body padd-10">
              <h4 class="card-title">Schedule</h4>
            </div>
            <div class="card-body bg-light card-body-cus">
              <div class="row m-t-20" id="datetimePicker">
                <div class="col-12">
                  <div class="form-group has-feedback">
                    <label>Start Date/Time<span class="asterrisk">*</span></label>
                    <div class="input-group">
                      <input type="text" class="date start form-control" placeholder="Start Date" name="start_date" value="{{ $job->start_date }}" autocomplete="off"/>
                      <input type="text" class="time start form-control last-input" placeholder="Start Time" name="start_time" value="{{ $job->start_time }}" autocomplete="off"/>
                      @if ($errors->has('start_date')) <span class="help-block"> <strong>{{ $errors->first('start_date') }}</strong> </span> @endif
                      @if ($errors->has('start_time')) <span class="help-block"> <strong>{{ $errors->first('start_time') }}</strong> </span> @endif </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group has-feedback">
                    <label>End Date/Time<span class="asterrisk">*</span></label>
                    <div class="input-group">
                      <input type="text" class="date end form-control" placeholder="End Date" name="end_date" value="{{ $job->end_date }}" autocomplete="off"/>
                      <input type="text" class="time end form-control last-input" placeholder="End Time" name="end_time" value="{{ $job->end_time }}" autocomplete="off"/>
                      @if ($errors->has('end_date')) <span class="help-block"> <strong>{{ $errors->first('end_date') }}</strong> </span> @endif
                      @if ($errors->has('end_time')) <span class="help-block"> <strong>{{ $errors->first('end_time') }}</strong> </span> @endif </div>
                  </div>
                </div>
                <!--<p id="datetimePicker">
                <input type="text" class="date start" />
                <input type="text" class="time start" />
                to
                <input type="text" class="time end" />
                <input type="text" class="date end" />
              </p>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://rawgit.com/jonthornton/jquery-timepicker/master/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/jonthornton/Datepair.js/master/dist/datepair.js"></script>
<script type="text/javascript" src="https://rawgit.com/jonthornton/Datepair.js/master/dist/jquery.datepair.js"></script>
<script type="text/javascript">//<![CDATA[


$('#datetimePicker .time').timepicker({
  'showDuration': true,
  //'timeFormat': 'g:ia'
  'timeFormat': 'H:i'
});

$('#datetimePicker .date').datepicker({
  'format': 'yyyy-mm-dd',
  'autoclose': true
});

$('#datetimePicker').datepair({
  parseDate: function(input) {
    return $(input).datepicker('getDate');
  },
  updateDate: function(input, dateObj) {
    $(input).datepicker('setDate', dateObj);
    console.log(input);
  }
});



  //]]></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
      $(".multiselect-single").multiselect({
	  	width: "100%",
		placeholder: 'Select Client',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		
		texts: {
        	placeholder: 'Select Client'
    	}
		
	  });
	  
	  
</script>
<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
		width: "100%",
        includeSelectAllOption: true,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		texts: {
        	placeholder: 'Select Employees'
    	}
    });
});
</script>
@endpush
@extends('admin.includes.base')

@push('styles')
<style>
.fc-basic-view .fc-day-number, .fc-basic-view .fc-week-number {
    padding: 20px;
}
/* metro dashboard states */
.metro-nav {
    position: relative;
}

.metro-fix-view .metro-nav-block.double {
    width: 251px !important;
}

.metro-fix-view .metro-nav-block.long {
    width: 251px !important;
    height: 235px !important;
}

.metro-fix-view .metro-nav-block.long .value {
    padding-top: 30px !important;
    display: inline-block;
}

.metro-fix-view .metro-nav-block.long .value i {
    font-size: 90px;
}

.metro-fix-view .metro-nav-block {
    color: white;
    cursor: pointer;
    display: block;
    float: left;
    font-weight: 300;
    height: 120px;
    letter-spacing: 0.02em;
    line-height: 20px;
    margin: 0 1% 1% 0;
    overflow: hidden;
    position: relative;
    text-decoration: none;
    width: 120px !important;
    z-index: 1;
}


.metro-nav .metro-nav-block.double {
    width: 28%;
}

.metro-nav .metro-nav-block {
    color: white;
    cursor: pointer;
    display: block;
    float: left;
    font-weight: 300;
    height:114px;
    letter-spacing: 0.02em;
    line-height: 20px;
    margin: 0 1% 1% 0;
    overflow: hidden;
    position: relative;
    text-decoration: none;
    width: 100%;
    z-index: 1;
	border-radius:15px;
}

.metro-nav .metro-nav-block i {
    font-size: 25px;
    margin-top: 20px;
    display: inline-block;
}

.metro-nav .metro-nav-block:last-child {
    margin-right: 0;
}

.metro-nav .metro-nav-block a {
    color: white;
    font-size: 18px;
    font-weight: 400;
    height: 90%;
    line-height: 16px;
    overflow: hidden;
    padding: 5px 10px;
    position: absolute;
    text-overflow: ellipsis;
    vertical-align: top;
    width: 88%;
    text-decoration: none;
}

.metro-nav .metro-nav-block a i {
    transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    -webkit-transition: all 0.5s ease-in-out 0s;
    -o-transition: all 0.5s ease-in-out 0s;
}

.metro-nav .metro-nav-block a .info {
    transition: all 0.4s ease-in-out 0s;
    -moz-transition: all 0.4s ease-in-out 0s;
    -webkit-transition: all 0.4s ease-in-out 0s;
    -o-transition: all 0.4s ease-in-out 0s;
}

.metro-nav .metro-nav-block a:hover i{
    transform:rotate(83deg);
    -moz-transform:rotate(83deg);
    -webkit-transform:rotate(83deg);
    -o-transform:rotate(83deg);
    font-size: 140px;
    opacity: 0.2;
}

.metro-nav .metro-nav-block.long a:hover i{

    font-size: 200px;
}
.metro-nav .metro-nav-block.long a {
    height: 96%;
}
.metro-nav .metro-nav-block a:hover .info {
    transform:rotate(360deg);
    -moz-transform:rotate(360deg);
    -webkit-transform:rotate(360deg);
    -o-transform:rotate(360deg);
    font-size: 40px;
    opacity: 0.6;
}

.metro-nav .metro-nav-block:hover {
    opacity: 0.8;
}

.metro-nav .metro-nav-block.double a {
    width: 94%;
}

.metro-nav .metro-nav-block .info {
    font-size: 24px;
    position: absolute;
    right: 10px;
    top: 45px;
}

.metro-nav .metro-nav-block .status, .metro-nav .metro-nav-block .tile-status {
    background-color: transparent;
    bottom: -10px;
    font-size: 14px;
    left: 10px;
    min-height: 30px;
    position: absolute;
}
.fc-event
{
cursor: pointer!important;
}

.badge
{
    padding: 0.375rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1;
    color: #424e56;
    text-align: center;
    background-color: #e8ebed;
    border-radius: 0.25rem;
}

.modal-body .card-body
{
border:1px solid #eaeaea;
padding:15px 10px 10px 10px;
}
.modal-body .card-title
{
padding:0px;
}

.fc-event
{
/*background-color: #e4e9ef !important;*/
border:1px solid #4b6A96 !important;
color: #012939 !important;
}
.fc-content-skeleton .bg-success
{
background:#2ABBB2!important;
}
.wid100
{
width:100%;
}

#calendarSignHub {
  /*max-width: 1100px;
  margin: 40px auto;*/
}
.fc-h-event .fc-event-title
{
color:#012939 !important;
}

.fc-event:before {
    background-color: #4b6A96!important;
}
.fc-event:before {
    position: absolute!important;
    top: 0!important;
    left: 0!important;
    bottom: 0!important;
    display: block!important;
    width: 0.25rem!important;
    content: ""!important;
}
.fc-button
{
background:none!important;
color:#2c3e50!important;
border-color:#2c3e50!important;
height:3.1em!important;
padding:10px 15px!important;
border-radius:0px!important;
font-size:14px!important;
}
.fc-button
{
text-transform:capitalize!important;
}
.fc-event-time
{
color:#4b6A96 !important;
}
.fc-timeline-slots td {
    height: 3.5em;
}
.fc-datagrid-cell-frame
{
position: relative;
    background-color: #ffffff;
    white-space: nowrap;
    color: #333;
    border-bottom: 1px solid #e1e1e1;
    background-repeat: no-repeat;
    /*height: 52px!important;*/
    min-width: 5rem;
    box-sizing: border-box;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
/*.fc-timeline-lane-frame
{
height: 52px!important;
}
.fc .fc-datagrid-cell-cushion
{
padding:20px 15px;
}
.fc-timeline-header-row
{
height: 48px!important;
}*/
.sidebar-item .active
{
background:#2ABBB2!important;
}
tbody tr {
    line-height: 34px!important;
}
 #external-events {
    /*position: fixed;
    z-index: 2;
    top: 20px;
    left: 20px;
    width: 150px;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;*/
  }

  .demo-topbar + #external-events { /* will get stripped out */
    /*top: 60px;*/
  }

  #external-events .fc-event {
    cursor: move;
    margin: 3px 10px;
  }
  
  #external-events .fc-event-main
  {
  cursor: move;
	margin: 3px 0;
    padding: 5px 10px 5px 10px;
    text-align: left;
  }
  .sidebar-nav ul .sidebar-item .sidebar-link {
    padding: 10px 10px;
	}
	
	
	.multiselect-container 
{
    width: 100%!important;
    min-width: 223px!important;
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
.fc-daygrid-event
{
white-space:wrap!important;
}
</style>
<link href="https://unpkg.com/pikaday@1.8.0/css/pikaday.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Email App Part -->
  <!-- ============================================================== -->
  <div class="email-app border-top">
    <!-- ============================================================== -->
    <!-- Left Part -->
    <!-- ============================================================== -->
    <div class="left-part bg-light"> <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
      <div class="scrollable" style="height:100%;">
        <div class="p-15"> <a href="javascript:;" class="btn btn-outline-primary waves-effect waves-light wid100 addJob" ><i class="icon-Add"></i> Create Job</a> </div>
        <div class="divider"></div>
        <ul class="list-group">
          <li> <small class="p-15 grey-text text-lighten-1 db">Workspace</small> </li>
		  
		  <li class="list-group-item" style="margin: 0px 15px;">
		  <select class="form-control select2" id="job_category" style="width:100%;">
		  <option value=""></option>
		  @if(!empty($boards))
		  @foreach($boards as $board)
		  <option value="{{ $board->title }}">{{ $board->title }}</option>
		  @endforeach
		  @endif
		  </select>
		  
		  
		  </li>
		  
		  
		  <li class="list-group-item">
            <hr>
          </li>
		  
		  <div class="boardJobs" id='external-events'>
		  
		  </div>
        </ul>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Right Part -->
    <!-- ============================================================== -->
    <div class="right-part mail-list bg-white">
      <!-- Action part -->
      <!-- Mail list-->
      <div class="card-body b-l calender-sidebar">
        <div id="calendarSignHub"></div>
        <div class="clearfix"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Right Part  Mail Compose -->
    <!-- ============================================================== -->
    <div class="right-part mail-compose bg-white" style="display: none;">
      <div class="p-20 border-bottom">
        <div class="d-flex align-items-center">
          <div>
            <h4>Compose</h4>
            <span>create new message</span> </div>
          <div class="ml-auto">
            <button id="cancel_compose" class="btn btn-dark">Back</button>
          </div>
        </div>
      </div>
      <!-- Action part -->
      <!-- Button group part -->
      <div class="card-body">
        <form>
          <div class="form-group">
            <input type="email" id="example-email" name="example-email" class="form-control" placeholder="To">
          </div>
          <div class="form-group">
            <input type="text" id="example-subject" name="example-subject" class="form-control" placeholder="Subject">
          </div>
          <div id="summernote"></div>
          <h4>Attachment</h4>
          <div class="dropzone" id="dzid">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
          </div>
          <button type="submit" class="btn btn-success m-t-20"><i class="far fa-envelope"></i> Send</button>
          <button type="submit" class="btn btn-dark m-t-20">Discard</button>
        </form>
        <!-- Action part -->
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Right Part  Mail detail -->
    <!-- ============================================================== -->
    <div class="right-part mail-details bg-white" style="display: none;">
      <div class="card-body bg-light">
        <button type="button" id="back_to_inbox" class="btn btn-outline-secondary font-18 m-r-10"><i class="mdi mdi-arrow-left"></i></button>
        <div class="btn-group m-r-10" role="group" aria-label="Button group with nested dropdown">
          <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-reply"></i></button>
          <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-alert-octagon"></i></button>
          <button type="button" class="btn btn-outline-secondary font-18"><i class="mdi mdi-delete"></i></button>
        </div>
        <div class="btn-group m-r-10" role="group" aria-label="Button group with nested dropdown">
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-folder font-18 "></i> </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
          </div>
          <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-label font-18"></i> </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
          </div>
        </div>
      </div>
      <div class="card-body border-bottom">
        <h4 class="m-b-0">Your Message title goes here</h4>
      </div>
      <div class="card-body border-bottom">
        <div class="d-flex no-block align-items-center m-b-40">
          <div class="m-r-10"><img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle" width="45"></div>
          <div class="">
            <h5 class="m-b-0 font-16 font-medium">Hanna Gover <small> ( hgover@gmail.com )</small></h5>
            <span>to Suniljoshi19@gmail.com</span> </div>
        </div>
        <h4 class="m-b-15">Hey Hi,</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
      </div>
      <div class="card-body">
        <h4><i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span></h4>
        <div class="row">
          <div class="col-md-2"> <a href="javascript:void(0)"> <img class="img-thumbnail img-responsive" alt="attachment" src="../../assets/images/big/img1.jpg"> </a> </div>
          <div class="col-md-2"> <a href="javascript:void(0)"> <img class="img-thumbnail img-responsive" alt="attachment" src="../../assets/images/big/img2.jpg"> </a> </div>
          <div class="col-md-2"> <a href="javascript:void(0)"> <img class="img-thumbnail img-responsive" alt="attachment" src="../../assets/images/big/img3.jpg"> </a> </div>
        </div>
        <div class="border m-t-20 p-15">
          <p class="p-b-20">click here to <a href="javascript:void(0)">Reply</a> or <a href="javascript:void(0)">Forward</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- End PAge Content -->
  <!-- ============================================================== -->
</div> 

<div class="modal fade none-border" id="eventDetails">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> </div>
  </div>
</div>
<!--<button type="button" id="clicke">clicke</button>-->


<div class="modal" tabindex="-1" role="dialog" id="taskModal" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
		
		
		
		<form class="form-horizontal r-separator" action="{{route('admin.task.store')}}" method="POST" enctype="multipart/form-data" role="form" id="taskForm">
      {{csrf_field()}}
	  <input type="hidden" class="task_date" name="task_date"/>
      <div class="row m-t-10">
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Client<span class="asterrisk">*</span></label>
                    <select class="form-control multiselect-single" id="client" name="client_id">
                      <option value="">Select Client</option>
                      
					  @if(!empty($clients))
					  @foreach($clients as $client)
                      
                      <option value="{{ $client->client_id }}" @if(old('client_id')==$client->client_id) selected="selected" @endif>{{ $client->first_name.' '.$client->last_name }}</option>
                      
					  @endforeach
					  @endif
                     
                    
                    </select>
                    <span class="help-block" id="client_idError"></span> </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Task Title<span class="asterrisk">*</span></label>
                    <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ old('title') }}" placeholder="Job Title">
                    <span class="help-block" id="titleError"></span> </div>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Employees<span class="asterrisk">*</span></label>
                    <select class="multiselect-ui form-control" multiple="multiple" style="width: 100%;" data-placeholder="Employees" name="employees[]" id="taskEmployees">
                      
					  @if(!empty($employees))
					  @foreach($employees as $employee)
                      
                      <option value="{{ $employee->employee_id }}">{{ $employee->name }}</option>
                      
					  @endforeach
					  @endif
                    
                    </select>
                    <span class="help-block" id="employeesError"></span> </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Status<span class="asterrisk">*</span></label>
                    <select class="form-control" id="status" name="status">
                      <option value="Designing" @if(old('status')=='Designing') selected="selected" @endif>Designing</option>
                      <option value="Approval" @if(old('status')=='Approval') selected="selected" @endif>Approval</option>
                      <option value="Production" @if(old('status')=='Production') selected="selected" @endif>Production</option>
                      <option value="Installation" @if(old('status')=='Installation') selected="selected" @endif>Installation</option>
                    </select>
                    <span class="help-block" id="statusError"></span> </div>
                </div>
				<div class="col-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Instructions</label>
                    <textarea type="text" class="form-control" id="inputEmail3" name="instructions" placeholder="Instructions">{{ old('instructions') }}</textarea>
                    <span class="help-block" id="instructionsError"></span> </div>
                </div>
              </div>
    </form>
		
		
		
		
		
		
		
		
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="ajaxSubmitTask">Add</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="jobModal" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
		
		
		
		<form class="form-horizontal r-separator" action="{{route('admin.job.store')}}" method="POST" enctype="multipart/form-data" role="form" id="jobForm">
      {{csrf_field()}}
      <div class="row m-t-10">
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Client<span class="asterrisk">*</span></label>
                    <select class="form-control multiselect-single" id="client" name="client_id">
                      <option value="">Select Client</option>
                      
					  @if(!empty($clients))
					  @foreach($clients as $client)
                      
                      <option value="{{ $client->client_id }}" @if(old('client_id')==$client->client_id) selected="selected" @endif>{{ $client->first_name.' '.$client->last_name }}</option>
                      
					  @endforeach
					  @endif
                     
                    
                    </select>
                    <span class="help-block" id="client_idError"></span> </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Job Title<span class="asterrisk">*</span></label>
                    <input type="text" class="form-control" id="inputEmail3" name="title" value="{{ old('title') }}" placeholder="Job Title">
                    <span class="help-block" id="titleError"></span> </div>
                </div>
                
                
                <div class="col-6">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Board<span class="asterrisk">*</span></label>
                    <select class="form-control" id="board" name="board">
					<option value="">--Select--</option>
					@if(!empty($boards))
					@foreach($boards as $board)
                      <option value="{{ $board->title }}" @if(old('board')==$board->title) selected="selected" @endif>{{ $board->title }}</option>
					  @endforeach
					  @endif
                    </select>
                    <span class="help-block" id="boardError"></span> </div>
                </div>
				<div class="col-12">
                  <div class="form-group">
                    <label for="inputEmail3" class="control-label col-form-label">Instructions</label>
                    <textarea type="text" class="form-control" id="inputEmail3" name="instructions" placeholder="Instructions">{{ old('instructions') }}</textarea>
                    <span class="help-block" id="instructionsError"></span> </div>
                </div>
              </div>
    </form>
		
		
		
		
		
		
		
		
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="ajaxSubmitJob">Add</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.4/index.global.min.js"></script>
<script src="https://unpkg.com/pikaday@1.8.0/pikaday.js"></script>
<script>
var Draggable = FullCalendar.Draggable;

  var calendarEl = document.getElementById('calendarSignHub');

	var containerEv = document.getElementById('external-events');


	// initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEv, {
      itemSelector: '.fc-event',
      eventData: function(eventEl) {
	  //console.log('eventData='+JSON.stringify(eventEl));
	  var j_selector = jQuery(eventEl);
        return {
          title: eventEl.innerText,
		  //eventId: eventEl.attr('data-id')
		  eventId: j_selector.data('id'),
		  eventType: 'Job',
        };
      }
    });

    // initialize the calendar
    // -----------------------------------------------------------------



  var calendarr = new FullCalendar.Calendar(calendarEl, {
    now: '<?php echo date('Y-m-d'); ?>',
  	customButtons: {
            // Add custom datepicker
            datepicker: {
                text: '{{ date("D, F d") }}',
                click: function(e) {
                    picker.show();
                }
            }
        },
		
  	schedulerLicenseKey: '0328343765-fcs-1677703094',
    timeZone: 'UTC',
    headerToolbar: {
      left: 'today prev,next datepicker',
      center: 'title',
      //right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineMonth,resourceTimelineYear'
	  right: 'resourceTimelineDay,resourceTimelineMonth,resourceTimelineYear'
    },
    initialView: 'resourceTimelineDay',
    scrollTime: '08:00',
	startTime: '08:00', // a start time (10am in this example)
    endTime: '18:00', // an end time (6pm in this example)
    //aspectRatio: 1.6,
	//contentHeight: 600,
	//contentHeight : 1300,
	lazyFetching: true,
	/*loading: function( isLoading, view ) {
            if(isLoading) {// isLoading gives boolean value
                //show your loader here 
				alert('loading');
            } else {
                //hide your loader here
				alert('loaded');
            }
        },*/
    /*views: {
      resourceTimelineDay: {
        buttonText: ':15 slots',
        slotDuration: '00:15'
      },
      resourceTimelineTenDay: {
        type: 'resourceTimeline',
        duration: { days: 10 },
        buttonText: '10 days'
      }
    },*/
    editable: false,
	eventDurationEditable: true,
    resourceAreaHeaderContent: 'Employees',
	resourceOrder: '-name',
    resources: '{{ url("admin/task/resourcesEmployees") }}',
    events: '{{ url("admin/task/eventsEmployees") }}',
	
	
	droppable: true, // this allows things to be dropped onto the calendar
      drop: function(arg) {
        // is the "remove after drop" checkbox checked?
        //if (document.getElementById("drop-remove").checked) {
            // if so, remove the element from the "Draggable Events" list
            arg.draggedEl.parentNode.removeChild(arg.draggedEl);
        //}
		calendarr.render();
      },
	  
	  eventReceive: function( info ) {
	  
	  var resources = info.event.getResources();
      var resourceIds = resources.map(function(resource) { return resource.id });
	  
	  var eventDatas = {
	  eventId: info.event.extendedProps.eventId,
    title: info.event.title,
    start: info.event.start.toISOString(),
	resourceIds: resourceIds
    //end: info.event.end.toISOString()
  };
//alert(JSON.stringify(eventDatas));
  
  
  
  
  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });			 
               jQuery.ajax({
                  url: "{{route('admin.task.dropEvent')}}",
                  method: 'post',   				  
				  data: eventDatas,
                  success: function(result){
				  
				  //alert(JSON.stringify(result));
                  	/*if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						toastr.success(result.message);					
                  	}*/
					//calendarr.render();
					
					calendarr.render();
					//$('#clicke').trigger('click');
                  },
				  error: function(err){
				  //alert(JSON.stringify(err));
				  }  
				  });
  
  
  
},
	
	
	eventClick: function(info) {
      info.jsEvent.preventDefault();
      
      // change the border color
      info.el.style.borderColor = 'red';
      
      //alert('taran benipal'+JSON.stringify(info));
	  
	  var id = info.event.extendedProps.eventId;
	  
	  var eventType = info.event.extendedProps.eventType;
	  
	  
	  
					var durl = "{{ url('/') }}"+'/admin/task/event/'+id+'/'+eventType;
					
					//alert('eventType'+durl);
					
					$.get(durl, function (data) {
						$('#eventDetails .modal-content').html(data);
						$('#eventDetails').modal('show');
						
					 });
	  
	  
	  
	  
	  
    },
	
	eventResize: function(info) {
			info.jsEvent.preventDefault();
			var id = info.event.extendedProps.eventId;
			var eventType = info.event.extendedProps.eventType;
			
			var startt = info.event.start.toISOString();
     		var endd = info.event.end.toISOString();
			
			//alert(id+eventType);
			
        /*alert(
            event.title + " was moved " +
            dayDelta + " days and " +
            minuteDelta + " minutes."
        );

        if (allDay) {
            alert("Event is now all-day");
        }else{
            alert("Event has a time-of-day");
        }

        if (!confirm("Are you sure about this change?")) {
            revertFunc();
        }*/
		//alert(info.event.title + " end is now " + info.event.end.toISOString());
		//alert('title=='+id+'eventType=='+eventType+'end=='+endd);
		
		
		
			
			$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });			 
               jQuery.ajax({
                  url: "{{route('admin.task.updateTime')}}",
                  method: 'post',   				  
				  data: {'task_id': id,'start_timee': startt,'end_timee': endd,'eventType': eventType},
                  success: function(result){
				  //alert(JSON.stringify(result));
                  	/*if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						toastr.success(result.message);					
                  	}*/
					//calendarr.render();
                  },
				  error: function(err){
				  //alert(JSON.stringify(err));
				  }  
				  });
               
		
		
		
		
		
		
		
		

    },
	dateClick: function(info) {
    //alert("dateClick==="+JSON.stringify(info));
	
	var employeeId = info.resource.id;
	var employeeDate = info.date.toISOString();
	//alert('employeeId=='+employeeId+'===employeeDate==='+employeeDate);
	
	//$('#taskEmployees').find('option[value="'+employeeId+'"]').attr("selected", "selected");
	//$('#taskEmployees').val(employeeId);
	$('#taskModal form').trigger('reset');
	$('.task_date').val(employeeDate);
	$("#taskEmployees option[value='"+employeeId+"']").attr("selected", "selected");
	$("#taskEmployees").multiselect('refresh');
	
	$('#taskModal').modal('show');	
		
	
	
	}
	
	
	
  });

// Initialize Pikaday
    var picker = new Pikaday({
        field: document.querySelector('.fc-datepicker-button'),
        format: 'yy-mm-dd',
        onSelect: function(dateString) {
            picker.gotoDate(new Date(dateString));
            calendarr.gotoDate(new Date(dateString));
			var date = new Date(dateString);
			
			var weekday=new Array("Sun","Mon","Tues","Wed","Thur", "Fri","Sat")
    		var monthname=new Array("January","February","March","April","May","June","July","August", "September","October","November","December");
			
			$('.fc-datepicker-button').text(weekday[date.getDay()]+', '+monthname[date.getMonth()]+' '+date.getDate());
        }
    });


$(document).ready(function() {


  calendarr.render();
  
  
});


function loadBoards()
{
var job_category = $('#job_category').val();
//alert('job_category='+job_category);
			$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });			 
               jQuery.ajax({
                  url: "{{route('admin.task.getJobs')}}",
                  method: 'post',   				  
				  data: {'job_category': job_category},
                  success: function(result){
				  //alert(result);
                  	/*if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						toastr.success(result.message);					
                  	}*/
					//calendarr.render();
					$('.boardJobs').html(result);
                  },
				  error: function(err){
				  //alert(JSON.stringify(err));
				  }  
				  });
}


$(document).ready(function()
{
$(document).on('change','#job_category',function()
{
loadBoards();

});


$(document).on('click','#ajaxSubmitTask',function(e)
{
			
			var btn = $(this);
			var old_html = btn.html();
			btn.html('Please wait...');
            btn.attr('disabled', true);
			
			//alert('click');
			$('#taskForm span.help-block').text(' ');
			
			var myObject = new Object();
			var other_data = $('#taskForm').serializeArray();
			$.each(other_data,function(key,input){
				myObject[input.name] = input.value;
			});
			
			
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
			  
			  
			  //alert(url+" "+method);
               jQuery.ajax({
                  url: "{{route('admin.task.store')}}",
                  method: 'post',   				  
				  data: myObject,
                  success: function(result){
				  //alert(JSON.stringify(result));
                  	if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#taskForm #'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						calendarr.refetchEvents();
						toastr.success(result.message);
						$('#taskModal').modal('hide');
						
                  		
                  	}
					btn.html(old_html);
                    btn.attr('disabled', false);
                  },
				  error: function(err){
				  //alert(JSON.stringify(err));
				  }  
				  });
               });
			   
$(document).on('click','#ajaxSubmitJob',function(e)
{
			
			var btn = $(this);
			var old_html = btn.html();
			btn.html('Please wait...');
            btn.attr('disabled', true);
			
			//alert('click');
			$('#jobForm span.help-block').text(' ');
			
			var myObject = new Object();
			var other_data = $('#jobForm').serializeArray();
			$.each(other_data,function(key,input){
				myObject[input.name] = input.value;
			});
			
			
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
			  
			  
			  //alert(url+" "+method);
               jQuery.ajax({
                  url: "{{route('admin.job.store')}}",
                  method: 'post',   				  
				  data: myObject,
                  success: function(result){
				  //alert(JSON.stringify(result));
				  
                  	if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#jobForm #'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						$('#jobModal form')[0].reset();
						toastr.success(result.message);
						$('#jobModal').modal('hide');
						loadBoards();
                  		
                  	}
					btn.html(old_html);
                    btn.attr('disabled', false);
                  },
				  error: function(err){
				  //alert(JSON.stringify(err));
				  }  
				  });
               });			   


$(document).on('click','.addJob',function(e)
{
$('#jobModal').modal('show');
});
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
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
background-color: #e4e9ef !important;
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
  max-width: 1100px;
  margin: 40px auto;
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
</style>
<link href="https://unpkg.com/pikaday@1.8.0/css/pikaday.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-9 align-self-center">
        <div class="d-flex align-items-center">
          <div>
            <h3 class="m-b-0"><i class="fa fa-cube"></i> Welcome back!</h3>
            <span>{{ date('l, d F Y') }}</span> </div>
        </div>
      </div>
      <div class="col-3 align-self-center">
        <!--<div class="d-flex no-block justify-content-end align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
              <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
          </nav>
        </div>-->
		<a href="{{ url('admin/task/create') }}" class="btn btn-outline-primary waves-effect waves-light wid100"><i class="icon-Add"></i> Create Task</a>
      </div>
    </div>
  </div>
  @include('common.notify')
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div id="calendarSignHub"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-body b-l">
                  
				  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- BEGIN MODAL -->
    <div class="modal none-border" id="my-event">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><strong>Add Event</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
            <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-new-event">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><strong>Add</strong> a category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <form>
              <div class="row">
                <div class="col-md-6">
                  <label class="control-label">Category Name</label>
                  <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name" />
                </div>
                <div class="col-md-6">
                  <label class="control-label">Choose Category Color</label>
                  <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                    <option value="success">Success</option>
                    <option value="danger">Danger</option>
                    <option value="info">Info</option>
                    <option value="primary">Primary</option>
                    <option value="warning">Warning</option>
                    <option value="inverse">Inverse</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL -->
	
	
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->
</div>


<div class="modal fade none-border" id="eventDetails">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<!--<script src="{{ asset('admin_assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js') }}"></script>
<script src="{{ asset('admin_assets/extra-libs/taskboard/js/jquery-ui.min.js') }}"></script>-->



<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.4/index.global.min.js"></script>

<script src="https://unpkg.com/pikaday@1.8.0/pikaday.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendarSignHub');

  var calendar = new FullCalendar.Calendar(calendarEl, {
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
      right: 'resourceTimelineDay,resourceTimelineTenDay,resourceTimelineMonth,resourceTimelineYear'
    },
    initialView: 'resourceTimelineDay',
    scrollTime: '09:00',
	startTime: '09:00', // a start time (10am in this example)
    endTime: '18:00', // an end time (6pm in this example)
    aspectRatio: 1.5,
    views: {
      /*resourceTimelineDay: {
        buttonText: ':15 slots',
        slotDuration: '00:15'
      },
      resourceTimelineTenDay: {
        type: 'resourceTimeline',
        duration: { days: 10 },
        buttonText: '10 days'
      }*/
    },
    editable: true,
    resourceAreaHeaderContent: 'Employees',
    resources: '{{ url("admin/task/resourcesEmployees") }}',
    events: '{{ url("admin/task/eventsEmployees") }}',
	
	
	
	
	
	
	
	
	
	
  });

  calendar.render();
  
  // Initialize Pikaday
    var picker = new Pikaday({
        field: document.querySelector('.fc-datepicker-button'),
        format: 'yy-mm-dd',
        onSelect: function(dateString) {
            picker.gotoDate(new Date(dateString));
            calendar.gotoDate(new Date(dateString));
			var date = new Date(dateString);
			
			var weekday=new Array("Sun","Mon","Tues","Wed","Thur", "Fri","Sat")
    		var monthname=new Array("January","February","March","April","May","June","July","August", "September","October","November","December");
			
			$('.fc-datepicker-button').text(weekday[date.getDay()]+', '+monthname[date.getMonth()]+' '+date.getDate());
        }
    });
});


</script>


@endpush
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
              <li class="breadcrumb-item active" aria-current="page">Schedule</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  @include('common.notify')
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">
        <div class="card">
          <div class="">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-body b-l calender-sidebar">
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
	  <a href="{{ url('admin/job/create') }}" class="btn btn-outline-primary waves-effect waves-light wid100"><i class="icon-Add"></i> Create Job</a>
        <div class="metro-nav m-t-30">
          <div class="metro-nav-block nav-block-orange" style="background:#2ABBB2;"> <a data-original-title="" href="{{ url('admin/employee') }}"> <i class="sl-icon-user-follow"></i>
            <div class="info">{{ $total_employees }}</div>
            <div class="status">Employees</div>
            </a> </div>
          <div class="metro-nav-block nav-olive m-t-10" style="background:#25A69E;"> <a data-original-title="" href="{{ url('admin/client') }}"> <i class="sl-icon-people"></i>
            <div class="info">{{ $total_clients }}</div>
            <div class="status">Clients</div>
            </a> </div>
          <div class="metro-nav-block nav-block-yellow m-t-10" style="background:#21918A;"> <a data-original-title="" href="{{ url('admin/job') }}"> <i class="sl-icon-paper-clip"></i>
            <div class="info">{{ $total_jobs }}</div>
            <div class="status">Jobs</div>
            </a> </div>
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
<script src="{{ asset('admin_assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('admin_assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js') }}"></script>
<script src="{{ asset('admin_assets/extra-libs/taskboard/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
/*var AllEvents1 = [{ title: "Meeting with Mr. Shreyu", start: new Date(l.now() + 158e6), end: new Date(l.now() + 338e6), className: "bg-warning" },{ title: "Interview - Backend Engineer", start: e, end: e, className: "bg-success" },{ title: "Phone Screen - Frontend Engineer", start: new Date(l.now() + 168e6), className: "bg-info" },{ title: "Buy Design Assets", start: new Date(l.now() + 338e6), end: new Date(l.now() + 4056e5), className: "bg-primary" }];


var AllEvents = {"brand": "Lamborghini", "model" : "Huracan", "origin": "Italy"};*/
var url = "{{ url('admin/job/schedule/events') }}";
//alert('url=='+url);
var baseUrl = "{{ url('/') }}";
</script>
<!--This page JavaScript -->
<script src="{{ asset('dist/js/pages/calendar/cal-init.js')}}"></script>
@endpush
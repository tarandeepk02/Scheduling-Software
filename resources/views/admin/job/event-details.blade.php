<div class="modal-header">
  <h4 class="modal-title"><strong>Job</strong> details</h4>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ $job->title }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="control-label text-right col-md-6">Start Date/Time:</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{ $job->start_date.' '.date('h:ma',strtotime($job->start_time)) }}</p>
                </div>
              </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group row">
                <label class="control-label text-right col-md-6">End Date/Time:</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{ $job->end_date.' '.date('h:ma',strtotime($job->end_time)) }}</p>
                </div>
              </div>
            </div>
            <!--/span-->
          </div>
          <!--/row-->
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Assigned to</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12"> 
			@php $employees = explode(',',$job->employees); @endphp
			@if(!empty($employees))
			@foreach($employees as $emp)
			
			<span class="badge">{{ getEmployee($emp)->name ?? '' }}</span> 
			@endforeach
			@endif
			</div>
            <!--/span-->
          </div>
          <!--/row-->
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Instructions</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <p>{{ $job->instructions }}</p>
            </div>
            <!--/span-->
          </div>
          <!--/row-->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <!--<button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>-->
  <a href="{{ route('admin.job.edit', $job->job_id) }}" class="btn btn-warning waves-effect"><i class="sl-icon-pencil"></i> Edit</a>
  <a href="{{ route('admin.job.uptStatus', ['id'=>$job->job_id,'status'=>'Complete']) }}" onclick="return confirm('Are you sure?')" class="btn btn-success waves-effect"><i class="sl-icon-cursor"></i> Mark Complete</a>
</div>

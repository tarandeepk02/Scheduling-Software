<div class="modal-header">
  <h4 class="modal-title"><strong>Task</strong> details</h4>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ $task->title }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="control-label text-right col-md-6">Start Date/Time:</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{ $task->start_date.' '.date('h:ma',strtotime($task->start_time)) }}</p>
                </div>
              </div>
            </div>
            <!--/span-->
            <div class="col-md-6">
              <div class="form-group row">
                <label class="control-label text-right col-md-6">End Date/Time:</label>
                <div class="col-md-6">
                  <p class="form-control-static">{{ $task->end_date.' '.date('h:ma',strtotime($task->end_time)) }}</p>
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
			@php $employees = explode(',',$task->employees); @endphp
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
              <p>{{ $task->instructions }}</p>
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
  @if($type=='Task')
  <a href="{{ route('admin.task.edit', $task->task_id) }}" class="btn btn-warning waves-effect"><i class="sl-icon-pencil"></i> Edit</a>
  <a href="{{ route('admin.task.uptStatus', ['id'=>$task->task_id,'status'=>'Complete']) }}" onclick="return confirm('Are you sure?')" class="btn btn-success waves-effect"><i class="sl-icon-cursor"></i> Mark Complete</a>
  @else
  <a href="{{ route('admin.job.edit', $task->job_id) }}" class="btn btn-warning waves-effect"><i class="sl-icon-pencil"></i> Edit</a>
  <a href="{{ route('admin.job.uptStatus', ['id'=>$task->job_id,'status'=>'Complete']) }}" onclick="return confirm('Are you sure?')" class="btn btn-success waves-effect"><i class="sl-icon-cursor"></i> Mark Complete</a>
  @endif
</div>

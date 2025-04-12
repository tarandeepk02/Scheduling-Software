@if(!empty($jobs) && count($jobs)>0)
@foreach($jobs as $job)
<li class="list-group-item fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event" data-id="{{ $job->job_id }}"> <a href="javascript:void(0)" class="active list-group-item-action fc-event-main"><i class="mdi mdi-inbox"></i> {{ $job->title }} <!--<span class="label label-success float-right">6</span>--></a> </li>
@endforeach
@else
<li class="list-group-item"><a href="javascript:void(0)" class="list-group-item-action">No Jobs</a></li>
@endif
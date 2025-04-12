<?php

namespace App\Http\Controllers\Resource;

use App\Models\Task;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Board;
use App\Models\Job;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use DB;
use App\Models\LoginActivity;
use Validator;
use Carbon\Carbon;

use Illuminate\Http\Response;

class TaskResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$tasks = Task::orderBy('created_at' , 'desc')->get();		
        return view('admin.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$clients = Client::orderBy('created_at' , 'desc')->get();
		$employees = Employee::where('status','1')->orderBy('created_at' , 'desc')->get();
        return view('admin.task.create',compact('clients','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
         $validator = Validator::make($request->all(), [
			'client_id' => 'required|max:255',
			'title' => 'required|max:255',
			"employees"    => "required|array",
			'status' => 'required',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try{
		
			$task_date = $request->task_date;
			$parseDate = Carbon::parse($task_date);
			$start_date = $parseDate->format('Y-m-d');
			$start_time = $parseDate->format('H:i');
			
			$end_time = $parseDate->addHours(1)->format('H:i');		
		
            $task = $request->all();
			$task['employees'] = implode(',',$request->employees);
			$task['start_date'] = $start_date;
			$task['start_time'] = $start_time;
			$task['end_date'] = $start_date;
			$task['end_time'] = $end_time;
			
			$task = Task::create($task);
			return response()->json(['message'=>'Task Details Saved Successfully']);
        } 
        catch (Exception $e) {
			return response()->json(['message'=>'Something went wrong. Please try again later']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $employee = Task::findOrFail($id);
			$activities = LoginActivity::where('admin_id',$id)->orderBy('created_at','desc')->paginate(15);
            return view('admin.task.details', compact('employee','activities'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
			$clients = Client::orderBy('created_at' , 'desc')->get();
			$employees = Employee::where('status','1')->orderBy('created_at' , 'desc')->get();
            $task = Task::where('task_id',$id)->first();
            return view('admin.task.edit',compact('clients','employees','task'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_id' => 'required|max:255',
			'title' => 'required|max:255',
			//'instructions' => 'required',
			'employees' => 'required',
			"employees"    => "required|array",
			'status' => 'required',
			'start_date' => 'required',
			'start_time' => 'required',
			'end_date' => 'required',
			'end_time' => 'required',
        ]);

        try {

            $employee = Task::where('task_id',$id)->first();
			
            $employee->client_id = $request->client_id;
			$employee->title = $request->title;
			$employee->instructions = $request->instructions;
			$employee->employees = implode(',',$request->employees);
			$employee->status = $request->status;
			$employee->start_date = $request->start_date;
			$employee->start_time = $request->start_time;
			$employee->end_date = $request->end_date;
			$employee->end_time = $request->end_time;
            $employee->save();

            return redirect()->route('admin.task.index')->with('flash_success', 'Task Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Task Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {

            Task::find($id)->delete();
			
            return back()->with('message', 'Task deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Task Not Found');
        }
    }	
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
        $tasks = Task::orderBy('created_at' , 'desc')->get();		
		
		$total_employees = Employee::count();
		$total_clients = Client::count();
		$total_tasks = Task::count();
		
		$boards = Board::orderBy('title','asc')->get();
		
		$clients = Client::orderBy('created_at' , 'desc')->get();
		
		$employees = Employee::where('status','1')->orderBy('name','asc')->get();
		$boards = Board::orderBy('created_at' , 'desc')->get();
        return view('admin.task.schedule1', compact('tasks','total_employees','total_clients','total_tasks','boards','clients','employees','boards'));
    }
	
	public function eventsEmployees()
	{
		$tasks = Task::where('status','!=','Complete')->orderBy('created_at' , 'desc')->get();		
		//dd(Auth::user()->id);
		$events = array();
		if(!empty($tasks))
		{
		
		$i=0;
		foreach($tasks as $task)
		{
		$employees = explode(',',$task->employees);
		/*if(!empty($employees))
		{
		foreach($employees as $emp)
		{*/
		$events[$i]['id'] = $task->task_id;
		//$events[$i]['title'] = $task->client->client_name;
		$events[$i]['resourceIds'] = $employees;
		$events[$i]['title'] = $task->title;
		
		$events[$i]['start'] = $task->start_date.' '.$task->start_time;
		$events[$i]['end'] = $task->end_date.' '.$task->end_time;		
		
		if($task->status=='Complete')
		{
		$className = 'bg-success';
		}
		else
		{
		$className = '';
		}
		
		$events[$i]['color'] = '#e4e9ef';
		$events[$i]['eventType'] = 'Task';
		$events[$i]['eventId'] = $task->task_id;
		
		$i++;
		}
		}
		
		
		
		
		$jobs = Job::where('status','Scheduled')->orderBy('created_at' , 'desc')->get();		
		//dd(Auth::user()->id);
		$events1 = array();
		if(!empty($jobs))
		{
		
		$i=0;
		foreach($jobs as $job)
		{
		$employees = explode(',',$job->employees);
		/*if(!empty($employees))
		{
		foreach($employees as $emp)
		{*/
		$events1[$i]['id'] = $job->job_id;
		//$events[$i]['title'] = $task->client->client_name;
		$events1[$i]['resourceIds'] = $employees;
		$events1[$i]['title'] = $job->title;
		
		$events1[$i]['start'] = $job->start_date.' '.$job->start_time;
		$events1[$i]['end'] = $job->end_date.' '.$job->end_time;		
		
		if($job->status=='Complete')
		{
		$className = 'bg-success';
		}
		else
		{
		$className = '';
		}
		
		$board = Board::where('title',$job->board)->first();
		
		$events1[$i]['color'] = '#e4e9ef';
		$events1[$i]['eventType'] = 'Job';
		$events1[$i]['eventId'] = $job->job_id;
		$i++;
		}
		}
		
		$final = array_merge($events,$events1);
		
        return $final;
	}
	
	
	public function eventDetails($id,$type)
	{
		if($type=='Task')
		{
		$task = Task::where('task_id',$id)->first();		
		}
		else
		{
		$task = Job::where('job_id',$id)->first();
		}
		return view('admin.task.event-details',compact('task','type'));
	}
	
	public function uptStatus($id,$status)
	{
		try {
			$task = Task::where('task_id',$id)->first();
			$task->status = $status;
            $task->save();
			
			
			
            return redirect()->route('admin.task.schedule')->with('flash_success', 'Task Status has been updated');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Task Not Found');
        }
	}
	
	public function resourcesEmployees()
	{
		$employees = Employee::where('status','1')->orderBy('name','asc')->get();
		
		$arr = array();
		$i=0;
		foreach($employees as $employee)
		{
		$arr[$i]['id'] = (string)$employee->employee_id;
		$arr[$i]['title'] = $employee->name;
		$i++;
		}
		
		return response()->json($arr);
	}	
	
	public function updateTime(Request $request)
	{
		$validator = Validator::make($request->all(), [	
			'task_id' => 'required',
			'start_timee' => 'required',
			'end_timee' => 'required'
        ]);  
	
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
	
		try {
			
			$start_timee = $request->start_timee;
			$end_timee = $request->end_timee;
			
			$start_timee1 = Carbon::parse($start_timee)->format('H:i');
			$end_timee1 = Carbon::parse($end_timee)->format('H:i');
			$eventType = $request->eventType;
			if($eventType=='Task')
			{
			$task = Task::where('task_id',$request->task_id)->first();
			$task->start_time = $start_timee1;
			$task->end_time = $end_timee1;
            $task->save();
			}
			else
			{
			$task = Job::where('job_id',$request->task_id)->first();
			$task->start_time = $start_timee1;
			$task->end_time = $end_timee1;
            $task->save();
			}
			
			
			return response()->json(['message'=>'Task information Updated Successfully'.$start_timee1.$end_timee1]);
            
        } 

        catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Something went wrong. Please try again later'],200);
        }
	}
	
	
	public function getJobs(Request $request)
	{
		$job_category = $request->job_category;
		$jobs = Job::where('board',$job_category)->where('status','Pending')->get();
		//dd($jobs);
		return view('admin.task.partials.get-jobs', compact('jobs'));
	
	}
	
	public function dropEvent(Request $request)
	{
		$validator = Validator::make($request->all(), [	
			'eventId' => 'required',
			'start' => 'required',
			//'end_timee' => 'required'
        ]);  
	
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
	
		try {			
			$start_timee = $request->start;
			//$end_timee = $request->end_timee;
			$parseDate = Carbon::parse($start_timee);
			$start_date = $parseDate->format('Y-m-d');
			$start_timee1 = $parseDate->format('H:i');
			
			$end_timee1 = $parseDate->addHours(1)->format('H:i');
			
			
			
			//$end_timee1 = Carbon::parse($end_timee)->format('H:i');
			
			$task = Job::where('job_id',$request->eventId)->first();
			$task->start_date = $start_date;
			$task->start_time = $start_timee1;
			$task->end_date = $start_date;
			$task->end_time = $end_timee1;
			$task->employees = implode(',',$request->resourceIds);
			$task->status = 'Scheduled';
            $task->save();
			
			
			return response()->json(['message'=>'Job information Updated Successfully']);
            
        } 

        catch (ModelNotFoundException $e) {
            return response()->json(['message'=>'Something went wrong. Please try again later'],200);
        }
	}
	
}

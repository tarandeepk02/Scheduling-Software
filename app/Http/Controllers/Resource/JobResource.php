<?php

namespace App\Http\Controllers\Resource;

use App\Models\Job;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Board;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use DB;
use App\Models\LoginActivity;
use Validator;

class JobResource extends Controller
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
		$jobs = Job::orderBy('created_at' , 'desc')->get();		
        return view('admin.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$clients = Client::orderBy('created_at' , 'desc')->get();
		$boards = Board::orderBy('created_at' , 'desc')->get();
		$employees = Employee::where('status','1')->orderBy('created_at' , 'desc')->get();
        return view('admin.job.create',compact('clients','employees','boards'));
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
			'board' => 'required|max:255',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		$job = $request->all();
			//$job['employees'] = implode(',',$request->employees);
			$job = Job::create($job);
			return response()->json(['message'=>'Job Details Saved Successfully']);
        try{
		
			
        } 
        catch (Exception $e) {
			return response()->json(['message'=>'Something went wrong. Please try again later']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $employee = Job::findOrFail($id);
			$activities = LoginActivity::where('admin_id',$id)->orderBy('created_at','desc')->paginate(15);
            return view('admin.job.details', compact('employee','activities'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
			$clients = Client::orderBy('created_at' , 'desc')->get();
			$employees = Employee::where('status','1')->orderBy('created_at' , 'desc')->get();
            $job = Job::where('job_id',$id)->first();
			$boards = Board::orderBy('created_at' , 'desc')->get();
            return view('admin.job.edit',compact('clients','employees','job','boards'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
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
			'board' => 'required',
			'start_date' => 'required',
			'start_time' => 'required',
			'end_date' => 'required',
			'end_time' => 'required',
        ]);

        try {

            $employee = Job::where('job_id',$id)->first();
			
            $employee->client_id = $request->client_id;
			$employee->title = $request->title;
			$employee->instructions = $request->instructions;
			$employee->employees = implode(',',$request->employees);
			$employee->board = $request->board;
			$employee->start_date = $request->start_date;
			$employee->start_time = $request->start_time;
			$employee->end_date = $request->end_date;
			$employee->end_time = $request->end_time;
            $employee->save();

            return redirect()->route('admin.job.index')->with('flash_success', 'Job Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Job Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        try {
            Job::find($id)->delete();			
            return back()->with('message', 'Job deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Job Not Found');
        }
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
        $jobs = Job::orderBy('created_at' , 'desc')->get();		
		
		$total_employees = Employee::count();
		$total_clients = Client::count();
		$total_jobs = Job::count();
		
        return view('admin.job.schedule', compact('jobs','total_employees','total_clients','total_jobs'));
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function schedule1()
    {
        $jobs = Job::orderBy('created_at' , 'desc')->get();		
		
		$total_employees = Employee::count();
		$total_clients = Client::count();
		$total_jobs = Job::count();
		
        return view('admin.job.schedule1', compact('jobs','total_employees','total_clients','total_jobs'));
    }
	
	public function calendarEvents()
	{
		$jobs = Job::orderBy('created_at' , 'desc')->get();		
		//dd(Auth::user()->id);
		$events = array();
		if(!empty($jobs))
		{
		
		$i=0;
		foreach($jobs as $job)
		{
		$events[$i]['id'] = $job->job_id;
		//$events[$i]['title'] = $task->client->client_name;
		$events[$i]['title'] = $job->title;
		$events[$i]['start'] = $job->start_date.' '.date('h:m a',strtotime($job->start_time)+ 60*60);
		$events[$i]['end'] = $job->end_date.' '.date('h:m a',strtotime($job->end_time)+ 60*60);
		
		if($job->status=='Complete')
		{
		$className = 'bg-success';
		}
		else
		{
		$className = '';
		}
		
		$events[$i]['className'] = $className;
		
		$i++;
		}
		}
		
        return $events;
	}
	
	
	public function eventDetails($id)
	{
		$job = Job::where('job_id',$id)->first();		
		return view('admin.job.event-details',compact('job'));
	}
	
	public function uptStatus($id,$status)
	{
		try {
			$job = Job::where('job_id',$id)->first();
			$job->status = $status;
            $job->save();
			
			
			
            return redirect()->route('admin.job.schedule')->with('flash_success', 'Job Status has been updated');
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Job Not Found');
        }
	}
	
	public function resourcesEmployees()
	{
		$employees = Employee::where('status','1')->get();
		
		$arr = array();
		$i=0;
		foreach($employees as $employee)
		{
		$arr[$i]['id'] = $employee->employee_id;
		$arr[$i]['title'] = $employee->name;
		$i++;
		}
		
		return response()->json($arr);
	}
	
	public function eventsEmployees()
	{
		$jobs = Job::where('status','1')->get();
		
		$arr = array();
		$i=0;
		foreach($jobs as $job)
		{
		$arr[$i]['id'] = $job->job_id;
		$arr[$i]['resourceId'] = $job->employee_id; 
		$arr[$i]['title'] = $job->name;
		$i++;
		}
		
		return response()->json($arr);
	}
	
	
}

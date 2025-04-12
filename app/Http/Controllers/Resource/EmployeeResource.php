<?php

namespace App\Http\Controllers\Resource;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use DB;
use Illuminate\Http\Response;
use Validator;

class EmployeeResource extends Controller
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
		$employees = Employee::orderBy('created_at' , 'desc')->get();
        return view('admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
        return view('admin.employee.create');
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
			'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone' => 'required|max:255'
        ],
		[
			'name.required' => 'The name field is required.',
			'email.required' => 'The email field is required.',
			'phone.required' => 'The phone field is required.'
		]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try{
            $employee = $request->all();
			$employee = Employee::create($employee);
			return response()->json(['message'=>'Employee Details Saved Successfully']);
        } 
        catch (Exception $e) {
			return response()->json(['message'=>'Something went wrong. Please try again later']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return view('admin.employee.employee-details', compact('employee'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $employee = Employee::findOrFail($id);
			return response()->json(['success' => '1','employee'=>$employee,'message'=>'']);
			
        } catch (ModelNotFoundException $e) {
			return response()->json(['success' => '0','employee'=>'','message'=>'Something went wrong. Please try again later']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:employees,email,'.$id.',employee_id',
            'phone' => 'required|max:255'
        ],
		[
			'name.required' => 'The name field is required.',
			'email.required' => 'The email field is required.',
			'phone.required' => 'The phone field is required.'
		]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try {

            $employee = Employee::where('employee_id',$id)->first();
            $employee->name = $request->name;
            $employee->email = $request->email;
			$employee->phone = $request->phone;
            $employee->save();
			return response()->json(['message'=>'Employee information Updated Successfully']);
			  
        } 

        catch (ModelNotFoundException $e) {
			return response()->json(['message'=>'Something went wrong. Please try again later'],200);
        }
    }
	

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
			Employee::where('employee_id',$id)->delete();
            return back()->with('flash_success', 'Employee deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Employee Not Found');
        }
    }
	
	public function uptStatus($id,$status)
    {
        try {
			$employee = Employee::findOrFail($id);
			$employee->status = $status;
            $employee->save();
			
			$statusMsg = ($status=='1') ? 'Activated' : 'Inactivated';
			
            return redirect()->route('admin.employee.index')->with('flash_success', 'Employee Status has been '.$statusMsg);
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Employee Not Found');
        }
    }

}

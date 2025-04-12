<?php

namespace App\Http\Controllers\Resource;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use DB;
use Illuminate\Http\Response;
use Validator;

class ClientResource extends Controller
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
		$clients = Client::orderBy('created_at' , 'desc')->get();
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
        return view('admin.client.create');
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
			'title' => 'required|max:255',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'nullable|email|max:255|unique:clients',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try{
            $client = $request->all();
			$client = Client::create($client);
			return response()->json(['message'=>'Client Details Saved Successfully']);
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
            $client = Client::findOrFail($id);
            return view('admin.client.client-details', compact('client'));
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
            $client = Client::findOrFail($id);
			return response()->json(['success' => '1','client'=>$client,'message'=>'']);
			
        } catch (ModelNotFoundException $e) {
			return response()->json(['success' => '0','client'=>'','message'=>'Something went wrong. Please try again later']);
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
			'title' => 'required|max:255',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'email|max:255|unique:clients,email,'.$id.',client_id',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try {
            $client = Client::where('client_id',$id)->first();
            $client->title = $request->title;
            $client->first_name = $request->first_name;
			$client->last_name = $request->last_name;
			$client->company_name = $request->company_name;
			$client->phone_type = $request->phone_type;
			$client->phone = $request->phone;
			$client->email_type = $request->email_type;
			$client->email = $request->email;
			$client->address = $request->address;
			$client->street_number = $request->street_number;
			$client->street_route = $request->street_route;
			$client->city = $request->city;
			$client->state = $request->state;
			$client->postal_code = $request->postal_code;
			$client->country = $request->country;
            $client->save();
			return response()->json(['message'=>'Client information Updated Successfully']);
			  
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
			Client::where('client_id',$id)->delete();
            return back()->with('flash_success', 'Client deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Client Not Found');
        }
    }

}

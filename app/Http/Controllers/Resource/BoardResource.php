<?php

namespace App\Http\Controllers\Resource;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use DB;
use Illuminate\Http\Response;
use Validator;

class BoardResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('demo', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$boards = Board::orderBy('created_at' , 'desc')->get();
        return view('admin.board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {	
        return view('admin.board.create');
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
			'color' => 'required|max:255',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try{
            $board = $request->all();
			$board = Board::create($board);
			return response()->json(['message'=>'Board Details Saved Successfully']);
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
            $board = Board::findOrFail($id);
            return view('admin.board.board-details', compact('board'));
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
            $board = Board::findOrFail($id);
			return response()->json(['success' => '1','client'=>$board,'message'=>'']);
			
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
			'color' => 'required|max:255',
        ]);  
		
		if ($validator->fails())
        {
			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
		
        try {
            $board = Board::where('board_id',$id)->first();
            $board->title = $request->title;
			$board->color = $request->color;
            $board->save();
			return response()->json(['message'=>'Board information Updated Successfully']);
			  
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
			Board::where('board_id',$id)->delete();
            return back()->with('flash_success', 'Board deleted successfully');
        } 
        catch (Exception $e) {
            return back()->with('flash_error', 'Board Not Found');
        }
    }

}

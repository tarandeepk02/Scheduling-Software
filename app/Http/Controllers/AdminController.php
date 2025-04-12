<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use Auth;
use Exception;
use \Carbon\Carbon;

use App\Models\Admin;
use App\Models\Receipt;
use App\Models\Donor;
use DB;
use App\Models\LoginActivity;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    } 


    /**
     * Dashboard.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
		return redirect()->route('admin.task.schedule');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('admin.account.profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function profile_update(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'contact' => 'required|max:255',
            //'email' => 'required|max:255|email|unique:admins',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
			'signature' => 'mimes:jpeg,jpg,bmp,png|max:5242880',
			//'about' => 'required',
        ]);

        try{
            $admin = Auth::guard('admin')->user();
            $admin->name = $request->first_name.' '.$request->last_name;
            //$admin->email = $request->email;
			$admin->contact = $request->contact;
			//$admin->about = $request->about;
            
            if($request->hasFile('picture')){
                $admin->picture = $request->picture->store('admin/profile');  
            }
			
			if($request->hasFile('signature')){
                $admin->signature = $request->signature->store('admin/profile');  
            }
						
            $admin->save();

            return redirect()->back()->with('flash_success','Profile Updated');
        }

        catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('admin.account.change-password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function password_update(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        try {

           $Admin = Admin::find(Auth::guard('admin')->user()->id);

            if(password_verify($request->old_password, $Admin->password))
            {
                $Admin->password = bcrypt($request->password);
                $Admin->save();

                return redirect()->back()->with('flash_success','Password Updated');
            }
        } catch (Exception $e) {
             return back()->with('flash_error','Something Went Wrong!');
        }
    }


}

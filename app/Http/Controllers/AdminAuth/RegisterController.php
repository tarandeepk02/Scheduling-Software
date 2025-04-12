<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Auth\Events\Registered;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/stripe';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /*return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);*/
		
		return Validator::make($data, [
            'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
			
			'phone' => 'required|max:255',
			'firm_name' => 'required|max:255',
			'street_name' => 'required|max:255',
			'city' => 'required|max:255',
			'state' => 'required|max:255'
			
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Admin
     */
    protected function create(array $data)
    {
		$name = $data['first_name'].' '.$data['last_name'];
        $admin = Admin::create([
            'name' => $name,
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
            'password' => bcrypt($data['password']),
			
			'phone' => $data['phone'],
			'firm_name' => $data['firm_name'],
			'street_name' => $data['street_name'],
			'city' => $data['city'],
			'state' => $data['state'],
			'utype' => $data['utype'],
        ]);	
		
		
		return $admin;
			
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
		$states = DB::table('states')->get();
        return view('admin.auth.register',compact('states'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
	
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();
	
		event(new Registered($user = $this->create($request->all())));
	
		$this->guard()->login($user);
	
		return $this->registered($request, $user)
						?: redirect($this->redirectPath());
	}
}

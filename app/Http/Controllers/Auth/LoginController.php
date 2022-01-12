<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
	protected function redirectTo()
	{
		$user=Auth::user();
		if($user->is_verified == true){
			if($user->user_type == 'employer'){
				return '/employerdashboard'; 
			} else if($user->user_type == 'employee') {
				return '/dashboard'; 
			}
		} else {
			return '/home';
		}
	}
//protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function check_login_before_submit(Request $request){
		$email = $request->email;		
		$password = $request->password;
		
		$ifexsists = User::where('email' , '=' , $email)->first();
		if ($ifexsists === null) {
			$data['success'] = 2;

			return response()->json($data);
		} else {
			if( Hash::check( $password, $ifexsists->password) )
			{ 
				$data['success'] = 1;

				return response()->json($data);
			} else {
				$data['success'] = 0;

				return response()->json($data);
			}

		}
	}
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Employee;
use App\IpConfig;
use App\GenerateOtp;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\IpConfigController;
use App\Http\Controllers\JobPostGuestController;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
	protected function redirectTo()
	{
		$user=Auth::user();
		if($user->is_verified == true){
			 if($user->user_type == 'employee') {
				return '/dashboard'; 
			}
		} else {
			if($user->user_type == 'employer'){
				return '/employerdashboard'; 
			} else {
				return '/home';
			}
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_type' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        /*return User::create([
            'user_type' => $data['user_type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);*/
		$insertuser = User::create([
            'user_type' => $data['user_type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_login_ip' => request()->ip(),
        ]);
		
		if($data['user_type'] == 'employee'){
			$employee = new Employee();
			$employee->user_id = $insertuser->id;
			$employee->full_name = $data['name'];
			$employee->full_name = $data['name'];
			$employee->skills = 'Not Mentioned';
			$employee->save();
			
			
		$ifexsists = GenerateOtp::where('user_id', '=', $insertuser->id)->first();
		$str_result = '0123456789';
		$otp = substr(str_shuffle($str_result), 0, 5);

			if ($ifexsists === null) {
				$otpgenerate = new GenerateOtp; 
				$otpgenerate->user_id = $insertuser->id;
				$otpgenerate->otp = $otp;
				$otpgenerate->otp_purpose = 'Verifying Employe';
				$otpgenerate->save();
			} else {
				GenerateOtp::where(['user_id' => $insertuser->id])->update(['otp' => $otp]);
			}
			$sendmail = new SendMailController;
			$sending = $sendmail->sendmailwithuserid($insertuser->id);
		}
		
		$ipconfig = new IpConfigController;
		//$ipCheckAndUpdate = $ipconfig->CheckAndUpdateIpDetails(request()->ip());
		//$ipCheckAndUpdate = $ipconfig->CheckAndUpdateIpDetails(request()->getClientIp());
		$ipCheckAndUpdate = $ipconfig->CheckAndUpdateIpDetails('66.102.0.1');
		
		$moveJobs = new JobPostGuestController;
		$moveJobsToUser = $moveJobs->checkTempAndMoveToJobpost();
		
		return $insertuser;
    }
}

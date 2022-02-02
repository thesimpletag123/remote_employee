<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalFields;
use App\CurrencyType;
use App\GenerateOtp;
use App\Countries;
use Carbon\Carbon;
use App\Employee;
use App\JobPost;
use App\Skills;
use App\User;
use Auth;

class SendMailController extends Controller
{
    public function sendmail(){
	$user = Auth::user();
	$getotp = GenerateOtp::where('user_id' , $user->id)->first();
	
	if($getotp->otp_purpose == 'Verifying Employe'){
		$details = [
			'title' => 'OTP for login Remote Employee',
			'username' => $user->name,
			'otp' => $getotp->otp
			];

		\Mail::to($user->email)->send(new \App\Mail\SendOtp($details));
		}
	return true;
	}
	
	public function sendinvoicemail(Request $request){
	$jobid = $request->jobid;
	$requesteduser = $user = Auth::user();

	$getjobwithidnew = new JobPost;
	$getjobbyid = $getjobwithidnew->GetJobByID($jobid);

	$getempdetails = new Employee;
	$getempbyid = $getempdetails->getemployedetails($getjobbyid->assigned_to_id);
	
	
	$details = ['requesteduser' => $requesteduser, 'getjobbyid' => $getjobbyid , 'getempbyid' => $getempbyid];

		\Mail::to($user->email)->send(new \App\Mail\SendOtp($details));
		
	return true;
	}
}

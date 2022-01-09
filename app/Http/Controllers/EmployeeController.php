<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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


class EmployeeController extends Controller
{
	public function emp1_submit(Request $request)
    {
		$user_image =null;
		$emp_fname = $request->emp_fname;
		$emp_email = $request->emp_email;
		$emp_phone_ext = $request->emp_phone_ext;
		$emp_phone_no = $request->emp_phone_no;
		$emp_country = $request->emp_country;
		$emp_professional_fields = $request->emp_professional_fields;
		
		if($request->file('user_image')){
				$file = $request->file('user_image');
				$filename = time()."-".$file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension();
				$location = "uploads";
				$file->move($location,$filename);
				$filepath = url('uploads/'. $filename);
				
				
			}
			
		if (Auth::user()) {
			$user = Auth::user();
			User::where(['id' => $user->id])->update([
													'user_type' => 'employee',
													'name' => $request->emp_fname,
													'country' => $request->emp_country
													]);
		
			$userid = $user->id;
			$data['success'] = 1;
			$data['message'] = 'User Profile Updated Successfully';
			
		} else {
			$usercheck = User::where('email', '=', $emp_email)->first();
			if ($usercheck === null) {
				$insertuser = new User;
				$insertuser->name = $emp_fname;
				$insertuser->email = $emp_email;
				$insertuser->user_type = 'employee';
				$insertuser->user_image = $user_image;
				$insertuser->country = $emp_country;
				$insertuser->password = Hash::make('password');
				$insertuser->save();
				
				$userid = $insertuser->id;
				
				Auth::loginUsingId($userid);
				
				$data['success'] = 1;
				$data['message'] = 'New User Added sucessfully';
				
			} else{
				User::where(['id' => $usercheck->id])->update([
													'user_type' => 'employee',
													'name' => $emp_fname,
													'country' => $emp_country
													]);
													
				$userid = $usercheck->id;
				Auth::loginUsingId($userid);
				
				$data['success'] = 1;
				$data['message'] = 'Profile Updated sucessfully, You are now LoggedIn.';
			}
		}
		
		$ifexsists = Employee::where('user_id', '=', $userid)->first();
		if ($ifexsists === null) {
			$emp1 = new Employee; 
			$emp1->user_id = $userid;
			$emp1->full_name = $request->emp_fname;
			$emp1->contact_no = $request->emp_phone_ext.$request->emp_phone_no;
			$emp1->professional_field = $request->emp_professional_fields;
			$emp1->save();
			
		} else {
			Employee::where(['user_id' => $userid])->update([
													'full_name' => $request->emp_fname,
													'contact_no' => $request->emp_phone_ext.$request->emp_phone_no,
													'professional_field' => $request->emp_professional_fields
							]);
		}
		
		return response()->json($data);	
	}
	public function emp2_submit(Request $request)
    {
		$data = array();
		$otp = null;
		$user = Auth::user();
		
		// Upload file  to "Uploads" folder and get the file path
		if($request->file('file')){
			$file = $request->file('file');
			$filename = time()."-".$file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$location = "uploads";
			$file->move($location,$filename);
			$filepath = url('uploads/'. $filename);
			
			$data['success'] = 1;
			$data['message'] = 'File Uploaded sucessfully';
			$data['filepath'] = $filepath;
			$data['extension'] = $extension;
		} else {
			$data['success'] = 2;
			$data['message'] = 'File not Uploaded.';
			$filepath = null;
			$data['filepath'] = 'No FILE Available.';
		}
		
			
		// Insert datas into DB
		
		if(is_array($request->emp_skills)){
			$skills = implode(",",$request->emp_skills);
		} else {
			$skills = $request->emp_skills;
		}
		if($request->emp_extra_skills){
			$addnewjobskill = new Skills;
			$newskill = $addnewjobskill->CheckAndUpdateSkill($request->emp_extra_skills);
		}
		
		$exp_yr = $request->exp_yr;
		$exp_month = $request->exp_month;
		$experience_in_month = ( $exp_yr*12) + $exp_month;
		
		Employee::where(['user_id' => $user->id])->update([
													'skills' => $skills,
													'extra_skills' => $request->emp_extra_skills,
													'experience_in_month' => $experience_in_month,
													'resume' => $filepath
							]);
		$ifexsists = GenerateOtp::where('user_id', '=', $user->id)->first();
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$otp = substr(str_shuffle($str_result), 0, 5);

		if ($ifexsists === null) {
			$otpgenerate = new GenerateOtp; 
			$otpgenerate->user_id = $user->id;
			$otpgenerate->otp = $otp;
			$otpgenerate->otp_purpose = 'Verifying Employe';
			$otpgenerate->save();
		} else {
			GenerateOtp::where(['user_id' => $user->id])->update(['otp' => $otp]);
		}		
		return response()->json($data);
	}
	
	public function emp_otp_verify(Request $request)
    {
		$user = Auth::user();
		$ifexsists = GenerateOtp::where('user_id', '=', $user->id)->first();
		if ($ifexsists) {
			$otp_in_db = $ifexsists->otp;
			$Otp_entered = $request->otp;
			
			if($otp_in_db == $Otp_entered){
				echo "OTP Verfied. Welcome ".$user->name;
				$updateuser = User::where(['id' => $user->id])->update(['is_verified' => true]);
				$updateemp = Employee::where(['user_id' => $user->id])->update(['is_verified' => true]);
				$deletedfromotp = GenerateOtp::where('user_id', $user->id)->delete();
				
			} else {
				die('ERROR');
			}			
		}
		return 'qq';
        
	}
	public function baseurllogin(){
		$user = Auth::user();
		$Countriesnew = new Countries();
		$countries = $Countriesnew->countrylist();

		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		//$employeenew = new Employee();
		//$employeies = $employeenew->employeeList();
		$employeies = null;
		
		$professionalfieldsnew = new ProfessionalFields();
		$professional_fields = $professionalfieldsnew->professionalfieldnames();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
			//echo "aaaa";
			//var_dump($skills);

		return view('landingpage', ['user' => $user, 'countries' =>$countries, 'currencies' =>$currencies, 'employeies' =>$employeies, 'professional_fields' =>$professional_fields, 'skills' =>$skills ] );
	}
}

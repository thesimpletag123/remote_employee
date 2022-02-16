<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalFields;
use App\Countries;
use App\CurrencyType;
use App\GenerateOtp;
use App\Employee;
use App\JobPost;
use App\Skills;
use App\User;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$user = Auth::user();
		$Countriesnew = new Countries();
		$countries = $Countriesnew->countrylist();

		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$employeenew = new Employee();
		$employeies = $employeenew->employeeList();

		$professionalfieldsnew = new ProfessionalFields();
		$professional_fields = $professionalfieldsnew->professionalfieldnames();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
			
		if($user->is_verified == true){
			return redirect()->route('dashboard');
		} else {
			return view('landingpage', ['user' => $user, 'countries' =>$countries, 'currencies' =>$currencies, 'employeies' =>$employeies, 'professional_fields' =>$professional_fields, 'skills' =>$skills ] );
		}
    }

	
	public function dashboard()
    {
		$user = Auth::user();
		
	
		$date = Carbon::now($user->country);
		
		$Countriesnew = new Countries();
		$countries = $Countriesnew->countrylist();

		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$employeenew = new Employee();
		$employeies = $employeenew->employeeList();

		$professionalfieldsnew = new ProfessionalFields();
		$professional_fields = $professionalfieldsnew->professionalfieldnames();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		$alljobsnew = new JobPost();
		$alljobslist = $alljobsnew->GetAllJobsList();
		
		return view('dashboard', ['user' => $user, 'countries' =>$countries, 'currencies' =>$currencies, 'employeies' =>$employeies, 'professional_fields' =>$professional_fields, 'skills' =>$skills, 'date' => $date, 'alljobslist' => $alljobslist]);
	}
	public function profilesetting($request)
    {	

		$user = User::find($request);
		$date = Carbon::now($user->country);
		
		$employeenew = new Employee();
		$employedetail = $employeenew->getemployedetails($user->id);
		
		$alljobsnew = new JobPost();
		$alljobslist = $alljobsnew->GetAllJobsList();
		//var_dump($alljobslist);
		//die();

		return view('profilesetting', ['user' => $user, 'date' => $date, 'employedetail' => $employedetail, 'alljobslist' => $alljobslist]);
	}
	public function update_profile_img(Request $request)
	{//die('as');
		
		$userid = $request->hidden_uid;
		
		if($request->file('user_image')){
			$file = $request->file('user_image');
			$filename = time()."-".$file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$location = "uploads";
			$file->move($location,$filename);
			$filepath = url('uploads/'. $filename);
			User::where(['id' => $userid])->update(['user_image' => $filepath]);
			return response()->json($filepath);
		}
	}
	public function update_employer_role()
	{
		$user = Auth::user();
		User::where(['id' => $user->id])->update(['user_type' => 'employer']);
		
	}
	public function update_employer_quick(Request $request)
	{
		$user = Auth::user();
		
		$quick_project_desc = $request->quick_project_desc;
		$quick_min_budget = $request->quick_min_budget;
		$quick_max_budget = $request->quick_max_budget;
		$quick_currency = $request->quick_currency;
		$quick_email = $request->quick_email;
		$quick_country = $request->quick_country;
		$quick_contact_ext = $request->quick_contact_ext;
		$quick_contact_no = $request->quick_contact_no;
		
		$quick_job_post = new JobPost;
		$quick_job_post->job_title = "Quick Job Post by - ".$user->name;
		$quick_job_post->required_skills = "Not Maintioned";
		$quick_job_post->hourly_rate_min = "N. A.";
		$quick_job_post->hourly_rate_max = "N. A.";
		$quick_job_post->project_budget = $quick_min_budget .' '. $quick_currency . ' - ' . $quick_max_budget .' '. $quick_currency;
		$quick_job_post->project_description = $quick_project_desc;
		$quick_job_post->posted_by_username = $user->name;
		$quick_job_post->posted_by_id = $user->id;
		
		$quick_job_post->save();
		
		$data['success'] = 1;
		$data['message'] = 'Quick job Posted Sucessfully';
		
		return response()->json($data);
	}
	
	public function otp_gen_for_find_emp(Request $request)
	{
		$user = Auth::user();
		$ifexsists = GenerateOtp::where('user_id', '=', $user->id)->first();
		//$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$str_result = '0123456789';
		$otp = substr(str_shuffle($str_result), 0, 5);

		if ($ifexsists === null) {
			$otpgenerate = new GenerateOtp; 
			$otpgenerate->user_id = $user->id;
			$otpgenerate->otp = $otp;
			$otpgenerate->otp_purpose = 'Verifying Employer for finding new Employee';
			$otpgenerate->save();
		} else {
			GenerateOtp::where(['user_id' => $user->id])->update(['otp' => $otp]);
		}
	}
	
	public function verify_fulltime_employer(Request $request)
	{	
		$user = Auth::user();
		$getotp = GenerateOtp::where('user_id', '=', $user->id)->first();
		//var_dump($getotp);
			$otp_in_db = $getotp->otp;
			
			$Otp_entered = $request->otp;
			
			if($otp_in_db == $Otp_entered){
				$updateuser = User::where(['id' => $user->id])->update(['is_verified' => true]);
				$updateemp = Employee::where(['user_id' => $user->id])->update(['is_verified' => true]);
				$deletedfromotp = GenerateOtp::where('user_id', $user->id)->delete();
				if(is_array($request->fulltime_job_skills)){
					$fulltime_job_skills = implode('-', $request->fulltime_job_skills);
				} else {
					$fulltime_job_skills = $request->fulltime_job_skills;
				}
				$postjob = new JobPost;
				
				$postjob->job_title = $request->fulltime_job_headline;
				$postjob->required_skills = $fulltime_job_skills.'-'.$request->fulltime_job_extra_skill;
				if($request->fulltime_job_min){
					$postjob->hourly_rate_min = $request->fulltime_job_min.' '.$request->fulltime_job_currency_minmax;
				}
				if($request->fulltime_job_max){
						$postjob->hourly_rate_max = $request->fulltime_job_max.' '.$request->fulltime_job_currency_minmax;
				}
				if($request->fulltime_job_budget){
						$postjob->project_budget = $request->fulltime_job_budget.' '.$request->fulltime_project_budget_currency;
				}
				$postjob->project_description = $request->fulltime_job_desc_budget;
				$postjob->posted_by_username = $user->name;
				$postjob->posted_by_id = $user->id;			
				$postjob->save();
				
				$data['success'] = 1;
				$data['message'] = 'Posted Sucessfully';

				return response()->json($data);
				
			} else {
				$data['success'] = 2;
				$data['message'] = 'Failed.. please retry';

				return response()->json($data);
			}
		}
		
		public function myprofile(){
			$user = Auth::user();
			
			if($user->user_type == "employer"){
				$date = Carbon::now($user->country);		
				$availablejob = new JobPost;
				$employerposts = $availablejob->GetJobsOfEmployer($user->id);
				
				$currencynew = new CurrencyType();
				$currencies = $currencynew->currencyList();

				$skillsnew = new Skills();
				$skills = $skillsnew->skillnames();
				
				$allinvoicenew = new JobPost;
				$allinvoice = $allinvoicenew->GetInvoiceWithDetails();
				
				$employeenew = new Employee();
				$employeies = $employeenew->employeeList();
				
				$employeeavailablenew = new Employee;
				$employeeavailable = $employeeavailablenew->AvailableEmployees();
				
				$alljobsnew = new JobPost();
				$alljobslist = $alljobsnew->GetAllJobsList();
				
				$useremployees = User::all();
				
				$assignedemployeenew = new JobPost;
				$assignedemployee = $assignedemployeenew->AssignedEmployees();

				$getjobwithidnew = new JobPost;
				$getjobbyid = $getjobwithidnew->GetJobByID(1);
				
				return view('employer-profile', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'skills' => $skills, 'employerposts' => $employerposts, 'employeeavailable' => $employeeavailable , 'useremployees' => $useremployees, 'allinvoice' => $allinvoice, 'assignedemployee' => $assignedemployee, 'employeies'=> $employeies, 'alljobslist' => $alljobslist]);
			} else if ($user->user_type == "employee"){
				
				$date = Carbon::now($user->country);		
				$Countriesnew = new Countries();
				$countries = $Countriesnew->countrylist();

				$currencynew = new CurrencyType();
				$currencies = $currencynew->currencyList();

				$employeenew = new Employee();
				$employeies = $employeenew->employeeList();

				$professionalfieldsnew = new ProfessionalFields();
				$professional_fields = $professionalfieldsnew->professionalfieldnames();

				$skillsnew = new Skills();
				$skills = $skillsnew->skillnames();
				
				$alljobsnew = new JobPost();
				$alljobslist = $alljobsnew->GetAllJobsList();
				
				return view('employee-profile', ['user' => $user, 'countries' =>$countries, 'currencies' =>$currencies, 'employeies' =>$employeies, 'professional_fields' =>$professional_fields, 'skills' =>$skills, 'date' => $date, 'alljobslist' => $alljobslist]);
			} else {
				return redirect('/home')->with('success', 'No UserType assigned to you.');
			}
		}
		
	public function employeeprofileupdate(Request $request){
		$user = Auth::user();
		$name = $request->name;
		//$my_skills = $request->my_skills;
		$contact = $request->contact;
		$experience_yr = $request->experience_yr;
		$experience_month = $request->experience_month;
		$experience = ($experience_yr * 12 ) + $experience_month;
		$getmypreviousskills = new Employee;
		$mypreviousskills = $getmypreviousskills->GetCurrentUserSkill();
		
		/*if($my_skills !=''){
			$addskill = implode('-',$my_skills);
			$newskillset = $mypreviousskills.'-'.$addskill;
		} else {
			$newskillset = $mypreviousskills;
		}*/
		User::where('id' , $user->id)->update(['name' => $name]); 
		Employee::where('user_id', $user->id)
					->update([
					'full_name' => $name, 
					'contact_no' => $contact,
					'experience_in_month' => $experience,
					]);
		
		return redirect()->back()->with('success', 'Profile Updated..');
	}
	
	public function employerprofileupdate(Request $request){
		$user = Auth::user();
		$prename = $user->name;
		$name = $request->name;
		User::where('id' , $user->id)->update(['name' => $name]);
		JobPost::where('posted_by_id' , $user->id)->update(['posted_by_username' => $name]);
		//$msg = "Congratulation. You have successfylly modified your name from '".$prename."' to '".$name."'";
		$msg = "Saved Successfully.";
		return redirect()->back()->with('success', $msg);
	}
	
	public function employeerateupdate(Request $request){
		
		$job_id = $request->job_id;
		$budget = null;
		$min = null;
		$max = null;
		
		if($request->budget_rate != null){
			$budgetrate = $request->budget_rate;
			$budgetcurrency = $request->budget_currency;
			$budget = $budgetrate.' '.$budgetcurrency;
		} else {
			$minrate = $request->minrate;
			$maxrate = $request->maxrate;
			$minrate_currency = $request->minrate_currency;
			$maxrate_currency = $request->maxrate_currency;
			$min = $minrate.' '.$minrate_currency;
			$max = $maxrate.' '.$maxrate_currency;
		}
		
		JobPost::where('id' , $job_id)->update([
									'hourly_rate_min' => $min,
									'hourly_rate_max' => $max,
									'project_budget' => $budget,
									]);
		

		return redirect()->back()->with('success', 'Profile Updated..');
	}
	
	public function employeskillupdate(Request $request){
		$user_id = $request->hidden_uid;
		$user = User::find($user_id);
		$allskills = $request->my_skills;
		if($user->skills != $allskills){
			$skills = implode('-',$allskills);
		} else {$skills = $allskills;}
		//var_dump($allskills);
		//die();
		Employee::where('user_id', $user_id)->update(['skills' => $skills]);
		
		return redirect()->back()->with('success', 'Your Skill Set has Updated.');
		
	}
}

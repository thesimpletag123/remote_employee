<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalFields;
use App\Countries;
use App\CurrencyType;
use App\GenerateOtp;
use App\Employee;
use App\Skills;
use App\User;
use App\JobPost;
use App\JobRequest;
use App\JobTracker;
use Auth;
use PDF;
use Mail;
use Carbon\Carbon;
use Session;
use Storage;

class JobPostController extends Controller
{
    public function jobpostview(){
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		return view('jobpost', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'skills' => $skills]);
	}
	
	public function submit_quick_project(Request $request)
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
		$quick_job_post->hourly_rate_min = $quick_min_budget .' '. $quick_currency;
		$quick_job_post->hourly_rate_max = $quick_max_budget .' '. $quick_currency;
		$quick_job_post->project_description = $quick_project_desc;
		$quick_job_post->posted_by_username = $user->name;
		$quick_job_post->posted_by_id = $user->id;
		
		$quick_job_post->save();		
		User::where(['id' => $user->id])->update(['user_type' => 'employer']);
		
		Session::put('quick_project_desc', '' );
		Session::put('quick_min_budget', '' );
		Session::put('quick_max_budget', '' );
		Session::put('quick_currency', '' );
		
		
		$data['success'] = 1;
		$data['message'] = 'Quick job Posted Sucessfully';
		
		return redirect('employerdashboard')->with('success', 'Project Submitted');
	}
	
	public function jobpost_to_db(Request $request){
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		if(is_array($request->get('emp_skills'))){
			$job_skills = implode(",",$request->get('emp_skills'));
		} else {
			$job_skills = $request->get('emp_skills');
		}		
		$job_title = $request->get('job_title');
		$job_desc = $request->get('job_desc');		
		$job_budget = $request->get('job_budget');
		$job_budget_currency = $request->get('job_budget_currency');
		$job_rate = $request->get('job_rate');
		$job_hour_rate_currency = $request->get('job_hour_rate_currency');
		$job_deadline = $request->get('job_deadline');
		
		$job_post_employer = new JobPost;
		$job_post_employer->job_title = $job_title;
		$job_post_employer->required_skills = $job_skills;
		
		if($job_rate){
			$job_post_employer->hourly_rate_min = $job_rate.' '.$job_hour_rate_currency;
		}		
		if($job_budget){
			$job_post_employer->project_budget = $job_budget.' '.$job_budget_currency;
		}
		
		$job_post_employer->project_description = $job_desc;
		$job_post_employer->posted_by_username = $user->name;
		$job_post_employer->posted_by_id = $user->id;
		$job_post_employer->save();
		
		
		return redirect()->route('dashboard')->with('success', 'Job Posted Sucessfully');
	}
	
	
	public function setsession_for_popups(Request $request){
		$popup_type = $request->popup;
		Session::put('popup_type', $popup_type );
		
		
		// Quick Project post
		if($popup_type == 'quick_project'){
			$quick_project_desc = $request->quick_project_desc;
			$quick_min_budget = $request->quick_min_budget;
			$quick_max_budget = $request->quick_max_budget;
			$quick_currency = $request->quick_currency;		
		
			Session::put('quick_project_desc', $quick_project_desc );
			Session::put('quick_min_budget', $quick_min_budget );
			Session::put('quick_max_budget', $quick_max_budget );
			Session::put('quick_currency', $quick_currency );
			
			$data['success'] = 1;
			$data['message'] = 'quick_project';
			
					
		} elseif($popup_type == 'full_or_part_project'){
			$fulltime_job_headline = $request->fulltime_job_headline;
			$fulltime_job_skills = $request->fulltime_job_skills;
			if(is_array($fulltime_job_skills)){
				$fulltime_job_skills = implode(',' , $fulltime_job_skills);
			}
			$fulltime_job_extra_skill = $request->fulltime_job_extra_skill;
			$fulltime_job_min = $request->fulltime_job_min;
			$fulltime_job_max = $request->fulltime_job_max;
			$fulltime_job_currency_minmax = $request->fulltime_job_currency_minmax;
			$fulltime_job_budget = $request->fulltime_job_budget;
			$fulltime_project_budget_currency = $request->fulltime_project_budget_currency;
			$fulltime_job_desc_minmax = $request->fulltime_job_desc_minmax;
			$fulltime_job_desc_budget = $request->fulltime_job_desc_budget;
			
			Session::put('fulltime_job_headline', $fulltime_job_headline );
			Session::put('fulltime_job_skills', $fulltime_job_skills );
			Session::put('fulltime_job_extra_skill', $fulltime_job_extra_skill );
			Session::put('fulltime_job_min', $fulltime_job_min );
			Session::put('fulltime_job_max', $fulltime_job_max );
			Session::put('fulltime_job_currency_minmax', $fulltime_job_currency_minmax );
			Session::put('fulltime_job_budget', $fulltime_job_budget );
			Session::put('fulltime_project_budget_currency', $fulltime_project_budget_currency );
			Session::put('fulltime_job_desc_minmax', $fulltime_job_desc_minmax );
			Session::put('fulltime_job_desc_budget', $fulltime_job_desc_budget );
			
			$data['success'] = 1;
			$data['message'] = 'fulltime_project';
		}
		return response()->json($data);	
	}
	public function unset_popup_sessions(){
		Session::put('popup_type', '' );
	}
	

	public function submit_full_project(Request $request)
	{	
		$user = Auth::user();	
		$updateuser = User::where(['id' => $user->id])->update(['is_verified' => true , 'user_type' => 'employer']);
		$updateemp = Employee::where(['user_id' => $user->id])->update(['is_verified' => true]);
		//$deletedfromotp = GenerateOtp::where('user_id', $user->id)->delete();

		if($request->fulltime_job_extra_skill){
			$addnewjobskill = new Skills;
			$newskill = $addnewjobskill->CheckAndUpdateSkill($request->fulltime_job_extra_skill);
		}
		
		if(is_array($request->fulltime_job_skills)){
			$fulltime_job_skills = implode('-', $request->fulltime_job_skills);
		} else {
			$fulltime_job_skills = $request->fulltime_job_skills;
		}
		$postjob = new JobPost;
		
		$postjob->job_title = $request->fulltime_job_headline;
		
		/*if($request->fulltime_job_extra_skill){
			$postjob->required_skills = $fulltime_job_skills.'-'.$request->fulltime_job_extra_skill;
		} else {
			$postjob->required_skills = $fulltime_job_skills;
		}*/
		if($fulltime_job_skills){
				if($request->fulltime_job_extra_skill){
					$postjob->required_skills = $fulltime_job_skills.'-'.$request->fulltime_job_extra_skill;
				} else {
					$postjob->required_skills = $fulltime_job_skills;
				}
		} else {
			$postjob->required_skills = $request->fulltime_job_extra_skill;
		}
		
		if($request->fulltime_job_min){
			$postjob->hourly_rate_min = $request->fulltime_job_min.' '.$request->fulltime_job_currency_minmax;
		}
		if($request->fulltime_job_max){
				$postjob->hourly_rate_max = $request->fulltime_job_max.' '.$request->fulltime_job_currency_minmax;
		}
		if($request->fulltime_job_budget){
				$postjob->project_budget = $request->fulltime_job_budget.' '.$request->fulltime_project_budget_currency;
		}
		$postjob->project_description = $request->fulltime_job_desc_minmax.$request->fulltime_job_desc_budget;
		$postjob->posted_by_username = $user->name;
		$postjob->posted_by_id = $user->id;		
		$postjob->save();
		
		$data['success'] = 1;
		$data['message'] = 'Full-time Job Posted Sucessfully';

		return response()->json($data);		
		
	}
	public function employerdashboard(){
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$availablejob = new JobPost;
		$employerposts = $availablejob->GetJobsOfEmployer($user->id);
		
		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$skillsnew = new Skills();
		$allskills = $skillsnew->skillnames();
		
		$allinvoicenew = new JobPost;
		$allinvoice = $allinvoicenew->GetInvoiceWithDetails();
		
		$employeeavailablenew = new Employee;
		$employeeavailable = $employeeavailablenew->AvailableEmployees();
		
		
		$useremployees = User::all();
		
		$assignedemployeenew = new JobPost;
		$assignedemployee = $assignedemployeenew->AssignedEmployees();
		
		/*foreach ($assignedemployee as $skill){
			print_r ($skill->user->name);
			echo "=================";
			echo "<br>";
			echo "<br>";
		}
		die();*/
		
		
		return view('employerdashboard', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'allskills' => $allskills, 'employerposts' => $employerposts, 'employeeavailable' => $employeeavailable , 'useremployees' => $useremployees, 'allinvoice' => $allinvoice, 'assignedemployee' => $assignedemployee]);

	}
	
	public function assign_job_to_emp(Request $request){
		$jobid = $request->jobid;
		$empid = $request->empid;
		
		$user = Auth::user();
		$userid = $user->id;
		$empname = User::find($empid);
		$assignjob = JobPost::where(['id' => $jobid])->update(['assigned_to_id' => $empname->id, 'assigned_to_username' => $empname->name]);
		
		$from_usernew = new User; 
		$from_user = $from_usernew->GetUserById($userid);		
		
		$to_usernew = new User; 
		$to_user = $to_usernew->GetUserById($empid);
		
		
		
		
		$ifexsists = JobRequest::where('job_id' , '=' , $jobid)->first();
		if ($ifexsists === null) {
			$post_job_request = new JobRequest;
			$post_job_request->job_id = $jobid;
			$post_job_request->request_as = $from_user->user_type;
			$post_job_request->from_userid = $from_user->id;
			$post_job_request->from_username = $from_user->name;
			$post_job_request->to_userid = $to_user->id;
			$post_job_request->to_username = $to_user->name;
			$post_job_request->is_accept = false;			
			$post_job_request->save();
		} else {
			JobRequest::where('job_id', $jobid)
					->update(['to_userid' => $to_user->id, 'to_username' => $to_user->name]);
		}
		
		$data['success'] = 1;
		$data['message'] = 'Assigned to'. $empname;

		return response()->json($data);		 
	}
	
	public function editjobview($jobid){
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();
		
		$getjobupdatebyidnew = new JobTracker;
		$getjobupdatebyid = $getjobupdatebyidnew->GetJobUpdateByJobid($jobid);
		//print_r($getjobupdatebyid);
		//die('aaaaaaaaaaaaaa');
		
		
		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($jobid);
		
		$alljobsnew = new JobPost();
		$alljobslist = $alljobsnew->GetAllJobsList();
		
		return view('jobpostview', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'skills' => $skills, 'getjobbyid' => $getjobbyid, 'getjobupdatebyid' => $getjobupdatebyid , 'alljobslist' => $alljobslist]);
		
	}
	
	public function editjobrequest(Request $request){
		$job_budget = null;
		$job_min_rate = null;
		
		$jobid = $request->get('hidden_jobid');
		$userid = $request->get('hidden_uid');
		
		$job_title = $request->get('job_title');
		$job_description = $request->get('job_desc');
		$emp_skills = implode('-' , $request->get('emp_skills'));
		$job_extra_skills = $request->get('job_extra_skills');
			if($job_extra_skills){
				$emp_skills = $emp_skills. '-' . $job_extra_skills;
				$addnewjobskill = new Skills;
				$newskill = $addnewjobskill->CheckAndUpdateSkill($job_extra_skills);
			}
		if($request->get('job_max_rate') != null){
			$job_max_rate = $request->get('job_max_rate'). ' ' . $request->get('job_max_rate_currency');
		}
		if($request->get('job_min_rate') != null){
			$job_min_rate = $request->get('job_min_rate'). ' ' .$request->get('job_min_rate_currency');
		}
		$job_deadline = $request->get('job_deadline');
		
		$updatejob = JobPost::where('id', $jobid)
					->update([
						'job_title' => $job_title, 
						'required_skills' => $emp_skills,
						'hourly_rate_min' => $job_min_rate,
						'hourly_rate_max' => $job_max_rate,
						'project_description' => $job_description,
						'deadline' => $job_deadline
						]);
						
		
		return redirect()->route('employerdashboard')->with('success', 'Job Updation Successfull.');
		
	}
	
	public function delete_job(Request $request){
		$jobid = $request->jobid;		
		$deletejob = JobPost::where('id', $jobid)->delete();
		//return redirect()->route('employerdashboard')->with('success', 'Job Deleted.');
		$data['success'] = 1;
		$data['message'] = 'Job Deleted Successfully.';
		return response()->json($data);
	}
	
	public function update_job_by_employee($request){
		$jobid = $request->jobid;
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($jobid);
		
		$getjobupdatebyidnew = new JobTracker;
		$getjobupdatebyid = $getjobupdatebyidnew->GetJobUpdateByJobid($request);
		
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		return view('viewjobemployee', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'skills' => $skills, 'getjobbyid' => $getjobbyid, 'getjobupdatebyid' => $getjobupdatebyid]);
	}
	
	public function viewjobemployee($request){
		//echo $request;
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($request);
		
		$getjobupdatebyidnew = new JobTracker;
		$getjobupdatebyid = $getjobupdatebyidnew->GetJobUpdateByJobid($request);
		
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$currencynew = new CurrencyType();
		$currencies = $currencynew->currencyList();

		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		return view('viewjobemployee', ['user' => $user, 'date' => $date, 'currencies' => $currencies, 'skills' => $skills, 'getjobbyid' => $getjobbyid, 'getjobupdatebyid' => $getjobupdatebyid]);
	}
	
	public function change_project_status(Request $request){
		$projectid = $request->projectid;
		$newstatus = $request->newstatus;
		$updatejob = JobPost::where('id', $projectid)->update(['project_status' => $newstatus]);
		$data['success'] = 1;
		return response()->json($data);
	}
	
	public function invoice_generate_for_completed_projects(Request $request){
		$jobid = $request->jobid;
		$requesteduser = $user = Auth::user();
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($jobid);
		
		$getempdetails = new Employee;
		$getempbyid = $getempdetails->getemployedetails($getjobbyid->assigned_to_id);
		
		$filename = 'remoteemployee_invoice_'.time().'.pdf';
		$data = ['requesteduser' => $requesteduser, 'getjobbyid' => $getjobbyid , 'getempbyid' => $getempbyid, 'email'=>$getempbyid->user->email, 'filename' => $filename];
		
		// Generate PDF
		$pdf = PDF::loadView('pdf.invoicebyemployer', $data);
		
		//Upload PDF
		$path = public_path('uploads/');
		$filepath = $path . '/' . $filename;
		$pdf->save($path . '/' . $filename);
		JobPost::where(['id' => $jobid])->update(['invoice_attachment' => $filepath]);
		
		
		// Send Invoice Mail with PDF Attachment
		Mail::send('emails.sendinvoice', $data, function($message)use($data, $pdf) {
            $message->to($data["email"])
                    ->subject('Invoice from RemoteEmployee')
                    ->attachData($pdf->output(), $data["filename"]);
        });
		$data['success'] = 1;
		return response()->json($data);
	}
	
	public function show_invoice_only(Request $request){
		$jobid = $request->jobid;
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($jobid);
		$data = $getjobbyid['invoice_attachment'];
		
		return response()->json($data);
	}
}

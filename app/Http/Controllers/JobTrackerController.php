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
use Carbon\Carbon;
use Session;

class JobTrackerController extends Controller
{
    public function employeetimeupdate(Request $request){
		$user_id = $request->hidden_uid;
		$jobid = $request->hidden_jobid;
		
		$emp_work_headline = $request->emp_work_headline;
		$emp_work_desc = $request->emp_work_desc;
		$emp_work_time = $request->emp_work_time;
		
		$updatejobtracknew = new JobTracker;
		$updatejobtracknew->jobid = $jobid;
		$updatejobtracknew->user_id = $user_id;
		$updatejobtracknew->jobupdate_headline = $emp_work_headline;
		$updatejobtracknew->jobupdate_description = $emp_work_desc;
		$updatejobtracknew->jobupdate_time = $emp_work_time;
		$updatejobtracknew->jobupdate_status = 'active';
		
		$updatejobtracknew->save();	
		
		return redirect('dashboard')->with('success', 'Your update posted successfully.');
	}
	
	public function trackjob(Request $request){
		$jobid = $request->jobid;
		$user = Auth::user();
		$date = Carbon::now($user->country);
		
		$skillsnew = new Skills();
		$skills = $skillsnew->skillnames();
		
		$getjobwithidnew = new JobPost;
		$getjobbyid = $getjobwithidnew->GetJobByID($jobid);
		
		$getjobupdatebyidnew = new JobTracker;
		$getjobupdatebyid = $getjobupdatebyidnew->GetJobUpdateByJobid($jobid);
		
		$alljobsnew = new JobPost();
		$alljobslist = $alljobsnew->GetAllJobsList();
		
		return view('employertrackjob', ['user' => $user, 'date' => $date, 'getjobbyid' => $getjobbyid, 'getjobupdatebyid' => $getjobupdatebyid, 'alljobslist' => $alljobslist, 'skills' => $skills]);
	}
}

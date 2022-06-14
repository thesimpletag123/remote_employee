<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\JobPost;
use App\JobPostGuest;
use App\User;
use Session;

class JobPostGuestController extends Controller
{
    public function checkTempAndMoveToJobpost(){
		$user=Auth::user();
		//$sessionid = Session::getId();
		$ip = request()->ip();
		
		//$ifexsists = JobPostGuest::where('posted_by_session_id', '=', $sessionid)->first();
		$ifexsists = JobPostGuest::where('posted_by_ip', '=', $ip)->first();
		if($ifexsists){
			//$alltemp = JobPostGuest::where('posted_by_session_id', '=', $sessionid)->get();
			$alltemp = JobPostGuest::where('posted_by_ip', '=', $ip)->get();
			
			foreach($alltemp as $temp){
				$moveJob = new JobPost;
				$moveJob->job_title = $temp->job_title;
				$moveJob->required_skills = $temp->required_skills;
				$moveJob->hourly_rate_min = $temp->hourly_rate_min;
				$moveJob->hourly_rate_max = $temp->hourly_rate_max;
				$moveJob->project_budget = $temp->project_budget;
				$moveJob->project_description = $temp->project_description;
				$moveJob->invoice_attachment = $temp->invoice_attachment;
				$moveJob->other_attachment = $temp->other_attachment;
				$moveJob->posted_by_username = $user->name;
				$moveJob->posted_by_id = $user->id;
				$moveJob->save();
			}
			$delJobs= JobPostGuest::where('posted_by_ip', '=', $ip)->get();
			$delJobs->each->delete();


		}
	}
}

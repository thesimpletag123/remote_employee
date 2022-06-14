<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
	use SoftDeletes;
	protected $fillable = [
        'job_title', 'required_skills', 'hourly_rate_min', 'hourly_rate_max', 'project_budget', 'project_description', 'is_project_approved'
    ];
	public function user()
	{
		return $this->hasOne('App\User', 'id', 'assigned_to_id');
	}
	public function employee()
	{
		return $this->hasOne('App\Employee', 'user_id','assigned_to_id');
	}
	public function GetAllJobsList(){
		$alljoblist = [];		
		
		$alljoblist = JobPost::get()->toArray();
		return $alljoblist;
	}
	
	public function GetJobsOfEmployer($request){		
		$employerposts ='';
		$alljobsofemployer = '';
		
		$id = $request;		
		$alljobsofemployer = JobPost::where("posted_by_id", "=", $id)->paginate(5);		
		//$alljobsofemployer = JobPost::where("posted_by_id", "=", $id)->get();		
		return $alljobsofemployer;
	}
	
	public function GetJobByID($jobid){
		$currentjob = JobPost::where('id', $jobid)->first();
		
		return $currentjob;
	}
	
	public function GetInvoiceWithDetails(){
		$alljobsofemployer = JobPost::whereNotNull("invoice_attachment")->get();
		//var_dump($alljobsofemployer);
		return $alljobsofemployer;
	}
	
	public function AssignedEmployees(){
		$result = JobPost::whereNotNull('assigned_to_id')->get();
		//$result = User::where('user_type','employee')->get();
		return $result;
	}

}

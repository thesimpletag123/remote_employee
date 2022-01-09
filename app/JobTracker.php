<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTracker extends Model
{
	protected $table = 'job_trackers';
	protected $fillable = [
        'jobid', 'user_id', 'jobupdate_headline', 'jobupdate_description', 'jobupdate_time', 'jobupdate_status'
    ];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
	
	public function jobpost()
	{
		return $this->belongsTo('App\JobPost', 'jobid');
	}
	
	public function GetJobUpdateByJobid($request){
		//echo 'From JobTracker Model: request = '.$request;
		//die();
		$jobupdates = JobTracker::where('jobid', "=", $request)->get();
		//var_dump($jobupdates);
		//die();
		return $jobupdates;
	}
}

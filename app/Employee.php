<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Employee extends Model
{
	
	protected $table = 'employees';
	protected $fillable = [
        'currency_name', 'currency_abbr', 'currency_origin'
    ];
	
	public function user()
	{
		//return $this->belongsTo(User::class , 'user_id' , 'id');
		return $this->belongsTo('App\User', 'user_id' , 'id');
	}
	
	public function employeeList(){
		$employee = [];
		$result = Employee::get();
		if(count($result)>0){
			foreach ($result as $employeelist){		 
				 $employee['user_id'] = $employeelist->user_id;	 
				 $employee['full_name'] = $employeelist->full_name;	 
				 $employee['contact_no'] = $employeelist->contact_no;	 
				 $employee['professional_field'] = $employeelist->professional_field;	 
				 $employee['skills'] = $employeelist->skills;
				 $employee['extra_skills'] = $employeelist->extra_skills;
				 $employee['experience_in_month'] = $employeelist->experience_in_month;
				 $employee['resume'] = $employeelist->resume;
				 $employee['is_verified'] = $employeelist->is_verified;
			 }
			 return $employee;
		}
    }
	
	public function getemployedetails($request){		
		$result = Employee::where('user_id',$request)->first();
		return $result;
	}
	
	public function AvailableEmployees(){
		$user = Auth::user();
		$result = Employee::where('is_verified',1)->where('emp_assigned_to', $user->id)->get();
		//$result = User::where('user_type','employee')->get();
		return $result;
	}
	
	public function AssignedEmployees(){
		$result = JobPost::whereNotNull('assigned_to_id')->get();
		//$result = User::where('user_type','employee')->get();
		return $result;
	}
	
	public function GetCurrentUserSkill(){
		$user = Auth::user();
		$result = Employee::where('user_id', $user->id)->first();
		$skills = $result->skills;
		return $skills;
	}
}

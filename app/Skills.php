<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
	protected $table = 'skills';
	protected $fillable = [
        'skill_name', 'skill_type'
    ];
	public function skillList(){
		$skills = [];
		$skill_name = [];
		$skill_type = [];
		$result = Skills::get();
		if(count($result)>0){
			foreach ($result as $skilllist){		 
				$skill_name[] = $skilllist->skill_name;	 
				$skill_type[] = $skilllist->skill_type;	 
			}
			$skills = array_combine($skill_name, $skill_type);
			return $skills;
		}
	}
	public function skillnames(){
		$skills = [];
		$result = Skills::get();
		if(count($result)>0){
			foreach ($result as $skilllist){		 
				$skills[] = $skilllist->skill_name;
			}
			return $skills;
		}
	}
	
	public function CheckAndUpdateSkill($request){
		$post = Skills::firstOrCreate(
        [
            'skill_name'             => $request,
            'skill_type'             => 'UserDefined',
        ]);
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalFields extends Model
{
	protected $table = 'professional_fields';
	protected $fillable = [
        'professional_fields', 'professional_fields_type'
    ];
	
	public function professionalfieldsList(){
		$professionalfield = [];
		$professionalfieldname = [];
		$professionalfieldtype = [];
		$result = ProfessionalFields::get();
		if(count($result)>0){
			foreach ($result as $professionalfieldlist){		 
				$professionalfieldname[] = $professionalfieldlist->professional_fields;
				$professionalfieldtype[] = $professionalfieldlist->professional_fields_type;
			 }
			 $professionalfield = array_combine($professionalfieldname , $professionalfieldtype);
			 return $professionalfield;
		}
    }
	
	public function professionalfieldnames(){
		$professionalfieldnames = [];
		$result = ProfessionalFields::get();
		if(count($result)>0){
			foreach ($result as $professionalfieldlist){		 
				$professionalfieldnames[] = $professionalfieldlist->professional_fields;
			 }
			 return $professionalfieldnames;
		}
    }
}

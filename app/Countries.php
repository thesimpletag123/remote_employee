<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
	protected $table = 'countries';
	protected $fillable = [
        'country_name', 'country_abbr'
    ];
	public function countryList(){
		$countries = [];
		$countrynames = [];
		$countryabbr = [];
		$result = Countries::get();
		
		

		if(count($result)>0){
			foreach ($result as $countrylist){		 
				$countrynames[] = $countrylist->country_name;	 
				$countryabbr[] = $countrylist->country_abbr;	
			
			}
		$countries = array_combine($countryabbr , $countrynames);
		
		return $countries;
		}
	}
	
	public function countryNames(){
		$countries = [];
		$result = Countries::get();
		if(count($result)>0){
			foreach ($result as $countrylist){		 
				$countries[] = $countrylist->country_name; 
			}
		return $countries;
		}
	}
}

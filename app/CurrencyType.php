<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
	protected $table = 'currency_types';
	protected $fillable = [
        'user_id', 'full_name', 'contact_no', 'professional_field', 'skills', 'experience_in_month', 'resume', 'is_verified'
    ];
	public function currencyList(){
		$currency = [];
		$currency_abbr = [];
		$currency_origin = [];
		$result = CurrencyType::get();
		if(count($result)>0){
			foreach ($result as $currencylist){		 
				//$currency[] = $currencylist->currency_name;	 
				$currency_abbr[] = $currencylist->currency_abbr; 
				$currency_origin[] = $currencylist->currency_origin; 
			}
			$currency = array_combine($currency_abbr , $currency_origin);
		return $currency;
		}
	}
}

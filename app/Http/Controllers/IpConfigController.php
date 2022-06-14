<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\IpConfig;
use App\User;


class IpConfigController extends Controller
{
    public function CheckAndUpdateIpDetails($ip){
		if (Auth::user()) {
			$user=Auth::user();
			User::where(['id' => $user->id])->update(['last_login_ip' => $ip]);
		}
		
		$data = \Location::get($ip);
		if($data){
			$ifexsists = IpConfig::where('ip', '=', $data->ip)->first();
			if ($ifexsists === null) {
				$insertIpDetails = new IpConfig; 
				$insertIpDetails->ip = $data->ip;
				$insertIpDetails->countryName = $data->countryName;
				$insertIpDetails->countryCode = $data->countryCode;
				$insertIpDetails->regionCode = $data->regionCode;
				$insertIpDetails->regionName = $data->regionName;
				$insertIpDetails->cityName = $data->cityName;
				$insertIpDetails->zipCode = $data->zipCode;
				$insertIpDetails->isoCode = $data->isoCode;
				$insertIpDetails->postalCode = $data->postalCode;
				$insertIpDetails->latitude = $data->latitude;
				$insertIpDetails->longitude = $data->longitude;
				$insertIpDetails->metroCode = $data->metroCode;
				$insertIpDetails->areaCode = $data->areaCode;
				$insertIpDetails->timezone = $data->timezone;
				$insertIpDetails->save();
			}
		}
		 
	}
}

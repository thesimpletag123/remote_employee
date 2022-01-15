<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;

class SocialAuthController extends Controller
{

// Google Social Login
   public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
	
    public function handleGoogleCallback()
    {
        try {    
            $user = Socialite::driver('google')->user();     
            $existUser = User::where('email', $user->email)->first();     
            if($existUser){
				if(!$existUser->google_id){					
					$userupdate = User::find($existUser->id);
					$userupdate->google_id = $user->id;
					$userupdate->save();
				}
                Auth::login($existUser);
				if($existUser->is_verified == true){
					if($existUser->user_type == 'employer'){
						return redirect('/employerdashboard'); 
					} else {
					return redirect('/dashboard'); 
					}
				} else {
					return redirect('/home');
				}
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('password')
                ]);
    
                Auth::login($newUser);     
                return redirect('/home');
            }    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


// LinkedIn Social Login
	
	public function linkedinredirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function linkedincallback()
    {
        try {
            $linkdinUser = Socialite::driver('linkedin')->user();
			
            $existUser = User::where('email',$linkdinUser->email)->first();
            if($existUser) {
				if(!$existUser->linkedin_id){					
					$userupdate = User::find($existUser->id);
					$userupdate->linkedin_id = $linkdinUser->id;
					$userupdate->save();
				}
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->name = $linkdinUser->name;
                $user->email = $linkdinUser->email;
                $user->linkedin_id = $linkdinUser->id;
                //$user->user_type = 'employer';
                $user->password = Hash::make('password');
                $user->save();
                Auth::loginUsingId($user->id);
            }
			/*if($existUser->is_verified == true){
					return redirect('/dashboard'); 
			} else {*/
				return redirect()->to('/');
			//}
			/*$data['success'] = 1;
			$data['message'] = 'Logged In..';

			return response()->json($data);*/
        }
        catch (Exception $e) {
			$data['success'] = 2;
			$data['message'] = 'Failed! Please Retry';

			return response()->json($data);
        }
    }	
	
	
	public function signin_using_google_popup(Request $request){
		$gprofileid = $request->gprofileid;
		$gname = $request->gname;
		$gimage = $request->gimage;
		$gemail = $request->gemail;
		
		if (Auth::check()) {
			$data['success'] = 1;
			$data['message'] = 'Already loggedin';
			return response()->json($data);
		} else {
			$existUser = User::where('email', $gemail)->first();     
			if($existUser){
				if(!$existUser->google_id){					
					$userupdate = User::find($existUser->id);
					$userupdate->google_id = $gprofileid;
					$userupdate->is_verified = true;
					//$userupdate->user_type = 'employer';
					
					$userupdate->save();
				}
				Auth::loginUsingId($existUser->id);
				
					$data['success'] = 1;
					$data['message'] = 'Login Successfull';
					$data['user_type'] = $existUser->user_type;
					return response()->json($data);
				
			}else{
				$newUser = User::create([
					'name' => $gname,
					'email' => $gemail,
					'google_id'=> $gprofileid,
					'is_verified' => true,
					//'user_type' => 'employer',
					'password' => Hash::make('password')
				]);

				Auth::login($newUser);     
				$data['success'] = 1;
				$data['message'] = 'Registration Successfull';
				return response()->json($data);
			}
		}
	}
}
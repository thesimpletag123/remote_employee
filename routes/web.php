<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'EmployeeController@baseurllogin')->name('baseurllogin');




Auth::routes();

	Route::post('emp1_submit', 'EmployeeController@emp1_submit')->name('emp1_submit');
	Route::post('emp2_submit', 'EmployeeController@emp2_submit')->name('emp2_submit');
	Route::post('emp_otp_verify', 'EmployeeController@emp_otp_verify')->name('emp_otp_verify');

## Social Login
	### 1. Google
	Route::get('auth/google', 'Auth\SocialAuthController@redirectToGoogle');
	Route::get('auth/google/callback', 'Auth\SocialAuthController@handleGoogleCallback');
	Route::post('signin_using_google_popup', 'Auth\SocialAuthController@signin_using_google_popup');

	### 2. LinkedIn
	Route::get('auth/linkedin/redirect', 'Auth\SocialAuthController@linkedinredirect');
	Route::get('auth/linkedin/callback', 'Auth\SocialAuthController@linkedincallback');
	
	### 3. Session Set for PopUp Jobpost
	Route::post('setsession_for_popups', 'JobPostController@setsession_for_popups')->name('setsession_for_popups');
	Route::post('unset_popup_sessions', 'JobPostController@unset_popup_sessions')->name('unset_popup_sessions');
	

Route::middleware(['auth'])->group(function () {
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/home', 'HomeController@index')->name('home');
	
	
	Route::get('profilesetting/{id}', 'HomeController@profilesetting')->name('profilesetting');
	Route::post('update_profile_img', 'HomeController@update_profile_img')->name('update_profile_img');
	Route::post('update_employer_role', 'HomeController@update_employer_role')->name('update_employer_role');
	Route::post('update_employer_quick', 'HomeController@update_employer_quick')->name('update_employer_quick');
	
	Route::post('submit_quick_project', 'JobPostController@submit_quick_project')->name('submit_quick_project');
	Route::post('otp_gen_for_find_emp', 'HomeController@otp_gen_for_find_emp')->name('otp_gen_for_find_emp');
	Route::post('verify_fulltime_employer', 'HomeController@verify_fulltime_employer')->name('verify_fulltime_employer');
	Route::get('jobpost', 'JobPostController@jobpostview')->name('jobpost');
	Route::post('jobpost_to_db', 'JobPostController@jobpost_to_db')->name('jobpost_to_db');
	Route::post('submit_full_project', 'JobPostController@submit_full_project')->name('submit_full_project');
	
	Route::post('assign_job_to_emp', 'JobPostController@assign_job_to_emp')->name('assign_job_to_emp');
	Route::get('myprofile', 'HomeController@myprofile')->name('myprofile');
	
	Route::middleware(['isEmployee'])->group(function () {
		Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
		Route::get('update_job_by_employee/{id}', 'JobPostController@viewjobemployee')->name('update_job_by_employee');
		Route::get('viewjobemployee/{id}', 'JobPostController@viewjobemployee')->name('viewjobemployee');
		Route::post('employeetimeupdate', 'JobTrackerController@employeetimeupdate')->name('employeetimeupdate');
		Route::post('employeeprofileupdate', 'HomeController@employeeprofileupdate')->name('employeeprofileupdate');
		
	});
	Route::middleware(['isEmployer'])->group(function () {
		Route::get('employerdashboard', 'JobPostController@employerdashboard')->name('employerdashboard');
		Route::get('editjobview/{jobid}', 'JobPostController@editjobview')->name('editjobview');
		Route::post('editjobrequest', 'JobPostController@editjobrequest')->name('editjobrequest');
		Route::post('delete_job', 'JobPostController@delete_job')->name('delete_job');
		Route::get('trackjob/{jobid}', 'JobTrackerController@trackjob')->name('trackjob');
	});
});

//Route::post('upload_file', 'HomeController@upload_file')->name('upload_file');

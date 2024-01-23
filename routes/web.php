<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\SuperAdminController;
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

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});

Route::get('/', 'EmployeeController@baseurllogin')->name('baseurllogin');
Route::get('service', 'EmployeeController@service')->name('service');
Route::get('aboutus', 'EmployeeController@aboutus')->name('aboutus');
Route::get('contactus', 'EmployeeController@contactus')->name('contactus');
Route::post('contactus', 'EmployeeController@contactususer')->name('contactususer');
Route::post('submit_project_as_guest', 'JobPostController@submit_project_as_guest')->name('submit_project_as_guest');

Auth::routes();
Route::get('login', [
  'as' => 'login',
  'uses' => 'EmployeeController@baseurllogin'
]);

	Route::post('emp1_submit', 'EmployeeController@emp1_submit')->name('emp1_submit');
	Route::post('emp2_submit', 'EmployeeController@emp2_submit')->name('emp2_submit');
	Route::post('emp_otp_verify', 'EmployeeController@emp_otp_verify')->name('emp_otp_verify');
	Route::post('countrynamecode', 'EmployeeController@countryNameCode')->name('countryNameCode');
	Route::get('valiedEmailCheck', 'EmployeeController@valiedEmailCheck')->name('valiedEmailCheck');
	Route::get('emailCheck', 'EmployeeController@emailCheck')->name('emailCheck');

	//Route::get('service', 'HomeController@service')->name('service');
	//Route::get('aboutus', 'HomeController@aboutus')->name('aboutus');
	//Route::get('whyus', 'HomeController@whyus')->name('whyus');
	//Route::get('contact', 'HomeController@contact')->name('contact');
	//Route::get('/allEmployee', 'SuperAdminController@allEmployee')->name('allEmployee');
	//Route::get('/allEmployer', 'SuperAdminController@allEmployer')->name('allEmployer');
##Schedule Free Consulting	
	Route::post('scheduleFreeConsulting', 'Auth\RegisterController@scheduleFreeConsulting')->name('scheduleFreeConsulting');
	
	

## Social Login
	### 1. Google
	 
	Route::get('auth/google', 'Auth\SocialAuthController@loginWithGoogle')->name('loginWithGoogle');
	Route::any('auth/google/callback', 'Auth\SocialAuthController@callBackFromGoogle')->name('callBackFromGoogle');

	### 2. LinkedIn
	 
	Route::get('auth/linkedin', 'Auth\SocialAuthController@loginWithLinkedin')->name('loginWithLinkedin');
	Route::any('auth/linkedin/callback', 'Auth\SocialAuthController@callBackFromLinkedin')->name('callBackFromLinkedin');
	
	### 3. Session Set for PopUp Jobpost
	Route::post('setsession_for_popups', 'JobPostController@setsession_for_popups')->name('setsession_for_popups');
	Route::post('unset_popup_sessions', 'JobPostController@unset_popup_sessions')->name('unset_popup_sessions');
	Route::post('check_login_before_submit', 'Auth\LoginController@check_login_before_submit')->name('check_login_before_submit');
	
	### IP Config
	Route::get('checkandupdateipdetails', 'IpConfigController@CheckAndUpdateIpDetails')->name('checkandupdateipdetails');
Route::middleware(['auth'])->group(function () {
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('admindashboard', 'JobPostController@admindashboard')->name('admindashboard');
	Route::get('editemployeehow/{id}','JobPostController@editemployeehow')->name('editemployeehow');
	Route::post('updateemployee','JobPostController@updateemployee')->name('updateemployee');
	Route::get('employeedelete/{id}','JobPostController@employeedelete')->name('employeedelete');

	//Route::get('valiedEmailCheckotp', 'EmployeeController@valiedEmailCheckotp')->name('valiedEmailCheckotp');

	Route::get('employer', 'JobPostController@employer')->name('employer');
	Route::get('editemployershow/{id}','JobPostController@editemployershow')->name('editemployershow');
	Route::post('updateemployer','JobPostController@updateemployer')->name('updateemployer');
	Route::get('employerdelete/{id}','JobPostController@employerdelete')->name('employerdelete');


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
	Route::post('change_project_status', 'JobPostController@change_project_status')->name('change_project_status');
	
	Route::middleware(['isEmployee'])->group(function () {
		Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
		 
		Route::get('update_job_by_employee/{id}', 'JobPostController@viewjobemployee')->name('update_job_by_employee');
		Route::get('viewjobemployee/{id}', 'JobPostController@viewjobemployee')->name('viewjobemployee');
		Route::post('employeetimeupdate', 'JobTrackerController@employeetimeupdate')->name('employeetimeupdate');
		Route::post('employeeprofileupdate', 'HomeController@employeeprofileupdate')->name('employeeprofileupdate');
		Route::post('employeerateupdate', 'HomeController@employeerateupdate')->name('employeerateupdate');
		Route::get('sendmail', 'SendMailController@sendmail')->name('sendmail');
		Route::get('sendmailotp', 'SendMailController@sendmailotp')->name('sendmailotp');
		Route::post('userempotpverify', 'SendMailController@userempotpverify')->name('userempotpverify');
		Route::get('sendmailwithuserid', 'SendMailController@sendmailwithuserid')->name('sendmailwithuserid');
		Route::get('sendwelcomemail', 'SendMailController@SendWelcomeMail')->name('SendWelcomeMail');
		Route::post('employeskillupdate', 'HomeController@employeskillupdate')->name('employeskillupdate');
		Route::post('verifyuser', 'HomeController@verifyuser')->name('verifyuser');
		 
	});
	Route::middleware(['isEmployer'])->group(function () {
		Route::get('employerdashboard', 'JobPostController@employerdashboard')->name('employerdashboard');
		Route::get('editjobview/{jobid}', 'JobPostController@editjobview')->name('editjobview');
		Route::post('editjobrequest', 'JobPostController@editjobrequest')->name('editjobrequest');
		Route::post('delete_job', 'JobPostController@delete_job')->name('delete_job');
		Route::get('trackjob/{jobid}', 'JobTrackerController@trackjob')->name('trackjob');
		Route::post('employerprofileupdate', 'HomeController@employerprofileupdate')->name('employerprofileupdate');
		Route::post('invoice_generate_for_completed_projects', 'JobPostController@invoice_generate_for_completed_projects')->name('invoice_generate_for_completed_projects');
		Route::post('show_invoice_only', 'JobPostController@show_invoice_only')->name('show_invoice_only');
	});
});

//Route::post('upload_file', 'HomeController@upload_file')->name('upload_file');

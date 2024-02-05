<?php
if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
	$origin = $_SERVER["HTTP_ORIGIN"];
	$allowed_origins = array(
		"http://public.app.moxio.com",
		"https://foo.app.moxio.com",
		"https://lorem.app.moxio.com"
	);
	if (in_array($origin, $allowed_origins, true) === true) {
		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Allow-Methods: POST');
		header('Access-Control-Allow-Headers: Content-Type');
	}
	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
		exit; // OPTIONS request wants only the policy, we can stop here
	}
}

?>
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<script src="{{ asset('assets/js/bundle.min.js') }}"></script>
 <!-- starting modal-employer -->
        <div class="modal fade modal-employer" id="modal-employer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <h3>How can I help you? ?</h3>
                                <div>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-quick-project" data-bs-dismiss="modal" class="find_emp">Help me with Quick Project</a>
                                    <a href="#" class="find-part-time-employee find_emp otp_gen_for_find_emp" data-bs-dismiss="modal">Find me a Part-time Employee</a>
                                    <a href="#" class="find-full-time-employee find_emp otp_gen_for_find_emp" data-bs-dismiss="modal">Find me a Full-Time Employee</a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <img src="{{ asset('assets/images/modal-employer-avatar.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employer -->
        
        
        <!-- starting modal-quick-project -->
        <div class="modal fade modal-quick-project" id="modal-quick-project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <h3>Quick Project? </h3>
                                <form name="submit_quick_project" id="submit_quick_project" action="{{route('submit_quick_project')}}" method="post">
								@csrf
                                    <div class="form-group">
                                        <label>Add Short Description for your Project</label>
											@if (session('quick_project_desc'))												
												<textarea rows="3" name="quick_project_desc" id="quick_project_desc" required>{{ session('quick_project_desc') }}</textarea>
											@else
												<textarea rows="3" name="quick_project_desc" id="quick_project_desc" required></textarea>
											@endif
                                        
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Estimate your budget</label>
                                        <div class="row">
                                            <div class="col">
											@if (session('quick_min_budget'))
												<input type="number" placeholder="Min " name="quick_min_budget" id="quick_min_budget" value="{{session('quick_min_budget')}}" required>
											@else
												<input type="number" placeholder="Min " name="quick_min_budget" id="quick_min_budget" required>
											@endif
											</div>
											
                                            <div class="col">
												@if (session('quick_max_budget'))
													<input type="number" placeholder="Max" name="quick_max_budget" id="quick_max_budget" value="{{session('quick_max_budget')}}" required>
												@else
													<input type="number" placeholder="Max" name="quick_max_budget" id="quick_max_budget" required>
												@endif
											</div>
                                            <div class="col">
                                                <select id="quick_currency" name ="quick_currency">
                                                 <option value="option">Option</option>
													@if(isset($currencies))													
														@foreach($currencies as $currency => $abbr)
															@if (session('quick_max_budget'))
																<option value="{{$currency}}" <?php if(session('quick_max_budget') == $currency){echo "selected";}?>>{{$currency}}</option>
															@else
																<option value="{{$currency}}">{{$currency}}</option>
															@endif
														@endforeach
													@else
															<option value="INR">INR</option>
															<option>Login to get More</option>
													@endif                                                        
												</select>
                                            </div>
                                        </div>
                                    </div>
                                   
									
									@if (Auth::check())
										<div class="form-group">
											<input type="submit" id="submit_quick_project_disable" value="submit" class="btn btn-primary" style="width:100%;">
										</div>
									@else
										<div class="form-group">
											
                                        <div class="d-flex align-items-center justify-content-between">
                                      
                                      <a href="{{route('loginWithGoogle') }}" class="social-icon g-signin google-sign bg-danger">
                                          <i class="fab fa-google bg-danger"></i>
                                          Sign In
                                      </a>
                                      <a href="{{route('loginWithLinkedin') }}" class="social-icon g-signin google-sign bg-info">
                                       
                                      <i class="fab fa-linkedin-in"></i>
                                         Sign In
                                      </a> 
                                      </div>   
											
										</div>
										<div class="form-group" >
											<input type="button" id="submit_quickproject_temp" value="Submit as Guest" class="btn btn-primary" style="width:100%;">
										</div>
									@endif
                                </form>

                            </div>
                            <div class="col-lg">
                                <div class="upimageatmodal">
                                    <img src="{{ asset('assets/images/modal-quick-project.png') }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-quick-project -->
        
        
        <!-- starting modal-employee -->
        <div class="modal fade modal-employee" id="modal-employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <h3>Let's know you better!</h3>
                                <div class="modal-employee-card">
                                    <form name="employe_form1" method="post" action="">
									@csrf
                                        <div class="form-group">
											@if(isset($user->user_image))
												<input type="hidden" id="hidden_uid" value="{{$user->id}}">
												<img id="user_image_preview" src="{{ $user->user_image }}" alt="">												
											@else
												<img id="user_image_preview" src="{{ asset('assets/images/avtar.png') }}" alt="">
											@endif
											@if (Auth::check())
												<input type="file" name="user_image" id="user_image" class="fas fa-pen profile_img">
											@endif
										
                                        </div>
                                        <div class="form-group">
											
												<input type="text" name="emp_fname" id="emp_name" placeholder="Enter Your Name">
                                        </div>
                                        <div class="form-group">
											@if (Auth::check())
												@if(isset($user->email))
													<input type="email" name="emp_email" id="emp_email" readonly value="{{$user->email}}">
												@else
													<input type="email" name="emp_email" id="emp_email">
												@endif
											@else
												<input type="email" name="emp_email" pattern="[^ @]*@[^ @]*" id="emp_email" placeholder="Enter Your Email ID" requird>
											@endif
                                        </div>
                                        <div class="alert alert-danger alert-block" style="display:none">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong> {{ Session::get('success') }}</strong>
                                            </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <select id="emp_country" name ="emp_country" onclick="myFunction()">
                                                    <option value="">Option</option>
														@if(isset($countries))													
															@foreach($countries as $country => $abbr)
																<option value="{{$abbr}}">{{$country}}</option>
															@endforeach
														@else
																<option>No Country Currently Available</option>
														@endif                                                        
                                                    </select>
                                                </div>
												<?php 
												$emp_contact_no = null;
												
												if(isset($employeies['contact_no'])){
													$emp_contact_no = $employeies['contact_no'];
												}
												?>
                                                <div class="col-3"><input type="text" name="emp_phone_ext" placeholder="+00" id="emp_phone_ext"></div>
                                                <div class="col-6"><input type="text" name="emp_phone_no" placeholder="Contact number" id="emp_phone_no" required></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select id="emp_professional_fields"name ="emp_professional_fields">
                                            <option value="">Select Professional</option>
											@if(isset($professional_fields))
												@foreach($professional_fields as $value)
													<option  value="{{$value}}">{{$value}}</option>
												@endforeach
											@else
													<option>No Professional Fields Available</option>
											@endif
											
                                            </select>
											
                                        </div>
                                    </form>
                                    <div class="modal-employee-navigation">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal-employee-skills" data-bs-dismiss="modal" id="emp_form1_next" style="pointer-events: none; ; opacity: 0.35;">Next</a>
                                        <ul>
                                            <li class="active"></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="upimageatmodal">
                                    <img src="{{ asset('assets/images/modal-employee-avatar.png') }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employee -->
        
        
        <!-- starting modal-employee-skills -->
        <div class="modal fade modal-employee-skills" id="modal-employee-skills" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <h3>What about your Skills!</h3>
                                <div class="modal-employee-card">
                                    <form name="employe_form2" id="employe_form2" method="post" action="" enctype="multipart/form-data">
									@csrf
									
                                        <div class="d-flex flex-column  mb-3 toggle_skill_onoff_div">
                                            <div class="modal_skill_main">
                                                <div class="modal_skill">
													<span id="my_skills" name="my_skills[]"></span>
													
                                                    <script>
                                                        var allSkills = new Array();
                                                        var required_skills_array = new Array();
                                                        <?php
                                                        $required_skills_array = [];
                                                        if(isset($skills) && count($skills) > 0){
                                                            foreach($skills as $skill){	
                                                            ?>
                                                            allSkills.push({label:'<?php echo $skill; ?>',value:'<?php echo $skill; ?>'});
                                                            <?php
                                                            }
                                                        }
                                                        foreach($required_skills_array as $rskill){	
                                                        ?>
                                                        required_skills_array.push({label:'<?php echo $rskill; ?>',value:'<?php echo $rskill; ?>'});
                                                        <?php
                                                        }
                                                        ?>
                                                        var instance = new SelectPure("#my_skills", {
                                                        options: allSkills,
                                                        multiple: true ,	
                                                        //value: required_skills_array,
                                                        icon: "fa fa-times",
                                                        onChange: value => { console.log(value); }
                                                        });
                                                    </script>
													
                                                   
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col"><label>Experience:</label></div>
												<?php 
												$emp_exp_yr = 0;
												$emp_exp_month = 0;
												if(isset($employeies['experience_in_month'])){
													$emp_experience_in_month = $employeies['experience_in_month'];
													if($emp_experience_in_month > 11){
														$emp_exp_month = $emp_experience_in_month%12;
														$emp_exp_yr = ($emp_experience_in_month - $emp_exp_month)/12;
													} else {
														$emp_exp_month = $emp_experience_in_month;
													}
												}												
												?>
                                                <div class="col"> 
                                                Year <input type="number" name="exp_yr" id="exp_yr" placeholder="Year" min="0" class="custom_input" value="{{$emp_exp_yr}}">
												</div>
												<div class="col"> 
                                                Month <input type="number" name="exp_month" id="exp_month" placeholder="Month" max="12" min="0" class="custom_input" value="{{$emp_exp_month}}">
												</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-inpfile">
                                                <div class="repl-inpfile">
                                                    <input type="file" class="bluebtn fil" name="file" id="file">Upload Resume
													
                                                <?php if(isset($employeies['resume'])){
													?>
													<br>
													 <a href="<?php echo $employeies['resume'];?>" id="displayfile" class="displayfile" target="_blank"> Previously uploaded </a>
													<?php
												}
												?>
												</div>
												
                                            </div>
                                        </div>
                                    </form>
                                    <div class="modal-employee-navigation">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal-employee-done" data-bs-dismiss="modal" id="emp_form2_next" style="pointer-events: none ; opacity: 0.35;">Next</a>
                                        <ul>
                                            <li></li>
                                            <li class="active"></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="upimageatmodal">
                                    <img src="{{ asset('assets/images/skills-avatar.png') }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employee-skills -->
        
        
        <!-- starting modal-employee-done -->
        <div class="modal fade modal-employee-done" id="modal-employee-done" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg">
                                <h3>Almost Done!</h3>
                                <div class="modal-employee-card">
                                    <form name="employe_form3" method="post" action="" >
									@csrf
                                        <div class="form-group">
                                            <div class="progress-modal">
												<div class="pie-wrapper progress-full">
													<span class="label">85<em>%</em></span>
													<div class="pie">
														<div class="left-side half-circle"></div>
														<div class="right-side half-circle"></div>
													</div>  
												</div>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col"><input class="otps text-center" type="text" id="otp1"  maxlength="1" placeholder=""></div>
                                                <div class="col"><input class="otps text-center" type="text" id="otp2"  maxlength="1" placeholder=""></div>
                                                <div class="col"><input class="otps text-center" type="text" id="otp3"  maxlength="1" placeholder=""></div>
                                                <div class="col"><input class="otps text-center" type="text" id="otp4"  maxlength="1" placeholder=""></div>
                                                <div class="col"><input class="otps text-center" type="text" id="otp5"  maxlength="1" placeholder=""></div>
                                            </div>
										</div>
                                        <div class="form-group">
                                            <p>One time verification send to your mail id <br>please verify yourself</p>
                                        </div>

                                    </form>
                                    <div class="modal-employee-navigation">
										
                                        <a href="#" id="emp_verify_btn" style="pointer-events: none ; opacity: 0.35;">Verify</a>
                                        <ul>
                                            <li></li>
                                            <li></li>
                                            <li class="active"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="upimageatmodal">
                                    <img src="{{ asset('assets/images/done-avatar.png') }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employee-done -->
        
        
        <!-- starting modal-employee-varifyed -->
        <div class="modal fade modal-employee-varifyed" id="modal-employee-varifyed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <img src="{{ asset('assets/images/varifyed-icon.png') }}" alt="image">
                            <h5>Verifyed</h5>
                        </div>
                        <div>
                            <p>An email confirmation sent to your provided mail id <br> in which you can get your ID &amp; temporary password. </p>
                        </div>
                        <div>
                            <a href="{{url('dashboard')}}">Go to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employee-varifyed -->
		
		<!-- starting modal-employee-VARIFICATION FAILED -->
        <div class="modal fade modal-employee-varifyed" id="modal-employee-verification-failed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <img src="{{ asset('assets/images/cross-icon.png') }}" alt="image">
                            <h5>Verification Failed</h5>
                        </div>
                        <div>
                            <p>Your Verification is failed. <br> It may cause of Incorrect insertion of OTP. Please retry. </p>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >Retry</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employee-VARIFICATION FAILED -->
        
        
        <!-- starting modal-Schedule Free Consulting -->
        <div class="modal fade modal-login" id="modal-scheduleFreeConsulting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"style="margin-left: 450px;"></i></button>
					</div>
					<div class="modal-body">
						<div>
							<img src="{{ asset('assets/images/main-logo.png') }}" alt="image" />
							<h4>Welcome to Remote Employee</h4>
							<p>Schedule Free Consulting</p>
						</div>
						<form method="POST" action="{{ route('scheduleFreeConsulting') }}" id="scheduleFreeConsulting_popup_form">
                         
                        @csrf
						
							<div class="form-group row">
								<i class="fa-solid fa-user-gear"></i>
								{{--<select name="user_type" id="user_type" class="form-control" required autofocus style="padding-left: 35px;">
									<option selected disabled>Select a user Type</option>
									<option value="employer">I am a Employer</option>
									<option value="employee">I am a Employee</option>
								</select >--}}
								<div class="col-md-12">
									<div class="col-sm-6" style="float:left;">
										<input type="radio" name="user_type" value="employer">
										<label for="employer" style="color: #fff;">I am an Employer</label>
									</div>
									<div class="col-sm-6" style="float:right;">
										<input type="radio" name="user_type" value="employee">
										<label for="employee" style="color: #fff;">I am an Employee</label>
									</div>
								</div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="form-group row">
								<i class="fas fa-user" ></i>
								<input id="name1" type="text" class="form-control @error('name') is-invalid @enderror bg-dark text-white" name="name" value="{{ old('name') }}" required autocomplete="name" Placeholder="Enter Your Name" autofocus style="padding-left: 35px;">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="form-group row">
								<i class="fas fa-envelope" ></i>
								<input id="email1" type="email1" class="form-control freeShudel @error('email') is-invalid @enderror bg-dark text-white" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your Email" style="padding-left: 35px;">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group row">
								<i class="fas fa-phone" ></i>
								<input id="phone1"type="text" class="form-control @error('phone') is-invalid @enderror bg-dark text-white" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Type Phone Number" style="padding-left: 35px;">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
                            <div class="form-group row">
								<i class="" ></i>
                                <!-- Calendly link widget begin -->
                                <a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/drdanial/the-remote-employee'});return false;">
                                <button id="calendly" type="button" name="calendly" class="form-control bg-info text-white"style="padding-left:10px;">
                                Schedule Free Consulting Schedule time with me</button>
                                 </a>
                                <!-- Calendly link widget end -->
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							 
							<div class="form-group">
								<button type="submit" class="btn btn-primary" id="scheduleFreeConsulting_button_for_validation">
                                    {{ __('Schedule Free Consulting') }}
                                </button>
							</div>
							<div class="form-group">
								 
                            <div class="d-flex align-items-center justify-content-between">
                                      
                                      <a href="{{route('loginWithGoogle') }}" id="google"class="social-icon g-signin google-sign bg-danger">
                                          <i class="fab fa-google bg-danger"></i>
                                          Sign In
                                      </a>
                                      <a href="{{route('loginWithLinkedin') }}" id="linkedin"class="social-icon g-signin google-sign bg-info">
                                       
                                      <i class="fab fa-linkedin-in"></i>
                                         Sign In
                                      </a> 
                              </div>          
							</div>						
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End modal-Schedule Free Consulting --> 
        
         
        
		
		<!-- starting modal-register -->
        <div class="modal fade modal-login" id="modal-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
					</div>
					<div class="modal-body">
						<div>
							<img src="{{ asset('assets/images/main-logo.png') }}" alt="image" />
							<h4>Welcome to Remote Employee</h4>
							<p>Register your account</p>
						</div>
						<form method="POST" action="{{ route('register') }}" id="reg_popup_form">
                        @csrf
						
							<div class="form-group row">
								
								{{--<select name="user_type" id="user_type" class="form-control" required autofocus style="padding-left: 35px;">
									<option selected disabled>Select a user Type</option>
									<option value="employer">I am a Employer</option>
									<option value="employee">I am a Employee</option>
								</select >--}}
								<div class="col-md-12">
									<div class="col-sm-6" style="float:left;">
										<input type="radio" name="user_type" value="employer">
										<label for="employer" style="color: #fff;">I am an Employer</label>
									</div>
									<div class="col-sm-6" style="float:right;">
										<input type="radio" name="user_type" value="employee">
										<label for="employee" style="color: #fff;">I am an Employee</label>
									</div>
								</div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="form-group row">
								<i class="fas fa-user" ></i>
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" Placeholder="Enter Your Name" autofocus style="padding-left: 35px;">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="form-group row">
								<i class="fas fa-envelope" ></i>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your Email" />

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group row">
								<i class="fas fa-unlock-alt" ></i>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Type Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="form-group row">
								<i class="fas fa-unlock-alt" ></i>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-Type Password">
							</div>

							<div class="form-group" style="text-align:left;">
								<a href="javascript:void(0)" class="toggle_login_reg_btn" id="go_to_login_popup"> Already a member </a>
							</div>
							<div class="form-group" style="text-align:left;">
								<button type="submit" class="btn btn-primary" id="reg_button_for_validation">
                                    {{ __('Register') }}
                                </button>
							</div>
							<div class="form-group">
								 
                                <div class="d-flex align-items-center justify-content-between">
                                      
                                        <a href="{{route('loginWithGoogle') }}" class="social-icon g-signin google-sign bg-danger">
                                            <i class="fab fa-google bg-danger"></i>
                                            Sign In
                                        </a>
                                        <a href="{{route('loginWithLinkedin') }}" class="social-icon g-signin google-sign bg-info">
                                         
                                        <i class="fab fa-linkedin-in"></i>
                                           Sign In
                                        </a> 
                                </div>          
							</div>						
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End modal-register --> 
        
        <!-- starting modal-login -->
        <div class="modal fade modal-login" id="modal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
					</div>
					<div class="modal-body">
						<div>
							<img src="{{ asset('assets/images/main-logo.png') }}" alt="image" />
							<h4>Welcome back</h4>
							<p>Enter your credentials to access your account</p>
						</div>
						<form method="POST" action="{{ route('login') }}" id="login_popup_form">
							@csrf

							<div class="form-group row">
								<i class="fas fa-envelope" ></i>
								<input id="login_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email" />

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group row">
								<i class="fas fa-unlock-alt" ></i>
								<input id="login_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password" />

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group" style="text-align: left; margin-left: 20px;">
								<span class="text-white"> <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} > Remember me</span>
							</div>
							<div class="form-group" style="text-align: left;">
								<button type="submit" id="login_button_for_validation" class="btn btn-primary">
									{{ __('Login') }}
								</button>
							</div>
							<div class="form-group" style="text-align: left;">
								<a class="toggle_login_reg_btn" id="go_to_register_popup"> Not a Member Yet? </a>
							</div>
							<div class="form-group" style="text-align: left;">
								@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
								</a>
								@endif
							</div>
							<div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                      
                                      <a href="{{route('loginWithGoogle') }}" class="social-icon g-signin google-sign bg-danger">
                                          <i class="fab fa-google bg-danger"></i>
                                          Sign In
                                      </a>
                                      <a href="{{route('loginWithLinkedin') }}" class="social-icon g-signin google-sign bg-info">
                                       
                                      <i class="fab fa-linkedin-in"></i>
                                         Sign In
                                      </a> 
                              </div>            
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
        <!-- End modal-login -->
		
        <!-- starting parttime -->
        <section class="parttime">
            <div class="container">
                <div class="parttime-slider">
                    <span class="parttime-slider-closebtn"><i class="fas fa-times"></i></span>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            
                            
                            <div class="swiper-slide parttime-headline">
                                <div class="row">
                                    <div class="col-md">
                                        <div>
                                            <h3>Let's start with a <br>strong headline.</h3>
                                            <p>This helps your job post stand out to the right candidates. It’s the first thing they’ll see, so make it count!</p>
                                        </div>
                                        <form>
											@if (session('fulltime_job_headline'))
												<input type="text" id="fulltime_job_headline" placeholder="Write a headline for your job post" value="{{session('fulltime_job_headline')}}">
											@else
												<input type="text" id="fulltime_job_headline" placeholder="Write a headline for your job post">
											@endif
                                            
                                        </form>
                                        <div>
                                            <h6>Example titles</h6>
                                            <ul>
                                                <li>Social media pro to write and post to Instagram and Facebook</li>
                                                <li>Facebook ad specialist needed for product launch</li>
                                                <li>SEO copywriter needed to write landing page and ad copy</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="upimageatmodal">
                                            <img src="{{ asset('assets/images/headline-avatar.png') }}" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="swiper-slide parttime-skills">
                                <div class="row padd-160">
                                    <div class="col-md">
                                        <h3>Great! What skills does <br> your work require?</h3>
                                        <div class="d-flex flex-column  mb-3 toggle_skill_onoff_div">
                                            <p>Popular skills for Search Engine Optimization</p>
                                            <div class="modal_skill_main">
                                            <?php 
                                                $session_skill = [];
                                                    if(session('fulltime_job_skills')){
                                                        $session_skill = explode(',' , session('fulltime_job_skills'));
                                                    }
                                            ?>
                                            @if(Route::is('employerdashboard'))
                                                <?php $skills = $allskills; ?>
                                            @endif

<span id="fulltime_job_skills" name="fulltime_job_skills[]"></span>
													
<script>
	var allSkills = new Array();
	var session_skill = new Array();
	<?php
	$selected_skills = [];
	foreach($skills as $skill){	
		
	?>
	allSkills.push({label:'<?php echo $skill; ?>',value:'<?php echo $skill; ?>'});
	<?php
	}
	foreach($session_skill as $rskill){	
	?>
	session_skill.push({label:'<?php echo $rskill; ?>',value:'<?php echo $rskill; ?>'});
	<?php
	}
	?>
	var fulltime_skills = new SelectPure("#fulltime_job_skills", {
	options: allSkills,
	multiple: true ,	
	value: session_skill,
	icon: "fa fa-times",
	onChange: value => { console.log(value); }
	});
</script>
<input type ="hidden" name="hidden_fulltime_job_skills" id="hidden_fulltime_job_skills">
                                                </div>				
                                            </div>
                                        <div>
                                            <form>
												@if (session('fulltime_job_extra_skill'))
													<input type="search" id="fulltime_job_extra_skill" placeholder="Add your own" value="{{session('fulltime_job_extra_skill')}}">
												@else
													<input type="search" id="fulltime_job_extra_skill" placeholder="Add your own">
												@endif
                                                
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="upimageatmodal">
                                            <img src="{{ asset('assets/images/parttime-skills-avatar.png') }}" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="swiper-slide parttime-hourlyrate">
                                <div class="row">
                                    <div class="col-md">
                                        <h3>What is Preferred <br> Hourly Rate?</h3>
                                        <h6>Estimate your budget</h6>
                                        <p>You will have the option to create milestones which divide your project into manageable phase.</p>
                                        <ul>
                                            <li class="selected" data-class="hourly-rate" id="hourly_rate_radio">
                                                <i class="fa-solid fa-check"></i>
                                                <i class="far fa-clock"></i>
                                                <h6>Hourly  rate</h6>
                                            </li>
                                            <li data-class="project-budget" id="project_budget_radio">
                                                <i class="fa-solid fa-check"></i>
                                                <i class="fas fa-tags"></i>
                                                <h6>Project  budget</h6>
                                            </li>
                                        </ul>


                                        <div>
                                            <div class="complex hourly-rate" id="hourly_rate_radio_onselect">
                                                <form>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col">
																@if (session('fulltime_job_min'))
																	<input type="number" id="fulltime_job_min" placeholder="Min " value="{{session('fulltime_job_min')}}">
																@else
																	<input type="number" id="fulltime_job_min" placeholder="Min ">
																@endif
																
															</div>
                                                            <div class="col">
																@if (session('fulltime_job_max'))
																	<input type="number" id="fulltime_job_max" placeholder="Max" value="{{session('fulltime_job_max')}}">
																@else
																	<input type="number" id="fulltime_job_max" placeholder="Max">
																@endif
																
															</div>
                                                            <div class="col">
                                                                <select id="fulltime_job_currency_minmax" name ="fulltime_job_currency_minmax">
																	@if(isset($currencies))													
																		@foreach($currencies as $currency => $abbr)
																			@if (session('fulltime_job_currency_minmax'))
																				<option value="{{$currency}}" <?php if(session('fulltime_job_currency_minmax') == $currency){echo "selected";}?>>{{$currency}}</option>
																			@else
																				<option value="{{$currency}}">{{$currency}}</option>
																			@endif
																			
																		@endforeach
																	@else
																			<option value="INR">INR</option>
																	@endif                                                        
																</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        &nbsp;
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea rows="3" id="fulltime_job_desc_minmax" placeholder="Add Short Description for your Project (Optional)">@if (session('fulltime_job_desc_minmax')){{session('fulltime_job_desc_minmax')}}@endif</textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="complex project-budget" id="project_budget_radio_onselect">
                                                <form>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-6">
																@if (session('fulltime_job_budget'))
																	<input type="number" id="fulltime_job_budget" placeholder="$" value="{{session('fulltime_job_budget')}}">
																@else
																	<input type="number" id="fulltime_job_budget" placeholder="$">
																@endif
															
															</div>
                                                            <div class="col-4">
                                                                <select id="fulltime_project_budget_currency" name ="fulltime_project_budget_currency">
																	@if(isset($currencies))													
																		@foreach($currencies as $currency => $abbr)
																			@if (session('fulltime_project_budget_currency'))
																				<option value="{{$currency}}" <?php if(session('fulltime_project_budget_currency') == $currency){echo "selected";}?>>{{$currency}}</option>
																			@else
																				<option value="{{$currency}}">{{$currency}}</option>
																			@endif
																			
																		@endforeach
																	@else
																			<option value="INR">INR</option>
																	@endif                                                        
																</select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        &nbsp;
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea rows="3" id="fulltime_job_desc_budget" placeholder="Add Short Description for your Project (Optional)">@if (session('fulltime_job_desc_budget')){{session('fulltime_job_desc_budget')}}@endif</textarea>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md">
                                        <div class="upimageatmodal">
                                            <img src="{{ asset('assets/images/hourly-rate-avtar.png') }}" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="swiper-slide parttime-almostdone">
                                <div class="row">
                                    <div class="col-md">
                                        @if (Auth::check())
											<h3>Submit your job</h3>
										@else
											<h3>Please Login to Post</h3>
										@endif
                                        <div class="modal-employee-card">
                                            <form>
											{{--<div class="form-group">
													<div class="progress-modal">
														<div class="pie-wrapper progress-full">
															<span class="label">90<em>%</em></span>
															<div class="pie">
																<div class="left-side half-circle"></div>
																<div class="right-side half-circle"></div>
															</div>  
														</div>
													</div>
												</div>--}}
												{{--
												@if (Route::has('register'))
													<a href="" data-bs-toggle="modal" data-bs-target="#modal-register" class="reg_modal_pop_btn btn btn-primary">Register</a>
												@endif
                                                @if (Route::has('login'))
													<a href="" data-bs-toggle="modal" data-bs-target="#modal-login" class="login_modal_pop_btn btn btn-primary">Login</a>
                                                @endif--}}
												@if (Auth::check())
													
													
													<div class="form-group">
														<input type="button" id="submit_full_project_disable" value="submit" class="btn btn-primary" style="width:100%;">
													</div>
												@else
													
													
													<div class="form-group">
														<div class="d-flex align-items-center justify-content-between">
                                                            <div class="google-btn">
                                                                <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                                                                <div class="google-sign">
                                                                    <i class="fab fa-google"></i>
                                                                    Sign In
                                                                </div>
                                                            </div>
                                                            <a href="{{ url('auth/linkedin/redirect') }}" class="social-icon" id="social_linkindin_login_login">
                                                                <i class="fab fa-linkedin-in"></i>
                                                                Sign In
                                                            </a> 
                                                        </div> 
													</div>
													
													{{--<div class="form-group" >
														<input type="button" id="submit_full_project_disable" value="Submit" class="btn btn-primary" style="width:100%;" disabled>
													</div>--}}
													<div class="form-group" >
														<input type="button" id="submit_fullproject_temp" value="Submit as Guest" class="btn btn-primary" style="width:100%;">
													</div>
												@endif
                                            </form>
                                            <!--<div class="employee-navigation">
                                                <a class="parttime-verifay" href="" data-bs-toggle="modal" data-bs-target="#modal-employer-varifyed">Verify</a>
												<input type="button" id="verify_fulltime_employer">Verify</a>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="upimageatmodal">
                                            <img src="{{ asset('assets/images/done-avatar.png') }}" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <!-- Add Pagination -->
                        <ul>
                            <li>Headline</li>
                            <li>Skills</li>
                            <li>Budget</li>
                            <li>Verifiy</li>
                        </ul>
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
						@if (session('fulltime_job_min'))
							<div class="swiper-button-next " style="pointer-events: all; opacity: 1;">NEXT</div>
						@else
							<div class="swiper-button-next " style="pointer-events: none; opacity: 0.35;">NEXT</div>
						@endif
                        
                        <div class="swiper-button-prev" >BACK</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End parttime -->
        
        
        <!-- starting modal-employer-varifyed -->
        <div class="modal fade modal-employer-varifyed" id="modal-employer-varifyed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <img src="{{ asset('assets/images/varifyed-icon.png') }}" alt="image">
                            <h5>Verifyed</h5>
                        </div>
                        <div>
                            <p>An email confirmation sent to your provided mail id <br> in which you can get your ID &amp; temporary password. </p>
                        </div>
                        <div>
                            <a href="{{url('employerdashboard')}}">Go to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-employer-varifyed -->
        
        
        <!-- starting modal-dashboard-employer -->
        <div class="modal fade modal-dashboard-employer" id="modal-dashboard-employer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        
                        
                        <div class="dashboard-header">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="dashboard-avatar">
                                        <img src="{{ asset('assets/images/avatar2.png') }}" alt="image">
                                        <span></span>
                                    </div>
                                    <div class="dashboard-avatar-data">
                                        <h4>Jyotirmoy Bhattacharyya</h4>
                                        <div><i class="fas fa-map-marker-alt"></i> <span>Mumbai, India </span> - <span>12:13pm local time</span></div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="settlink">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#modal-profile-setting">Profile Setting</a>
                                    </div>
                                    <div class="setticon">
                                        <span><i class="fas fa-ellipsis-h fa-2x"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="employer-dashboard-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                                    <ul class="employer-dashboard-menu">
                                        <li class="selected" data-class="part1">Current Employees</li>
                                        <li data-class="part2">Hire a New Employee</li>
                                        <li data-class="part3">View all Invoices</li>
                                    </ul>
                                    <div class="uplogout"><a href="">Log out</a></div>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12 col-12">
                                    <div class="complex part1">
                                        <h5>Current Employees</h5>
                                        
                                        <div class="current-employees-box">
                                            <div class="current-header">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="dashboard-avatar">
                                                            <img src="{{ asset('assets/images/avatar3.png') }}" alt="image">
                                                            <span></span>
                                                        </div>
                                                        <div class="dashboard-avatar-data">
                                                            <h4>Jyotirmoy Bhattacharyya</h4>
                                                            <div><i class="fas fa-map-marker-alt"></i> <span>Mumbai, India </span> - <span>12:13pm local time</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="setticon">
                                                            <span><i class="fas fa-ellipsis-h fa-2x"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="current-details">
                                                <div class="row">
                                                    <div class="col-md">
                                                        <h6>Project details</h6>
                                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
                                                        <div class="review">
                                                            <span>Review</span>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="current-performance">
                                                            <h6>Performance </h6>
                                                            <div class="progress-modal">
                                                                <div class="pie-wrapper progress-full">
                                                                    <span class="label">85<em>%</em></span>
                                                                    <div class="pie">
                                                                        <div class="left-side half-circle"></div>
                                                                        <div class="right-side half-circle"></div>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="current-employees-box">
                                            <div class="current-header">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="dashboard-avatar">
                                                            <img src="{{ asset('assets/images/avatar3.png') }}" alt="image">
                                                            <span></span>
                                                        </div>
                                                        <div class="dashboard-avatar-data">
                                                            <h4>Jyotirmoy Bhattacharyya</h4>
                                                            <div><i class="fas fa-map-marker-alt"></i> <span>Mumbai, India </span> - <span>12:13pm local time</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="setticon">
                                                            <span><i class="fas fa-ellipsis-h fa-2x"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="current-details">
                                                <div class="row">
                                                    <div class="col-md">
                                                        <h6>Project details</h6>
                                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
                                                        <div class="review">
                                                            <span>Review</span>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="current-performance">
                                                            <h6>Performance </h6>
                                                            <div class="progress-modal">
                                                                <div class="pie-wrapper progress-full">
                                                                    <span class="label">85<em>%</em></span>
                                                                    <div class="pie">
                                                                        <div class="left-side half-circle"></div>
                                                                        <div class="right-side half-circle"></div>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="current-employees-box">
                                            <div class="current-header">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="dashboard-avatar">
                                                            <img src="{{ asset('assets/images/avatar3.png') }}" alt="image">
                                                            <span></span>
                                                        </div>
                                                        <div class="dashboard-avatar-data">
                                                            <h4>Jyotirmoy Bhattacharyya</h4>
                                                            <div><i class="fas fa-map-marker-alt"></i> <span>Mumbai, India </span> - <span>12:13pm local time</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="setticon">
                                                            <span><i class="fas fa-ellipsis-h fa-2x"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="current-details">
                                                <div class="row">
                                                    <div class="col-md">
                                                        <h6>Project details</h6>
                                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat</p>
                                                        <div class="review">
                                                            <span>Review</span>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="current-performance">
                                                            <h6>Performance </h6>
                                                            <div class="progress-modal">
                                                                <div class="pie-wrapper progress-full">
                                                                    <span class="label">85<em>%</em></span>
                                                                    <div class="pie">
                                                                        <div class="left-side half-circle"></div>
                                                                        <div class="right-side half-circle"></div>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                    <div class="complex part2">222222</div>
                                    <div class="complex part3">333333</div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal-dashboard-employer -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA="crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
$('input[name="phone"]').mask('000-000-0000'); 
$("#emp_country").click(function () {
var country_name = this.value;
//alert(country_name);
var token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
type: "post",
dataType:'json',
data: { "_token": "{{ csrf_token() }}" , 
     "country_name":country_name
    },
url: "{{url('countrynamecode')}}",
success: function(data) {
//alert(data.selectmenuId);
$("#emp_phone_ext").val(data.selectmenuId);
}
});

});
});
$(document).ready(function () {
$("#emp_phone_no").click(function () {
//var country_name = this.value;
//alert(country_name);
var emp_email = document.getElementById("emp_email").value; 
        //document.getElementById("demo").innerHTML = x; 
        //alert(emp_email);
var token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
type: "get",
dataType:'json',
data: { "_token": "{{ csrf_token() }}" , emp_email:emp_email},
url: "{{url('valiedEmailCheck')}}",
            success: function (data) {
            console.log('data', data);
            $(".alert-danger").css("display", "block");
            $(".alert-danger").append("<P>Email is already exist");
        } 
});
});
});

function myFunction() { 
       /// var valiedEmail = document.getElementById("emp_email").value; 
        //document.getElementById("demo").innerHTML = x; 
       // alert(valiedEmail);
        //var token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
type: "post",
dataType:'json',
//data: { "_token": "{{ csrf_token() }}" , valiedEmail:emp_email},
//url: "{{url('valiedEmailCheck')}}",
success: function(data) {
//alert(data.selectmenuId);
$("#emp_phone_ext").val(data.selectmenuId);
}
});

    }
    </script>
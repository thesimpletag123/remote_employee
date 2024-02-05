 
 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- for responsive page -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('assets/images/logo-icon.png')}}">
		<meta name="google-signin-client_id" content="548697632443-e8k8jltgggkl7vqj97iudua56jftqdaf.apps.googleusercontent.com">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome CDN-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css" />
        <title>About Us || {{ config('app.name') }}</title>
        <!-- for animation -->
        @include('layouts.css')
		@yield('pagecss')		
    </head>
    <style> 
   {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
section {
  height: 100vh;
  width: 100%;
  display: grid;
  place-items: center;
}
.row {
  display: flex;
  flex-wrap: wrap;
}
.column {
  width: 100%;
  padding: 0 1em 1em 1em;
  text-align: center;
}
.card {
  width: 250px;
  height: 410px;
  padding: 2em 1.5em;
  background: linear-gradient(#ffffff 50%,);
  background-size: 100% 200%;
  background-position: 0 2.5%;
  border-radius: 5px;
  box-shadow: 0 0 35px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  transition: 0.5s;
}
h3 {
  font-size: 20px;
  font-weight: 270;
  color: #1f194c;
  margin: 1em 0;
  
}
p {
  color: #575a7b;
  font-size: 15px;
  line-height: 1.6;
  letter-spacing: 0.03em;
}
.icon-wrapper {
  background-color: #2c7bfe;
  position: absolute;
  
  font-size: 60px;
  height: 2.5em;
  width: 2.5em;
  color: #ffffff;
  border-radius: 50%;
 
   
   
}
 
 
     </style>
    <body>
        <!-- starting header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg col-sm-3 d-flex justify-content-center justify-content-sm-start">
                        <a href="{{url('/')}}"><img src="{{ asset('assets/images/main-logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="col-lg col-sm-9">
					{{--<div>
							 @if (Auth::check())
								<form>
									<input type="search" placeholder="SEARCH" name="">
								</form>
							@endif
                        </div>--}}
                        <div>
							@if (Route::has('login'))
								<div class="top-right links">
									@auth
										<a href="#" target="_blank"data-bs-toggle="modal" id="scheduleFreeConsulting"data-bs-target="#modal-scheduleFreeConsulting" class="scheduleFreeConsulting_modal_pop_btn">Schedule Free Consulting</a>
										 @if( Request::path() == '/' || Request::path() == '/home')
											@if($user->user_type == 'employer') 
												<a class="home_btn" href="{{ url('/employerdashboard') }}">Dashboard</a>
											@elseif($user->user_type == 'employee')
												<a class="home_btn" href="{{ url('/dashboard') }}">Dashboard</a>
											@endif
										 @else
											 <a class="home_btn" href="{{ url('/') }}">Home</a>
										 @endif
										
										<a class="logout_btn" href="{{url('logout')}}" onclick="signOut();">Logout</a>
									@else
										<a href="#" data-bs-toggle="modal" data-bs-target="#modal-scheduleFreeConsulting" class="scheduleFreeConsulting_modal_pop_btn"target="_blank">Schedule Free Consulting</a>
										<a href="" data-bs-toggle="modal" data-bs-target="#modal-login" class="login_modal_pop_btn">Login</a>

										@if (Route::has('register'))
											<a href="" data-bs-toggle="modal" data-bs-target="#modal-register" class="reg_modal_pop_btn">Register</a>
										@endif
									@endauth
								</div>
							@endif
                        </div>
                        <!--<div><span><i class="fas fa-th"></i></span></div>-->
                    </div>
                </div>
            </div>
        </header>
        <!-- End header -->
		
		@if(Session::get('success'))
			<div class="alert-custom-div col-lg container">
				<div class="alert alert-success">
				{{session::get('success')}}
				</div>
			</div>
		@endif
		 
		@if(Route::currentRouteName() == 'baseurllogin')
		<div class="main">
		@else
		<div class="main dashboard" style="margin-top:125px;">
		@endif

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

							<div class="form-group">
								<a href="javascript:void(0)" class="toggle_login_reg_btn" id="go_to_login_popup"> Already a member </a>
							</div>
							<div class="form-group">
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

							<div class="form-group">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> <span class="text-white">Remember me</span>
							</div>
							<div class="form-group">
								<button type="submit" id="login_button_for_validation" class="btn btn-primary">
									{{ __('Login') }}
								</button>
							</div>
							<div class="form-group">
								<a class="toggle_login_reg_btn" id="go_to_register_popup"> Not a Member Yet? </a>
							</div>
							<div class="form-group">
								@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">
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



<!-- starting modal-dashboard-employee -->
<div class="container">
	<div class="modal-dashboard-employee">
		<div class="jopboard-box">
            <div class="row">
                <div class="col-12">
                    <h2 style="text-align: center;">About us</h2>
                    
                </div>
                <div class="col-12">
                    <h5 class="text-center" style="text-align: justify;">At TheRemoteEmployee.com, we believe in transforming businesses through strategic outsourcing solutions. With a commitment to excellence and a focus on delivering measurable results, we have positioned ourselves as a trusted partner for organisations seeking to optimise their operations and achieve sustainable growth.
                </h6>
                </div>
                <div class="col-sm-6 col-12">
                </div>   
            </div>
        </div>
       
        <div style=" padding-top:50px;"></div>           
        <h2 class="text-center">Our Mission</h2>
        <div style=" padding-top:50px;"></div>

        <div class="row">
	        <div class="col-sm-6 col-md-6" style="padding-left:90px;">
	          <div class="text">
	            		<p style="text-align: justify;">
			              Provide remote employees and remote teams to Businesses, Entrepereneurs, Starups, Innovative & Emerginh Companies in the world to help them boost.<br>
			              Empowering businesses through seamless outsourcing, we strive to be the catalyst for success in an ever-evolving business landscape. Our mission is to provide innovative, cost-effective, and tailored outsourcing solutions that allow our clients to concentrate on their core competencies while we handle the rest.
	              		</p>
	            </div>
	              	
	        </div>
	        <div class="col-sm-6 col-md-6">
	            <div class="icon-wrapper" style="margin-left:30%;">
                    <i class="fa-solid fa-bullseye" style="padding-top:45px;padding-left: 45px;"></i>
                </div>
	        </div>
	    </div>

        <div style=" padding-top:50px;"></div>
        <h2 class="text-center">Who We Are</h2>
        <div style=" padding-top:50px;"></div>

        <div class="row">
        	<div class="col-sm-6 col-md-6">
	            <div class="icon-wrapper" style="margin-left:30%;">
                    <i class="fa-solid fa-question-circle" style="padding-top:45px;padding-left: 45px;"></i>
                </div>
	        </div>
	        <div class="col-sm-6 col-md-6" style="padding-right:90px;">
	          <div class="text">
	            		<p style="text-align: justify;">
			              	Established with a passion for driving efficiency and fostering growth, 
				            TheRemoteEmployee.com is a team of dedicated professionals with diverse expertise.
				            From virtual assistants for outsource customer service,  
				            IT consulting and process automation to implement AI and beyond, 
				            our talented pool of specialists is committed to delivering exceptional results.
	              		</p>
	            </div>	
	        </div>
	    </div>
        
        <div style=" padding-top:50px;"></div>

         	</div>
    	</div>
                </div> 
			</div>					
		</div>
	</div>
</div>
        <!-- starting footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md col-sm-6 col-6 wow fadeInUpBig" data-wow-duration=".25s" data-wow-offset="60">
                        <a href="{{route('service')}}">Services</a>
                        <a href="{{route('aboutus')}}">About Us</a>
                        <a href="{{route('contactus')}}">Contact Us</a>
                        <a href="{{route('whoweare')}}">Who We Are</a>
                    </div>
                    <div class="col-lg-2 col-md col-sm-6 col-6 wow fadeInUpBig" data-wow-duration=".5s" data-wow-offset="60">
                        <a href="" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                    </div>
                    <div class="col-lg-5 col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration=".75s" data-wow-offset="60">
                        <p>Subscribe to our newsletter</p>
                        <form>
                            <input type="email" placeholder="Email Address" name="">
                            <input type="submit" value="ok">
                        </form>
                    </div>
                    <div class="col-lg-3 col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration="1s" data-wow-offset="60">
                        <p>Srijan Corporate, Tower 1, 1505, Sector V, 700091</p>
                        <p><a href="tel:+44 345 678 903">+91 968 121 5646</a></p>
                        <p><a href="mailto:theremoteemployee@gmail.com">theremoteemployee@gmail.com</a></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End footer -->			
			
        
        <!-- starting button-top -->
        <div id="button-top">
            <i class="fa fa-angle-up fa-2x"></i>
        </div>
        <!-- End button-top -->
		<div class="cssloader" id="siteLoader" style="display:none">
            {{-- <div class="sh1"></div>
            <div class="sh2"></div> --}}
            <img src="{{asset('assets/images/480px-Loader.gif') }}" />
        </div>
        @include('layouts.script')
	@yield('pagescript')
    </body>
</html>
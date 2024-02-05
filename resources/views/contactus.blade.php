 
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
        <title>Contact Us || {{ config('app.name') }}</title>
        <!-- for animation -->
        @include('layouts.css')
		@yield('pagecss')
		
		
		 
     
    </head>

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
                    <h1>Contact Us</h1>
                     
                </div>  
            </div>
        </div>
		 <!-- Contact 1 - Bootstrap Brain Component -->
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-lg-center">
      <div class="col-12 col-md-12">
        <div class="bg-white border rounded shadow-sm overflow-hidden">
          <form action="{{route('contactususer')}}" method="post">
            @csrf
            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
              <div class="col-12">
                <label for="fullname" class="form-label">Full Name <span class="text-danger"></span></label>
                <input type="text" class="form-control" id="fullname" name="name" value="" placeholder="Add Fullname" required>
              </div>
              <div class="col-12 col-md-6">
                <label for="email" class="form-label">Email <span class="text-danger"></span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                    </svg>
                  </span>
                  <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email" required>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <label for="phone" class="form-label">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>
                  </span>
                  <input type="tel" class="form-control" id="phone" name="phone" value="" placeholder="Phone">
                </div>
              </div>
              <div class="col-12">
                <label for="message" class="form-label">Message <span class="text-danger"></span></label>
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Add note here" required></textarea>
              </div>
              <div class="col-12" style="padding-top:10px;">
                <div class="d-grid">
                  <button class="btn btn-primary btn-lg form-control" type="submit">Submit</button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
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
                         
                    </div>
                    <div class="col-lg-2 col-md col-sm-6 col-6 wow fadeInUpBig" data-wow-duration=".5s" data-wow-offset="60">
                        <a href="https://youtube.com/channel/UCJufvVVE_wPhYquwjrFi2Qw" target="_blank"><i class="fab fa-youtube"></i> YouTube</a>
                        <a href="https://twitter.com/TREmployee" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="https://www.linkedin.com/in/theremote-employee-6427492a2/" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
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
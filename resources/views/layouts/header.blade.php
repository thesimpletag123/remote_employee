<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- for responsive page -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('assets/images/logo-icon.png') }}">
		<meta name="google-signin-client_id" content="548697632443-e8k8jltgggkl7vqj97iudua56jftqdaf.apps.googleusercontent.com">
        <title>@yield('title') || {{ config('app.name') }}</title>
        <!-- for animation -->
        @include('layouts.css')
		@yield('pagecss')
		
		
    </head>
    <body>
        <!-- starting header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg col-sm-3">
                        <a href="{{url('/')}}"><img src="{{ asset('assets/images/main-logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="col-lg col-sm-9">
                        <div>
							 @if (Auth::check())
								<form>
									<input type="search" placeholder="SEARCH" name="">
								</form>
							@endif
                        </div>
                        <div>
							@if (Route::has('login'))
								<div class="top-right links">
									@auth
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
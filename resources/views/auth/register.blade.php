@extends('layouts.master')


@section('title', 'Register')
@section('pagecss')
<style>
div#modal-register {
    margin-top: 5%;
}
.modal-xl {
    max-width: 80%;
}
a.reg_modal_pop_btn {
    display: none;
}
</style>
@endsection

@section('content')
<div class="modal-login" id="modal-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<form method="POST" action="{{ route('register') }}">
					@csrf

						<div class="form-group row">
							<i class="fas fa-envelope"></i>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" Placeholder="Enter Your Name" autofocus style="padding-left: 35px;">

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="form-group row">
							<i class="fas fa-unlock-alt"></i>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your Email" />

							@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="form-group row">
							<i class="fas fa-unlock-alt" ></i>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class="form-group row">
							<i class="fas fa-unlock-alt" ></i>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>

						<div class="form-group">
							<a href="{{url('login')}}"> Already a member </a>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								{{ __('Register') }}
							</button>
						</div>
						<div class="form-group">
							<a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="social-icon"><img src="{{ asset('assets/images/google-logo.png') }}"></a>
							<a href="{{ url('auth/linkedin/redirect') }}" class="social-icon"><img src="{{ asset('assets/images/linkedin-logo.png') }}"></a>            
						</div>						
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

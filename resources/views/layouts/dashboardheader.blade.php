<style>
.user-verified-batch, .user-unverified-batch {
    padding: 5px;
    border-radius: 25px;
    margin-left: -10px;
	text-align: center;
}

.user-verified-batch {
    background-color: lightgreen;
}	
.user-unverified-batch {
    background-color: orangered;
}
.verify-tag {
	cursor: pointer;
}

</style>
<div class="modal fade" id="verify-user-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between">
				<h3>Hello , {{$user->name}}</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
			</div>
			@if($user->is_verified == 0)
				<div class="modal-body verify_user_pop">
					
							
							<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
							<div class="col-auto py-3">
								<div class="d-flex flex-column  mb-3">
									Please enter the OTP for verifications
									<input type="number" class="form-control" id="headerotp" name="headerotp"
										placeholder="Enter OTP here" value="">
								</div>
								<div class="d-flex flex-column  mb-3">
									<input type="button" id="verifyotpfromhead" class="btn btn-primary" value="Submit OTP">
								</div>
							</div>
				</div>
			@else
				<div class="modal-body verify_user_pop">
					
							<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
							<div class="col-auto py-3">
								<div class="d-flex flex-column  mb-3">
									You have already verified your Email. No action Required.
									
								</div>
								<div class="d-flex flex-column  mb-3">
									<button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"> Ok </button>
								</div>
							</div>
				</div>
			@endif
		</div>
	</div>
</div>
	<div class="dashboard-header">
		<div class="row">
			<div class="col-lg">
				<div class="dashboard-avatar">
					@if(isset($user->user_image))
						<img id="user_image_previewas" src="{{ $user->user_image }}" alt="">						
					@else
						<img id="user_image_previewsa" src="{{ url('assets/images/avtar.png') }}" alt="">						
					@endif
						<span class="profile_img fa-solid fa-angles-up">
					
						<input type="file" name="user_image" id="user_image" >
						</span>
						
					<!--<span class="activemark"></span>
					<span class="editicon"><i class="fas fa-pen"></i></span>-->
				</div>
				<div class="dashboard-avatar-data">
					<h4>{{$user->name}}</h4>
					@if($user->is_verified == 0)
					<div class="user-unverified-batch">
						<span class="verify-tag" data-bs-toggle="modal" data-bs-target="#verify-user-popup">
							<i class="fas fa-square-xmark" style="color:#464646;"> UnVerified User </i> 
						</span>
					</div>
					@endif
				</div>
			</div>
			<div class="col-lg">
				<!--<div class="settlink">
					<a href="{{route('dashboard')}}">Go to Dashboard</a>
				</div>-->
				&nbsp;
				<div class="settlink">
					<!--<span><i class="fas fa-ellipsis-h fa-2x"></i></span>-->
					{{--<div class="dropdown show">
						<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Actions
						</a>
						@if($user->user_type == 'employer')
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
								
								@if(Route::is('employerdashboard'))
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
								@else
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
									<a class="dropdown-item" href="{{route('employerdashboard')}}">Go to Dashboard</a>
								@endif
								<a class="dropdown-item" href="#" onclick="open_jobpost_popup()">Post a new Job</a>
							</div>
						@else
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
								@if(Route::is('dashboard'))
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
								@else
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
									<a class="dropdown-item" href="{{route('dashboard')}}">Go to Dashboard</a>
								@endif
							</div>
						@endif
					</div>--}}
						@if($user->user_type == 'employer')
							
								
								@if(Route::is('employerdashboard'))
									<a class="btn btn-primary" href="{{route('myprofile')}}">My Profile</a>
									<a class="btn btn-primary" href="#" onclick="open_jobpost_popup()">Post a new Job</a>
								@else
									<a class="btn btn-primary" href="{{route('myprofile')}}">My Profile</a>
									<a class="btn btn-primary" href="{{route('employerdashboard')}}">Go to Dashboard</a>
									<a class="btn btn-primary" href="#" onclick="open_jobpost_popup()">Post a new Job</a>
								@endif
									
							
						@else
							
								@if(Route::is('dashboard'))
									<a class="btn btn-primary" href="{{route('myprofile')}}">My Profile</a>
								@else
									<a class="btn btn-primary" href="{{route('myprofile')}}">My Profile</a>
									<a class="btn btn-primary" href="{{route('dashboard')}}">Go to Dashboard</a>
								@endif
							
						@endif
				</div>
			</div>
		</div>
	</div>
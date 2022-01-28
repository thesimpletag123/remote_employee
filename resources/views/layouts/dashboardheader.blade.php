	<div class="dashboard-header">
		<div class="row">
			<div class="col-lg">
				<div class="dashboard-avatar">
					@if(isset($user->user_image))
						<img id="user_image_previewas" src="{{ $user->user_image }}" alt="">		
						<span></span>				
					@else
						<img id="user_image_previewsa" src="{{ url('assets/images/avtar.png') }}" alt="">						
					@endif
						<input type="file" name="user_image" id="user_image" class="fas fa-pen profile_img">
						
					<!--<span class="activemark"></span>
					<span class="editicon"><i class="fas fa-pen"></i></span>-->
				</div>
				<div class="dashboard-avatar-data">
					<h4>{{$user->name}}</h4>
					<div><span>LoggedIn as </span> - <span class="text-capitalize"> {{$user->user_type}}</span></div>
				</div>
			</div>
			<div class="col-lg">
				<!--<div class="settlink">
					<a href="{{route('dashboard')}}">Go to Dashboard</a>
				</div>-->
				&nbsp;
				<div class="settlink">
					<!--<span><i class="fas fa-ellipsis-h fa-2x"></i></span>-->
					<div class="dropdown show">
						<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Actions
						</a>
						@if($user->user_type == 'employer')
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								
								@if(Route::is('employerdashboard'))
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
								@else
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
									<a class="dropdown-item" href="{{route('employerdashboard')}}">Go to Dashboard</a>
								@endif
								<a class="dropdown-item" href="#" onclick="open_jobpost_popup()">Post a new Job</a>
							</div>
						@else
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								@if(Route::is('dashboard'))
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
								@else
									<a class="dropdown-item" href="{{route('myprofile')}}">My Profile</a>
									<a class="dropdown-item" href="{{route('dashboard')}}">Go to Dashboard</a>
								@endif
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
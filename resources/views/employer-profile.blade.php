@extends('layouts.master')
@section('title', 'Profile')
@section('pagecss')
<style>
div#modal-profile-setting {
    margin-top: 6%;
}
.modal-xl {
    max-width: 80%;
}

.padding_none {
	padding-left: 0px;
}
select#emp_skills {
    width: -webkit-fill-available;
    overflow: auto;
	width: -webkit-fill-available;
    overflow: auto;
    border: 1px solid #ced4da;
    border-radius: 5px;
}
</style>
@endsection
@section('content')
<!-- starting modal-profile-setting -->
	<div class="modal-profile-setting" id="modal-profile-setting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-body">
					
					<input type="hidden" id="hidden_uid" value="{{$user->id}}">
@include('layouts.dashboardheader')
					
					<div class="profile-setting-body">
						<div class="row">

	
	
<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
	<div class="main-setting">
	<?php 
		$i = 0;
		$j = 0;
		$k = 0;
		$l = 0;
	?>
		@if(isset($alljobslist))
			@foreach($alljobslist as $singlejob)
				@if($singlejob['posted_by_id'] == $user->id)
					<?php						
						$i++;
						if( $singlejob['project_status'] == 0){
							$j++;
						}
						if( $singlejob['project_status'] == 1){
							$k++;
						}
						if( $singlejob['project_status'] == 2){
							$l++;
						}
					?>
				@endif
			@endforeach
		@endif	
		
		
		<div class="availability">
			<h6>Name </h6>
			<p>{{$user->name}}</p>
			
		</div>
		<div class="myskills">
			<h6>My Email</h6>
			<div class="skill-group">
				<p>{{$user->email}}</p>
			</div>
		</div>
		
		<table class="show_project_count">
			<thead>
				<tr><td colspan='2'>Project Details</td></tr>
			</thead>
			<tr>
				<td>Completed Jobs</td><td>{{$l}}</td>
			</tr>
			<tr>
				<td>Active Jobs</td><td>{{$k}}</td>
			</tr>
			<tr>
				<td>Pending Jobs</td><td>{{$j}}</td>
			</tr>
			<tr>
				
				<td>Total Posted Jobs</td><td>{{$i}}</td>
			</tr>
		
		</table>
		
		


	<hr>
	<?php $i = 1; ?>
		@if(isset($alljobslist))
			@foreach($alljobslist as $singlejob)
				@if($singlejob['posted_by_id'] == $user->id)
					@if($i == 1)
						
					@endif
					<div class="mysidebardiv job-show-hide-div" id="job-{{$singlejob['id']}}">
						<b>{{$singlejob['job_title']}}</b>
						<div class="col-lg-12 custom_div">
							
								<b><label>Description :</label></b>{{$singlejob['project_description']}}
							
						</div>
						<div class="col-lg-12 custom_div">
							@if($singlejob['assigned_to_username'] != '')
								<b><label>Assigned to :</label></b>{{$singlejob['assigned_to_username']}}
							@else
								<b><label style="color:red;">Not Assigned Yet.</label></b>
							@endif
						</div>
						<div class="col-lg-12 custom_div">
							<b><label>Skill Required:</label></b> <?=str_replace('-', ' , ', $singlejob['required_skills'])?>
						</div>
					</div>
					
				@endif	
			@endforeach
		@endif
	</div>
</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>My Profile</h5>
								<form id="employerprofileupdate" name="employerprofileupdate" method="post" action="{{route('employerprofileupdate')}}" enctype="multipart/form-data">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<div class="col-auto">
										<div class="col-lg-8 custom_div">
											<label for="name" class="form-label">Name</label>
											<input type="text" class="form-control" id="name" name="name" placeholder="Job Title here" value="{{$user->name}}">
										</div>
										<div class="col-lg-8 custom_div">
										  <label for="email" class="form-label">Email ID</label>
										  <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
										</div>
										<div class="col-lg-8 custom_div">
											<label for="experience" class="form-label">Joined Remote Employee</label>
											<?php
												$monthNum  = $user->created_at->month;
												$dateObj   = DateTime::createFromFormat('!m', $monthNum);
												$monthName = $dateObj->format('F');
												$usersince = $monthName.', '.$user->created_at->year;
											?>
											<input type="text" step=1 class="form-control" value="{{$usersince}}" readonly>
										</div>
										<div class="col-lg-8 custom_div">
											<input type="submit" value="Update Name" class="btn btn-primary">
											<a href="{{route('employerdashboard')}}" class="btn btn-success"> Back to dashboard</a>
										</div>
									</div>
									
									
								</form>
								<hr>
								<div class="col-auto mother-jobdiv">
									@if(isset($alljobslist))
										@foreach($alljobslist as $singlejob)
											@if($singlejob['posted_by_id'] == $user->id)
												@if($i == 1)
													<h5> Posted Jobs: </h5>
												@endif
												<div class="jobdiv" id="{{$singlejob['id']}}" onClick="show_job_on_click(this.id)">
													<b>{{$singlejob['job_title']}}</b>
													<div class="col-lg-12 custom_div">
														@if($singlejob['assigned_to_username'] != '')
															<b><label>Assigned to :</label></b>{{$singlejob['assigned_to_username']}}
														@else
															<b><label style="color:red;">Not Assigned Yet.</label></b>
														@endif
													</div>
												</div>
												<?php $i++; ?>
											@endif	
										@endforeach
									@endif
									
								</div>
								
							</div>
							
						</div>
						
									
					</div>					
				</div>
			</div>
		</div>
	</div>
	<!-- End modal-profile-setting -->
@endsection

@section('pagescript')
<script>

</script>
@endsection
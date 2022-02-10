@extends('layouts.master')
@section('title', 'View Job')
@section('pagecss')

@endsection
@section('content')
<!-- starting modal-profile-setting -->
<div class="container">
	<div class="modal-profile-setting">
					
					<input type="hidden" id="hidden_uid" value="{{$user->id}}">
@include('layouts.dashboardheader')

					<div class="profile-setting-body">
						<div class="row">

	
	
<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
	<div class="main-setting">
		<div class="availability">
			<h6>My Proffesional Fields </h6>
			<p>{{$user->name}}</p>
			
		</div>
		<div class="myskills">
			<h6>My Skills</h6>
			<div class="skill-group">
				<p>{{$user->email}}</p>
			</div>
		</div>
		
	
	<hr>
	
	</div>
</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<div class="job_up_head d-flex justify-content-between align-items-center col-auto">
									<h5 class="pl-0">Post an update</h5> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#post-an-update-modal">Post status</button>
								</div>
								
								
									
									<div class="col-auto">
										<div class="custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" readonly value="{{$getjobbyid->job_title}}">
										</div>
										<div class="custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" readonly>{{$getjobbyid->project_description}}</textarea>
										</div>
									</div>
										
									
								
								<div class="col-auto">
								<div class="panelbox py-1 mb-3">
								@if(isset($getjobupdatebyid))
									@foreach($getjobupdatebyid as $jobupdate)
										<div class="current-employees-box">
											<div class="current-header">
												<div class="row">
													<div class="col-sm-12">
													
														<div class="dashboard-avatar">
															@if($jobupdate->user->user_image == null)
																<img src="{{url('assets/images/avtar.png')}}" alt="image">
															@else
																<img src="{{$jobupdate->user->user_image}}" alt="image">
															@endif
															<!--<span></span>-->
														</div>
														<div class="dashboard-avatar-data">
															<h4>{{$jobupdate->user->name}}</h4>													
															<div>{{$jobupdate->user->email}}</div>
														</div>
													</div>
												</div>
											</div>
											<div class="current-details">
												<div class="row">
													<div class="col-md">
														<div class="job_block">
															<b><label>Description:</label></b> {{$jobupdate->jobupdate_description}}
														</div>
														<div class="job_block">
															<b><label>Time worked:</label></b> {{$jobupdate->jobupdate_time}} Hour
														</div>
														<div class="job_block">
															<b><label>Mail:</label></b> {{$jobupdate->jobupdate_headline}}
														</div>
														
													</div>
												</div>
											</div>
										</div>
									@endforeach
								@else
									<div class="mysidebardiva">
										<b>No Updates available</b>		
									</div>
								@endif
								</div>
								</div>
							</div>
						</div>
						</div>
						
									
					</div>	
							
				</div>
			
	</div>
	<div class="modal fade" id="post-an-update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header d-flex justify-content-between">
					<h3>Post New Status</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
				</div>
				<div class="modal-body emp_profile_pop">
					<form id="employeetimeupdate" name="employeetimeupdate" method="post" action="{{route('employeetimeupdate')}}">

						@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="col-auto py-3">
										<div class="d-flex flex-column  mb-3">											
											
											<label for="emp_work_headline" class="form-label">Task Name :</label>
											
											<input type="text" class="form-control" id="emp_work_headline" name="emp_work_headline" placeholder="My Work Headline" required>
										</div>
										<div class="d-flex flex-column  mb-3">
											<label for="emp_work_desc" class="form-label">Task Description :</label>
											<textarea class="form-control" id="emp_work_desc" name="emp_work_desc" placeholder="My work in detail"rows="3" required></textarea>
										</div>
										<div class="d-flex flex-column  mb-3">
											<label for="emp_work_time" class="form-label">Time Spent (Hours) :</label>
											<input type="number" step=0.25 class="form-control" id="emp_work_time" name="emp_work_time" placeholder="Time I have worked" required>
										</div>
										
										<div class="d-flex flex-column  mb-3">
											<button type="submit" class="btn btn-primary" >Update My work</button>
										</div>
									</div>
								</form>	
				</div>
			</div>
		</div>
	</div>
	<!-- End modal-profile-setting -->
@endsection

@section('pagescript')
<script>
$('#job_budget_currency').on('change', function() {
	var job_budget_currency = $('#job_budget_currency').val();
	var job_min_rate_currency = $('#job_min_rate_currency').val();

	if(job_budget_currency != job_min_rate_currency){
		$('#job_min_rate_currency').val(job_budget_currency);
	}
});
$('#job_min_rate_currency').on('change', function() {
	var job_budget_currency = $('#job_budget_currency').val();
	var job_min_rate_currency = $('#job_min_rate_currency').val();

	if(job_budget_currency != job_min_rate_currency){
		$('#job_budget_currency').val(job_min_rate_currency);
	}
});
</script>
@endsection
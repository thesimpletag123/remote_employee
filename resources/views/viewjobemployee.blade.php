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
	<div class="parent-job-update">
		@if(isset($getjobupdatebyid))
			@foreach($getjobupdatebyid as $jobupdate)
				<div class="mysidebardiv job-update-sidebar">
					<strong class="mb-2 d-block">By: {{$jobupdate->user->name}}</strong>
					<div class="job_block">
						<b><label>Task Name :</label></b>{{$jobupdate->jobupdate_headline}}
					</div>
					<div class="job_block">
						<b><label>Description:</label></b> {{$jobupdate->jobupdate_description}}
					</div>
					<div class="job_block">
						<b><label>Time worked:</label></b> {{$jobupdate->jobupdate_time}} Hour
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
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Post an update</h5>
								<form id="employeetimeupdate" name="employeetimeupdate" method="post" action="{{route('employeetimeupdate')}}">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="col-auto">
										<div class="custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" readonly value="{{$getjobbyid->job_title}}">
										</div>
										<div class="custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" readonly>{{$getjobbyid->project_description}}</textarea>
										</div>
										<!--<div class="custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_skills" class="form-label">Required Skills:</label>
											</div>
											<?php
												$skill = null;												
												$required_skills = $getjobbyid->required_skills;
												$required_skills_array = [];
												$required_skills_array = explode('-' , $required_skills);
											
											?>
											
												@if(is_array($required_skills_array))													
													@foreach($required_skills_array as $skill)
														<br>
														<i class="fas fa-star"></i> {{$skill}}
													@endforeach
												@else
													<option>No Skills required</option>
												@endif                                                        
											
											
										</div>
											<?php 
												$project_budget = $getjobbyid->project_budget;
												$project_rate_min = $getjobbyid->hourly_rate_min;
											?>
										<div class="custom_div">
											@if( $project_budget != null )													
												<div class="col-md-12">
													<label for="job_budget" class="form-label">Project Budget :</label>
												</div>
												<input type="text" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$project_budget}}" readonly>
											@endif
												
										</div>
										<div class="custom_div">
											@if( $project_rate_min != null )
												<div class="col-md-12">
													<label for="job_budget" class="form-label">Project Min. Rate :</label>
												</div>
												<input type="text" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$project_rate_min}}" readonly>													
											@endif
										</div>
										<div class="custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" readonly value="{{$getjobbyid->deadline}}" readonly>
										</div>-->
										
										
									</div>
									<hr>
									<div class="col-auto">
										<div class="custom_div">											
											
											<label for="emp_work_headline" class="form-label">Task Name :</label>
											
											<input type="text" class="form-control" id="emp_work_headline" name="emp_work_headline" placeholder="My Work Headline" required>
										</div>
										<div class="custom_div">
											<label for="emp_work_desc" class="form-label">Task Description :</label>
											<textarea class="form-control" id="emp_work_desc" name="emp_work_desc" placeholder="My work in detail"rows="3" required></textarea>
										</div>
										<div class="custom_div">
											<label for="emp_work_time" class="form-label">Time Spent (Hours) :</label>
											<input type="number" step=0.25 class="form-control" id="emp_work_time" name="emp_work_time" placeholder="Time I have worked" required>
										</div>
										
										<div class="custom_div">
											<button type="submit" class="btn btn-primary">Update My work</button>
										</div>
									</div>
								</form>
							</div>
							
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
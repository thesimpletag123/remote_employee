@extends('layouts.master')
@section('title', 'Track Job')
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
<div class="container">
	<div class="modal-profile-setting" >
		
					
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
			$m = 0;
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
						if( $singlejob['project_status'] == 3){
							$m++;
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
		<table class="show_project_count table table-bordered">
			<thead class="thead-dark">
				<tr class="bg-primary text-white">
					<td colspan='2'><strong>Project Details</strong></td>
				</tr>
			</thead>
			<tr>
				<td>Todo Jobs</td>
					<td>{{$j}}</td>
				</tr>
				<tr>
					<td>In Progress Jobs</td>
					<td>{{$k}}</td>
				</tr>
				<tr>
					<td>In Testing Jobs</td>
					<td>{{$l}}</td>
				</tr>
				<tr>
					<td>Completed Jobs</td>
					<td>{{$m}}</td>
				</tr>
				<tr>

					<td><strong>Total Posted Jobs</strong></td>
					<td><strong>{{$i}}</strong></td>
				</tr>

		</table>
	
	<hr>
	
		
	</div>
</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								
									<div class="col-12">
										<h5>Track Job</h5>
									</div>
								
								<form id="employeetimeupdate" name="employeetimeupdate" method="post" action="{{route('employeetimeupdate')}}">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="row">
										<div class="col-lg-12 custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" readonly value="{{$getjobbyid->job_title}}">
										</div>
										<div class="col-lg-12 custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" readonly>{{$getjobbyid->project_description}}</textarea>
										</div>
										<div class="col-lg-12 custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_skills" class="form-label">Required Skills:</label>
											</div>
											<div class="review">
											<?php
												$skill = null;												
												$required_skills = $getjobbyid->required_skills;
												$required_skills_array = [];
												$required_skills_array = explode('-' , $required_skills);
											
											?>
											<div class="items">
												@if(is_array($required_skills_array))													
													@foreach($required_skills_array as $skill)
														<span>{{$skill}}</span>
													@endforeach
												@else
													<span>No Skills required</span>
												@endif                                                        
											</div>
											
										</div>
										</div>
										<?php 
											$project_budget = $getjobbyid->project_budget;
											$project_rate_min = $getjobbyid->hourly_rate_min;
											$project_rate_max = $getjobbyid->hourly_rate_max;
										?>
										
										@if( $project_budget != null )													
										<div class="col-lg-12 custom_div">
												<label for="job_budget" class="form-label">Project Budget :</label>
											
											<input type="text" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$project_budget}}" readonly>
										</div>
										@endif
												
										
										<div class="col-lg-12 custom_div">
											@if( $project_rate_min != null )
												
													<label for="job_budget" class="form-label">Project Minimum Rate :</label>
											
												<input type="text" class="form-control" id="project_rate_min" name="project_rate_min" placeholder="Project Minimum Rate" value="{{$project_rate_min}}" readonly>													
											@endif
										</div>
										<div class="col-lg-12 custom_div">
											@if( $project_rate_max != null )
												
													<label for="job_budget" class="form-label">Project Maximum Rate :</label>
											
												<input type="text" class="form-control" id="project_rate_max" name="project_rate_max" placeholder="Project Maximum Rate" value="{{$project_rate_max}}" readonly>													
											@endif
										</div>
										<div class="col-lg-12 custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" readonly value="{{$getjobbyid->deadline}}" readonly>
										</div>
										
										
									</div>
									<hr>
									
									<?php
											$totaltime = 0;
										?>
									<div class="col-auto">
											<h5 class="pt-0">Updated Status</h5>
										<div class="panelbox py-1 mb-3">
											@if(isset($getjobupdatebyid))
											@foreach($getjobupdatebyid as $update)
											<div class="current-employees-box" id="{{$update->id}}">
												<div class="current-header">
													<div class="row">
														<div class="col-sm-12">
															<div class="dashboard-avatar">
																<img src="http://127.0.0.1:8000/uploads/1645042355-PSFix_20171007_215025.jpeg" alt="image">
															</div>
															<div class="dashboard-avatar-data">
																<h4>Employee</h4>													
																<div>emp2@gmail.com</div>
															</div>
														</div>
													</div>
												</div>
												<div class="current-details" style="display: none;">
													<div class="row">
														<div class="col-md">
															<div class="job_block">
																<strong><label>Headline:</label></strong> <span>{{$update->jobupdate_headline}}</span>
															</div>
															<div class="job_block">
																<strong><label>My Work Description:</label></strong> <span>{{$update->jobupdate_description}}</span>
															</div>
															<div class="job_block">
																<strong><label>Time worked:</label></strong> <span>{{$update->jobupdate_time}} Hours</span>
															</div>
															
														</div>
													</div>
												</div>
											</div>
											<?php 		
												$totaltime = $totaltime + $update->jobupdate_time;
											?>
											@endforeach
											@endif
											
										</div>
									</div>
								</form>
								<br>
								<div class="d-flex justify-content-between flex-wrap align-items-center px-3">
									<a href="{{route('employerdashboard')}}" class="btn btn-primary">Back to Dashboard</a>
									<h5>Total worked time : <?php echo $totaltime;?> Hours</h5>
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
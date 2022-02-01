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
		<table class="show_project_count table table-bordered">
			<thead class="thead-dark">
				<tr>
					<td colspan='2'><strong>Project Details</strong></td>
				</tr>
			</thead>
			<tr>
				<td>Completed Jobs</td>
				<td>{{$l}}</td>
			</tr>
			<tr>
				<td>Active Jobs</td>
				<td>{{$k}}</td>
			</tr>
			<tr>
				<td>Pending Jobs</td>
				<td>{{$j}}</td>
			</tr>
			<tr>

				<td>Total Posted Jobs</td>
				<td>{{$i}}</td>
			</tr>

		</table>
	
	<hr>
	
		@foreach($getjobupdatebyid as $jobupdate)
			<div class="mysidebardiv comment-show-hide-div" id="comment-{{$jobupdate->id}}">
				<b>By: {{$jobupdate->user->name}}</b>
				<div class="col-lg-12 custom_div">
					<b><label>Headline :</label></b>{{$jobupdate->jobupdate_headline}}
				</div>
				<div class="col-lg-12 custom_div">
					<b><label>My Work Description:</label></b> {{$jobupdate->jobupdate_description}}
				</div>
				<div class="col-lg-12 custom_div">
					<b><label>Time worked:</label></b> {{$jobupdate->jobupdate_time}}
				</div>			
			</div>
				
		@endforeach
	</div>
</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Track Job</h5>
								<form id="employeetimeupdate" name="employeetimeupdate" method="post" action="{{route('employeetimeupdate')}}">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="col-auto">
										<div class="col-lg-8 custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" readonly value="{{$getjobbyid->job_title}}">
										</div>
										<div class="col-lg-8 custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" readonly>{{$getjobbyid->project_description}}</textarea>
										</div>
										<div class="col-lg-8 custom_div">
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
										<div class="col-lg-8 custom_div">
											@if( $project_budget != null )													
												<div class="col-md-12">
													<label for="job_budget" class="form-label">Project Budget :</label>
												</div>
												<input type="text" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$project_budget}}" readonly>
											@endif
												
										</div>
										<div class="col-lg-8 custom_div">
											@if( $project_rate_min != null )
												<div class="col-md-12">
													<label for="job_budget" class="form-label">Project Min. Rate :</label>
												</div>
												<input type="text" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$project_rate_min}}" readonly>													
											@endif
										</div>
										<div class="col-lg-8 custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" readonly value="{{$getjobbyid->deadline}}" readonly>
										</div>
										
										
									</div>
									<hr>
									<div class="col-auto mother-commentdiv">
										<?php
											$totaltime = 0;
										?>
										@if(isset($getjobupdatebyid))
											<h5>Updates about this </h5>
											@foreach($getjobupdatebyid as $update)
												<div class="commentdiv" id="{{$update->id}}" onClick="show_comment_on_click(this.id)">
													<div class="col-lg-8 custom_div">											
														Headline : {{$update->jobupdate_headline}}
													</div>
													<div class="col-lg-8 custom_div">
														Time Worked : {{$update->jobupdate_time}} Hours
													</div>
													<?php 
														
														$totaltime = $totaltime + $update->jobupdate_time;
													?>
												</div>
											@endforeach
										@endif
											<br>
												Total worked time : <?php echo $totaltime;?> Hours
											
									</div>
								</form>
								<br>
								<div class="col-lg-8 custom_div">
									<a href="{{route('employerdashboard')}}" class="btn btn-primary">Back to Dashboard</a>
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
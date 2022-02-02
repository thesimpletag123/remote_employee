@extends('layouts.master')
@section('title', 'Job Update')
@section('pagecss')
<style>
div#modal-profile-setting {
    margin-top: 6%;
}
.modal-xl {
    max-width: 80%;
}
input#job_max_rate, input#job_min_rate {
    float: right;
    width: 85%;
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
<div class="container">
	<div class="modal-profile-setting">
					
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
										<h6>Email</h6>
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
									<div class="sidebardatadiv">
										@if(isset($getjobupdatebyid))
											@foreach($getjobupdatebyid as $jobupdate)
												<div class="mysidebardiv">
													<b>By: {{$jobupdate->user->name}}</b>
													<div class="col-lg-12 custom_div">
														<b><label>Headline :</label></b>{{$jobupdate->jobupdate_headline}}
													</div>
													<div class="col-lg-12 custom_div">
														<b><label>My Work Description:</label></b> {{$jobupdate->jobupdate_description}}
													</div>
													<div class="col-lg-12 custom_div">
														<b><label>Time worked:</label></b> {{$jobupdate->jobupdate_time}} Hour
													</div>			
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Update your job</h5>
								<form id="editjobrequest" name="editjobrequest" method="post" action="{{route('editjobrequest')}}">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="col-auto">
										<div class="col-lg-8 custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" required value="{{$getjobbyid->job_title}}">
										</div>
										<div class="col-lg-8 custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" required>{{$getjobbyid->project_description}}</textarea>
										</div>
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_skills" class="form-label">Required Skills (Multi-Select)</label>
											</div>
											<?php
												$skill = null;												
												$required_skills = $getjobbyid->required_skills;
												$required_skills_array = [];
												$required_skills_array = explode('-' , $required_skills);
											
											?>
											<select id="emp_skills" name ="emp_skills[]" multiple required>
												@if(isset($skills))													
													@foreach($skills as $skill)
														<option value="{{$skill}}"  <?php if(in_array($skill, $required_skills_array)){echo "selected";}?>>{{$skill}}</option>
													@endforeach
												@else
													<option>No Skill Available</option>
												@endif                                                        
											</select>
											
										</div>
										<div class="col-lg-8 custom_div">
											<label for="job_title" class="form-label">Extra Skills</label>
											<input type="text" class="form-control" id="job_extra_skills" name="job_extra_skills" placeholder="Enter if any Extra Skills required">
										</div>
										<?php
											$budgetcurrency = null;
											$minratecurrency = null;
											$maxratecurrency = null;
											$budget = null;
											$minrate = null;
											$maxrate = null;
											
											$project_budget = $getjobbyid->project_budget;
											if( $project_budget != null ){
												$project_budget_array = explode(' ' , $project_budget);
												$budget = $project_budget_array[0];
												$budgetcurrency = $project_budget_array[1];
											}
											
											$project_rate_min = $getjobbyid->hourly_rate_min;
											if( $project_rate_min != null ){
												$project_rate_min_array = explode(' ' , $project_rate_min);
												$minrate = $project_rate_min_array[0];
												$minratecurrency = $project_rate_min_array[1];
											}
											
											$project_rate_max = $getjobbyid->hourly_rate_max;
											if( $project_rate_max != null ){
												$project_rate_max_array = explode(' ' , $project_rate_max);
												$maxrate = $project_rate_max_array[0];
												$maxratecurrency = $project_rate_max_array[1];
											}
											
										?>
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_rate" class="form-label">Hourly Rate -Minimum</label>
											</div>
											<select id="job_min_rate_currency" name ="job_min_rate_currency">
												@if(isset($currencies))													
													@foreach($currencies as $currency => $abbr)
														<option value="{{$currency}}" <?php if($currency == $minratecurrency){echo "selected";}?>>{{$currency}}</option>
													@endforeach
												@else
													<option>No Currency Available</option>
												@endif                                                        
											</select>
											<input type="number" class="form-control" id="job_min_rate" name="job_min_rate" placeholder="Hourly Rate -Minimum" value="{{$minrate}}">
										</div>
										<div class="col-lg-8 custom_div">
											<div class="adjust-currency">
												<label for="job_budget" class="form-label">Hourly Rate -Maximum</label>
											</div>
											<select id="job_max_rate_currency" name ="job_max_rate_currency">
												@if(isset($currencies))													
													@foreach($currencies as $currency => $abbr)
														<option value="{{$currency}}" <?php if($currency == $maxratecurrency){echo "selected";}?>>{{$currency}}</option>
													@endforeach
												@else
													<option>No Currency Available</option>
												@endif                                                        
											</select>
											<input type="number" class="form-control" id="job_max_rate" name="job_max_rate" placeholder="Project Budget" value="{{$maxrate}}">
										</div>
										
										<div class="col-lg-8 custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" required value="{{$getjobbyid->deadline}}">
										</div>
										
										<div class="col-lg-8 custom_div">
											<button type="submit" class="btn btn-primary">Update this Job</button>
											<button id="{{$getjobbyid->id}}" onClick="reply_click(this.id)" class="btn btn-danger deletejob">Delete this</button>
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
$('#job_max_rate_currency').on('change', function() {
	var job_max_rate_currency = $('#job_max_rate_currency').val();
	var job_min_rate_currency = $('#job_min_rate_currency').val();

	if(job_max_rate_currency != job_min_rate_currency){
		$('#job_min_rate_currency').val(job_max_rate_currency);
	}
});
$('#job_min_rate_currency').on('change', function() {
	var job_max_rate_currency = $('#job_max_rate_currency').val();
	var job_min_rate_currency = $('#job_min_rate_currency').val();

	if(job_max_rate_currency != job_min_rate_currency){
		$('#job_max_rate_currency').val(job_min_rate_currency);
	}
});
</script>
@endsection
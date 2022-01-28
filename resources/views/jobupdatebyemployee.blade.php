@extends('layouts.master')
@section('title', 'Post Update')
@section('pagecss')
<style>
div#modal-profile-setting {
    margin-top: 6%;
}
.modal-xl {
    max-width: 80%;
}
input#job_budget, input#job_min_rate {
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

							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Post an update</h5>
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
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 adjust-currency">
												<label for="job_budget" class="form-label">Project Budget</label>
											</div>
											<?php
												$budgetcurrency = null;
												$minratecurrency = null;
												$budget = null;
												$minrate = null;
												
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
												
											?>
											<select id="job_budget_currency" name ="job_budget_currency">
												@if(isset($currencies))													
													@foreach($currencies as $currency => $abbr)
														<option value="{{$currency}}" <?php if($currency == $budgetcurrency){echo "selected";}?>>{{$currency}}</option>
													@endforeach
												@else
													<option>No Currency Available</option>
												@endif                                                        
											</select>
											<input type="number" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget" value="{{$budget}}">
										</div>
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
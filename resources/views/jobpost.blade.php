@extends('layouts.master')
@section('title', 'Job Post')
@section('pagecss')

@endsection
@section('content')
<!-- starting modal-profile-setting -->
<div class="container">
	<div class="modal-profile-setting" >
		
					
					<input type="hidden" id="hidden_uid" value="{{$user->id}}">
@include('layouts.dashboardheader')
					
					<div class="profile-setting-body">
						<div class="row">
@include('layouts.dashboardsidebar')
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Post a new Job Here</h5>
								<form id="post_new_job" name="post_new_job" method="post" action="{{route('jobpost_to_db')}}">
								@csrf
									<div class="col-auto">
										<div class="col-lg-8 custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" required>
										</div>
										<div class="col-lg-8 custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" required></textarea>
										</div>
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_skills" class="form-label">Required Skills (Multi-Select)</label>
											</div>
											<select id="emp_skills" name ="emp_skills[]" multiple required>
												@if(isset($skills))													
													@foreach($skills as $skill)
														<option value="{{$skill}}">{{$skill}}</option>
													@endforeach
												@else
													<option>No Skill Available</option>
												@endif                                                        
											</select>
											
										</div>
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 adjust-currency">
												<label for="job_budget" class="form-label">Project Budget</label>
											</div>
											<select id="job_budget_currency" name ="job_budget_currency">
												@if(isset($currencies))													
													@foreach($currencies as $currency => $abbr)
														<option value="{{$currency}}">{{$currency}}</option>
													@endforeach
												@else
													<option>No Currency Available</option>
												@endif                                                        
											</select>
											<input type="number" class="form-control" id="job_budget" name="job_budget" placeholder="Project Budget">
										</div>
										<div class="col-lg-8 custom_div">
											<div class="col-md-12 padding_none">
												<label for="job_rate" class="form-label">Hourly Rate -Minimum</label>
											</div>
											<select id="job_hour_rate_currency" name ="job_hour_rate_currency">
												@if(isset($currencies))													
													@foreach($currencies as $currency => $abbr)
														<option value="{{$currency}}">{{$currency}}</option>
													@endforeach
												@else
													<option>No Currency Available</option>
												@endif                                                        
											</select>
											<input type="number" class="form-control" id="job_rate" name="job_rate" placeholder="Hourly Rate -Minimum">
										</div>
										<div class="col-lg-8 custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" required>
										</div>
										
										<div class="col-lg-8 custom_div">
											<button type="submit" class="btn btn-primary mb-3">Confirm Job</button>
										</div>
									</div>
								</form>
								
								<!--<div class="jopboard-box">
									<div class="row">
										<div class="col-sm-6 col-12">
											<h4>Motion Video Design for a wedding song</h4>
										</div>
										<div class="col-sm-6 col-12">
											<select>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
											</select>
											<div class="setticon">
												<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
											</div>
										</div>
										<div class="col-12">
											<h6>Project Brief</h6>
											<p>
											   <i class="fas fa-file-alt fa-2x"></i> 
												Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile. Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile.
											</p>
										</div>
										<div class="col-md-8 col-sm-12 col-12">
											<h6>Invoice Attachment</h6>
											<div><i class="fas fa-paperclip"></i> <a href="">WhatsApp Image 2021-03-10 at 10.25.32 PM.jpeg (205 KB)</a></div>
										</div>
										<div class="col-md-4 col-sm-12 col-12">
											<h6>Project Deadline</h6>
											<div><i class="fas fa-calendar-week"></i> <span>20.09.2021</span></div>
										</div>
									</div>
								</div>-->
								
								<!--<div class="jopboard-box">
									<div class="row">
										<div class="col-sm-6 col-12">
											<h4>Motion Video Design for a wedding song</h4>
										</div>
										<div class="col-sm-6 col-12">
											<select>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
											</select>
											<div class="setticon">
												<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
											</div>
										</div>
										<div class="col-12">
											<h6>Project Brief</h6>
											<p>
											   <i class="fas fa-file-alt fa-2x"></i> 
												Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile. Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile.
											</p>
										</div>
										<div class="col-md-8 col-sm-12 col-12">
											<h6>Invoice Attachment</h6>
											<div><i class="fas fa-paperclip"></i> <a href="">WhatsApp Image 2021-03-10 at 10.25.32 PM.jpeg (205 KB)</a></div>
										</div>
										<div class="col-md-4 col-sm-12 col-12">
											<h6>Project Deadline</h6>
											<div><i class="fas fa-calendar-week"></i> <span>20.09.2021</span></div>
										</div>
									</div>
								</div>-->
								
								<!--<div class="jopboard-box">
									<div class="row">
										<div class="col-sm-6 col-12">
											<h4>Motion Video Design for a wedding song</h4>
										</div>
										<div class="col-sm-6 col-12">
											<select>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
												<option>Ongoing </option>
											</select>
											<div class="setticon">
												<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
											</div>
										</div>
										<div class="col-12">
											<h6>Project Brief</h6>
											<p>
											   <i class="fas fa-file-alt fa-2x"></i> 
												Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile. Specialized profiles can help you better highlight your expertise when submitting proposals to jobs like these. Create a specialized profile.
											</p>
										</div>
										<div class="col-md-8 col-sm-12 col-12">
											<h6>Invoice Attachment</h6>
											<div><i class="fas fa-paperclip"></i> <a href="">WhatsApp Image 2021-03-10 at 10.25.32 PM.jpeg (205 KB)</a></div>
										</div>
										<div class="col-md-4 col-sm-12 col-12">
											<h6>Project Deadline</h6>
											<div><i class="fas fa-calendar-week"></i> <span>20.09.2021</span></div>
										</div>
									</div>
								</div>-->
								
								
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
	var job_hour_rate_currency = $('#job_hour_rate_currency').val();

	if(job_budget_currency != job_hour_rate_currency){
		$('#job_hour_rate_currency').val(job_budget_currency);
	}
});
$('#job_hour_rate_currency').on('change', function() {
	var job_budget_currency = $('#job_budget_currency').val();
	var job_hour_rate_currency = $('#job_hour_rate_currency').val();

	if(job_budget_currency != job_hour_rate_currency){
		$('#job_budget_currency').val(job_hour_rate_currency);
	}
});
</script>
@endsection
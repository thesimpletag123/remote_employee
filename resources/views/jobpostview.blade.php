@extends('layouts.master')
@section('title', 'Job Update')

@section('content')
<!-- starting modal-profile-setting -->
<script src="{{ asset('assets/js/bundle.min.js') }}"></script>
<div class="modal fade" id="job_view_mod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-end">
				
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body emp_profile_pop">
				<div id="view_status"  class="sidebardatadiv carousel slide" data-interval="false" data-ride="carousel">
					<div class="carousel-inner">
						<?php $i=1; ?>
					@if(isset($getjobupdatebyid))
						@if ( sizeof($getjobupdatebyid) )
							@foreach($getjobupdatebyid as $jobupdate)
								
								<div class="mysidebardiv carousel-item <?php if($i == 1){ echo 'active';} ?>">
									<div class="col-12 mb-3 text-center">
										<h4><i class="fa-solid fa-circle-user mr-1"></i> <strong>{{$jobupdate->user->name}}</strong></h4>
									</div>
									<hr>
									<div class="col-lg-12 mb-3 d-flex align-items-center justify-content-between">
										<strong>Task Name :</strong><strong>{{$jobupdate->jobupdate_headline}}</strong>
									</div>
									<hr>
									<div class="col-lg-12 mb-3 d-flex flex-wrap flex-column justify-content-between">
										<strong>Task Description:</strong> 
										<div>{{$jobupdate->jobupdate_description}}</div>
									</div>
									<hr>
									<div class="col-lg-12 d-flex align-items-center justify-content-between">
										<strong>Time worked:</strong> {{$jobupdate->jobupdate_time}} Hour
									</div>			
								</div>
								<?php $i++; ?>
							@endforeach
						@else
							<div class="mysidebardiv carousel-item active" style="text-align:center;">
								No Update posted yet
							</div>
						@endif
					@endif
					
					</div>
					<button class="carousel-control-prev" type="button" data-target="#view_status" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </button>
					  <button class="carousel-control-next" type="button" data-target="#view_status" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </button>
				</div>
			</div>
		</div>
	</div>
</div>
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
										<h6>Email</h6>
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
								<div class="col-auto ">
									<div class="col-12 d-flex align-items-center justify-content-between"><h5>Update your job</h5>
									<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#job_view_mod">View all updates</button></div>
								</div>
								<form id="editjobrequest" name="editjobrequest" method="post" action="{{route('editjobrequest')}}">
								@csrf
									<input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
									<input type="hidden" id="hidden_jobid" name="hidden_jobid" value="{{$getjobbyid->id}}">
									<div class="col-auto">
										<div class="col-lg-12 custom_div">
											<label for="job_title" class="form-label">Job Title</label>
											<input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title here" required value="{{$getjobbyid->job_title}}">
										</div>
										<div class="col-lg-12 custom_div">
										  <label for="job_desc" class="form-label">Job Description</label>
										  <textarea class="form-control" id="job_desc" name="job_desc" rows="3" required>{{$getjobbyid->project_description}}</textarea>
										</div>
										<div class="col-lg-12 custom_div">
											<div class="d-flex flex-column  mb-3 toggle_skill_onoff_div">
												<?php 
													$skill = null;												
													$required_skills = $getjobbyid->required_skills;
													$required_skills_array = [];
													
													if($required_skills != ''){
														$required_skills_array = explode('-' , $required_skills);
													}
												?>
													<span id="req_skills" name="req_skills[]"></span>
													
                                                    <script>
                                                        var allSkills = new Array();
                                                        var required_skills_push = new Array();
                                                        <?php
														
                                                        foreach($skills as $skill){                                                        
														?>											
															allSkills.push({label:'<?php echo $skill; ?>',value:'<?php echo $skill; ?>'});
                                                        <?php
                                                        }
                                                        foreach($required_skills_array as $rskill){	
                                                        ?>
                                                        required_skills_push.push('<?php echo $rskill; ?>');
                                                        <?php
                                                        }
                                                        ?>
														//console.log(required_skills_push);
                                                        var jobeditinstance = new SelectPure("#req_skills", {
                                                        options: allSkills,
                                                        multiple: true ,	
                                                        value: required_skills_push,
                                                        icon: "fa fa-times",
                                                        onChange: value => { console.log(value); }
                                                        });
														
                                                    </script>
											<input type="hidden" name="hidden_req_skills" id ="hidden_req_skills">
																		
												</div>
										</div>
										<div class="col-lg-12 custom_div">
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
										@if( $project_budget != null )
											<div class="col-lg-12 custom_div">
												<label for="job_rate" class="form-label">Project Budget</label>
												<div class="row">
													<div class="col-sm-3 col-6 pl-0">
														<select class="form-control" id="project_budget_currency" name ="project_budget_currency" required>
															@if(isset($currencies))													
																@foreach($currencies as $currency => $abbr)
																	<option value="{{$currency}}" <?php if($currency == $budgetcurrency){echo "selected";}?>>{{$currency}}</option>
																@endforeach
															@else
																<option>No Currency Available</option>
															@endif                                                        
														</select>
													</div>
													<div class="col-sm-9 col-6 px-0">
														<input type="number" class="form-control" id="project_budget" name="project_budget" placeholder="Project Budget" value="{{$budget}}" required>
													</div>
												</div>
											</div>
										@else
											<div class="col-lg-12 custom_div">
												<label for="job_rate" class="form-label">Hourly Rate -Minimum</label>
												<div class="row">
													<div class="col-sm-3 col-6 pl-0">
														<select class="form-control" id="job_min_rate_currency" name ="job_min_rate_currency">
															@if(isset($currencies))													
																@foreach($currencies as $currency => $abbr)
																	<option value="{{$currency}}" <?php if($currency == $minratecurrency){echo "selected";}?>>{{$currency}}</option>
																@endforeach
															@else
																<option>No Currency Available</option>
															@endif                                                        
														</select>
													</div>
													<div class="col-sm-9 col-6 px-0">
														<input type="number" class="form-control" id="job_min_rate" name="job_min_rate" placeholder="Hourly Rate -Minimum" value="{{$minrate}}">
													</div>
												</div>
												
											</div>
											<div class="col-lg-12 custom_div">
												<div class="adjust-currency">
													<label for="job_budget" class="form-label">Hourly Rate -Maximum</label>
												</div>
												<div class="row">
													<div class="col-sm-3 col-6 pl-0">
														<select class="form-control" id="job_max_rate_currency" name ="job_max_rate_currency">
															@if(isset($currencies))													
																@foreach($currencies as $currency => $abbr)
																	<option value="{{$currency}}" <?php if($currency == $maxratecurrency){echo "selected";}?>>{{$currency}}</option>
																@endforeach
															@else
																<option>No Currency Available</option>
															@endif                                                        
														</select>
													</div>
													<div class="col-sm-9 col-6 px-0">
														<input type="number" class="form-control" id="job_max_rate" name="job_max_rate" placeholder="Project Budget" value="{{$maxrate}}">
													</div>
												</div>										
											</div>
										@endif
										
										<div class="col-lg-12 custom_div">
											<label for="job_deadline" class="form-label">Project Deadline</label>
											<input type="date" class="form-control" id="job_deadline" name="job_deadline" placeholder="Project Deadline" required value="{{$getjobbyid->deadline}}">
										</div>
										
										<div class="col-lg-12 custom_div">
											<button type="submit" class="btn btn-primary" id="update_job">Update this Job</button>
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
$(document).on('click', '#update_job', function() {
    event.preventDefault();
	var req_skills = jobeditinstance.value();
	$('#hidden_req_skills').val(req_skills);
    $( "#editjobrequest" ).submit();
    return false;
});

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
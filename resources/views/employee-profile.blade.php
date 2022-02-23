@extends('layouts.master')
@section('title', 'Profile')
@section('pagecss')
<style>
.select2-results__option[aria-selected=true] {
    display: none;
}
</style>
@endsection
@section('content')
<!-- starting modal-profile-setting -->
<script src="{{ asset('assets/js/bundle.min.js') }}"></script>

<div class="modal fade" id="employee-profile-settings" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between">
				<h3>Profile Settings</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body emp_profile_pop">
				<form id="employeeprofileupdate" name="employeeprofileupdate" method="post"
                        action="{{route('employeeprofileupdate')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
                        <div class="col-auto py-3">
                            <div class="d-flex flex-column  mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Job Title here" value="{{$user->name}}">
                            </div>
                            <div class="d-flex flex-column  mb-3">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{$user->email}}" readonly>
                            </div>
                            <div class="d-flex flex-column  mb-3">
                                <label for="contact" class="form-label">Contact Number :</label>

                                <input type="text" class="form-control" id="contact" name="contact"
                                    placeholder="My Contact Number" value="{{$user->employee->contact_no}}">
                            </div>
                            <div class="d-flex flex-column  mb-3">
							<?php
								$emp_exp_yr = 0;
								$emp_exp_month = 0;
									if(isset($user->employee->experience_in_month)){
										$emp_experience_in_month = $user->employee->experience_in_month;
										if($emp_experience_in_month > 11){
											$emp_exp_month = $emp_experience_in_month%12;
											$emp_exp_yr = ($emp_experience_in_month - $emp_exp_month)/12;
										} else {
											$emp_exp_month = $emp_experience_in_month;
										}
									}
							?>
                                <label for="experience" class="form-label">Total Experience</label>
                                <div class="d-flex justify-content-between align-items-center g-3">
									<div class="col pl-0 pr-2 d-flex align-items-center">
										<label class="mb-0 pr-2">Year:</label>
										<input  type="number" name="experience_yr" id="experience_yr" placeholder="Year" min="0" class="form-control" value="{{$emp_exp_yr}}">
									
									</div>
									<div class="col pr-0 pl-2 d-flex align-items-center">
										<label class="mb-0 pr-2">Month:</label>
										<input type="number" name="experience_month" id="experience_month" placeholder="Month" step="1" max="11" min="0" class="form-control" value="{{$emp_exp_month}}">
									</div>
								</div>
								
                            </div>
                            <div class="d-flex flex-column  mb-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update Profile">
                            </div>
                        </div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="employee-profile-rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between">
				<h3>Profile Rate / Budget</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body emp_rate_pop">
			@if(isset($user->jobpost->id))
			<form id="employeerateupdate" name="employeerateupdate" method="post"
                        action="{{route('employeerateupdate')}}">
						@csrf
						<input type='hidden' name="job_id" value="{{$user->jobpost->id}}">
				<?php
					$minrate = explode(' ',$user->jobpost->hourly_rate_min);
					$maxrate = explode(' ',$user->jobpost->hourly_rate_max);
					$budget = explode(' ',$user->jobpost->project_budget);
				?>
				<div>
					@if(isset($user->jobpost->project_budget) != null)
						<div class="d-flex flex-row flex-wrap align-items-center  mb-3">
							
							<label class="mb-0 col" for="range-1a"><b>Project Budget:</b></label>
							
							<div class="col px-0">
								<input type="text" class="form-control" id="budget_rare" name="budget_rate" value="{{$budget[0]}}">
								
							</div>
							<div class="col pr-0">
								<select id="budget_currency" class="form-control" name ="budget_currency">
									@if(isset($currencies))													
										@foreach($currencies as $currency => $abbr)
											@if(isset($budget[1]))
												<option value="{{$currency}}" <?php if($budget[1] == $currency){echo "selected";}?>>{{$currency}}</option>
											@else
												<option value="{{$currency}}">{{$currency}}</option>
											@endif
										@endforeach
									@else
											<option value="INR">INR</option>
									@endif                                                        
								</select>
							</div>
						</div>
					@else
						<div class="d-flex flex-row flex-wrap align-items-center  mb-3">
							
							<label class="mb-0 col" for="range-1a"><b>Minimum rate:</b></label>
							
							<div class="col px-0">
								<input type="text" class="form-control" id="minrate" name="minrate" value="{{$minrate[0]}}">
								
							</div>
							<div class="col pr-0">
								<select id="minrate_currency" class="form-control" name ="minrate_currency">
									@if(isset($currencies))													
										@foreach($currencies as $currency => $abbr)
											@if ($minrate[1])
												<option value="{{$currency}}" <?php if($minrate[1] == $currency){echo "selected";}?>>{{$currency}}</option>
											@else
												<option value="{{$currency}}">{{$currency}}</option>
											@endif
										@endforeach
									@else
											<option value="INR">INR</option>
									@endif                                                        
								</select>
							</div>
						</div>
						<div class="d-flex flex-row flex-wrap align-items-center mb-3">
							<label class="mb-0 col" for="range-1b"><b>Maximum Rate:</b></label>
							<div class="col px-0">
								<input type="text" class="form-control" id="maxrate" name="maxrate" value="{{$maxrate[0]}}">
							</div>
							<div class="col pr-0">
								<select id="maxrate_currency" class="form-control" name ="maxrate_currency">
									@if(isset($currencies))													
										@foreach($currencies as $currency => $abbr)
											@if ($maxrate[1])
												<option value="{{$currency}}" <?php if($maxrate[1] == $currency){echo "selected";}?>>{{$currency}}</option>
											@else
												<option value="{{$currency}}">{{$currency}}</option>
											@endif
										@endforeach
									@else
											<option value="INR">INR</option>
									@endif                                                        
								</select>
							</div>
						</div>
					@endif
					
					<div class="d-flex flex-column  mb-3">
							<input type="submit" name="submit" class="btn btn-primary" value="Update Budget/Rate">
						</div>	
				</div>
			</form>
			@else
				No Project assigned
			@endif
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="employee-profile-skills" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md">
		<div class="modal-content">
			<div class="modal-header d-flex justify-content-between">
				<h3>Profile Skills</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
			</div>
			<div class="modal-body emp_profile_pop">
				<form id="employeskillupdate" name="employeskillupdate" method="post"
                        action="{{route('employeskillupdate')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
                        <div class="col-auto py-3">
						<div class="d-flex flex-column  mb-3 toggle_skill_onoff_div">
							<?php
								$skill = null;												
								$required_skills = $user->employee->skills;
								$required_skills_array = [];
								$required_skills_array = explode('-' , $required_skills);
//dd($required_skills_array);								
							?>
								<strong>Current Skills</strong>
								<hr/>
								<span id="employee_skills" name="employee_skills[]"></span>
													
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
														//alert(required_skills_push);
                                                        var employeeinstance = new SelectPure("#employee_skills", {
                                                        options: allSkills,
                                                        multiple: true ,	
                                                        value: required_skills_push,
                                                        icon: "fa fa-times",
                                                        onChange: value => { console.log(value); }
                                                        });
                                                    </script>
								<input type="hidden" name="hidden_skills" id ="hidden_skills">
													
						</div>
						<div class="d-flex flex-column  mb-3">
							<input type="button" id="submit_skills" class="btn btn-primary" value="Update Skills">
						</div>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>




<div class="container">




    <div class="modal-profile-setting ">


        <input type="hidden" id="hidden_uid" value="{{$user->id}}">
        @include('layouts.dashboardheader')

        <div class="profile-setting-body">
            <div class="row">



                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                    <!-- <div class="main-setting">
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
                        <div class="myskills">
                            <h6>My Skills</h6>
                            <div class="skill-group">
                                <p>
                                    <?php
										//var_dump($skills);
											$skill = null;												
											$required_skills = $user->employee->skills;
											$required_skills_array = [];
											$required_skills_array = explode('-' , $required_skills);
										
										?>
                                    @if(is_array($skills))
                                    @foreach($skills as $skill)
                                    @if(in_array($skill , $required_skills_array))
                                    <i class="fas fa-star"></i> {{$skill}}
                                    @endif
                                    @endforeach
                                    @else
                                    No Skills
                                    @endif
                                </p>
                            </div>
                        </div>
                        <hr>
                        <?php $i = 1; ?>
                        @if(isset($alljobslist))
                        @foreach($alljobslist as $singlejob)
                        @if($singlejob['assigned_to_id'] == $user->id)
                        @if($i == 1)
                        <h5> Assigned Jobs to you </h5>
                        @endif
                        <div class="mysidebardiv" id="comment-{{$singlejob['id']}}">
                            <b>{{$singlejob['job_title']}}</b>
                            <div class="d-flex flex-column  mb-3">
                                <b><label>Assigned By :</label></b>{{$singlejob['posted_by_username']}}
                            </div>
                            <div class="d-flex flex-column  mb-3">
                                <b><label>Skill Required:</label></b>
                                <?=str_replace('-', ' , ', $singlejob['required_skills'])?>
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endif
                        @endforeach
                        @endif
                    </div> -->
                    <div class="main-setting">
						<div class="profsetting ">
							<h6>Profile Setting <span class="editicon" data-bs-toggle="modal" data-bs-target="#employee-profile-settings"><i class="fas fa-pen"></i></span></h6>
						</div>
						<div class="availability ">
							<h6>Rate / Budget <span class="editicon" data-bs-toggle="modal" data-bs-target="#employee-profile-rate" ><i class="fas fa-pen"></i></span></h6>
							

							<div class="rate_budget">
								@if(isset($user->jobpost->project_budget))
									<div class="d-flex align-items-center justify-content-between">
										<strong>Budget</strong>
										<span>{{$user->jobpost->project_budget}}</span>
									</div>
								@elseif(isset($user->jobpost->hourly_rate_min))									
									<div class="d-flex align-items-center justify-content-between">
										<strong>Min rate :</strong>
										<span>{{$user->jobpost->hourly_rate_min}}</span>
									</div>
									<div class="d-flex align-items-center justify-content-between">
										<strong>Max Rate :</strong>
										<span>{{$user->jobpost->hourly_rate_max}}</span>
									</div>									
								@else
									<div class="d-flex align-items-center justify-content-between">
										<strong>No Project Assigned</strong>
									</div>								
								@endif
							</div>
						</div>
						<div class="myskills ">
							<h6>My Skills <span class="editicon" data-bs-toggle="modal" data-bs-target="#employee-profile-skills"><i class="fas fa-pen"></i></span></h6>
							<?php
							//var_dump($skills);
								$skill = null;												
								$required_skills = $user->employee->skills;
								$required_skills_array = [];
								$required_skills_array = explode('-' , $required_skills);
								
							?>

							@if(is_array($skills))													
								@foreach($skills as $skill)
									@if(in_array($skill , $required_skills_array))

										<?php 
											//$rand = rand(0,100);
											$rand = 60;
										?>
										<div class="skill-group">
											<p>{{$skill}}</p>
											<div class="progress">
												<div class="progress-bar" role="progressbar" style="width:{{$rand}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$rand}}%</div>
											</div>
										</div>
									@endif
								@endforeach
							@else
							<div class="skill-group">
								<p>No Skills</p>
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
								</div>
							</div>
							@endif
							
							
						</div>
					</div>
                </div>

                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                    
<?php $i=0; ?>						
					<div class="col-sm-12">
					<h5>Workspace</h5>
					<div class="jopboard">
						@if(isset($alljobslist))
							@foreach($alljobslist as $singlejob)
								@if($singlejob['assigned_to_id'] == $user->id)
									<?php 
									//echo 'User Name'.$user->id;
									//echo "<br>";
									//echo $singlejob['assigned_to_id'];
									$i++;
									?>								
									<div class="jopboard-box">
										<div class="row">
											<div class="col-sm-6 col-12">
												<h4>{{$singlejob['job_title']}}</h4>
											</div>
											<div class="col-sm-6 col-12">
												@if(isset($singlejob['assigned_to_username']))
													@if( $singlejob['assigned_to_username'] == $user->name)
														<a href="{{route('update_job_by_employee' , $singlejob['id'])}}" class="btn btn-primary">Post an Update </a>
													@else
														Assigned to : {{$singlejob['assigned_to_username']}}
													@endif
													
												@else
													<a href="{{route('viewjobemployee' , $singlejob['id'])}}" class="btn btn-secondary">View this</a>
												@endif
												
												
											</div>
											<div class="col-12">
												<h6>Project Brief</h6>
												<p>
												   <i class="fas fa-file-alt fa-2x"></i> 
													{{$singlejob['project_description']}}
												</p>
											</div>
											<div class="col-md-8 col-sm-12 col-12 d-flex flex-column justify-content-center">
											@if($singlejob['invoice_attachment'])
												<h6 class="m-0">Invoice Attachment</h6>
												<div><i class="fas fa-paperclip"></i> <a href="{{URL::asset($singlejob['invoice_attachment'])}}"> Latest Invoice</a></div>
											@else
												<h6 class="m-0">No Invoice available.</h6>
											@endif
											</div>
											<div class="col-md-4 col-sm-12 col-12">
												<h6>Project Deadline</h6>
												<div><i class="fas fa-calendar-week"></i> <span>{{$singlejob['deadline']}}</span></div>
											</div>
										</div>
									</div>	
								@endif
							@endforeach
						@endif
						@if($i == 0)
							<div class="jopboard-box">
								<div class="row">
									<div class="col-sm-6 col-12">
										<h4>You have no assigned Jobs</h4>
									</div>
								</div>
							</div>
						@endif
					</div>
					</div>
					
					<!--- appear inside popup --->
                    
					<!--- appear inside popup --->
                </div>

            </div>


        </div>
    </div>

</div>
<!-- End modal-profile-setting -->
@endsection

@section('pagescript')
<script>


$(document).on('click', '#submit_skills', function() {
	event.preventDefault();
    var my_skills = employeeinstance.value();
	
	//console.log(my_skills);
    $('#hidden_skills').val(my_skills);
	//console.log($('#hidden_skills').val());
    $( "#employeskillupdate" ).submit();
    return false;
});

$('#maxrate_currency').on('change', function() {
	var maxrate_currency = $('#maxrate_currency').val();
	var minrate_currency = $('#minrate_currency').val();

	if(maxrate_currency != minrate_currency){
		$('#minrate_currency').val(maxrate_currency);
	}
});
$('#minrate_currency').on('change', function() {
	var maxrate_currency = $('#maxrate_currency').val();
	var minrate_currency = $('#minrate_currency').val();

	if(maxrate_currency != minrate_currency){
		$('#maxrate_currency').val(minrate_currency);
	}
});
</script>
@endsection
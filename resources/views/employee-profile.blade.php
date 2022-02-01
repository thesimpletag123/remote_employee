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
						<div class="col-lg-12 custom_div">
							<b><label>Assigned By :</label></b>{{$singlejob['posted_by_username']}}
						</div>
						<div class="col-lg-12 custom_div">
							<b><label>Skill Required:</label></b> <?=str_replace('-', ' , ', $singlejob['required_skills'])?>
						</div>
					</div>
					<?php $i++; ?>
				@endif	
			@endforeach
		@endif
	</div>
</div>
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>My Profile</h5>
								<form id="employeeprofileupdate" name="employeeprofileupdate" method="post" action="{{route('employeeprofileupdate')}}" enctype="multipart/form-data">
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
											<label for="email" class="form-label">My skills :</label>
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
                                        </div>
											
										<div class="col-lg-8 custom_div">
											Add more Skills : <input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-on="Yes" data-off="No" id="toggle_skill_onoff_btn" data-style="slow">
										</div>
										<div class="col-lg-8 custom_div toggle_skill_onoff_div">
                                            <?php 
												$emp_skills = [];
												if(isset($user->employee->skills)){
													$emp_skills_array = $user->employee->skills;
													$emp_skills = explode('-' , $emp_skills_array);													
												}
												?>
											<select id="my_skills" name="my_skills[]" style="width: 100%;" multiple>
												@if(isset($skills))
													@foreach($skills as $value)
														@if(!in_array($value , $emp_skills))
															<option value="{{$value}}">{{$value}}</option>
														@endif
													@endforeach
												@else
														<option >No Skill</option>
												@endif
											</select>
										</div>
										<div class="col-lg-8 custom_div">
											<label for="contact" class="form-label">Contact Number :</label>
											
											<input type="text" class="form-control" id="contact" name="contact" placeholder="My Contact Number" value="{{$user->employee->contact_no}}" >
										</div>
										<div class="col-lg-8 custom_div">
											<label for="experience" class="form-label">Total Experience(in month)</label>
											<input type="number" step=1 class="form-control" id="experience" name="experience" placeholder="My Experience" value="{{$user->employee->experience_in_month}}">
										</div>
										<div class="col-lg-8 custom_div">
											<input type="submit" name="submit" class="btn btn-primary">
											<a href="{{route('dashboard')}}" class="btn btn-success"> Back to dashboard</a>
										</div>
									</div>
									
									
								</form>
								<br>
								
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
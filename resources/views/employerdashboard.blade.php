@extends('layouts.master')
@section('title', 'Employer-Profile')
@section('pagecss')
<style>
div#modal-dashboard-employer {
    margin-top: 6%;
}
.modal-xl {
    max-width: 80%;
}
* {box-sizing: border-box}


</style>
@endsection
@section('content')
<div class="container">
	<div class="modal-dashboard-employer">

<input type="hidden" id="hidden_uid" value="{{$user->id}}">				
				
@include('layouts.dashboardheader')
				
				
				<div class="employer-dashboard-body">
					<div class="row flex-row align-items-stretch emp_box">
						<div class="col-lg-3 col-md-12 col-sm-12 col-12 px-0">
							<ul class="employer-dashboard-menu">
								<li class="tablinks active selected" data-class="part1" onclick="changetab(event, 'current_employee')">Current Jobs</li>
								<li class="tablinks" data-class="part2" onclick="changetab(event, 'new_employee')">All Employees</li>
								<li class="tablinks" data-class="part3" onclick="changetab(event, 'all_invoice')">View all Invoices</li>
							</ul>
							<!--<div class="uplogout"><a href="">Log out</a></div>-->
						</div>
						<div class="col-lg-9 col-md-12 col-sm-12 col-12">
							<div id='current_employee' class="complex part1">
								<h5>Current Jobs</h5>
								
								@if(isset($employerposts))
									@foreach($employerposts as $employerpost)
									<?php
										$newtime = strtotime($employerpost->created_at);
										$date = date('M d, Y',$newtime);
									?>
								<div class="current-employees-box">
									<div class="current-header">
										<div class="row">
											<div class="col-sm-8">
											
												<div class="dashboard-avatar">
													@if($user->user_image == null)
														<img src="{{url('assets/images/avtar.png')}}" alt="image">
													@else
														<img src="{{$user->user_image}}" alt="image">
													@endif
													<!--<span></span>-->
												</div>
												<div class="dashboard-avatar-data">
													<h4>{{$employerpost->job_title}}</h4>													
													<div><i class="fas fa-clock"></i> <span>Created at : {{$date }}</span></div>
												</div>
												
											</div>
											<div class="col-sm-2">
												<div class="project_status">
													@if($employerpost->project_status == 0)
														<div class="btn btn-warning">Pending</div>
													@elseif($employerpost->project_status == 1)
														<div class="btn btn-primary">Active</div>
													@elseif($employerpost->project_status == 2)
														<div class="btn btn-success">Completed</div>
													@endif
												</div>
											</div>
											<div class="col-sm-2" style="float:right;">
												<div class="setticon">
													<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="current-details">
										<div class="row">
											<div class="col-md">
												@if(isset($employerpost->project_budget))
													<span>|Budget : {{$employerpost->project_budget}}|  </span>
												@endif
												@if(isset($employerpost->hourly_rate_min))
													<span>|Rate Per hour:  Min{{$employerpost->hourly_rate_min}} - Max {{$employerpost->hourly_rate_max}}|</span>
												@endif
												<br>
												<br>
												<p><i class="fas fa-align-justify"></i> {{$employerpost->project_description}}</p>
												<div class="review">
													<span>Required Skills</span>
													<?php 
														$skills = null;
														if($employerpost->required_skills){
															$skills = explode('-' , $employerpost->required_skills);
														}
													?>
														@foreach($skills as $skill)
															<br>
															<i class="fas fa-star"></i> {{$skill}}															
														@endforeach
												</div>
											</div>
											<div class="col-md">
												<div class="current-performance">
													@if($employerpost->project_status != 2)
														@if($employerpost->assigned_to_id == null)
														
														<h6>Not assigned yet</h6>
															<div class="btn-group">
																<select id="employeeavailable_assign-{{$employerpost->id}}" name="employeeavailable_assign" class="employeeavailable_assign">
																			<option>--Select to assign--</option>
																	@if(isset($employeeavailable))
																		@foreach($employeeavailable as $emp)
																			<option value="{{$emp->user->id}}">{{$emp->user->name}}</option>
																		@endforeach
																	@else
																			<option> No Employee Available </option>
																	@endif
																</select>
															</div>
														@else
															<h6>Assigned to: </h6>
															{{$employerpost->assigned_to_username}}
															<br>
															<h6>Re-assign to</h6>
															<div class="btn-group">
																<select id="employeeavailable_assign-{{$employerpost->id}}" name="employeeavailable_assign" class="employeeavailable_assign">
																			<option>--Select to assign--</option>
																	@if(isset($employeeavailable))
																		@foreach($employeeavailable as $emp)
																			<option value="{{$emp->user->id}}">{{$emp->user->name}}</option>
																		@endforeach
																	@else
																			<option> No Employee Available </option>
																	@endif
																</select>
															</div>
														@endif
													@endif
													<!--<div class="progress-modal">
														<div class="pie-wrapper progress-full">
															<span class="label">85<em>%</em></span>
															<div class="pie">
																<div class="left-side half-circle"></div>
																<div class="right-side half-circle"></div>
															</div>  
														</div>
													</div>-->
												</div>
												<div class="current-performance">
													Change Status
													<select name="change_status" class="change_status">
														<option value="0" <?php if($employerpost->project_status == 0){echo 'selected';}?>>Pending</option>
														<option value="1" <?php if($employerpost->project_status == 1){echo 'selected';}?>>Active</option>
														<option value="2" <?php if($employerpost->project_status == 2){echo 'selected';}?>>Completed</option>
													</select>
													<input type="hidden" id="project_id" name="project_id" value="{{$employerpost->id}}">
												</div>
												@if($employerpost->project_status == 2)
													<div class="current-performance">
														<input type="hidden" id="project_id" name="project_id" value="{{$employerpost->id}}">
														<button id="{{$employerpost->id}}" onClick="generate_invoice(this.id)" class="btn btn-success deletejob">Generate Invoice</button>
													</div>
												@endif
											</div>
											<table>
												<tr><input type="hidden" class="hidden_jobid" value="{{$employerpost->id}}"></tr>
											</table>
											
											<div class="col-md-12 padding-top">
												<a href="{{route('editjobview' , $employerpost->id)}}" class="btn btn-primary">Edit</a>
												<button id="{{$employerpost->id}}" onClick="reply_click(this.id)" class="btn btn-danger deletejob">Delete</button>
												
												<a href="{{route('trackjob' , $employerpost->id)}}" class="btn btn-success">Track</a>
											</div>
										</div>
									</div>
								</div>
									@endforeach
									<div class="paginate_links">{{ $employerposts->links() }}</div>
								@else
								
									<div class="dashboard-avatar-data">
										<h4>No jobs Available for you</h4>
										<div><i class="fas fa-map-marker-alt"></i> <span>You are now loggedin as </span> - <span>{{$user->name}}</span></div>
									</div>
								
								@endif
							</div>
							
							<!-- Tab 2 -->
							<div id='new_employee' class="complex part2" style="display: none;">
								<h5>Employee List</h5>
								
								@if(isset($assignedemployee))
									@foreach($assignedemployee as $employee)
										@if($employee->posted_by_id == $user->id)
										
											@if($employee->user->user_type == 'employee')
										<?php
									//echo "1";
											
											
											$newtime = strtotime($employee->user->created_at);
											$date = date('M d, Y',$newtime);
											
											$exp_yr = floor($employee->employee->experience_in_month/12);
											$exp_month = $employee->employee->experience_in_month%12;
											$experience = $exp_yr. ' Year ' . $exp_month. ' Month';
											//$experience = $date;
										?>
									<div class="current-employees-box">
										<div class="current-header">
											<div class="row">
												<div class="col-sm-10">
													<div class="dashboard-avatar">
														@if($employee->user->user_image == null)
															<img src="{{url('assets/images/avtar.png')}}" alt="image">
														@else
															<img src="{{$employee->user->user_image}}" alt="image">
														@endif
														
														<!--<span></span>-->
													</div>
													<div class="dashboard-avatar-data">
														<div class="one-line">
															<!--<h4>{{$employee->job_title}}</h4>&nbsp; assigned to : &nbsp;--><h4>{{$employee->user->name}}</h4>
														</div>
														<div><i class="fas fa-clock"></i> <span>With us Since : {{$date }}</span></div>

													</div>
												</div>
												<div class="col-sm-2">
													<div class="setticon">
														<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="current-details">
											<div class="row">
												<div class="col-md">
													<h5>About :: &nbsp;{{$employee->user->name}} </h5>
													<p><i class="fas fa-align-justify"></i> Experience : {{$experience}}</p>
													<div class="review">
														<span>Key Skills</span>
														<?php 
															$skillsets = null;
															if($employee->employee->skills){
																$skillsets = explode(',' , $employee->employee->skills);
															}
														?>
															@foreach($skillsets as $skill)
																<br>
																<i class="fas fa-star"></i> {{$skill}}															
															@endforeach
													</div>
												</div>
												<div class="col-md">
													<h5>Assigned Project Name :: &nbsp;{{$employee->job_title}}</h5>
													
												</div>
											</div>
										</div>
									</div>
											@endif
										@endif
									@endforeach
									
								@else
								
									<div class="dashboard-avatar-data">
										<h4>No jobs Available for you</h4>
										<div><i class="fas fa-map-marker-alt"></i> <span>You are now loggedin as </span> - <span>{{$user->name}}</span></div>
									</div>
								
								@endif
							</div>
							
							<!-- Tab 3 -->
							<div id='all_invoice' class="complex part3" style="display: none;">
								@if(isset($allinvoice))
									@foreach($allinvoice as $invoice)
									<div class="dashboard-avatar-data">
										<strong>Invoice for: {{$invoice->user->name}}</strong>
										<strong>Job Name: {{$invoice->job_title}}</strong>
										<div> Invoice mailed to: {{$invoice->user->email}} <span id="{{$invoice->id}}" onclick="show_invoice_only(this.id)">Show PDF</span></div>
									</div>
									<br>
									@endforeach
								@else
									<div class="dashboard-avatar-data">
										<h5>No Invoice available</h5>
									</div>
								@endif
								
								
									<div class="modal show_invoice_popup" tabindex="-1" role="dialog">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<img class="show_invoice_popup_img" id="show_invoice_popup_img" src="">
												</div>
											</div>
										</div>
									</div>
								
								
								
								
							</div>
						</div>
					</div>
				</div>
				
	</div>
</div>
@endsection

@section('pagescript')
	<script>
	function changetab(evt, tabName) {
	  // Declare all variables
	  var i, tabcontent, tablinks;

	  // Get all elements with class="tabcontent" and hide them
	  tabcontent = document.getElementsByClassName("complex");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }

	  // Get all elements with class="tablinks" and remove the class "active"
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active selected", "");
	  }

	  // Show the current tab, and add an "active" class to the link that opened the tab
	  document.getElementById(tabName).style.display = "block";
	  evt.currentTarget.className += " active selected";
	}

	</script>
@endsection

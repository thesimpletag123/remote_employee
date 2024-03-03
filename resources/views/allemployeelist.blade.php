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
								<li class="tablinks active selected" data-class="part1"><a href="{{url('allEmployee')}}" class="nav-link">Employee List</a></li>
								<li class="tablinks" data-class="part2" onclick="changetab(event, 'new_employee')">Employer List</li>
								<li class="tablinks" data-class="part3" onclick="changetab(event, 'all_invoice')">View all Invoices</li>
							</ul>
							<!--<div class="uplogout"><a href="">Log out</a></div>-->
						</div>
						<div class="col-lg-9 col-md-12 col-sm-12 col-12">
							<div id='current_employee' class="complex part1">
								<h5>Current Jobs</h5>
								
								@if(!$employerposts->isEmpty())
									@foreach($employerposts as $employerpost)
									<?php
										$newtime = strtotime($employerpost->created_at);
										$date = date('M d, Y',$newtime);
									?>
								<div class="current-employees-box">
									<div class="current-header">
										<div class="row">
											<div class="col-sm-7">
											
												<div class="dashboard-avatar">
													@if($employerpost->assigned_to_id == null)
														
														<img src="{{url('assets/images/avtar.png')}}" alt="image">
													@else
														@if($employerpost->user->user_image == null)
															<img src="{{url('assets/images/avtar.png')}}" alt="image">
														@else
															<img src="{{$employerpost->user->user_image}}" alt="image">
														@endif	
														
													@endif
												</div>
												<div class="dashboard-avatar-data">
													<h4>{{$employerpost->job_title}}</h4>													
													<div><i class="fas fa-clock"></i> <span>Job Posted On: {{$date }}</span></div>
												</div>
												
											</div>
											<div class="col-sm-3">
												<div class="project_status">
													@if($employerpost->project_status == 0)
														<div class="btn btn-warning rounded-pill">Todo</div>
													@elseif($employerpost->project_status == 1)
														<div class="btn btn-primary rounded-pill">In Progress</div>													
													@elseif($employerpost->project_status == 2)
														<div class="btn btn-success rounded-pill">Completed</div>
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
													<?php
														$total_budget = null;
														$budget = explode(' ', $employerpost->project_budget);
														$total_budget = number_format($budget[0]). ' '.$budget[1];
													?>
													<span class="rate_wrap">
														<span class="rate_head">
															<i class="fa-solid fa-square-poll-vertical"></i> Budget
														</span> 
														<span class="rate_boxes">
															<i class="fa-solid fa-coins"></i></i>															
															{{$total_budget}}
														</span>
													</span>
												@elseif(isset($employerpost->hourly_rate_min))
													<?php
														$total_hourly_rate_min = null;
														$total_hourly_rate_max = null;
														
														$hourly_rate_min = explode(' ', $employerpost->hourly_rate_min);
														$total_hourly_rate_min = number_format($hourly_rate_min[0]). ' '.$hourly_rate_min[1];
														
														$hourly_rate_max = explode(' ', $employerpost->hourly_rate_max);
														$total_hourly_rate_max = number_format($hourly_rate_max[0]). ' '.$hourly_rate_max[1];
													?>
													<span class="rate_wrap">
														<span class="rate_head">
															<i class="fa-solid fa-square-poll-vertical"></i>
															Rate Per hour
														</span>
														<span class="rate_boxes">
															<i class="fa-solid fa-circle-down"></i>
															{{$total_hourly_rate_min}}
														</span>
														<i class="fa-solid fa-minus"></i>
														<span class="rate_boxes">
															<i class="fa-solid fa-circle-arrow-up"></i> 
															{{$total_hourly_rate_max}}
														</span>
													</span>
												@endif
												@if (isset($employerpost->project_description) == '')
													<p><i class="fa-brands fa-product-hunt"></i> {{$employerpost->project_description}}</p>
												@endif
												<div class="review">
													<span class="review_head">Required Skills</span>
													<?php 
														$skills = null;
														if($employerpost->required_skills){
															$skills = explode('-' , $employerpost->required_skills);
														}
													?>
													<div class="items">
														@foreach($skills as $skill)
															<span> {{$skill}} </span>													
														@endforeach
													</div>
												</div>
											</div>
											<div class="col-md">
												
													@if($employerpost->project_status != 2)
													<div class="current-performance">
														@if($employerpost->assigned_to_id == null)
														<div class="d-flex justify-content-between align-items-center">
														<h6>Not assigned yet</h6>
														{{--<div class="btn-group">
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
														</div>--}}
														</div>
														@else

															<div class="d-flex justify-content-between mb-3 align-items-center">
															<h6>Assigned to: </h6>
															{{$employerpost->assigned_to_username}}
															</div>
															{{--<div class="d-flex justify-content-between align-items-center">
																<h6>Re-assign to:</h6>
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
															</div>--}}
														@endif
													</div>
													@endif
												@if($employerpost->assigned_to_username != null)
													<div class="current-performance">
														<div class="d-flex justify-content-between align-items-center">
														Change Status
															<select name="change_status" class="change_status">
																<option value="0" <?php if($employerpost->project_status == 0){echo 'selected';}?>>Todo</option>
																<option value="1" <?php if($employerpost->project_status == 1){echo 'selected';}?>>In Progress</option>
																<option value="2" <?php if($employerpost->project_status == 2){echo 'selected';}?>>Completed</option>
															</select>
															<input type="hidden" id="project_id" name="project_id" value="{{$employerpost->id}}">
														</div>
													</div>
												
													@if($employerpost->project_status == 2)
														<div class="current-performance">
															<input type="hidden" id="project_id" name="project_id" value="{{$employerpost->id}}">
															<button id="{{$employerpost->id}}" onClick="generate_invoice(this.id)" class="btn btn-success" style="width:100%;">Generate Invoice</button>
														</div>
													@endif
												@endif
											</div>
											<table>
												<tr><input type="hidden" class="hidden_jobid" value="{{$employerpost->id}}"></tr>
											</table>
											
											<div class="col-md-12 padding-top">
												<a href="{{route('editjobview' , $employerpost->id)}}" class="btn btn-primary">Edit</a>
												<button id="{{$employerpost->id}}" onClick="reply_click(this.id)" class="btn btn-danger deletejob">Close</button>
												
												<a href="{{route('trackjob' , $employerpost->id)}}" class="btn btn-success">Track</a>
											</div>
										</div>
									</div>
								</div>
									@endforeach
									<div class="paginate_links">{{ $employerposts->links() }}</div>
								@else
								
									<div class="dashboard-avatar-data">
										<div class="current-employees-box">
										<div class="current-header">
											<div class="row">
												<div class="col-sm-7">			
													<div class="dashboard-avatar-data">
														<Strong>No jobs Available for you</Strong> 
													</div>				
												</div>
											</div>
										</div>
									</div>
										<a class="btn btn-primary" href="#" onclick="open_jobpost_popup()">Post a new Job</a>
									</div>
								
								@endif
							</div>
							
							<!-- Tab 2 -->
							<div id='new_employee' class="complex part2" style="display: none;">
								<h5>Employee List</h5>
								
								{{--@if(isset($assignedemployee))
									<?php echo "aaaaaaaaaaa";?>
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
														
														<div><i class="fa fa-tasks-alt"></i> {{$employee->job_title}}
															
															</div>

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
												<div class="col-12 d-flex align-items-stretch gutter-1x">
													<div class="abt-emp col-xs-12 col-md-5">
														<span class="abt-head"><i class="fa-solid fa-user-astronaut"></i>{{$employee->user->name}} </span>
														<p class="mb-2"><i class="fas fa-clock"></i> <span>With us Since : {{$date }}</span></p>
														<p class="m-0"><i class="fas fa-align-justify"></i> Experience : {{$experience}}</p>
													</div>
													<div class="review col-xs-12 col-md-7">
														<span class="review_head">Employee Skills</span>
														<?php 
															$skillsets = null;
															if($employee->employee->skills){
																$skillsets = explode('-' , $employee->employee->skills);
															}
														?>
															<div class="items">
															@foreach($skillsets as $skill)
																<span>{{$skill}}</span>															
															@endforeach
															</div>
													</div>
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
								
								@endif --}}
								<?php $i = 0; ?>
								@if(isset($employeeavailable))
									@foreach($employeeavailable as $employee)
										<?php
											$i++;
											
											
											$newtime = strtotime($employee->user->created_at);
											$date = date('M d, Y',$newtime);
											
											$exp_yr = floor($employee->experience_in_month/12);
											$exp_month = $employee->experience_in_month%12;
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
														
														<div><i class="fa fa-tasks-alt"></i> @if($employee->contact_no != '')
																								<strong>Phone:</strong>{{$employee->contact_no}} || 
																							@endif 
																								<strong>Email:</strong> {{$employee->user->email}}
															
															</div>

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
												<div class="col-12 d-flex align-items-stretch gutter-1x">
													<div class="abt-emp col-xs-12 col-md-5">
														<span class="abt-head"><i class="fa-solid fa-user-astronaut"></i>{{$employee->user->name}} </span>
														<p class="mb-2"><i class="fas fa-clock"></i> <span>With us Since : {{$date }}</span></p>
														<p class="m-0"><i class="fas fa-align-justify"></i> Experience : {{$experience}}</p>
													</div>
													<div class="review col-xs-12 col-md-7">
														<span class="review_head">Employee Skills</span>
														<?php 
															$skillsets = null;
															if($employee->skills){
																$skillsets = explode('-' , $employee->skills);
															}
														?>
															<div class="items">
															@foreach($skillsets as $skill)
																<span>{{$skill}}</span>															
															@endforeach
															</div>
													</div>
												</div>
												
											</div>
										</div>
									</div>
											
										
									@endforeach
									
								@endif
								@if($i == 0)
									<div class="current-employees-box">
										<div class="current-header">
											<div class="row">
												<div class="col-sm-7">			
													<div class="dashboard-avatar-data">
														<Strong>Not connected to any employees</Strong>
													</div>				
												</div>
											</div>
										</div>
									</div>							
								@endif
							</div>
							
							<!-- Tab 3 -->
							<div id='all_invoice' class="complex part3 all_invoice" style="display: none;">
								
									<div class="dashboard-avatar-data">
										<table class="table table-bordered mb-0 rounded-pills">
											<thead>
											  <tr class="bg-primary text-white">
												<th class="align-middle text-center" scope="align-middle"><i class="fa-solid fa-file-export"></i></th>
												<th scope="col">Invoice for</th>
												<th scope="col">Job Name</th>
												<th scope="col">Invoice mailed to</th>
												<th class="align-middle text-center" scope="col">Action</th>
											  </tr>
											</thead>
											<tbody>
												
												@if(!$allinvoice->isEmpty())
													@foreach($allinvoice as $invoice)
														<?php $invoiceurl = $invoice->invoice_attachment; ?>
														<tr>
															<th class="align-middle text-center"><i class="fa-solid fa-file-lines"></i></th>
															<td class="align-middle">{{$invoice->user->name}}</td>
															<td class="align-middle">{{$invoice->job_title}}</td>
															<td class="align-middle">{{$invoice->user->email}}</td>
															<td class="align-middle"><a class="rounded-pill btn btn-primary w-100" href="{{URL::asset($invoiceurl)}}"> Download</a></td>
														</tr>
													@endforeach
												@else
													<tr>
														<td colspan="5" class="align-middle" style="text-align:center;">
															<div class="current-employees-box">
																<div class="current-header">
																	<Strong>No Invoice to show at the moment!</Strong> 
																</div>	
															</div>	
														</td>
													</tr>
												@endif
											</tbody>
										  </table>
									</div>
									<br>
									
								
								
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

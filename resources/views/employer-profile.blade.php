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
                                
                                
                            </div>
                        </div>

                        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
                           
							<div class="col-auto">
								<div class="col-12"><h5>My Profile</h5></div>
							</div>
                            <form id="employerprofileupdate" name="employerprofileupdate" method="post"
                                action="{{route('employerprofileupdate')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="hidden_uid" name="hidden_uid" value="{{$user->id}}">
                                <div class="col-auto">
                                    <div class="col-lg-8 custom_div">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Job Title here" value="{{$user->name}}">
                                    </div>
                                    <div class="col-lg-8 custom_div">
                                        <label for="email" class="form-label">Email ID</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{$user->email}}" readonly>
                                    </div>
                                    <div class="col-lg-8 custom_div">
                                        <label for="experience" class="form-label">Joined Remote Employee</label>
                                        <?php
												$monthNum  = $user->created_at->month;
												$dateObj   = DateTime::createFromFormat('!m', $monthNum);
												$monthName = $dateObj->format('F');
												$usersince = $monthName.', '.$user->created_at->year;
											?>
                                        <input type="text" step=1 class="form-control" value="{{$usersince}}" readonly>
                                    </div>
                                    <div class="col-lg-8 custom_div">
                                        <input type="submit" value="Update Name" class="btn btn-primary">
                                        <a href="{{route('employerdashboard')}}" class="btn btn-success"> Back to
                                            dashboard</a>
                                    </div>
                                </div>


                            </form>
                            <hr>
                            <div class="col-auto mother-jobdiv">
								<h5> Posted Jobs: </h5>
								@if(isset($alljobslist))
								@foreach($alljobslist as $singlejob)
									@if($singlejob['posted_by_id'] == $user->id)
																	
										<div class="current-employees-box">
											<div class="current-header">
												<div class="row">
													<div class="col-sm-7">
													
														<div class="dashboard-avatar">
															@if($user->user_image == null)
																<img src="{{url('assets/images/avtar.png')}}" alt="image">
															@else
																<img src="{{$user->user_image}}" alt="image">
															@endif
															<!--<span></span>-->
														</div>
														<div class="dashboard-avatar-data">
															<h4>{{$singlejob['job_title']}}</h4>													
															<div><i class="fas fa-clock"></i> <span>Created at : {{$date }}</span></div>
														</div>
														
													</div>
													<div class="col-sm-3">
														<div class="project_status">										
															@if($singlejob['project_status'] == 0)
																<div class="btn btn-warning rounded-pill">Todo</div>
															@elseif($singlejob['project_status'] == 1)
																<div class="btn btn-primary rounded-pill">In Progress</div>
															@elseif($singlejob['project_status'] == 2)
																<div class="btn btn-success rounded-pill">Testing</div>
															@elseif($singlejob['project_status'] == 3)
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
														@if(isset($singlejob['project_budget']))
															<span>|Budget : {{$singlejob['project_budget']}}|  </span>
														@endif
														@if(isset($singlejob['hourly_rate_min']))
															<span class="rate_wrap"><span class="rate_head"><i class="fa-solid fa-square-poll-vertical"></i> Rate Per hour </span> <span class="rate_boxes"><i class="fa-solid fa-circle-down"></i> {{$singlejob['hourly_rate_min']}}</span> <i class="fa-solid fa-minus"></i> <span class="rate_boxes"><i class="fa-solid fa-circle-arrow-up"></i>  {{$singlejob['hourly_rate_max']}}</span></span>
														@endif
														<br>
														<p><i class="fa-brands fa-product-hunt"></i> {{$singlejob['project_description']}}</p>
														<div class="review">
															<span class="review_head">Required Skills</span>
															<?php 
																$skills = null;
																if($singlejob['required_skills']){
																	$skills = explode('-' , $singlejob['required_skills']);
																}
															?>
															<div class="items">
																@foreach($skills as $skill)
																	<span> {{$skill}} </span>															
																@endforeach
															</div>
														</div>
														
													</div>
													
													<table>
														<tr><input type="hidden" class="hidden_jobid" value="{{$singlejob['id']}}"></tr>
													</table>
													
													<div class="col-md-12 padding-top">
														<a href="{{route('editjobview' , $singlejob['id'])}}" class="btn btn-primary">Edit</a>
														<button id="{{$singlejob['id']}}" onClick="reply_click(this.id)" class="btn btn-danger deletejob">Delete</button>
														
														<a href="{{route('trackjob' , $singlejob['id'])}}" class="btn btn-success">Track</a>
													</div>
												</div>
											</div>
										</div>
									@endif	
								@endforeach
							@endif

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
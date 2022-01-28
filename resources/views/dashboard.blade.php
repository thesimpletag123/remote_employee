@extends('layouts.master')
@section('title', 'Dashboard')
@section('pagecss')

@endsection
@section('content')

<!-- starting modal-dashboard-employee -->
<div class="container">
	<div class="modal-dashboard-employee">
		
<input type="hidden" id="hidden_uid" value="{{$user->id}}">				
@include('layouts.dashboardheader')
					

					<div class="jopboard p-3 ">
						<h5>Job Board</h5>
					
						
						@if(isset($alljobslist))
							@foreach($alljobslist as $singlejob)
								@if($singlejob['assigned_to_id'] == $user->id)
<?php 
//echo 'User Name'.$user->id;
//echo "<br>";
//echo $singlejob['assigned_to_id'];
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
												
												<div class="setticon">
													<span><i class="fas fa-ellipsis-h fa-2x"></i></span>
												</div>
											</div>
											<div class="col-12">
												<h6>Project Brief</h6>
												<p>
												   <i class="fas fa-file-alt fa-2x"></i> 
													{{$singlejob['project_description']}}
												</p>
											</div>
											<div class="col-md-8 col-sm-12 col-12">
											@if($singlejob['invoice_attachment'])
												<h6>Invoice Attachment</h6>
												<div><i class="fas fa-paperclip"></i> <a href="{{$singlejob['invoice_attachment']}}" target="_blabk"> View Last Invoice</a></div>
											@else
												<h6>No Invoice available.</h6>
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
					</div>					
				
		</div>
	</div>
	<!-- End modal-dashboard-employee -->
@endsection
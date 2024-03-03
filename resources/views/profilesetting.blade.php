@extends('layouts.master')
@section('title', 'Profile')
@section('pagecss')

@endsection
@section('content')
<!-- starting modal-profile-setting -->
<div class="container" style="margin-top:120px;">
	<div class="modal-profile-setting">
		
					
					<input type="hidden" id="hidden_uid" value="{{$user->id}}">
					@include('layouts.dashboardheader')
					
					<div class="profile-setting-body">
						<div class="row">
							@include('layouts.dashboardsidebar')
							
							<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
								<h5>Workspace</h5>
									
										@foreach($alljobslist as $singlejob)
											<div class="jopboard-box">
												<div class="row">
													<div class="col-sm-6 col-12">
														<h4>{{$singlejob['job_title']}}</h4>
													</div>
													<div class="col-sm-6 col-12">
														<select>
															<option>Edit </option>
															<option>Delete </option>
														</select>
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
										@endforeach						
								
							</div>
						</div>
					</div>
					
				</div>
			
	</div>
	<!-- End modal-profile-setting -->
@endsection
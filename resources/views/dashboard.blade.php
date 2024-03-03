@extends('layouts.master')
@section('title', 'Dashboard')
@section('pagecss')
@endsection
@section('content')

<!-- starting modal-dashboard-employee -->
<div class="container" style="margin-top:120px;">
	<div class="modal-dashboard-employee">
		
		<input type="hidden" id="hidden_uid" value="{{$user->id}}">				
		@include('layouts.dashboardheader')
		<?php $i=0; ?>	 				

		<div class="jopboard px-3">
			<h5>Job Board</h5>
			<h6> You have assigned to bellow Jobs</h6>
					
						
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
							<h6 class="mb-0">Invoice Attachment</h6>
							<div><i class="fas fa-paperclip"></i> <a href="{{URL::asset($singlejob['invoice_attachment'])}}"> Latest Invoice</a></div>
						@else
							<h6 class="mb-0">No Invoice available.</h6>
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
		
</div>
<!-- End modal-dashboard-employee -->
@endsection
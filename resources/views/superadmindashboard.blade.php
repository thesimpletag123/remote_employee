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
								<li class="tablinks active selected" data-class="part1" onclick="changetab(event, 'current_employee')">Employee</li>
								<li class="tablinks" data-class="part2" onclick="changetab(event, 'current_employer')">Employeer</li>
								<li class="tablinks" data-class="part3" onclick="changetab(event, 'all_invoice')">View all Invoices</li>
							</ul>
							<!--<div class="uplogout"><a href="">Log out</a></div>-->
						</div>
						<div class="col-lg-9 col-md-12 col-sm-12 col-12">
							<div id='current_employee' class="complex part1">
								<div class="current-employees-box">
									<div class="current-header">
										<div class="row">
											<div class="col-sm-7">
											<h5>All Employee List</h5> 
												<div class="dashboard-avatar">
													 
												</div>
											</div>
											<div class="col-sm-3">	
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
										<div class="col-12 table-responsive">
        <br />
            <table class="table table-striped table-bordered user_datatable"> 
                <thead>
                    <tr>
                        <th>
						ID<br>
						<input type="text" class="from-control filter-input" placeholder="search id" data-column="0" style="width:100px;">
						</th>
                        <th>
						Name
						<br>
						<input type="text" class="from-control filter-input" placeholder="search name" data-column="1" style="width:100px;">
						</th>
						<th>
						Phone<br>
						<input type="text" class="from-control filter-input" placeholder="search phone" data-column="3" style="width:100px;">
						</th>
						<th>
						Email<br>
						<input type="text" class="from-control filter-input" placeholder="search email" data-column="4" style="width:100px;">
						</th>
						 
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
 
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" id="sample_form" enctype="multipart/form-data"class="form-horizontal">
            <div class="modal-body">
                <span id="form_result"></span>
                <div class="form-group">
                     <label for="name">Admin Name</label>
					<input type="text" class="form-control" name="name" id="employer_name" value="" placeholder="Name">
                </div>
                <div class="form-group">
                     <label for="email">Admin Email</label>
					<input type="text" class="form-control" name="email" id="employer_email" value="" >
                </div>
				 
				<div class="form-group">
                     <label for="phone">Admin Phone</label>
					<input type="number" class="form-control" name="phone" id="phone" value="" placeholder="Phone">
                </div> 
                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="action_button" id="action_button" value="Update" class="btn btn-info" />
            </div>
        </form>  
        </div>
        </div>
    </div>
 
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" id="sample_form" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
            </div>
        </form>  
        </div>
        </div>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Tab 2 -->
							<div id='current_employer' class="complex part2" style="display: none;">
							<div class="current-employees-box">
									<div class="current-header">
										<div class="row">
											<div class="col-sm-7">
											<h5>All Employer List</h5> 
												<div class="dashboard-avatar">
													 
												</div>
											</div>
											<div class="col-sm-3">	
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
										<div class="col-12 table-responsive">
        <br />
            <table class="table table-striped table-bordered employer_datatable"> 
                <thead>
                    <tr>
                        <th>
						Employer ID<br>
						<input type="text" class="from-control filter-input" placeholder="search id" data-column="0" style="width:100px;">
						</th>
                        <th>
						Employer Name
						<br>
						<input type="text" class="from-control filter-input" placeholder="search name" data-column="1" style="width:100px;">
						</th>
						 
						<th>
						Employer Phone<br>
						<input type="text" class="from-control filter-input" placeholder="search phone" data-column="3" style="width:100px;">
						</th>
						<th>
						Employer Email<br>
						<input type="text" class="from-control filter-input" placeholder="search email" data-column="4" style="width:100px;">
						</th>
						 
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
 
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" id="sample_form" enctype="multipart/form-data"class="form-horizontal">
            <div class="modal-body">
                <span id="form_result"></span>
                <div class="form-group">
                     <label for="name">Employer Name</label>
					<input type="text" class="form-control" name="name" id="employer_name" value="" placeholder="Name">
                </div>
                <div class="form-group">
                     <label for="email">Employer Email</label>
					<input type="text" class="form-control" name="email" id="employer_email" value="" readonly>
                </div>
				 
				<div class="form-group">
                     <label for="phone">Employer Phone</label>
					<input type="number" class="form-control" name="phone" id="phone" value="" placeholder="Phone">
                </div> 
                <input type="hidden" name="action" id="action" value="Add" />
                <input type="hidden" name="hidden_id" id="hidden_id" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="action_button" id="action_button" value="Update" class="btn btn-info" />
            </div>
        </form>  
        </div>
        </div>
    </div>
 
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" id="sample_form" class="form-horizontal">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
            </div>
        </form>  
        </div>
        </div>	
										</div>
									</div>
								</div>
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
	
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  
  $(function () {
	   
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admindashboard') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
             
			
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
	$('.filter-input').keyup(function(){
		table.column($(this).data('column'))
		.search($(this).val())
		.draw();
		
	});
    
  });



  $('#sample_form').on('submit', function(event){
        event.preventDefault(); 
        var action_url = '';
 
         
 
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('updateemployee') }}";
        }
 
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: action_url,
            data:$(this).serialize(),
            dataType: 'json',
            success: function(data) {
                console.log('success: '+data);
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#sample_form')[0].reset();
                    $('#user_table').DataTable().ajax.reload();
                }
                $('#form_result').html(html);
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
    });











$(document).on('click', '.edit', function(event){
        event.preventDefault(); 
        var id = $(this).attr('id'); alert(id);
		//alert(id);
        $('#form_result').html('');
 
         
 
        $.ajax({
            url :"/editemployeehow/"+id+"/",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType:"json",
            success:function(data)
            {
                console.log('success: '+data);
				$('#employer_name').val(data.result.name);
                $('#employer_email').val(data.result.email);
                $('#phone').val(data.result.phone);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Update');
                $('#action').val('Edit'); 
                $('.editpass').hide(); 
                $('#formModal').modal('show');
            },
            error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
            }
        })
    });

var id;
 
    $(document).on('click', '.delete', function(){
      id = $(this).attr('id');
	  //alert(id );
        $('#confirmModal').modal('show');
    });
 
     $('#ok_button').click(function(){
        $.ajax({
            url:"employeedelete/"+id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data)
            {
                setTimeout(function(){
                $('#confirmModal').modal('hide');
                $('.user_datatable').DataTable().ajax.reload();
                //alert('Data Deleted');
                }, 1000);
            }
        })
    });


 
 
 
 
 
 
 
 $(document).ready(function (){
	 
	 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
	 
	 $('.button').click(function (e){
		 e.preventDefault();
		 var softdelete=$(this).closest("tr").find(".softdelete_id").val();
		 alert(softdelete);
		 swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this imaginary file!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				   
				   var data ={
					   "_token":$('input[name="_token"]').val(),
					   "id": softdelete,
				   }
				   
				  $.ajax({
					  type: 'DELETE',
					  url:"/employeedelete/"+softdelete,
					  data: data,
					  success:function(response){
						  swal(response.status, {
							  icon: "success",
							})
							.then((result) => {
								location.reload();
							});
					  }
					  
				  });
				  
				  
			  }  
			});
     
});
});


//EMPLOYER DETAILS//


$(function () {
	   
	   var table = $('.employer_datatable').DataTable({
		   processing: true,
		   serverSide: true,
		   ajax: "{{ route('employer') }}",
		   columns: [
			   {data: 'id', name: 'id'},
			   {data: 'name', name: 'name'},
			 
			   {data: 'phone', name: 'phone'},
			   {data: 'email', name: 'email'},
			 
			   
			   {
				data: 'action', 
				   name: 'action', 
				   orderable: true, 
				   searchable: true
			   },
		   ]
	   });
	   $('.filter-input').keyup(function(){
		   table.column($(this).data('column'))
		   .search($(this).val())
		   .draw();
		   
	   });
	   
	 });
   
   
   
   $('#sample_form').on('submit', function(event){
		   event.preventDefault(); 
		   var action_url = '';
	
			
	
		   if($('#action').val() == 'Edit')
		   {
			   action_url = "{{route('updateemployer')}}";
		   }
	
		   $.ajax({
			   type: 'post',
			   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			   url: action_url,
			   data:$(this).serialize(),
			   dataType: 'json',
			   success: function(data) {
				   console.log('success: '+data);
				   var html = '';
				   if(data.errors)
				   {
					   html = '<div class="alert alert-danger">';
					   for(var count = 0; count < data.errors.length; count++)
					   {
						   html += '<p>' + data.errors[count] + '</p>';
					   }
					   html += '</div>';
				   }
				   if(data.success)
				   {
					   html = '<div class="alert alert-success">' + data.success + '</div>';
					   $('#sample_form')[0].reset();
					   $('#user_table').DataTable().ajax.reload();
				   }
				   $('#form_result').html(html);
			   },
			   error: function(data) {
				   var errors = data.responseJSON;
				   console.log(errors);
			   }
		   });
	   });
   
   
   
   
   
   
   
   
   
   
   
   $(document).on('click', '.edit', function(event){
		   event.preventDefault(); 
		   var id = $(this).attr('id'); alert(id);
		   //alert(id);
		   $('#form_result').html('');
	
			
	
		   $.ajax({
			   url :"/editemployershow/"+id+"/",
			   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			   dataType:"json",
			   success:function(data)
			   {
				   console.log('success: '+data);
				   $('#employer_name').val(data.result.name);
				   $('#employer_email').val(data.result.email);
				    
				   $('#phone').val(data.result.phone);
				    
				   $('#hidden_id').val(id);
				   $('.modal-title').text('Edit Record');
				   $('#action_button').val('Update');
				   $('#action').val('Edit'); 
				   $('.editpass').hide(); 
				   $('#formModal').modal('show');
			   },
			   error: function(data) {
				   var errors = data.responseJSON;
				   console.log(errors);
			   }
		   })
	   });
   
   var id;
	
	   $(document).on('click', '.delete', function(){
		 id = $(this).attr('id');
		 //alert(id );
		   $('#confirmModal').modal('show');
	   });
	
		$('#ok_button').click(function(){
		   $.ajax({
			   url:"employerdelete/"+id,
			   beforeSend:function(){
				   $('#ok_button').text('Deleting...');
			   },
			   success:function(data)
			   {
				   setTimeout(function(){
				   $('#confirmModal').modal('hide');
				   $('.user_datatable').DataTable().ajax.reload();
				   //alert('Data Deleted');
				   }, 1000);
			   }
		   })
	   });
   
   
	
	
	
	
	
	
	
	$(document).ready(function (){
		
		$.ajaxSetup({
	   headers: {
		   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	   }
	  });
		
		$('.button').click(function (e){
			e.preventDefault();
			var softdelete=$(this).closest("tr").find(".softdelete_id").val();
			alert(softdelete);
			swal({
				 title: "Are you sure?",
				 text: "Once deleted, you will not be able to recover this imaginary file!",
				 icon: "warning",
				 buttons: true,
				 dangerMode: true,
			   })
			   .then((willDelete) => {
				 if (willDelete) {
					  
					  var data ={
						  "_token":$('input[name="_token"]').val(),
						  "id": softdelete,
					  }
					  
					 $.ajax({
						 type: 'DELETE',
						 url:"employerdelete/"+softdelete,
						 data: data,
						 success:function(response){
							 swal(response.status, {
								 icon: "success",
							   })
							   .then((result) => {
								   location.reload();
							   });
						 }
						 
					 });
					 
					 
				 }  
			   });
		
   });
   });




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

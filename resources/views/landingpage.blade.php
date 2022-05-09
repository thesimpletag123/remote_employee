@extends('layouts.master')
@section('title', 'Home')
@section('pagecss')
<style>
::file-selector-button {
    display: none;
}
.profile_img {
	margin-left: 30%;
}
.otp-input{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;font-family:Roboto}input.single-otp-input,input.single-otp-input:focus{border:none;border-bottom:1px solid var(--BG_COLOR_L2);background:transparent;border-radius:0;width:42px;text-align:center;font-size:16px;font-size:16px;line-height:1.88;margin-right:18px;outline:none}input.single-otp-input:focus{border:none;border-bottom:1.5px solid var(--BRAND_BLUE)}.light input.single-otp-input,.light input.single-otp-input:focus{border-bottom-color:rgba(0,0,0,0.3)}

</style>
@endsection
@section('content')
        <!-- starting menu-links -->
        @if (Auth::check())
			<section class="menu-links">
				<span class="closbtn"><i class="fas fa-times"></i></span>
				<div class="row">
					<div class="col-md"></div>
					<div class="col-md">
						<h3>MENU</h3>
						<ul>
							@if ($user->user_type == 'employer')
								<li><a href="{{route('employerdashboard')}}">Dashboard</a></li>
							@elseif ($user->user_type == 'employee')
								<li><a href="{{route('dashboard')}}">Dashboard</a></li>
							@else
								<li><a href="">No Menu available</a></li>
							@endif
						</ul>
					</div>
				</div>
			</section>
		@endif
        <!-- End menu-links -->
        
        
        <!-- starting banner -->
        <section class="banner">
                <div class="tre-carousel">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row mainbox">
                                    <div class="col-lg-5 col-md">
                                        <div class="leftsidebox">
                                            <h6>Lorem Ipsum is simply dummy text</h6>
                                            <h1>WORK... <br> <span>MANAGE...</span> <br> FROM YOUR <br> OWN SPACE </h1>
                                            
												<div class="row">
													@if (Auth::check())
														@if($user->user_type == 'employer')
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														@elseif ($user->user_type == 'employee')
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@else
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@endif
													@else
														<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
													@endif
												</div>
											
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md">
                                        <img src="{{ asset('assets/images/astronat.png') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row mainbox">
                                    <div class="col-lg-5 col-md">
                                        <div class="leftsidebox">
                                            <h6>Lorem Ipsum is simply dummy text</h6>
                                            <h1>WORK... <br> <span>PROGRAMING...</span> <br> FROM YOUR <br> OWN SPACE </h1>
                                            
												<div class="row">
													@if (Auth::check())
														@if($user->user_type == 'employer')
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														@elseif ($user->user_type == 'employee')
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@else
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@endif
													@else
														<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
													@endif
												</div>
											
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md">
                                        <img src="{{ asset('assets/images/astronat.png') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row mainbox">
                                    <div class="col-lg-5 col-md">
                                        <div class="leftsidebox">
                                            <h6>Lorem Ipsum is simply dummy text</h6>
                                            <h1>WORK... <br> <span>SOCIALMED...</span> <br> FROM YOUR <br> OWN SPACE </h1>
                                            
												<div class="row">
													@if (Auth::check())
														@if($user->user_type == 'employer')
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														@elseif ($user->user_type == 'employee')
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@else
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@endif
													@else
														<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
													@endif
												</div>
											
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md">
                                        <img src="{{ asset('assets/images/astronat.png') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row mainbox">
                                    <div class="col-lg-5 col-md">
                                        <div class="leftsidebox">
                                            <h6>Lorem Ipsum is simply dummy text</h6>
                                            <h1>WORK... <br> <span>MOBILEAPP...</span> <br> FROM YOUR <br> OWN SPACE </h1>
                                            
												<div class="row">
													@if (Auth::check())
														@if($user->user_type == 'employer')
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														@elseif ($user->user_type == 'employee')
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@else
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@endif
													@else
														<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
													@endif
												</div>
											
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md">
                                        <img src="{{ asset('assets/images/astronat.png') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row mainbox">
                                    <div class="col-lg-5 col-md">
                                        <div class="leftsidebox">
                                            <h6>Lorem Ipsum is simply dummy text</h6>
                                            <h1>WORK... <br> <span>MARKETING...</span> <br> FROM YOUR <br> OWN SPACE </h1>
                                            
												<div class="row">
													@if (Auth::check())
														@if($user->user_type == 'employer')
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														@elseif ($user->user_type == 'employee')
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@else
															<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
															<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
														@endif
													@else
														<div class="col"><a class="employer" href="" data-bs-toggle="modal" data-bs-target="#modal-employer">I'm an Employer</a></div>
														<div class="col"><a class="employee" href="" data-bs-toggle="modal" data-bs-target="#modal-employee">I'm an Employee</a></div>
													@endif
												</div>
											
											
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md">
                                        <img src="{{ asset('assets/images/astronat.png') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
        </section>
        <!-- End banner -->
        
        
        
        
        
        <!-- starting haveproject -->
        <section class="haveproject">
            <div class="container">
                <h3 class="wow fadeInUpBig" data-wow-duration=".25s" data-wow-offset="60">HAVE A PROJECT <br>IN MIND?</h3>
                <h6 class="wow fadeInUpBig" data-wow-duration=".55s" data-wow-offset="60">Get in touch with us today</h6>
                <a href="" class="wow fadeInUpBig" data-wow-duration=".75s" data-wow-offset="60">Talk to us</a>
            </div>
        </section>
        <!-- End haveproject -->
		<!-- starting findtelent -->
        <section class="findtelent">
            <div class="container">
                <div class="main-heading">
                    <h2>Find talent your way</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the  1500s, when an unknown printer took a galley</p>
                </div>
                <div class="row">
                    <div class="col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration=".25s" data-wow-offset="60">
                        <div class="mainbox">
                            <h4>Lorem Ipsum is simply</h4>
                            <p>Lorem Ipsum is simply</p>
                            <a href="">
                                <i class="fas fa-angle-right fa-2x"></i>
                                <i class="fas fa-angle-double-right fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration=".5s" data-wow-offset="60">
                        <div class="mainbox">
                            <h4>Lorem Ipsum is simply</h4>
                            <p>Lorem Ipsum is simply</p>
                            <a href="">
                                <i class="fas fa-angle-right fa-2x"></i>
                                <i class="fas fa-angle-double-right fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md col-sm-6 col-12 wow fadeInUpBig" data-wow-duration=".75s" data-wow-offset="60">
                        <div class="mainbox">
                            <h4>Lorem Ipsum is simply</h4>
                            <p>Lorem Ipsum is simply</p>
                            <a href="">
                                <i class="fas fa-angle-right fa-2x"></i>
                                <i class="fas fa-angle-double-right fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div><p>Need a solution for large organizations? Enterprise Suite has you covered.</p></div>
            </div>
        </section>
        <!-- End findtelent -->
@endsection

@section('pagescript')
	@if (Auth::check())
		<script>
			$('#submit_quick_project').prop('disabled', false);
			$('.linkedin_login').hide();
			$('.google-btn').hide();
			$('a#social_linkindin_login_login').hide();
		</script>			
	@endif
<script>
$("#go_to_login_popup").click(function(){
	$("#modal-register").modal('hide');
	$('#modal-login').modal('toggle');
});
$("#go_to_register_popup").click(function(){
	$("#modal-login").modal('hide');
	$('#modal-register').modal('toggle');
});
$("#emp_form1_next").click(function(){
	var emp_fname = $('#emp_name').val();
	var emp_email = $('#emp_email').val();
	var emp_phone_ext = $('#emp_phone_ext').val();
	var emp_phone_no = $('#emp_phone_no').val();
	var emp_country = $('#emp_country').val();
	var emp_professional_fields = $('#emp_professional_fields').val();
	
	
	var CSRF_TOKEN = "{{ csrf_token() }}";
	//var files = $('#user_image')[0].files;
	var fd = new FormData();
	//if(files.length > 0){		
		//fd.append('user_image',files[0]);	
	//}	
		fd.append('_token',CSRF_TOKEN);
		fd.append('emp_fname',emp_fname);
		fd.append('emp_email',emp_email);
		fd.append('emp_phone_ext',emp_phone_ext);
		fd.append('emp_phone_no',emp_phone_no);
		fd.append('emp_country',emp_country);
		fd.append('emp_professional_fields',emp_professional_fields);
	
	
	 $.ajax({
        type: "POST",
        url: "{{url('emp1_submit')}}",
        data: fd,
		contentType: false,
		processData: false,
		dataType: "json",
        //success: function( msg ) {
            //alert( msg );
        //}
    });
});
$("#emp_form2_next").click(function(){
	//alert('test');

	var emp_skills = instance.value();
	//alert(emp_skills);
	//var emp_extra_skills = $('#emp_extra_skills').val();
	var exp_yr = $('#exp_yr').val();
	var exp_month = $('#exp_month').val();
	
	var CSRF_TOKEN = "{{ csrf_token() }}";
	var files = $('#file')[0].files;
	var fd = new FormData();
	if(files.length > 0){		
		fd.append('file',files[0]);	
	}
		fd.append('_token',CSRF_TOKEN);
		fd.append('emp_skills',emp_skills);
		//fd.append('emp_extra_skills',emp_extra_skills);
		fd.append('exp_yr',exp_yr);
		fd.append('exp_month',exp_month);
	$.ajax({
			url:"{{url('emp2_submit')}}",
			method: "post",
			data: fd,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(data){				
					$.ajax({
						url:"{{url('sendmail')}}",
						success: function(data){
							//alert('done');
							swal({
								title: "OTP Sent!",
								text: "OTP sent to your given mail ID, Please verify the OTP!",
								type: "success",
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'ok!'
							});
						}
					});

			}
		});

});
$("#emp_verify_btn").click(function(){
	var otp1 = $('#otp1').val();
	var otp2 = $('#otp2').val();
	var otp3 = $('#otp3').val();
	var otp4 = $('#otp4').val();
	var otp5 = $('#otp5').val();
	var otp = otp1 + otp2 + otp3 + otp4 + otp5;
	//alert(otp);
	$.ajax({
        type: "POST",
        url: "{{url('emp_otp_verify')}}",
        data: { "_token": "{{ csrf_token() }}",otp:otp}, 
        success: function( msg ) {
				 if(msg == 'ERROR'){
					$('#modal-employee-verification-failed').modal('show');
				 } else {
					 $('#modal-employee-done').modal('toggle');
					 $('#modal-employee-varifyed').modal('show');
				 }
		}
        
    });
});


/*$(".find_emp").click(function(){
	 $.ajax({
        type: "POST",
        url: "{{url('update_employer_role')}}",
		data: { "_token": "{{ csrf_token() }}"}
	});
});*/
/*$("#submit_quick_project").click(function(){
	var quick_project_desc = $('#quick_project_desc').val();
	var quick_min_budget = $('#quick_min_budget').val();
	var quick_max_budget = $('#quick_max_budget').val();
	var quick_currency = $('#quick_currency').val();
	var quick_email = $('#quick_email').val();
	var quick_country = $('#quick_country').val();
	var quick_contact_ext = $('#quick_contact_ext').val();
	var quick_contact_no = $('#quick_contact_no').val();
	$.ajax({
        type: "POST",
        url: "{{url('update_employer_quick')}}",
		data: { "_token": "{{ csrf_token() }}" , quick_project_desc: quick_project_desc, quick_min_budget: quick_min_budget, quick_max_budget: quick_max_budget, quick_currency: quick_currency, quick_email:quick_email, quick_country: quick_country, quick_contact_ext: quick_contact_ext, quick_contact_no: quick_contact_no},
		        success: function( data ) {
					var result = JSON.parse(data.success);
					if(result == 1){
						$('#modal-quick-project').modal('toggle');
						$('#modal-employee-varifyed').modal('show');
					} else {
						$('#modal-employee-verification-failed').modal('show');
					}
		}
	});
});*/

$("#verify_fulltime_employer").click(function(){
	var fulltime_job_headline = $('#fulltime_job_headline').val();
	var fulltime_job_skills = $('#my_skills').val();
	var fulltime_job_extra_skill = $('#fulltime_job_extra_skill').val();
	var fulltime_job_min = $('#fulltime_job_min').val();
	var fulltime_job_max = $('#fulltime_job_max').val();
	var fulltime_job_currency_minmax = $('#fulltime_job_currency_minmax').val();
	var fulltime_job_email_minmax = $('#fulltime_job_email_minmax').val();
	var fulltime_job_desc_minmax = $('#fulltime_job_desc_minmax').val();
	var fulltime_job_budget = $('#fulltime_job_budget').val();
	var fulltime_project_budget_currency = $('#fulltime_project_budget_currency').val();
	var fulltime_job_email_budget = $('#fulltime_job_email_budget').val();
	var fulltime_job_desc_budget = $('#fulltime_job_desc_budget').val();
	var otp1 = $('#otpp1').val();
	var otp2 = $('#otpp2').val();
	var otp3 = $('#otpp3').val();
	var otp4 = $('#otpp4').val();
	var otp5 = $('#otpp5').val();
	var otp = otp1 + otp2 + otp3 + otp4 + otp5;
	//alert ('Need to start work from landing.blade.php');
	$.ajax({
        type: "POST",
        url: "{{url('verify_fulltime_employer')}}",
		data: { "_token": "{{ csrf_token() }}" , fulltime_job_headline:fulltime_job_headline, fulltime_job_skills:fulltime_job_skills , fulltime_job_extra_skill:fulltime_job_extra_skill, fulltime_job_min:fulltime_job_min, fulltime_job_max:fulltime_job_max, fulltime_job_currency_minmax:fulltime_job_currency_minmax, fulltime_job_email_minmax:fulltime_job_email_minmax, fulltime_job_desc_minmax:fulltime_job_desc_minmax, fulltime_job_budget:fulltime_job_budget ,fulltime_project_budget_currency:fulltime_project_budget_currency, fulltime_job_email_budget:fulltime_job_email_budget, fulltime_job_desc_budget:fulltime_job_desc_budget, otp:otp },
		success: function( data ) {
			var result = JSON.parse(data.success);
			//alert(result);
			if(result == 1){
				$('#parttime').hide();
				$('#modal-employee-varifyed').modal('show');
			} 
			if(result == 2){
				$('#parttime').hide();
				$('#modal-employee-verification-failed').modal('show');
			}
		}
	});
});

$("#submit_full_project").click(function(){
	var fulltime_job_headline = $('#fulltime_job_headline').val();
	var fulltime_job_skills = $('#my_skills').val();
	var fulltime_job_extra_skill = $('#fulltime_job_extra_skill').val();
	var fulltime_job_min = $('#fulltime_job_min').val();
	var fulltime_job_max = $('#fulltime_job_max').val();
	var fulltime_job_currency_minmax = $('#fulltime_job_currency_minmax').val();
	var fulltime_job_email_minmax = $('#fulltime_job_email_minmax').val();
	var fulltime_job_desc_minmax = $('#fulltime_job_desc_minmax').val();
	var fulltime_job_budget = $('#fulltime_job_budget').val();
	var fulltime_project_budget_currency = $('#fulltime_project_budget_currency').val();
	var fulltime_job_email_budget = $('#fulltime_job_email_budget').val();
	var fulltime_job_desc_budget = $('#fulltime_job_desc_budget').val();
	//alert ('Need to start work from landing.blade.php');
	$.ajax({
        type: "POST",
        url: "{{url('submit_full_project')}}",
		data: { "_token": "{{ csrf_token() }}" , fulltime_job_headline:fulltime_job_headline, fulltime_job_skills:fulltime_job_skills , fulltime_job_extra_skill:fulltime_job_extra_skill, fulltime_job_min:fulltime_job_min, fulltime_job_max:fulltime_job_max, fulltime_job_currency_minmax:fulltime_job_currency_minmax, fulltime_job_email_minmax:fulltime_job_email_minmax, fulltime_job_desc_minmax:fulltime_job_desc_minmax, fulltime_job_budget:fulltime_job_budget ,fulltime_project_budget_currency:fulltime_project_budget_currency, fulltime_job_email_budget:fulltime_job_email_budget, fulltime_job_desc_budget:fulltime_job_desc_budget},
		success: function( data ) {
			var result = JSON.parse(data.success);
			//alert(result);
			if(result == 1){
				$('#parttime').hide();
				$('#modal-employee-varifyed').modal('show');
			} 
			if(result == 2){
				$('#parttime').hide();
				$('#modal-employee-verification-failed').modal('show');
			}
		}
	});
});

</script>
@endsection
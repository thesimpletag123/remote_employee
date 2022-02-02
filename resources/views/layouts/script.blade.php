        <!-- starting scripts -->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.mixitup.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
		<script src="{{ asset('assets/js/outdatedbrowser.min.js') }}"></script>        
		<script src="{{ asset('assets/js/myscript.js') }}"></script>
		<script src="{{ asset('assets/js/wow.min.js') }}"></script>
		<script src="{{ asset('assets/js/wowjava.js') }}"></script>
		<script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js">
		

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/multi-select/0.9.12/js/jquery.multi-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
new WOW().init();

        
        <!-- Initialize Swiper -->
//Open Modal for Employee and Employer in homepage with session
	function init(){
		var popup = '<?php echo Session("popup_type"); ?>';
		
		if(popup == 'quick_project'){
			$('#modal-quick-project').modal('show');
		}
		if(popup == 'full_or_part_project'){
			$('.parttime').css('top','0px');
		}
		$.ajax({
				type: "POST",
				url: "{{url('unset_popup_sessions')}}",
				data: { "_token": "{{ csrf_token() }}" }
			}); 
	}
		
// Signout Function
	function signOut() {		
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
			google.accounts.id.disableAutoSelect();
			GoogleAuth.signOut();
			gapi.auth.signOut();
			theUser.disconnect();
			location.reload();
		});

	}
			
// Google After SignIn Function
	function onSignIn(googleUser) {
		gapi.load('auth2', function() {
			  var profile = googleUser.getBasicProfile();
	  var gprofileid = profile.getId(); // Do not send to your backend! Use an ID token instead.
	  var gname = profile.getName();
	  var gimage = profile.getImageUrl();
	  var gemail = profile.getEmail(); // This is null if the 'email' scope is not present.
	  //alert('calling signin_using_google_popup');
	  var token = $('meta[name="csrf-token"]').attr('content');
	  $.ajax({
			type: "POST",
			url: "{{url('signin_using_google_popup')}}",
			data: { "_token": token , gprofileid:gprofileid, gname:gname , gimage:gimage, gemail:gemail},
			success: function( data ) {
				//var result = JSON.parse(data.success);
				//console.log(data.user_type);
				if(data.user_type == 'employer'){
					window.location.href = "{{url('employerdashboard')}}";
				} else if(data.user_type == 'employee'){
					window.location.href = "{{url('dashboard')}}";
				} else {
					//location.reload();
					$('#submit_quick_project').prop('disabled', false);
					$('#submit_full_project_disable').prop('disabled', false);
					$('#submit_quick_project_disable').prop('disabled', false);
					$('#modal-login').modal('hide');
					$('.linkedin_login').hide();
					$('#social_linkindin_login_quick').hide();
					$('#social_linkindin_login_full_n_part').hide();
					$('.login_modal_pop_btn').hide();
					$('.reg_modal_pop_btn').hide();				
					}
				}
			});
		});
	}
			
// Quick Job post using LinkedIn			
	$("#social_linkindin_login_quick").click(function(){
		var popup = 'quick_project';
		var quick_project_desc = $('#quick_project_desc').val();
		var quick_min_budget = $('#quick_min_budget').val();
		var quick_max_budget = $('#quick_max_budget').val();
		var quick_currency = $('#quick_currency').val();		
		$.ajax({
			type: "post",
			data: { "_token": "{{ csrf_token() }}" , popup:popup, quick_project_desc:quick_project_desc , quick_min_budget:quick_min_budget, quick_max_budget:quick_max_budget, quick_currency:quick_currency},
			url: "{{url('setsession_for_popups')}}",
			success: function( data ) {
				var result = JSON.parse(data.success);
				//alert(result);
				if(result == 1){
					window.location.href = "{{url('auth/linkedin/redirect')}}";							
				} 
				if(result == 2){
					alert('failed');
				}
			}
		});
	});
			
// Fulltime / PartTime Job post using LinkedIn
	$("#social_linkindin_login_full_n_part").click(function(){
		var popup = 'full_or_part_project';
		var fulltime_job_headline = $('#fulltime_job_headline').val();
		var fulltime_job_skills = $('#fulltime_job_skills').val();
		var fulltime_job_extra_skill = $('#fulltime_job_extra_skill').val();
		var fulltime_job_min = $('#fulltime_job_min').val();
		var fulltime_job_max = $('#fulltime_job_max').val();
		var fulltime_job_currency_minmax = $('#fulltime_job_currency_minmax').val();
		var fulltime_job_budget = $('#fulltime_job_budget').val();
		var fulltime_project_budget_currency = $('#fulltime_project_budget_currency').val();
		var fulltime_job_desc_minmax = $('#fulltime_job_desc_minmax').val();
		var fulltime_job_desc_budget = $('#fulltime_job_desc_budget').val();
		
		$.ajax({
			type: "post",
			data: { "_token": "{{ csrf_token() }}" , popup:popup, fulltime_job_headline:fulltime_job_headline , fulltime_job_skills:fulltime_job_skills, fulltime_job_extra_skill:fulltime_job_extra_skill, fulltime_job_min:fulltime_job_min, fulltime_job_max:fulltime_job_max, fulltime_job_currency_minmax:fulltime_job_currency_minmax, fulltime_job_budget:fulltime_job_budget, fulltime_project_budget_currency:fulltime_project_budget_currency, fulltime_job_desc_minmax:fulltime_job_desc_minmax, fulltime_job_desc_budget:fulltime_job_desc_budget, },
			url: "{{url('setsession_for_popups')}}",
			success: function( data ) {
				var result = JSON.parse(data.success);
				//alert(result);
				if(result == 1){
					window.location.href = "{{url('auth/linkedin/redirect')}}";							
				}
			}

		});
		
		
	});
			
// Submit FullProject for Employer
	$("#submit_full_project_disable").click(function(){
			var fulltime_job_headline = $('#fulltime_job_headline').val();
			var fulltime_job_skills = $('#fulltime_job_skills').val();
			var fulltime_job_extra_skill = $('#fulltime_job_extra_skill').val();
			var fulltime_job_min = $('#fulltime_job_min').val();
			var fulltime_job_max = $('#fulltime_job_max').val();
			var fulltime_job_currency_minmax = $('#fulltime_job_currency_minmax').val();
			var fulltime_job_budget = $('#fulltime_job_budget').val();
			var fulltime_project_budget_currency = $('#fulltime_project_budget_currency').val();
			var fulltime_job_desc_minmax = $('#fulltime_job_desc_minmax').val();
			var fulltime_job_desc_budget = $('#fulltime_job_desc_budget').val();
			
			$.ajax({
				type: "post",
				data: { "_token": "{{ csrf_token() }}" , fulltime_job_headline:fulltime_job_headline , fulltime_job_skills:fulltime_job_skills, fulltime_job_extra_skill:fulltime_job_extra_skill, fulltime_job_min:fulltime_job_min, fulltime_job_max:fulltime_job_max, fulltime_job_currency_minmax:fulltime_job_currency_minmax, fulltime_job_budget:fulltime_job_budget, fulltime_project_budget_currency:fulltime_project_budget_currency, fulltime_job_desc_minmax:fulltime_job_desc_minmax, fulltime_job_desc_budget:fulltime_job_desc_budget, },
				url: "{{url('submit_full_project')}}",
				success: function( data ) {
					var result = JSON.parse(data.success);
					//alert(result);
					if(result == 1){
						//alert('Job posted Successfully');
						window.location.href = "{{url('employerdashboard')}}";						
					}
				}

			});
			
			
		});
			
// LinkedIn button Redirect
	$("#linkedin_btn").click(function(){
		
		var quick_project_desc = $('#quick_project_desc').val();
		var quick_min_budget = $('#quick_min_budget').val();
		var quick_max_budget = $('#quick_max_budget').val();
		var quick_currency = $('#quick_currency').val();
		var accessToken='{{csrf_token()}}';
		$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'Access-Control-Allow-Origin': '*', 'Access-Control-Allow-Credentials': false } });
		$.ajax({
			type: "get",
			url: "{{url('auth/linkedin/redirect')}}",
			success: function( data ) {
				var result = JSON.parse(data.success);
				//alert(result);
				if(result == 1){
					alert(quick_project_desc);
					alert(quick_min_budget);
					alert(quick_max_budget);
					alert(quick_currency);
				} 
				if(result == 2){
					alert('failed');
				}
			}

		});
	});
			
// Next Button for PopUp
	var swiper = new Swiper('.swiper-container', {
		pagination: {
			el: '.swiper-pagination',
			type: 'progressbar',
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
			
			
// Prevent from posting Past dates(Job Post- New)
	var dtToday = new Date();
	var month = dtToday.getMonth() + 1;
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();
	if(month < 10)
	month = '0' + month.toString();
	if(day < 10)
	day = '0' + day.toString();
	var maxDate = year + '-' + month + '-' + day;
	$('#job_deadline').attr('min', maxDate);
			
			
// User Image Upload
	$( "#user_image" ).change(function() {	
		var ext = $('#user_image').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			alert('Invalid File formarmat. Only GIF/PNG/JPG/JPEG Allowed.');
			return false;
		}
			var hidden_uid = $('#hidden_uid').val();
			var CSRF_TOKEN = "{{ csrf_token() }}";
			var files = $('#user_image')[0].files;
			var fd = new FormData();
			if(files.length > 0){		
				fd.append('user_image',files[0]);	
			}	
				fd.append('_token',CSRF_TOKEN);
				fd.append('hidden_uid',hidden_uid);				
			 $.ajax({
				type: "POST",
				url: "{{url('update_profile_img')}}",
				data: fd,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function( msg ) {
				   // console.log( msg );
					$('#user_image_preview').attr('src',msg);
					$('#user_image').val('');
				}
			});
		});
		
// JobPost Modal in Employer-Dashboard
	function open_jobpost_popup(){
		$('#modal-employer').modal('show');
	}
	
// Employer assign Employee to a JobPost
	$('.employeeavailable_assign').on('change', function() {
		var empid = this.value;
		var fullid = $(this).attr('id');		
		jobid = fullid.replace('employeeavailable_assign-','');
		
		 $.ajax({
				type: "post",
				data: { "_token": "{{ csrf_token() }}" , empid:empid , jobid:jobid },
				url: "{{url('assign_job_to_emp')}}",
				success: function( data ) {
					var result = JSON.parse(data.success);
					//alert(result);
					if(result == 1){
						//alert('Job posted Successfully');
						window.location.href = "{{url('employerdashboard')}}";						
					}
				}

			});
	});

// Employer Job delete confirm Button by SWEAT-Alert	
	function reply_click(jobid){
		event.preventDefault(); // prevent form submit
		var form = event.target.form; // storing the form
				swal({
				  title: "Are you sure to delete this JOB?",
				  text: "This job will be removed from Database",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, Delete it  !",
				  cancelButtonText: "No, Don't Delete  !",		  
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
		function(isConfirm){
		  if (isConfirm) {
			$.ajax({
					type: "post",
					data: { "_token": "{{ csrf_token() }}" , jobid:jobid},
					url: "{{url('delete_job')}}",
					success: function( data ) {
						var result = JSON.parse(data.success);
						//alert(result);
						if(result == 1){
							//alert('Job posted Successfully');
							window.location.href = "{{url('employerdashboard')}}";						
						}
					}

				});
		  } else {
			swal("Cancelled", "This Job is safe now. :)", "error");
		  }
		});
		
	}
	
	
	
// Employer Job post Budget & MinMax blank initialize on changing tabs	
	$( "#hourly_rate_radio" ).click(function() {
		setTimeout(CheckEmpBudgetOrMinmax(), 5000); 
	});
	$( "#project_budget_radio" ).click(function() {
		setTimeout(CheckEmpBudgetOrMinmax(), 5000);
	});	
	function CheckEmpBudgetOrMinmax(){
		var hourly_radio_class = $('#hourly_rate_radio').attr('class');
		var budget_radio_class = $('#project_budget_radio').attr('class');
		
		if(budget_radio_class == 'selected'){
			$('#fulltime_job_budget').val('');
			$('#fulltime_job_desc_budget').val('');			
		}
		if(hourly_radio_class == 'selected'){
			
			$('#fulltime_job_min').val('');		
			$('#fulltime_job_max').val('');				
			$('#fulltime_job_desc_minmax').val('');
		}
	}

// Employer Job post Min - Max field validation	
$('#fulltime_job_min').change(function() {
	var minrate = $('#fulltime_job_min').val();
	var maxrate = parseInt(minrate) + 1;
	$('#fulltime_job_max').attr({
       "min" : maxrate
    });
});
	
//Show Comment in full sidebar Employer
	function show_comment_on_click(commentid){
		event.preventDefault();
		$('.comment-show-hide-div').hide();
		$('#comment-'+commentid).show();		
	}

//Show Jobs in full sidebar Employer
	function show_job_on_click(commentid){
		event.preventDefault();
		$('.job-show-hide-div').hide();
		$('#job-'+commentid).show();		
	}
	

// Landing page Employee modal next disabled - step 1
$('#emp_name').keyup(function() {
CheckNameNEmail();
});
$('#emp_email').keyup(function() {
CheckNameNEmail();
});
function CheckNameNEmail(){
	var emp_name = $('#emp_name').val();
	var emp_email = $('#emp_email').val();
	if(emp_email != '' && emp_name != ''){
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(regex.test(emp_email)) {
		$('#emp_email').css('border-color', '');
		$('#emp_form1_next').css('pointer-events', '');
		$('#emp_form1_next').css('opacity', '1');
	  }  else {
		$('#emp_email').css('border-color', 'red');
		$('#emp_form1_next').css('pointer-events', 'none');
		$('#emp_form1_next').css('opacity', '0.35');
		}
	}
}

// Landing page Employee modal next disabled - step 2
$('#emp_skills').change(function() {
	CheckSkills();
});
$('#emp_extra_skills').keyup(function() {
	CheckSkills();
});
function CheckSkills(){
	var emp_skills = $('#emp_skills').val();	
	var emp_extra_skills = $('#emp_extra_skills').val();	
	if(emp_skills == '' && emp_extra_skills == ''){
		$('#emp_skills').css('border-color', 'red');
		$('#emp_extra_skills').css('border-color', 'red');
		$('#emp_form2_next').css('pointer-events', 'none');
		$('#emp_form2_next').css('opacity', '0.35');
	} else {
		$('#emp_skills').css('border-color', '');
		$('#emp_extra_skills').css('border-color', '');
		$('#emp_form2_next').css('pointer-events', '');
		$('#emp_form2_next').css('opacity', '1');
	}
}

// Landing page Employee modal next disabled - step 2
$('.otps').on('input', function() {
	ChecksOtps();
});
function ChecksOtps(){
	var otp1 = $('#otp1').val();	
	var otp2 = $('#otp2').val();	
	var otp3 = $('#otp3').val();	
	var otp4 = $('#otp4').val();	
	var otp5 = $('#otp5').val();		
	if(otp1 != '' && otp2 != '' && otp3 != '' && otp4 != '' && otp5 != ''){
		$('#emp_verify_btn').css('pointer-events', '');
		$('#emp_verify_btn').css('opacity', '1');
	}
}

// Otp Next field on focus
$('.otps').keyup(function(){
        if($(this).val().length==$(this).attr("maxlength")){
            $(this).parent().next().find('.otps').focus();  
        }
    });
	
var i = 1;

// Employer Job Post Validation

	$( "#fulltime_job_headline" ).keyup(function() {
		var fulltime_job_headline = $('#fulltime_job_headline').val();
		if( fulltime_job_headline == ''){
			$('#fulltime_job_headline').css('border-color', 'red');
			$('.swiper-button-next').css('pointer-events', 'none');
			$('.swiper-button-next').css('opacity', '0.35');
		} else {
			$('#fulltime_job_headline').css('border-color', '');
			$('.swiper-button-next').css('pointer-events', '');
			$('.swiper-button-next').css('opacity', '1');
		}
	});
	
	$(".swiper-button-next").click(function() {
		$('.swiper-button-next').css('pointer-events', 'none');
		$('.swiper-button-next').css('opacity', '0.35');
	});
	$(".swiper-button-prev").click(function() {
		$('.swiper-button-next').css('pointer-events', '');
		$('.swiper-button-next').css('opacity', '1');
	});
	$('#fulltime_job_skills').change(function() {
		CheckSkillEmployerPost()
	});
	
	$( "#fulltime_job_extra_skill" ).keyup(function() {
		CheckSkillEmployerPost();
	});
	
	function CheckSkillEmployerPost(){
		var fulltime_job_skills = $('#fulltime_job_skills').val();
		var fulltime_job_extra_skill = $( "#fulltime_job_extra_skill" ).val();
		if(fulltime_job_skills != '' || fulltime_job_extra_skill != ''){
			$('#fulltime_job_headline').css('border-color', '');
			$('.swiper-button-next').css('pointer-events', '');
			$('.swiper-button-next').css('opacity', '1');
		} else {
			$('#fulltime_job_headline').css('border-color', 'red');
			$('.swiper-button-next').css('pointer-events', 'none');
			$('.swiper-button-next').css('opacity', '0.35');
		}
	}
	
	$( "#fulltime_job_min" ).on('input', function(){
		var minrate = $('#fulltime_job_min').val();
		var maxrate = parseInt(minrate) + 1;
		$( "#fulltime_job_max" ).val('');

		$('#fulltime_job_max').attr({"min" : maxrate});
		CheckMinMaxOrBudget();
	});
	$( "#fulltime_job_max" ).on('input', function() {
		var maxrate = $( "#fulltime_job_max" ).val();
		
		//alert('maxrate' + maxrate);
		
			CheckMinMaxOrBudget();
	});
	$( "#fulltime_job_budget" ).keyup(function() {
		CheckMinMaxOrBudget();
	});
	function CheckMinMaxOrBudget(){
		var fulltime_job_min = $('#fulltime_job_min').val();
		var fulltime_job_max = $( "#fulltime_job_max" ).val();
		var fulltime_job_budget = $( "#fulltime_job_budget" ).val();
		if(fulltime_job_min == "" && fulltime_job_max == "" && fulltime_job_budget == ""){
			$('#fulltime_job_min').css('border-color', 'red');
			$('#fulltime_job_max').css('border-color', 'red');
			$('#fulltime_job_budget').css('border-color', 'red');
			$('.swiper-button-next').css('pointer-events', 'none');
			$('.swiper-button-next').css('opacity', '0.35');
		} else if (fulltime_job_min != "" && fulltime_job_max != "" && fulltime_job_budget == ""){
			//alert(parseInt(fulltime_job_max));
			if(parseInt(fulltime_job_max) >= parseInt(fulltime_job_min)){
				$('#fulltime_job_min').css('border-color', '');
				$('#fulltime_job_max').css('border-color', '');
				$('#fulltime_job_budget').css('border-color', '');
				$('.swiper-button-next').css('pointer-events', '');
				$('.swiper-button-next').css('opacity', '1');
			} else {
				$('#fulltime_job_min').css('border-color', 'red');
				$('#fulltime_job_max').css('border-color', 'red');
				$('#fulltime_job_budget').css('border-color', 'red');
				$('.swiper-button-next').css('pointer-events', 'none');
				$('.swiper-button-next').css('opacity', '0.35');
			}			
			
		} else if (fulltime_job_min == "" && fulltime_job_max == "" && fulltime_job_budget != ""){
			$('#fulltime_job_min').css('border-color', '');
			$('#fulltime_job_max').css('border-color', '');
			$('#fulltime_job_budget').css('border-color', '');
			$('.swiper-button-next').css('pointer-events', '');
			$('.swiper-button-next').css('opacity', '1');
		}	
	}
	$("#hourly_rate_radio").click(function() {
		$('#fulltime_job_min').css('border-color', 'red');
		$('#fulltime_job_max').css('border-color', 'red');
		$('#fulltime_job_budget').css('border-color', 'red');
		$('.swiper-button-next').css('pointer-events', 'none');
		$('.swiper-button-next').css('opacity', '0.35');
	});
	$("#project_budget_radio").click(function() {
		$('#fulltime_job_min').css('border-color', 'red');
		$('#fulltime_job_max').css('border-color', 'red');
		$('#fulltime_job_budget').css('border-color', 'red');
		$('.swiper-button-next').css('pointer-events', 'none');
		$('.swiper-button-next').css('opacity', '0.35');		
	});
	
// Employee Profile page add more skill div on-off toggle button
$('#toggle_skill_onoff_btn').change(function() {
check = $("#toggle_skill_onoff_btn").is(":checked");
    if(check) {
        $('.toggle_skill_onoff_div').show();
		 $("#my_skills").attr('required',true);
    } else {
		$("#my_skills").val([]);
		$('.toggle_skill_onoff_div').hide();
		 $("#my_skills").attr('required',false);
    }
});

// Login Validation before Submit
	$( "#login_button_for_validation" ).click(function() {
		event.preventDefault();
		$('#login_email').css('border-color', '');
		$('#login_email').removeClass("shakeing");
		$('#login_password').css('border-color', '');
		$('#login_password').removeClass("shakeing");
		var email = $('#login_email').val();
		var password = $('#login_password').val();
		$.ajax({
				type: "post",
				data: { "_token": "{{ csrf_token() }}" , email:email , password:password },
				url: "{{url('check_login_before_submit')}}",
				success: function( data ) {
					var result = JSON.parse(data.success);					
					if(result == 0){
						$('#login_password').css('border-color', 'red');
						$( '#login_password' ).addClass( "shakeing" );											
					} else if (result == 1){
						$("#login_popup_form").submit();
					}else if (result == 2){
						$('#login_email').css('border-color', 'red');
						$( '#login_email' ).addClass( "shakeing" );
					}
				}

			});
	});
	
// Registration Validation before Submit	
	$( "#reg_button_for_validation" ).click(function() {
		event.preventDefault();
		$('#name').css('border-color', '');
		$('#email').css('border-color', '');
		$('#password').css('border-color', '');
		$('#password-confirm').css('border-color', '');
		
		$('#name').removeClass("shakeing");		
		$('#email').removeClass("shakeing");		
		$('#password').removeClass("shakeing");		
		$('#password-confirm').removeClass("shakeing");
		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		var repassword = $('#password-confirm').val();
		if(name != '' && email != '' && password != '' && repassword != ''){
			if (password === repassword){
				$("#reg_popup_form").submit();
			} else {
				$('#password').css('border-color', 'red');
				$( '#password' ).addClass( "shakeing" );
				$('#password-confirm').css('border-color', 'red');
				$( '#password-confirm' ).addClass( "shakeing" );
			}
		} else {
			if(name == ''){
				$('#name').css('border-color', 'red');
				$( '#name' ).addClass( "shakeing" );
			}
			if(email == ''){
				$('#email').css('border-color', 'red');
				$( '#email' ).addClass( "shakeing" );
			}
			if(password == ''){
				$('#password').css('border-color', 'red');
				$( '#password' ).addClass( "shakeing" );
			}
			if(repassword == ''){
				$('#password-confirm').css('border-color', 'red');
				$( '#password-confirm' ).addClass( "shakeing" );
			}
		}
	});
	

// Change or Update project status for employer
$('.change_status').change(function(){
	
	var projectid = $(this).closest("div").find("input[name='project_id']").val();
	var newstatus = $(this).val();
  //console.log('newstatus = ' + newstatus + ' , projectid = ' +projectid);
  
  $.ajax({
		type: "post",
		data: { "_token": "{{ csrf_token() }}" , projectid:projectid , newstatus:newstatus },
		url: "{{url('change_project_status')}}",
		success: function( data ) {
				var result = JSON.parse(data.success);
				if(result == 1){
						swal({
							title: "Congratulation",
							text: "You have sucessfully updated Proect Status!",
							type: "success",
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'ok!'
						},function(){
							window.location.reload();
						});
							
						
					}
					
		}

	});
});

// Generate Invoice for completed Project
	function generate_invoice(jobid){
		event.preventDefault(); // prevent form submit
		//var form = event.target.form; // storing the form
		swal({
			  title: "Generate Invoice for this job?",
			  text: "Invoice will be attached to this job.",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, Generate!",
			  cancelButtonText: "No, I dont need it!",
			  closeOnConfirm: true,
			  closeOnCancel: true
			},
		function(isConfirm){
		  if (isConfirm) {
			$.ajax({
					type: "post",
					data: { "_token": "{{ csrf_token() }}" , jobid:jobid},
					url: "{{url('invoice_generate_for_completed_projects')}}",
					success: function( data ) {
						var result = JSON.parse(data.success);
						//alert(result);
						if(result == 1){
							swal({
								title: "Invoice Sent to email ID",
								text: "Invoice will be attached to this job.",
								type: "success"
								});					
						}
					}

				});
		  } else {
			swal("Cancelled", "Invoice Generation TERMINATED :X", "error");
		  }
		});		
	}
	
	function show_invoice_only(jobid){
		$.ajax({
				type: "post",
				data: { "_token": "{{ csrf_token() }}" , jobid:jobid},
				url: "{{url('show_invoice_only')}}",
				success: function( data ) {
						$('#show_invoice_popup_img').attr("src",data);
						$('.show_invoice_popup').modal('show');
				}		
			});
	}
	
</script>
        
        <!-- End scripts -->
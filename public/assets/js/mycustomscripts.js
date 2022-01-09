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
	  $.ajax({
			type: "POST",
			url: "{{url('signin_using_google_popup')}}",
			data: { "_token": "{{ csrf_token() }}" , gprofileid:gprofileid, gname:gname , gimage:gimage, gemail:gemail},
			success: function( data ) {
				var result = JSON.parse(data.success);
				//alert(result);
				if(result == 1){
					$('#submit_quick_project').prop('disabled', false);
					$('#submit_full_project_disable').prop('disabled', false);
					$('#submit_quick_project_disable').prop('disabled', false);
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
						window.location.href = "{{url('dashboard')}}";						
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
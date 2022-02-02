<!DOCTYPE html>

<html>

<head>

	

</head>

<body>
	
Date: {{now()->format('d-m-Y')}}
	<h4>Hi, {{$requesteduser->name}}</h4>
	
	This job was assigned to {{$getempbyid->user->name}}. From {{$getjobbyid->created_at->format('d-m-Y')}} - {{$getjobbyid->updated_at->format('d-m-Y')}}<br>
	
	Job Name: {{$getjobbyid->job_title}}<br>
	Min Rate: {{$getjobbyid->hourly_rate_min}}<br>
	Max Rate: {{$getjobbyid->hourly_rate_max}}

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

</body>

</html>
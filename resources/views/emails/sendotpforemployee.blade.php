<!DOCTYPE html>
<html>
<head>
    <title>Remote Employee OTP Verification</title>
</head>
<body>
    <b>{{ $details['title'] }}</b>
    <p>Dear {{ $details['title'] }}, <br>
		&nbsp; Thank you for Logging in Remote Employee. <br>
		You are trying to logging in Remote Employee, For this you first need to verify your email ID. Please provide the OTP to login as Verified user.
	</p>	
	<h4 class="text-center">{{ $details['otp'] }}</h4>
   
    <p>Thank you</p>
</body>
</html>
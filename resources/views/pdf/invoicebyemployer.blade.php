<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="text-align:left;margin: auto;font-family: Arial, Helvetica, sans-serif;">
        <tr>
            <td align="center" valign="top">
                <table border="1" cellpadding="20" cellspacing="0" style="width:100%;">
                    <tr>
                        <td align="center" valign="top">
                            <!--<img src="{{URL::asset('assets/images/main-logo.png')}}" style="max-width: 110px;display:table-cell;" />-->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td  valign="top">
                <table border="0" cellpadding="20" cellspacing="0" style="width:100%;">
                    <tr>
                        <td colspan="2"  valign="top" style="font-size:14px;line-height:18px;">
                            <p>Dear <strong>{{$requesteduser->name}}</strong>,</p>
                            <p>Thank you for your continued partnership with Remote Employee.</p>
                            <p>We have submitted an ACH Request for the last billing period. For your convenience, we have included a 
                                copy of the charges involved. Detailed transaction & reconciliation reports can be accessed from your 
                                YouNegotiate account.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td  valign="top">
                <table border="1" cellpadding="15" cellspacing="0" style="width:100%;">
                    <tr>
                        <td>
                            <table border="0" cellpadding="10" cellspacing="0" style="width:100%;font-size:14px;line-height:18px;">
                                <tr style="background:#e0e0e0">
                                    <th>Invoice#</th>
                                    <th>Billing Period</th>
                                    <th>Invoice Date</th>
                                </tr>
                                <tr>
                                    <td>{{$requesteduser->name}}</td>
                                    <td>{{$getjobbyid->created_at->format('d-m-Y')}} to {{$getjobbyid->updated_at->format('d-m-Y')}}</td>
                                    <td>{{now()->format('d-m-Y')}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="1" cellpadding="10" cellspacing="0" style="width:100%;font-size:14px;line-height:18px;">
                                <tr style="background:#e0e0e0">
                                    <th>Work Details</th>
                                    @if($getjobbyid->project_budget != null)
										<th colspan = "2">Budget </th>
									@else
										<th>Rate</th>
										<th>Time(In Hour)</th>
									@endif
									
                                    <th>Amount</th>
                                </tr>
<?php
	$totaltime = 0;
	$hourly_rate_max = $getjobbyid->hourly_rate_max;
	$hourly_rate = explode(' ', $hourly_rate_max);
?>
@if(isset($getjobupdatebyid))
	@foreach($getjobupdatebyid as $update)
			<?php 
				
				$totaltime = $totaltime + $update->jobupdate_time;
			?>
	@endforeach
@endif
                                @if($getjobbyid->project_budget != null)
									<tr>
										<td>{{$getjobbyid->job_title}}</td>
										<td colspan="2">Total Budget : {{$getjobbyid->project_budget}}</td>
										<td>{{$getjobbyid->project_budget}}</td>
									</tr>
									<tr>
										<td align="center" colspan="3"><strong>Total</strong></td>
										<td><strong>{{$getjobbyid->project_budget}}</strong></td>
									</tr>
								@else
									<tr>
										<td>{{$getjobbyid->job_title}}</td>
										<td>{{$getjobbyid->hourly_rate_max}}</td>
										<td>{{$totaltime}}</td>
										<td><?php echo $hourly_rate[0]*$totaltime.' '.$hourly_rate[1]; ?></td>
									</tr>
									<tr>
										<td align="center" colspan="3"><strong>Total</strong></td>
										<td><strong><?php echo $hourly_rate[0]*$totaltime.' '.$hourly_rate[1]; ?></strong></td>
									</tr>
								@endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="10" cellspacing="0" style="width:100%;font-size:14px;line-height:18px;">
                                <tr style="background:#e0e0e0">
                                    <th colspan="4" >Billing Details</th>
                                </tr>
                                <tr>
                                    <td valign="top" style="min-width:150px;"><strong>Company Name:</strong></td>
                                    <td valign="top">Remote Employee</td>
                                </tr>
                                <tr>
                                    <td valign="top" style="min-width:150px;"><strong>Customer:</strong></td>
                                    <td valign="top">{{$requesteduser->name}} | {{$requesteduser->email}} </td>
                                </tr>
							</table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="10" cellspacing="0" style="width:100%;font-size:14px;line-height:18px;">
                    <tr>
                        <td style="height:100px;">
                            <p style="margin: 0;line-height: 1.5;">
                                <strong>The Remote Employee</strong><br/>
                                <strong>Site:</strong> <a href="https://remoteemployees.com" style="text-decoration:none; color:#000" target="_blank">https://remoteemployees.com</a><br/>
                                <strong>Email:</strong> <a href="mailto:connect@remoteemployees.com"  style="text-decoration:none; color:#000"> connect@remoteemployees.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
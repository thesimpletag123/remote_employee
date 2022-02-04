<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="text-align:left;margin: auto;font-family: Arial, Helvetica, sans-serif;">
        <tr>
            <td align="center" valign="top">
                <table border="1" cellpadding="20" cellspacing="0" style="width:100%;">
                    <tr>
                        <td align="center" valign="top">
                            <!--<img src="{{URL::asset('assets/images/logo-icon.png')}}" style="max-width: 110px;display:table-cell;" />-->
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
                            <p>Thank you for your continued partnership with H2H Technologies.</p>
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
                                    <th>Rate</th>
                                    <th>Time(In Hour)</th>
                                    <th>Amount</th>
                                </tr>
                                <tr>
                                    <td>{{$getjobbyid->job_title}}</td>
                                    <td>{{$getjobbyid->hourly_rate_max}}</td>
                                    <td>2</td>
                                    <td>$2.63</td>
                                </tr>
								<tr>
                                    <td align="center" colspan="3"><strong>Total</strong></td>
                                    <td><strong>$2.63</strong></td>
                                </tr>
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
                                <strong>Site:</strong> <a href="https://h2htechnologies.com" style="text-decoration:none; color:#000" target="_blank">https://h2htechnologies.com</a><br/>
                                <strong>Email:</strong> <a href="mailto:connect@h2htechnologies.com"  style="text-decoration:none; color:#000"> connect@h2htechnologies.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
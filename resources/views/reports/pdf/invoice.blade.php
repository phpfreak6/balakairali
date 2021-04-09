<!DOCTYPE html>
<html>
<head>
	<style>
		html{
		width: 100%;
		height: 100%;
		padding: 0;
		margin: 0;
		}
		footer { position: fixed; left: 0px; bottom: -63px; right: 0px; height: 150px; }
	</style>
</head>
<body>
	<div style="margin:0 auto; max-width: 900px; font-family: futuraregular;">
		<table cellpadding="0" cellspacing="0" style="width:100%; margin:0 auto;background-color:#fff;">
			<tr style="background-color:#f3d77d;">
				<td style="width: 100%;  padding-right:40px;">
					<table style="margin:0 auto; width:100%; padding: 40px 10px 10px; ">
						<tr>
							<td style="padding-left:40px; vertical-align:top; width:270px;">
								<h3 style="line-height: 18px; font-size: 18px; letter-spacing: 0.8px; margin-bottom: 0px;">BALA KAIRALI<br/>Educational Association Inc.</h3>
								<p style="margin-top:4px;margin-bottom:0px; font-size: 13px;line-height: 20px;color: #000;font-family:futuraregular;">Gate 9, Monash St., Wentworthville Public school</p>
								<p style="margin-top:0px; margin-bottom:0px; font-size: 13px;line-height: 20px;color: #000;font-family:futuraregular;">Telephone: 0405 343251, 0419 408584</p>
								<p style="margin-top:0px; margin-bottom:0px;font-size: 13px;line-height: 20px;color: #000;font-family:futuraregular;">Email: <a href="#">admin@balakairali.org</a></p>
								<p style="margin-top:0px; margin-bottom:0px;font-size: 13px;line-height: 20px;color: #000;font-family:futuraregular;">Web: <a href="#">www.balakairali.org</a></p>
							</td>
							<td style="width:300px; text-align:right; vertical-align:top;">
								<img width="100" src="{{ asset('assets/images/logo.png') }}" />
								<p style="font-size:16px; margin-bottom: 2px;font-family:futuraregular;"><strong>ABN: 16 889 099 669</strong></p>
								<table width="160" style="padding-left:190px;">
									<tr>
										<td style="width: 100%; height: 5px; background: #f3d77d;"></td>
									</tr>
								</table>	
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%; height:60px"></td>
			</tr>
			<tr>
				<td style="width: 100%; ">
					<table style="width:80%; margin:0 auto;  padding: 0px; ">
						<tr>
							<td style="font-family:futuraregular; width:385px;">
								<h3 style="font-size: 45px;color: #5E2615;font-weight: 900;margin-bottom: 25px;font-family:futurabold;">Invoice</h3>
								<p style="font-size: 13px; margin: 6px 0px; color: #5A5959;">{{ $payment->user->student->parent_details['p1']['p1_first_name'] }} {{ $payment->user->student->parent_details['p1']['p1_last_name'] }}</p>
								<p style="font-size: 13px; margin: 6px 0px; color: #5A5959;">{{ $payment->user->address }}</p>
								<p style="font-size: 13px; margin: 6px 0px; color: #5A5959;">{{ $payment->user->suburb }}</p>
								<p style="font-size: 13px; margin: 6px 0px; color: #5A5959;">{{ $payment->user->state }}</p>	
							</td>
							<td style="font-family:futuraregular;text-align: right; vertical-align: top; width:300px;" >
								<p style="font-size: 13px; margin: 6px 0px;color: #5A5959;">DATE: {{  date('d-M-Y',strtotime($payment->created_at)) }}</p>
								<p style="font-family:futurabold; font-weight:700; font-size: 13px; margin: 6px 0px;color: #5A5959;">INVOICE NO: {{ $payment->invoice_number }}</p>
								<p style="font-size: 13px; margin: 6px 0px;color: #5A5959;">TERM: {{ $payment->quarter->name }}</p>
								<p style="font-size: 13px; margin: 6px 0px;color: #5A5959;">CLASS: {{ $payment->user->student->studentclasses->name }}</p>
								<p style="font-size: 13px; margin: 6px 0px;color: #5A5959;">STUDENT/S:
                                 @if($payment->invoice_type == 'family')
                                    
                                    @foreach($users as $user)
                                    	<br>
                                    	{{ $user->name }}

                                    @endforeach

                                 @else
                                       {{ $payment->user->name }}
                                 @endif
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%;">
					<table style="width:87%; margin:0 auto;  padding: 0px; ">
						<tr style="">
							<th style="width: 40%; text-align: left; padding: 14px 0px; letter-spacing: 0.8px; font-weight: 700;">DESCRIPTION</th>
							<th style="width: 20%; text-align: right; padding: 14px 0px; letter-spacing: 0.8px; font-weight: 700;">UNIT PRICE</th>
							<th style="width: 20%; text-align: center; padding: 14px 0px; letter-spacing: 0.8px; font-weight: 700;">QTY</th>
							<th style="width: 20%; text-align: right; padding: 14px 0px; letter-spacing: 0.8px; font-weight: 700;">AMOUNT</th>
						</tr> 
						<tr>
							<td style="vertical-align: top; width: 40%; text-align: left; padding: 6px 0px; font-size: 13px; line-height: 23px; color: #5A5959;font-family:futuraregular;">{{ $payment->invoice_detail->description }}</td>
							<td style="vertical-align: top; width: 20%; text-align: right; padding: 6px 0px; font-size: 13px; color: #5A5959;font-family:futuraregular;">${{ $payment->invoice_detail->unit_price }}</td>
							<td style="vertical-align: top; width: 20%; text-align: center; padding: 6px 0px; font-size: 13px; color: #5A5959;font-family:futuraregular;"> 1 </td>
							<td style="vertical-align: top; width: 20%; text-align: right; padding: 6px 0px; font-size: 13px; color: #5A5959;font-family:futuraregular;">${{ number_format((float) ($payment->invoice_detail->unit_price + $payment->invoice_detail->gst_percentage ), 2, '.', '') }}</td>
						</tr>
						<tr>
							<td colspan="4"  style="width: 100%; height:25px"></td>
						</tr>
						<tr>
							<td colspan="4" style="  background: #000; padding-right:40px;"></td>
						</tr>
						<tr>							
							<td colspan="4" style="padding-left: 346px;">
								<table width="260" style="margin:0 auto;  padding: 10px 0px; float: right; padding-left:430px; ">
									<tr>
										<td style="font-size: 15px; font-weight: 600;     width: 40%; text-align:right; letter-spacing: 0.8px; padding: 12px 0px;">SUBTOTAL</td>
										<td style="text-align: right;     width: 60%; font-size: 15px; padding: 12px 0px; color: #5A5959;font-family:futuraregular;">${{ $payment->invoice_detail->unit_price }}</td>
									</tr>
									<tr>
										<td style="font-size: 15px;  width: 40%; font-weight: 600; text-align:right; letter-spacing: 0.8px;">GST</td>
										<td style="text-align: right;     width: 60%; font-size: 15px; color: #5A5959;font-family:futuraregular; ">${{ number_format((float) ($payment->invoice_detail->gst_percentage ), 2, '.', '') }}</td>
									</tr>
									<tr>
										<td style="height:10px"></td>
									</tr>
									<tr>
										<td colspan="2" style="width: 60%; background: #5E2615;"></td>
									</tr>
									<tr>
										<td style="height:10px"></td>
									</tr>
									<tr>
										<td style="font-size: 22px;  width: 40%; font-weight: 600; text-align:right; letter-spacing: 0.8px; ">TOTAL</td>
										<td style="text-align: right;  width: 60%; font-weight: 600; font-size: 22px; letter-spacing: 0.8px;">${{ number_format((float) ($payment->invoice_detail->unit_price + $payment->invoice_detail->gst_percentage ), 2, '.', '') }}</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="width: 100%; height:140px"></td>
			</tr>
		</table>
		<footer>
		<div  style="width: 100%; text-align:center;padding-bottom: 8px;font-size: 18px;color: #5A5959;">
			<font style="font-family:futuraregular;">Thanks for the payment and your ongoing support</font>
		</div>
		<div  style="padding: 20px 20px 20px 20px; background-color:#5e2615; text-align:center;">
			<p style="width: 100%; font-size: 16px; color: #DEDEDE;letter-spacing: 0.8px; margin: 0;">
				<font style="font-family:futuraregular;">Bala Kairali is supported by NSW Department of Education</font>
			</p>
		</div>
	   </footer>
	</div>
</body>
</html>
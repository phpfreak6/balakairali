<!DOCTYPE html>

<html>

<head></head>

<body>

<div style="margin:0 auto;bordera: 1px solid #BDBDBD; max-width: 900px; font-family: Helvetica Neue,sans-serif;">

	<table style="margin:0 auto;border-spacing: 0;font-family: Helvetica Neue,sans-serif;" width="100%" cellspacing="0">

		<tr>

			<td colspan="6" style="text-align:center;padding-bottom: 10px;">			

				<p style="font-family: sans-serif; font-size: 18px; margin-bottom: 0px; margin-top: 0;"><strong>BALA KIARALI</strong></p>

				<!-- <p style="margin-top: 0px; margin-bottom: 0px; font-size: 12px;">Barrio Montevideo 7 Ave. 4 Calle</p>	 -->

				<!-- <p style="margin-top: 0px; margin-bottom: 0px; font-size: 12px;">Tel. 2617-1009</p>		   			 -->

			</td>	

		</tr>

	</table>



	<table style="margin:0 auto;border-spacing: 0;font-family: Helvetica Neue,sans-serif;" width="100%" cellspacing="0">

		<tr>

			<td colspan="7" style="border-top: 2px solid #000;height: 20px;text-align: center;padding-top: 5px;padding-bottom: 10px;font-size: 16px;"><strong>Student Progress Report</strong></td>

		</tr>

		<tr>

			<td colspan="2" style="font-size: 12px;text-align: left;padding: 0px 0px 4px 15px;">

				<span><strong>Student Name</strong> : {{ $student->first_name }}</span>

			</td>

			<td colspan="3" style="font-size: 12px;text-align: center;padding: 0px 0px 4px 15px;">

				<span><strong>Class</strong> : {{ $student->student->studentclasses->name }}</span>

			</td>

			

			<td colspan="2" style="font-size: 12px;text-align: right;padding: 0px 15px 4px 0px;">

				<span><strong>Centre</strong>: {{ $student->student->centres->name }}</span>

			</td>

		</tr>

		<tr>

			<td colspan="4" style="font-size: 12px;border-bottom: 1px solid #000;text-align: left;padding: 0px 0px 4px 15px;">

				<span><strong>Father Name</strong> : {{ $student->student->parent_details['p1']['p1_first_name'] }} {{ $student->student->parent_details['p1']['p1_last_name'] }}</span>

			</td>

			<!-- <td colspan="3" style="font-size: 12px;border-bottom: 1px solid #000;text-align: center;padding: 0px 0px 4px 15px;"> -->

				<!-- <span>Class : class</span> -->

			<!-- </td> -->

			

			<td colspan="3" style="font-size: 12px;border-bottom: 1px solid #000;text-align: right;padding: 0px 15px 4px 0px;">

				<span><strong>Term</strong>: {{ $term }}</span>

			</td>

		</tr>

		<tr>

			<td colspan="2" style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;padding: 4px 0px 4px 15px;">

				<span><strong>Test</strong></span>

			</td>		

			<td colspan="1" style="font-size: 14px;text-align: center;border-bottom: 1px solid #000;color: #891325;padding: 4px 0px 4px 0px;">

				<span><strong>Obtained mark</strong></span>

			</td>

			<td colspan="1" style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;text-align: center;padding: 4px 0px 4px 0px;">

				<span><strong>Total mark</strong></span>

			</td>

			<td colspan="2" style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;text-align: center;padding: 4px 0px 4px 0px;">

				<span><strong>Date</strong></span>

			</td>

			<td colspan="1" style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;text-align: center;padding: 4px 0px 4px 0px;">

				<span><strong>%</strong></span>

			</td>		

			<!-- <td style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;text-align: right;padding: 4px 0px 4px 0px;"> -->

				<!-- <span><strong>ISV</strong></span> -->

			<!-- </td> -->

			<!-- <td style="font-size: 14px;border-bottom: 1px solid #000;color: #891325;text-align: right;padding: 4px 15px 4px 0px;"> -->

				<!-- <span><strong>Total</strong></span> -->

			<!-- </td>		 -->

		</tr>

		@php

		$obtained = 0;

		$total = 0;

		@endphp

		@foreach($marks as $mark)

		<tr>

			<td colspan="2" style="font-size: 12px;padding: 4px 0px 4px 15px;">

				<span>{{ $mark->test }}</span>

			</td>		

			<td colspan="1" style="font-size: 12px;text-align: center;padding: 4px 0px 4px 0px;">

				<span>{{ $mark->obtained_marks }}</span>

			</td>

			<td colspan="1" style="font-size: 12px;text-align: center;padding: 4px 0px 4px 0px;">

				<span>{{ $mark->test_total_marks }}</span>

			</td>

			<td colspan="2" style="font-size: 12px;text-align: center;padding: 4px 0px 4px 0px;">

				<span>{{ $mark->date_of_test }}</span>

			</td>

			<td colspan="1" style="font-size: 12px;text-align: center;padding: 4px 0px 4px 0px;">

				<span>{{ sprintf ("%.2f",(($mark->obtained_marks/$mark->test_total_marks)*100)) }}%</span>

			</td>		

			<!-- <td style="font-size: 12px;text-align: right;padding: 4px 0px 4px 0px;"> -->

				<!-- <span>720.02</span> -->

			<!-- </td> -->

			<!-- <td style="font-size: 12px;padding: 4px 15px 4px 0px;text-align: right;"> -->

				<!-- <span>6,578.2</span> -->

			<!-- </td>		 -->

		</tr>

		@php

		$obtained+= $mark->obtained_marks;

		$total+= $mark->test_total_marks;

		@endphp

		@endforeach

		<tr>

			<td colspan="2" style="font-size: 12px;padding: 4px 0px 4px 15px;">

				<span></span>

			</td>		

			<td colspan="1" style="font-size: 12px;text-align: center;padding: 4px 0px 4px 0px;border-top: 1px solid #000;">

				<span><strong>{{ $obtained }}</strong></span>

			</td>

			<td colspan="1" style="font-size: 13px;text-align: center;padding: 4px 0px 4px 0px;border-top: 1px solid #000;">

				<span><strong>{{ $total }}</strong></span>

			</td>

			<td colspan="2" style="font-size: 13px;text-align: center;padding: 4px 0px 4px 0px;border-top: 1px solid #000;">

				<span></span>

			</td>		

			<td colspan="1" style="font-size: 13px;padding: 4px 0px 4px 0px;text-align: center;border-top: 1px solid #000;">

				<span><strong>{{ sprintf ("%.2f",(($obtained/$total)*100)) }}%</strong></span>

			</td>

		

		</tr>

	</table>

</div>

</body>

</html>


<div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
	<div class="widget-body">
		<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th>
							<i class="ace-icon fa fa-user"></i>
							Student
						</th>
						<th class="hidden-480">Status</th>
						<th class="hidden-480">Action</th>
					</tr>
				</thead>

				<tbody>
				  @foreach($students as $student)
				    <tr>
						<td class="">{{ $student->name }}</td>

						<td>
							<span class="label label-success status_login{{$student->id}}">{{ \App\Models\User::todaySigninSignoutStatus($student->id) }}</span>
						</td>

						<td class="hidden-480">
							<span class=" btn btn-primary btn-sm stdnt{{ $student->id }} student_action_btn" data-login="{{ $student->id }}">{{ loginOrLogout($student->id) }}</span>
						</td>
					</tr>
				  
				  @endforeach
				
			    </tbody>
		    </table>
	    </div>
	</div>
</div>


<div class="profile-user-info profile-user-info-striped">
	@php $x = 1; @endphp
    @foreach($students as $student)
		<div class="profile-info-row">
			<div class="profile-info-name"> {{$x}}. </div>

			<div class="profile-info-value">
				<span class="editable editable-click" id="username">{{ $student->user->name }}</span>
			</div>
		</div>
	@php $x++; @endphp
    @endforeach
</div>
<div class="space-20"></div>
<div class="widget-box transparent">
	<div class="widget-header widget-header-small">
		<h4 class="widget-title blue smaller">
			<i class="ace-icon fa fa-rss orange"></i>
			Un-Assign From
		</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main padding-8">
			<div class="row">

				<div class="col-md-8">
					<input type="text" id="another_parent_number" class="form-control" placeholder="Enter Mobile Number">
				</div>
				<div class="col-md-4">

					<button class="btn btn-primary btn-sm assign_btn">Un-Assign</button>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
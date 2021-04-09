
@extends('layouts/main')
@section('title')
 Profile Setting
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-6 col-sm-offset-3">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Profile</h4>
			</div>
            <form action="{{ route('admin.profile.update') }}" method="post">
            	@csrf
			<div class="widget-body">
				<div class="widget-main">
					<div>
						<label for="form-field-8">First Name</label>

						<input type="text" name="first_name" class="form-control " value="{{ auth()->user()->first_name }}" placeholder="First Name">
					</div>

					<hr>

					<div>
						<label for="form-field-8">Last Name</label>

						<input type="text" name="last_name" value="{{ auth()->user()->last_name }}" class="form-control" placeholder="Last Name">
					</div>

					<hr>

					<div>
						<label for="form-field-9">Email</label>

						<input type="text" name="email"  value="{{ auth()->user()->email }}" class="form-control" placeholder="Email">
					</div>

					<hr>

					<div>
						<button name="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			</div>
		</form>
		</div>
	</div><!-- /.span -->


</div>
@endsection
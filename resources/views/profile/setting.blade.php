@extends('layouts/main')
@section('title')
Change Password
@endsection
@section('content')
<div class="row">
	<div class="col-xs-12 col-sm-6 col-sm-offset-3">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Change Password</h4>
			</div>
            <form method="post" action="{{ route('admin.changePass') }}">
            	@csrf
			<div class="widget-body">
				<div class="widget-main">
					<div>
						<label for="form-field-8">Current Password</label>

						<input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password">
						@error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<hr>

					<div>
						<label for="form-field-9">New Password</label>

						<input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password">
						@error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
	
					</div>

					<hr>

					<div>
						<label for="form-field-11">Confirm New Password</label>

						<input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Conform New Password">
						@error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
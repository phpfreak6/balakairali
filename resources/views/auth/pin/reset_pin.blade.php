@extends('layouts.front')

@section('content')
   <style>
html, body.LoginPageBody {
  height: 100% !important;
}
</style>
	<section class="LoginPage">
      <div class="BackPage"><a href=""><i><img src="{{ asset('assets/images/front/BackArrow.svg') }}" alt=""></i> <span>Back </span></a></div>
      <div class="container LoginPageContent">
        <div class="row">
          <div class="col-md-12 d-flex justify-content-center align-items-center">
            <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
            <div class="FormDiv">
              <h2>Enter Pin</h2>
              @if ($errors->any())
			     @foreach ($errors->all() as $error)
			         <span class="invalid-feedback" style="display: block;" role="alert">{{$error}}</span>
			     @endforeach
			 @endif
              <form method="post" action="{{ route('resetPinPost',$token) }}">
              	@csrf
                <div class="InputDivWrap mb-5">
                  <div class="InputDiv">
                    <i><img src="{{ asset('assets/images/front/Lock.svg') }}" alt="" /></i>
                    <input type="password" class="form-control" name="new_pin" placeholder="Enter new pin" required="">
                  </div>
                  <div class="InputDiv mt-2">
                    <i><img src="{{ asset('assets/images/front/Lock.svg') }}" alt="" /></i>
                    <input type="password" class="form-control" name="confirm_pin" placeholder="Confirm new pin" required="">
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button type="submit" class="btn GreyBtn">Update</button>
                </div>

              </form>
            </div>
          </div>
          @include('partials.footer')
        </div>
      </div>
    </section>

@endsection
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
              <h2>Enter OTP</h2>
              <form method="post" action="{{ route('matchOtp',$token) }}">
                @csrf
                <div class="InputDivWrap mb-5">
                  <div class="InputDiv">
                    <i><img src="{{ asset('assets/images/front/User.svg') }}" alt="" /></i>
                    <input type="text" class="form-control" name="otp" placeholder="Enter OTP here..." required="">
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <button type="" class="btn GreyBtn">Reset</button>
                </div>

              </form>
            </div>
          </div>
          @include('partials.footer')
        </div>
      </div>
    </section>

@endsection
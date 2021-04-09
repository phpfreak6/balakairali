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
             <div class="card">
              <div class="card-body">
                <p class="card-text">We have sent an email to your email address. Click on the link to reset your password.</p>
              </div>
            </div>
            <div class="mt-3">
              <a href="{{ route('admin.login.form') }}" class="btn GreyBtn">Login</a>
            </div>
            
            </div>
          </div>
          @include('partials.footer')
        </div>
      </div>
    </section>

@endsection
@extends('layouts.front')

@section('content')
<style>
    html, body.LoginPageBody {
        height: 100% !important;
    }
</style>
<section class="LoginPage">
    <div class="BackPage">
        <a href="">
            <i>
                <img src="{{ asset('assets/images/front/BackArrow.svg') }}" alt="">
            </i>
            <span>Back </span>
        </a>
    </div>
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
                <div class="FormDiv">
                    <h2>Update Password</h2>
                    <form method="post" action="{{ route('admin.password.update',$token) }}">
                        @csrf
                        <div class="InputDivWrap">
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">

                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required="">
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
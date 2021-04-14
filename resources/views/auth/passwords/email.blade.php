@extends('layouts.front')

@section('content')
<style>
    html, body.LoginPageBody {
        height: 100% !important;
    }
</style>
<section class="LoginPage generate_otp">
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
                <div class="FormDiv">
                    <h2>Enter Your Email Address</h2>
                    <form method="post" action="{{ route('admin.reset') }}">
                        @csrf
                        <div class="InputDivWrap mb-5">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/User.svg') }}" alt="" /></i>
                                <input type="email" class="form-control" name="email" value="" placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn GreyBtn">Send Link</button>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?= url('login') ?>" class="btn btn-danger">Login</a>
                        </div>
                    </form>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</section>
@endsection
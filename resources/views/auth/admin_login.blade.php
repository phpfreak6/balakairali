@extends('layouts.front')
@section('content')
<style>
    html, body.LoginPageBody {
        height: 100% !important;
    }
</style>
<section class="LoginPage">
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
                <div class="FormDiv">
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <span class="invalid-feedback" style="display: block;" role="alert">{{$error}}</span>
                    @endforeach
                    @endif
                    <form method="post" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="InputDivWrap">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/User.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>
                        </div>
                        <div class="InputDivWrap">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Lock.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="password" name="password" class="form-control" placeholder="*  *  *  *  *  *  *  *">
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="" class="btn GreyBtn">Login</button>
                            <a href="{{ route('password.request') }}" class="ml-auto ForgotPassword">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</section>
<script type="text/javascript" language="javascript">
    $(function () {
        $(this).bind("contextmenu", function (e) {
            e.preventDefault();
        });
    });
</script>
@endsection
@extends('layouts.front')
@section('content')
<section class="LoginPage">
    <div class="BackPage">
        <a href="#" class="logout_btn">
            <i class="fas fa-sign-out-alt"></i> <span>Logout </span>
        </a>
    </div>
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo">
                    <img src="{{ asset('assets/images/front/Logo.png') }}" alt="" />
                </div>
                <div class="FormDiv">
                    <div class="InputDivWrap studentLogin ">
                        <div class="user_list mt-2">
                            @if(count($students) > 0)
                            <ul class="list-group">
                                @foreach($students as $student)
                                <li class="list-group-item">
                                    <span class="login_status{{ $student->id }}">{{ loginOrLogoutStatus($student->id) }}</span>{{ $student->name }}<span class="float-right stdnt{{ $student->id }} student_btn" data-login="{{ encryptID($student->id) }}">{{ loginOrLogout($student->id) }}</span></li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="sub_form_btn">
                        <button class="btn btn-default submit_btn_btn">Submit</button>
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</section>
<style>
    .login-color {
        color: green;
    }
    html,
    body.LoginPageBody {
        height: 100% !important;
    }
    .FormDiv form .ResetNow {
        margin-bottom: 6px;
    }
    .LoginPageBody .LoginPageContent {
        padding-top: 0px;
    }
    .list-group-item{
        margin-bottom:10px;
    }
    .sub_form_btn button {
        background: linear-gradient(45deg, #ea951c, #d73b32);
        border: none;
        color: #fff;
        transition: 0.3s ease-in-out;
        display: block;
        margin: 0 auto;
    }
    .sub_form_btn button:hover{
        background: linear-gradient(45deg, #d73b32, #ea951c);
    }
    .sub_form_btn button:focus{
        box-shadow:none !important;
    }
</style>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.student_btn', function () {
            var crypt_data = $(this).data('login');
            var content = $(this).text();
            $.ajax({
                type: 'POST',
                url: BASE_URL + '/student-login',
                data: {_token: AUTHENTICATION_TOKEN, 'crypt_data': crypt_data},
                success: function (response) {
                    if (response.status == 'time-bounded') {
                        toastr.options = {"closeButton": true};
                        toastr.warning(response.message);
                        return false;
                    }
                    if (response.status == 'logged-out') {
                        toastr.options = {"closeButton": true};
                        toastr.success('Student Signed Out Successfully');
                        $('.login_status' + response.id).html('Signed-out - ');
                    }
                    if (response.status == 'inactive') {
                        toastr.options = {"closeButton": true};
                        toastr.error('Selected student account is inactive. Please contact with centre.');
                        return false;
                    }
                    if (response.status == 'logout') {
                        toastr.options = {"closeButton": true};
                        toastr.error('Selected student is already logged out or not logged in for today!');
                        return false;
                    }
                    if (response.text == 'Sign-out') {
                        toastr.options = {"closeButton": true};
                        toastr.success('Student signed in successfully');
                        $('.login_status' + response.id).html('Signed-in - ');
                    }
                    $('.stdnt' + response.id).html(response.text);
                },
            });
        });

        $(document).on('click', '.logout_btn', function () {
            $('#logoutform').append('<input type="hidden" name="flash_message" value="Logged Out Successfully">');
            $('#logoutform').submit();
        });

        $(document).on('click', '.submit_btn_btn', function () {
            $('#logoutform').append('<input type="hidden" name="flash_message" value="Success">');
            $('#logoutform').submit();
        });
    });
</script>
@endsection
@extends('layouts.front')
@section('content')
<style>
    .login-color{
        color: green;
    }
    html, body.LoginPageBody {
        height: 100% !important;
    }
    .FormDiv form .ResetNow {
        margin-bottom: 6px;
    }
    .LoginPageBody .LoginPageContent {
        padding-top: 0px;
    }
</style>
<section class="LoginPage">
    <div class="BackPage">
        <a href="#" class="logout_btn">
            <i class="fas fa-sign-out-alt"></i> <span>Logout </span>
        </a>
    </div>
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
                <div class="FormDiv">
                    <h2>Student Sign In/Out</h2>
                    <form method="post" action="{{ route('slogin') }}">
                        @csrf
                        <div class="InputDivWrap studentLogin ">
                            <div class="input_show_hide" style="{{ (count($students) > 0) ? 'display: none' : '' }}">
                                <div class="InputDiv">
                                    <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                    <input type="password" class="form-control" name="pin" id="pin" placeholder="Enter Your 4-Digit PIN">
                                </div>
                                <span class="mobile_error"></span>
                            </div>
                            <div class="user_list mt-2">
                                @if(count($students) > 0)
                                <ul class="list-group">
                                    @foreach($students as $student)
                                    <li class="list-group-item"><span class="login_status{{ $student->id }}">{{ loginOrLogoutStatus($student->id) }}</span>{{ $student->name }}<span class="float-right stdnt{{ $student->id }} student_btn" data-login="{{ encryptID($student->id) }}">{{ loginOrLogout($student->id) }}</span></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="keypad_div" style="{{ (count($students) > 0) ? 'display: none' : '' }}">
                            <div class="Digit">
                                <ul>
                                    <li><div class="DigitBox hover-overlay" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '1';">1</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '2';">2</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '3';">3</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '4';">4</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '5';">5</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '6';">6</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '7';">7</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '8';">8</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '9';">9</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value.slice(0, -1);">DEL</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '0';">0</div></li>
                                    <li><div class="DigitBox" onclick="document.getElementById('number').value = ''">CLR</div></li>
                                </ul>
                            </div>
                            <div class="d-flex ResetNow">
                                @if(\App\Models\User::pinCreatedOrNot() == false)
                                <p>Don’t have a pin? <br/><a href="{{ route('createPin') }}">Create one</a></p>
                                @endif
                                <p class="ml-auto">Forgot pin? <br/><a href="{{ route('forgotPin') }}">Reset now</a></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="button" id="pinLogin" class="btn GreyBtn">Find Student/s</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/student/login.js') }}"></script>
@endsection
@extends('layouts.front')
@section('content')
<section class="LoginPage">
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo">
                    <img src="{{ asset('assets/images/front/Logo.png') }}" alt="" />
                </div>
                <div class="FormDiv">
                    <?= Form::open(['url' => url('/attemptParentLogin'), 'method' => 'POST']) ?>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                <input readonly name="phone_number" id="phone_number" type="text" class="form-control" value="<?= $parent_mobile_number ?>" placeholder="<?= $parent_mobile_number ?>">
                            </div>
                        </div>
                    </div>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="password" class="form-control" name="pin" id="pin" placeholder="Enter Your 4-Digit PIN" required>
                            </div>
                        </div>
                    </div>
                    <div class="keypad_div">
                        <div class="Digit">
                            <ul>
                                <li>
                                    <div class="DigitBox hover-overlay" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '1';">1</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '2';">2</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '3';">3</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '4';">4</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '5';">5</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '6';">6</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '7';">7</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '8';">8</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '9';">9</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value.slice(0, -1);">DEL</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('pin').value = document.getElementById('pin').value + '0';">0</div>
                                </li>
                                <li>
                                    <div class="DigitBox" onclick="document.getElementById('number').value = ''">CLR</div>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex ResetNow">
                            @if(\App\Models\User::pinCreatedOrNot($parent_mobile_number) == false)
                            <p>Don’t have a pin? <br><a href="{{ route('createPin') }}">Create one</a></p>
                            @endif
                            <p class="ml-auto">Forgot pin? <br /><a href="{{ route('forgotPin') }}">Reset now</a></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="submit" id="pinLogin" class="btn GreyBtn">Find Student/s</button>
                        </div>
                    </div>
                    </form>
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
</style>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/student/login.js') }}"></script>
@endsection
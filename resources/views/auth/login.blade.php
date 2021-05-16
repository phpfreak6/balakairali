@extends('layouts.front')
@section('content')
<?php
if (!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_USER'] != $auth['settings']['username'] || $_SERVER['PHP_AUTH_PW'] != $auth['settings']['password'])) {
    header('WWW-Authenticate: Basic stroberry="StroBerry"');
    header('HTTP/1.0 401 Unauthorized');
    echo '<h1>Access Denied!</h1>';
    exit;
}
?>
<section class="LoginPage">
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo">
                    <img src="{{ url('assets/images/front/Logo.png') }}">
                </div>
                <div class="FormDiv">
                    <?= Form::open(['id' => 'student_login_form', 'url' => 'validatePhoneNumber']) ?>
                    <?= Form::hidden('current_desktop_timestamp', '', ['id' => 'current_desktop_timestamp']) ?>
                    <div class="InputDivWrap studentLogin">
                        <div class="InputDiv">
                            <i><img src="{{ asset('assets/images/front/Mobile.svg') }}" alt=""></i>
                            <input autocomplete="off" type="text" class="form-control" name="mobile" id="number" placeholder="Enter Parent’s Mobile Number" required>
                        </div>
                        <span class="mobile_error text-danger"></span>
                    </div>
                    <div class="Digit">
                        <ul>
                            <li>
                                <div class="DigitBox hover-overlay" onclick="document.getElementById('number').value = document.getElementById('number').value + '1';">1</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '2';">2</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '3';">3</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '4';">4</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '5';">5</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '6';">6</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '7';">7</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '8';">8</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '9';">9</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value.slice(0, -1);">DEL</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '0';">0</div>
                            </li>
                            <li>
                                <div class="DigitBox" onclick="document.getElementById('number').value = ''">CLR</div>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="submit" id="parentMobile" class="btn GreyBtn">Submit</button>
                    </div>
                    <?= Form::close() ?>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</section>
<style>
    .LoginPage .row {
        position: unset;
    }
</style>
@endsection
@section('scripts')
<script>
    function fillTimeStamp() {
        $('#current_desktop_timestamp').val(+new Date());
    }
    $(document).ready(function() {
        setInterval(fillTimeStamp, 1000);
    });
</script>
@endsection
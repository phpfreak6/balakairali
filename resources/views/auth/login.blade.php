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
<style>
    .LoginPage .row {
        position: unset;
    }
 
</style>
<section class="LoginPage">
    <div class="container LoginPageContent">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <div class="LoginLogo">
                    <img src="{{ asset('assets/images/front/Logo.png') }}" alt="" />
                </div>
                <div class="FormDiv">
                    <h2>Student Sign In/Out</h2>
                    <form method="post" >
                        @csrf
                        <div class="InputDivWrap studentLogin">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Mobile.svg') }}" alt="" /></i>
                                <input type="number" class="form-control" name="mobile" id="number" placeholder="Enter Parent’s Mobile Number">
                            </div>
                            <span class="mobile_error"></span>
                        </div>
                        <div class="Digit">
                            <ul>
                                <li><div class="DigitBox hover-overlay" onclick="document.getElementById('number').value = document.getElementById('number').value + '1';">1</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '2';">2</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '3';">3</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '4';">4</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '5';">5</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '6';">6</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '7';">7</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '8';">8</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '9';">9</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value.slice(0, -1);">DEL</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = document.getElementById('number').value + '0';">0</div></li>
                                <li><div class="DigitBox" onclick="document.getElementById('number').value = ''">CLR</div></li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center">
                            <button type="button" id="parentMobile" class="btn GreyBtn">Submit</button>
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
<script>
</script>
@endsection
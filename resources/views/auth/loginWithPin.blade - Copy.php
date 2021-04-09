@extends('layouts.front')

@section('content')

 <section class="LoginPage">
      <div class="BackPage"><a href="#"><i><img src="{{ asset('assets/images/front/BackArrow.svg') }}" alt=""></i> <span>Back </span></a></div>
      <div class="container LoginPageContent">
        <div class="row">
          <div class="col-md-12 d-flex justify-content-center align-items-center">
            <div class="LoginLogo"><img src="{{ asset('assets/images/front/Logo.png') }}" alt="" /></div>
            <div class="FormDiv">
              <h2>Studnet Sign In/Out</h2>
              <form method="post" action="{{ route('slogin') }}">
              	@csrf
              	<div class="div_one" >
              	<div class="InputDivWrap studentLogin">
                  <div class="InputDiv">
                    <i><img src="{{ asset('assets/images/front/Mobile.svg') }}" alt="" /></i>
                    <input type="text" class="form-control" name="mobile" id="number" placeholder="Enter Parent’s Mobile Number" readonly="">
                   </div>
                   
                </div>
                <span class="mobile_error"></span>
                <div class="Digit">
                  <ul>
                    <li><div class="DigitBox hover-overlay" onclick="document.getElementById('number').value=document.getElementById('number').value + '1';">1</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '2';">2</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '3';">3</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '4';">4</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '5';">5</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '6';">6</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '7';">7</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '8';">8</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '9';">9</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value.slice(0, -1);">&times;</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('number').value=document.getElementById('number').value + '0';">0</div></li>
                    <li><div class="DigitBox">&rarr;</div></li>
                  </ul>
                </div>
                <div class="d-flex align-items-center">
                  <button type="button" id="parentMobile" class="btn GreyBtn">Submit</button>
                </div>
              	</div>
              	<div class="div_two" style="display: none;">
                <div class="InputDivWrap studentLogin ">
                  <div class="InputDiv">
                    <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                    <input type="password" class="form-control" name="pin" id="pin" placeholder="Enter Your 4-Digit PIN" readonly="">
                  </div>
                  <div class="user_list mt-2">
	                  
					</div>

                </div>
                <div class="Digit">
                  <ul>
                    <li><div class="DigitBox hover-overlay" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '1';">1</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '2';">2</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '3';">3</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '4';">4</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '5';">5</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '6';">6</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '7';">7</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '8';">8</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '9';">9</div></li>

                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value.slice(0, -1);">&times;</div></li>
                    <li><div class="DigitBox" onclick="document.getElementById('pin').value=document.getElementById('pin').value + '0';">0</div></li>
                    <li><div class="DigitBox">&rarr;</div></li>
                  </ul>
                </div>
                <div class="d-flex ResetNow">
                  <p>Don’t have a pin? <br/><a href="">Create one</a></p>
                  <p class="ml-auto">Forgot pin? <br/><a href="">Reset now</a></p>
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
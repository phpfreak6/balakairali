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
                    <?= Form::open(['url' => url('/change-pin/' . $parent_mobile_number), 'method' => 'POST', 'id' => 'change_pin_form']) ?>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i class="fas fa-phone"></i>
                                <input readonly name="phone_number" id="phone_number" type="text" class="form-control" value="<?= $parent_mobile_number ?>" placeholder="<?= $parent_mobile_number ?>">
                            </div>
                        </div>
                    </div>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="password" class="form-control" name="current_pin" id="current_pin" placeholder="ENTER CURRENT PIN" required>
                            </div>
                        </div>
                    </div>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="password" class="form-control" name="new_pin" id="new_pin" placeholder="ENTER NEW PIN" required>
                            </div>
                        </div>
                    </div>
                    <div class="InputDivWrap studentLogin ">
                        <div class="input_show_hide">
                            <div class="InputDiv">
                                <i><img src="{{ asset('assets/images/front/Number.svg') }}" alt="" /></i>
                                <input autocomplete="off" type="password" class="form-control" name="new_pin_confirmation" id="new_pin_confirmation" placeholder="CONFIRM NEW PIN" required>
                            </div>
                        </div>
                    </div>
                    <div class="keypad_div">
                        <div class="d-flex align-items-center">
                            <button type="submit" id="change_pin_button" class="btn GreyBtn">Change Pin</button>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?= url('login') ?>" class="btn btn-sm btn-danger back-login">Back to Login</a>
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
    .change_pin_wrp {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
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
        height: calc(100% - 70px);
    }
    .LoginPage .row {
        padding-bottom: 50px;
        padding-top: 50px;
    }
    .LoginPage .FormDiv .InputDivWrap {
        padding-bottom: 10px;
    }
    @media only screen and (max-width: 575px) {
        .back-login {
            padding: 10px 5px;
        }
        button#pinLogin {
            padding: 10px 5px;
        }
    }
</style>
@endsection
@section('scripts')
<script>
//    $(document).ready(function () {
//        $('#change_pin_form').validate({
//            rules: {
//                current_pin: {
//                    required: true
//                },
//                new_pin: {
//                    required: true
//                },
//                confirm_new_pin: {
//                    required: true
//                },
//
//            },
//            messages: {
//                current_pin: {
//                    required: 'Please Enter Current Pin'
//                },
//                new_pin: {
//                    required: 'Please Enter New Pin'
//                },
//                confirm_new_pin: {
//                    required: 'Please Confirm New Pin'
//                },
//            },
//            submit: function (form) {
//                form.submit();
//            }
//        });
//    });
</script>
@endsection
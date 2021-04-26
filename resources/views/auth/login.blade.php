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
                    <img src="{{ asset('assets/images/front/Logo.png') }}">
                </div>
                <div class="FormDiv">
                    <?= Form::open(['id' => 'student_login_form']) ?>
                    <div class="InputDivWrap studentLogin">
                        <div class="InputDiv">
                            <i><img src="{{ asset('assets/images/front/Mobile.svg') }}" alt=""></i>
                            <input autocomplete="off" type="text" class="form-control" name="mobile" id="number" placeholder="Enter Parent’s Mobile Number">
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
@endsection
@section('scripts')
<script>

//    function validateParentMobileNumber() {
//        $('#student_login_form').validate({
//            errorElement: 'label',
//            errorClass: 'help-block',
//            focusInvalid: false,
//            ignore: "",
//            errorPlacement: function (error, element) {
//                error.appendTo('.mobile_error');
//            },
//            highlight: function (e) {
//                $('.InputDiv').addClass('border_red');
//            },
//            success: function (e) {
//                $('.InputDiv').removeClass('border_red');
//                $(e).remove();
//            },
//            rules: {
//                mobile: {
//                    required: true,
//                    remote: {
//                        url: 'available.php',
//                        type: 'POST',
//                        data: {
//                            user_nickname: function () {
//                                return $("#user_nickname").val();
//                            }
//                        }
//                    }
//                }
//            },
//            messages: {
//                mobile: {
//                    required: 'Please Enter Mobile Number'
//                }
//            },
//            submitHandler: function (form) {
//                form.submit();
//            },
//            invalidHandler: function (form) {
//            }
//        });
//    }

    $(document).ready(function () {
//        validateParentMobileNumber();

        var baseUrl = $('meta[name="base-url"]').attr('content');
        $('#parentMobile').on('click', function (e) {
            $('#parentMobile').prop('disabled', true);
            $('#parentMobile').text('').html('<div class="spinner-border"></div>');

            if ($('#number').val() == '') {
                $('.InputDiv').css('border', '1px solid #D22935');
                $('.mobile_error').html('<label class="text-danger">Please Enter Mobile Number.</label>');
                $('#parentMobile').prop('disabled', false);
                $('#parentMobile').text('Submit');
                return false;
            } else {
                $('.InputDiv').css('border', '1px solid #E4E3E3');
                $('.mobile_error').html('');
            }

            $.ajax({
                type: 'POST',
                url: baseUrl + '/findParentMobile',
                data: {
                    'mobile': $('#number').val(),
                    '_token': AUTHENTICATION_TOKEN
                },
                success: function (response) {
                    if (response == false) {
                        $('#parentMobile').prop('disabled', false);
                        $('#parentMobile').text('Submit');
                        $('.InputDiv').css('border', '1px solid #D22935');
                        $('.mobile_error').html('<label class="text-danger">Mobile Number Not Found.</label>');
                        return false;
                    } else if (response == 'time') {
                        toastr.options = {"closeButton": true};
                        toastr.error("You can't login at this time.");
                        $('#parentMobile').prop('disabled', false);
                        $('#parentMobile').text('Submit');
                    } else if (response == 'holiday') {
                        toastr.options = {"closeButton": true};
                        toastr.warning("You can't login today. Today is holiday.");
                        $('#parentMobile').prop('disabled', false);
                        $('#parentMobile').text('Submit');
                    } else {
                        window.location.replace('<?= url('/') ?>');
                    }
                }
            });
        });

        $('#pinLogin').on('click', function (e) {
            $('#pinLogin').prop('disabled', true);
            $('#pinLogin').text('').html('<div class="spinner-border"></div>');
            if ($('#pin').val() == '') {
                $('.InputDiv').css('border', '1px solid #D22935');
                $('.mobile_error').html('<center><label class = "text-danger">Please enter PIN.</label></center>');
                $('#pinLogin').prop('disabled', false);
                $('#pinLogin').text('Find Student/s');
                return false;
            } else {
                $('.InputDiv').css('border', '1px solid #E4E3E3');
                $('.mobile_error').html('');
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: baseUrl + '/findStudent',
                data: {
                    'mobile': $('#number').val(),
                    'pin': $('#pin').val()
                },
                success: function (response) {
                    if (response == false) {
                        $('#pinLogin').prop('disabled', false);
                        $('#pinLogin').text('Find Student/s');
                        $('.InputDiv').css('border', '1px solid #D22935');
                        $('.mobile_error').html('<center><label class = "text-danger">Please enter valid PIN.</label></center>');
                        return false;
                    }
                    $('.input_show_hide').hide();
                    $('.keypad_div').hide();
                    $('.user_list').html(response);
                    $('#pinLogin').prop('disabled', false);
                    $('#pinLogin').text('Find Student/s')
                },
            });
        });
        $(document).on('click', '.student_btn', function () {
            var crypt_data = $(this).data('login');
            var content = $(this).text();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: baseUrl + '/student-login',
                data: {
                    'crypt_data': crypt_data
                },
                success: function (response) {
                    if (response.status == 'logged-out') {
                        toastr.options = {
                            "closeButton": true,
                            "positionClass": "toast-top-center",
                            "timeOut": 3000
                        };
                        toastr.success('Student signed out successfully');
                        $('.login_status' + response.id).html('Signed-out - ');
                    }
                    if (response.status == 'inactive') {
                        toastr.options = {
                            "closeButton": true,
                            "positionClass": "toast-top-center"
                        };
                        toastr.warning('Selected student account is inactive. Please contact with centre.');
                        return false;

                    }
                    if (response.status == 'logout') {
                        toastr.options = {
                            "closeButton": true,
                            "positionClass": "toast-top-center"
                        };
                        toastr.warning('Selected student accounts are logged out already or not logged in for today !');
                        return false;
                    }
                    if (response.logout == true) {
                        $('#logoutform').submit();
                    }
                    if (response.text == 'Sign-out') {
                        toastr.options = {
                            "closeButton": true,
                            "positionClass": "toast-top-center",
                            "timeOut": 3000
                        };
                        toastr.success('Student signed-in successfully');
                        $('.login_status' + response.id).html('Signed-in - ');
                    } else {
                        $('.login_status' + response.id).html('Signed-in - ');
                    }
                    if (response.status == 'logged-out') {
                        $('.login_status' + response.id).html('Signed-out - ');
                    }
                    $('.stdnt' + response.id).html(response.text);
                },
            });
        });
        $(document).on('click', '.logout_btn', function () {
            $('#logoutform').submit();
        });
        $('.search-kids').on('click', function (e) {
            var $parent = $('#parent_number').val();
            $.ajax({
                type: 'GET',
                url: URL + '/admin/load-kids-signin',
                data: {
                    'parent_number': $parent
                },
                success: function (response) {
                    if (response.status == false) {
                        toastr.options = {
                            "closeButton": true,
                            "timeOut": 3000
                        };
                        toastr.error(response.message);
                        return false;
                    }
                    divLoader('#append_kids_list_loader');
                    $('.append_kids_list').html(response);
                }
            });
        });
        $(document).on('click', '.student_action_btn', function () {
            var student_id = $(this).data('login');
            var action = $(this).text();
            $.ajax({
                type: 'GET',
                url: URL + '/admin/login-kids',
                data: {
                    'student_id': student_id,
                    'action': action
                },
                success: function (response) {
                    if (response.status == false) {
                        toastr.options = {
                            "closeButton": true,
                            "timeOut": 3000
                        };
                        toastr.error(response.message);
                        return false;
                    }
                    divLoader('#append_kids_list_loader');
                    toastr.options = {
                        "closeButton": true,
                        "positionClass": "toast-top-center",
                        "timeOut": 3000
                    };
                    toastr.success(response.message);
                    $('.status_login' + response.user_id).text(response.html);
                    $('.stdnt' + response.user_id).text(response.btn_text);
                }
            });
        });
        $('#number').mask('9999999999', {
            placeholder: ''
        });
    });

//    $(function () {
//        $(this).bind("contextmenu", function (e) {
//            e.preventDefault();
//        });
//    });
</script>
@endsection
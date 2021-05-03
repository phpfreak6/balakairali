
// Virender 


$(document).ready(function () {
    var baseUrl = $('meta[name="base-url"]').attr('content');
//    $('#parentMobile').on('click', function (e) {
//        $('#parentMobile').prop('disabled', true);
//        $('#parentMobile').text('').html('<div class="spinner-border"></div>');
//        if ($('#number').val() == '') {
//            $('.InputDiv').css('border', '1px solid #D22935');
//            $('.mobile_error').html('<label class="text-danger">Please Enter Mobile Number.</label>');
//            $('#parentMobile').prop('disabled', false);
//            $('#parentMobile').text('Submit');
//            return false;
//        } else {
//            $('.InputDiv').css('border', '1px solid #E4E3E3');
//            $('.mobile_error').html('');
//        }
//        $.ajax({
//            type: 'POST',
//            url: baseUrl + '/findParentMobile',
//            data: {'mobile': $('#number').val(), '_token': AUTHENTICATION_TOKEN},
//            success: function (response) {
//                if (response == false) {
//                    $('#parentMobile').prop('disabled', false);
//                    $('#parentMobile').text('Submit');
//                    $('.InputDiv').css('border', '1px solid #D22935');
//                    $('.mobile_error').html('<center><label class = "text-danger">Mobile number not found.</label></center>');
//                    return false;
//                } else if (response == 'time') {
//                    toastr.options = {"closeButton": true};
//                    toastr.error("You can't login at this time.");
//                    $('#parentMobile').prop('disabled', false);
//                    $('#parentMobile').text('Submit');
//                } else if (response == 'holiday') {
//                    toastr.options = {"closeButton": true};
//                    toastr.warning("You can't login today. Today is holiday.");
//                    $('#parentMobile').prop('disabled', false);
//                    $('#parentMobile').text('Submit');
//                } else {
//                    window.location.reload();
//                }
//            },
//        });
//    });


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
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: baseUrl + '/findStudent',
            data: {'mobile': $('#number').val(), 'pin': $('#pin').val()},
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
                toastr.options = {"closeButton": true, "positionClass": "toast-top-center", "timeOut": 3000};
                toastr.success('Welcome');
                $('#pinLogin').prop('disabled', false);
                $('#pinLogin').text('Find Student/s');
            }
        });
    });


    $(document).on('click', '.student_btn', function () {
        var crypt_data = $(this).data('login');
        var content = $(this).text();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url: baseUrl + '/student-login',
            data: {'crypt_data': crypt_data},
            success: function (response) {
                if (response.status == 'logged-out') {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-center", "timeOut": 3000};
                    toastr.success('Student Signed Out Successfully');
                    $('.login_status' + response.id).html('Signed-out - ');
                }
                if (response.status == 'inactive') {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-center"};
                    toastr.warning('Selected Student Account Is Inactive. Please Contact With Centre.');
                    return false;

                }
                if (response.status == 'logout') {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-center"};
                    toastr.warning('Selected Student Accounts Are Logged Out Already Or Not Logged In For Today!');
                    return false;
                }
                if (response.logout == true) {
                    $('#logoutform').append('<input type="hidden" name="flash_message" value="Signing Process Completed Successfully">');
                    $('#logoutform').submit();
                }
                if (response.text == 'Sign-out') {
                    toastr.options = {"closeButton": true, "positionClass": "toast-top-center", "timeOut": 3000};
                    toastr.success('Student Signed In Successfully');
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
        $('#logoutform').append('<input type="hidden" name="flash_message" value="Logged Out Successfully">');
        $('#logoutform').submit();
    });

    $('.search-kids').on('click', function (e) {
        var $parent = $('#parent_number').val();
        $.ajax({
            type: 'GET',
            url: URL + '/admin/load-kids-signin',
            data: {'parent_number': $parent},
            success: function (response) {
                if (response.status == false) {
                    toastr.options = {"closeButton": true, "timeOut": 3000};
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
            data: {'student_id': student_id, 'action': action},
            success: function (response) {
                if (response.status == false) {
                    toastr.options = {"closeButton": true, "timeOut": 3000};
                    toastr.error(response.message);
                    return false;
                }
                divLoader('#append_kids_list_loader');
                toastr.options = {"closeButton": true, "positionClass": "toast-top-center", "timeOut": 3000};
                toastr.success(response.message);
                $('.status_login' + response.user_id).text(response.html);
                $('.stdnt' + response.user_id).text(response.btn_text);
            }
        });
    });
    $('#number').mask('9999999999', {placeholder: ''});
});
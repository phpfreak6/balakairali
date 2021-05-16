$(document).ready(function () {
    var baseUrl = $('meta[name="base-url"]').attr('content');
    $('.search-kids').on('click', function (e) {
        var $parent = $('#parent_number').val();
        $.ajax({
            type: 'GET',
            url: URL + '/admin/load-kids-signin',
            data: { 'parent_number': $parent },
            success: function (response) {
                if (response.status == false) {
                    toastr.options = { "closeButton": true, "timeOut": 3000 };
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
            data: { 'student_id': student_id, 'action': action },
            success: function (response) {
                if (response.status == false) {
                    toastr.options = { "closeButton": true, "timeOut": 3000 };
                    toastr.error(response.message);
                    return false;
                }
                divLoader('#append_kids_list_loader');
                toastr.options = { "closeButton": true, "positionClass": "toast-top-center", "timeOut": 3000 };
                toastr.success(response.message);
                $('.status_login' + response.user_id).text(response.html);
                $('.stdnt' + response.user_id).text(response.btn_text);
            }
        });
    });
    $('#number').mask('9999999999', { placeholder: '' });
});
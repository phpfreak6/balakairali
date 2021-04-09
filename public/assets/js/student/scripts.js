$(document).ready(function () {
    
    //Account Status

	$('.account_status').on('change', function(){

        var status = $(this).val();

         blockScreen();

         $.ajax({
            type: 'POST',
            url: URL + "/admin/student/change/status",
            data: {_token: _TOKEN, status: status, user_id: $('#student_id').val() },
            success: function (data) {
             unblockScreen();
             toastr.options = {"closeButton": true};
             toastr.success('Account Status Changed.');
               //alert();
            },
        });

    });

    //Marks Form

    $('#marksFormm').on('submit', function(e){

        e.preventDefault();
        blockScreen();

         $.ajax({
            type: 'POST',
            url: URL + "/admin/student/marks-store",
            data: $(this).serialize(),
            success: function (data) {

             $('#marksModel').modal('hide');
             $('#marksFormm').find("input[type=text], input[type=number]").val("");

             unblockScreen();
             toastr.options = {"closeButton": true};
             toastr.success('Marks submitted !');
           
            },
        });

    });


    $('.add_marks').on('click',function(){
        $('#marksModel').modal('show');
    });

    $('.progress_report').on('click',function(){
        $('#progressModel').modal('show');
    });

});

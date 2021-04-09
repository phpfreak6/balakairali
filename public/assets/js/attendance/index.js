
$('#submit_btn').on('click', function() {
      blockScreen();       
      $.ajax({
          
          url: URL + "/admin/attendance",
          type: 'POST',
          data: {_token:_TOKEN, centre:$('select[name=centre]').val(), classes:$('select[name=classes]').val()},
          
          success: function(data) {
                
            $('.append_attendance_table').html(data);

              unblockScreen()

            }
        });        
});

$(document).on('click','.attend', function() {

      blockScreen();

      if($('#date').val() == ''){

        
        if($(this).not(':checked')){
          unblockScreen();
        
        toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
        toastr.error('Please select attendance date.');
        $(this).prop('checked', false);
        return false;

        }

      }

      var isMark;

      if ($(this).is(':checked')) {

          isMark = 1;

       }else{

          isMark = 0;

       }  
       

      $.ajax({
          
          url: URL + "/admin/mark/attendance",
          type: 'POST',
          data: {
            _token:_TOKEN, 
            centre:$('select[name=centre]').val(), 
            classes:$('select[name=classes]').val(),
            isMark:isMark,
            student:$(this).val(),
            date:$('#date').val(),
          },
          
          success: function(data) {
            
    

              unblockScreen()
              
            }
        });   

});


 $( ".datepicker2" ).datepicker({
                format: 'dd-mm-yyyy',
                // endDate: '+0d',
                todayHighlight: true,
                useCurrent: true,
                autoclose: true,
                keepOpen: false,
              });  



$(document).on('click', '.attendance_mark_filter', function(e){ 

     if($('#date').val() == ''){

        toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
        toastr.error('Please select attendance date.');
        $(this).prop('checked', false);
        return false;
     }
    
    $.ajax({
    
            url: URL + "/admin/attendance",
            type: 'POST',
            data: {_token:_TOKEN, centre:$('select[name=centre]').val(), classes:$('select[name=classes]').val(), date:$('#date').val()},
            
            success: function(data) {
                  
              $('.append_attendance_table').html(data);

                unblockScreen()

              }
          });

}); 

$(document).on('change', '#filter_by_centre', function(e){  

        blockScreen();
        //table.draw();    
        
        $.ajax({        
            type: 'GET',        
            url: URL + "/admin/load_classes",

            data: { centre : $('#filter_by_centre').val() },

            success: function (data) { 

            unblockScreen();  
            if(data == false){
                return false;
            }
            $('.classes_append').html(data);

                  
            },    
        });
});

// $(document).on('change','#centre, #classes',function(){

//   if($('#centre').val() != '' && $('#classes').val() != ''){
//     $('#date').prop('disabled',false);
//   }
// });


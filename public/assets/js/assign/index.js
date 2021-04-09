 $(document).ready(function () {

 /**** List Parent ****/
	$('#btn-search-parent').on('click', function(e) { 
	   var another_parent = $('#another_parent_number').val();
        var $parent = $('#btn-search-parent').data('parent');
	    $.ajax({
	    	
	        type: 'GET',
	        url: URL + '/admin/load-parent-list',
	        data: { 'another_parent' : another_parent,'main_parent' : $parent },
	        success: function (response) {

	          if(response.status == false){
                

                $('#parent_list').html('');

                toastr.options = {"closeButton": true, "timeOut": 3000};
                toastr.error(response.message);
               
	        	return false;	

	          }

              divLoader('#kids-listing');

             $('#parent_list').html(response);

            
	     } 

	    });

    });

    /**** Assign student ****/

    
	$(document).on('change','.parent_select', function(e) { 

      $('.parent_select').not(this).prop('checked', false);

        if($(this).is(':checked')){
        	
        }else{
        	return false;
        }
        blockScreen(); 
        var parent = $('#main_parent_num').val();
		var assignTo = $(this).val();

        $.ajax({
	    	
	        type: 'POST',
	        url: URL + '/admin/kids-assign',
	        data: { _token: _TOKEN, 'parent_number' : parent, 'assignTo' : assignTo },
	        success: function (response) {

	          if(response.status == false){
                

                toastr.options = {"closeButton": true, "timeOut": 3000};
                toastr.error(response.message);
                unblockScreen()
	        	return false;	

	          }



               toastr.options = {"closeButton": true, "timeOut": 3000};
               toastr.success(response.message);

               location.reload();
    
	     } 

	    });



	});

	$(document).on('click','#btn-unassign', function(e) {

		var parent = $('#main_parent_num').val();
		var assignTo = $('#btn-unassign').data('unassign');

        $.ajax({
	    	
	        type: 'POST',
	        url: URL + '/admin/kids-unassign',
	        data: { _token: _TOKEN, 'parent_number' : parent, 'assignTo' : assignTo },
	        success: function (response) {

	          if(response.status == false){
                

                toastr.options = {"closeButton": true, "timeOut": 3000};
                toastr.error(response.message);
               
	        	return false;	

	          }



               toastr.options = {"closeButton": true, "timeOut": 3000};
               toastr.success(response.message);
               location.reload();
    
	     } 

	    });

    });

    
});


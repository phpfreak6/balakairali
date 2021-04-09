/*====================================================================================================*/

var max_fields = 10;
var wrapper    = $('.append_cert_html');
var add_btn    = $('.add_mor_cert');


    var x = 1;
    $(add_btn).click(function(e){

        e.preventDefault();
        if(x < max_fields){
         
         x++;
          
         $(wrapper).append('<div class="row"><div class="col-sm-4"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="detail">'+x+') Detail : </label><div class="col-sm-8"> <input type="text" name="cert['+x+'][detail]" class="form-control"></div></div></div><div class="col-sm-3"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="certification_status"> Status : </label><div class="col-sm-8"> <select class="form-control " id="certification_status" name="cert['+x+'][certification_status]"><option value="">Select Status</option><option value="1">VALID</option><option value="0">EXPIRED</option> </select></div></div></div><div class="col-sm-3"><div class="form-group"> <label class="col-sm-4 control-label no-padding-right" for="expiry"> Expiry : </label><div class="col-sm-8"> <input type="text" id="expiry" name="cert['+x+'][expiry]" class="form-control datepicker2"></div></div></div><div class="col-sm-2"><button type="button" class="btn btn-danger btn-sm remove_field"><i class="fa fa-minus"></i></button></div></div>');
         
             refreshDate();

        }

      });

    $(wrapper).on('click','.remove_field',function(){
        
           $(this).parent().parent().remove();
           x--;
      });


    function refreshDate(){

    	$( ".datepicker2" ).datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            useCurrent: true,
            autoclose: true,
            keepOpen: false,
          }); 

    }


/*========================================================================================================*/

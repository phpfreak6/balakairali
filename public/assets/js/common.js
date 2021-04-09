function flashToastError(message) {
    toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
    toastr.error(message);
}

function flashToastSuccess(message) {
    toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
    toastr.success(message);
}

function blockScreen() {
    $.fn.center = function () {
        this.css("position", "absolute");
        this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
        this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
        return this;
    }
    $.blockUI({
        css: {
            backgroundColor: 'transparent',
            border: 'none'
        },
        message: '<i style="font-size:120px;color:#438eb9;" class="ace-icon fa fa-spinner fa-spin"></i>',
        baseZ: 1500,
        overlayCSS: {
            backgroundColor: '#FFFFFF',
            opacity: 0.5,
            cursor: 'wait'
        }
    });
    $('.blockUI.blockMsg').center();
}

function unblockScreen() {
    $.unblockUI();
}

function clock() {
    $('#clock').html(new Date().toGMTString());
}

$(document).ready(function () {
    setInterval(clock, 1000);
});

$('.multiselect').multiselect({
     enableFiltering: true,
     enableHTML: true,
     buttonClass: 'btn btn-white btn-primary',
     templates: {
        button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
        ul: '<ul class="multiselect-container dropdown-menu"></ul>',
        filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
        filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
        li: '<li><a tabindex="0"><label></label></a></li>',
        divider: '<li class="multiselect-item divider"></li>',
        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
     }
});

$( ".datepicker1" ).datepicker({
              format: 'dd-mm-yyyy',
              todayHighlight: true,
              useCurrent: true,
              autoclose: true,
              keepOpen: false,
});

function divLoader(classt){
    if(classt == '#upload'){
        classt = '#id-message-form';
    }
    $(classt).append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-spinner orange2 bigger-160"></i></div>');
                    
        setTimeout(function() {
          
            $(classt).find('.message-loading-overlay').remove();
            
        }, 300 + parseInt(Math.random() * 300));
}


var dateTimeOptions = {
  weekday: 'short',
  year: 'numeric',
  month: 'short',
  day: '2-digit',
  hour12: true,
  hour: 'numeric',
  minute: 'numeric',
  second: 'numeric',
  timeZone: 'Australia/Sydney',
  // timeZoneName: 'short'
};

function display_c() {
  var refresh = 1000; // Refresh rate in milli seconds
  mytime = setTimeout('display_ct()', refresh)
}

function display_ct() {
  var x = new Date();
  document.getElementById('ct').innerHTML = x.toLocaleString('en-US', dateTimeOptions);
  display_c();
}

display_c();


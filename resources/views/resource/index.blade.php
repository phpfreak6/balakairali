@extends('layouts/main')
@section('title')
Teachers Resource
@endsection
@section('content')
<style>
    .fa-file{
        background-color: #EFAD62 !important;
    }
    #resource_datatable{

        width: 100% !important;
    }
</style>
<div class="row">
    <div class="col-sm-12 main_div">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#document">
                        <i class="green ace-icon fa  fa-folder-o bigger-200"></i>
                        Resources
                    </a>
                </li>
                @permission('editing_teacher')
                <li class="li-new-mail pull-right">
                    <a data-toggle="tab" href="#upload" class="btn-new-mail uoloadbt">
                        <i class="green ace-icon fa fa-cloud-upload bigger-200"></i>
                        <span class="bigger-110">Upload Resource</span>
                    </a>
                </li>
                @endpermission
            </ul>
            <div class="tab-content">
                <div id="document" class="tab-pane fade in active">
                    @include('partials.standard_table')
                </div>
                @permission('editing_teacher')
                <div id="upload" class="tab-pane fade">
                    <form id="id-message-form" method="post" action="{{ route('admin.upload') }}" class="form-horizontal message-form col-xs-12">
                        @csrf
                        <div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-recipient">Title:</label>
                                <div class="col-sm-9">
                                    <span class="input-icon">
                                        <input type="text" name="title" id="form-field-recipient"  value="" placeholder="Title">
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="hr hr-18 dotted"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-subject">Type:</label>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="input-icon block col-xs-12 no-padding">
                                        <select name="file_type">
                                            <option value="">Select Type</option>
                                            <option value="standard_document">Standard Document</option>
                                            <option value="syllabus">Syllabus</option>
                                            <option value="test_format">Test Format</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-18 dotted"></div>
                            <div class="form-group no-margin-bottom">
                                <label class="col-sm-3 control-label no-padding-right">Files:</label>
                                <div class="col-sm-9">
                                    <div id="form-attachments">
                                        <div class="form-group file-input-container"><div class="col-sm-7"><label class="ace-file-input width-90 inline"><input type="file" onchange="showIcon()" class="filename" name="attachment[]"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="javascript:void(0);"><i class=" ace-icon fa fa-times"></i></a></label></div></div>
                                    </div>
                                    <div class="align-left">
                                        <button id="id-add-attachment" type="button" class="btn btn-sm btn-danger">
                                            <i class="ace-icon fa fa-paperclip bigger-140"></i>
                                            More File
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr-18 dotted"></div>
                            <div class="align-center">
                                <button id="" type="submit" class="btn btn-sm btn-danger">
                                    <i class="ace-icon fa fa-cloud-upload bigger-140"></i>
                                    Upload
                                </button>
                            </div>
                            <div class="space"></div>
                        </div>
                    </form>
                </div>
                @endpermission
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pregressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title in" id="myModalLabel">Please Wait</h4>
                <h4 class="modal-title hide" id="myModalLabel">Complete</h4>
            </div>
            <div class="modal-body center-block">
                <div class="progress">
                    <div class="progress-bar bar percent" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="bar"></div >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default hide" data-dismiss="modal" id="btnClose">OK</button>
            </div>
        </div>
    </div>
</div>
<?= getDatatableResources() ?>
<script src="{{ asset('assets/js/resource/index.js') }}"></script>
@csrf
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script>
                                            $('#pregressModal').modal({
                                                backdrop: 'static',
                                                keyboard: false,
                                                show: false
                                            });

                                            $('#pregressModal').on('hidden.bs.modal', function () {
                                                // reset modal
                                                if ($('#pregressModal').data('reenable')) {
                                                    $(this).removeData();
                                                    $('#pregressModal').modal({
                                                        show: true
                                                    });
                                                }
                                            });
                                            $('#btnClose').click(function () {
                                                divLoader('body');
                                                window.location.reload();
                                            });

                                            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                                                var $id = ($(this).attr('href'));
                                                divLoader($id);
                                            });


                                            var tabs$ = $(".nav-tabs a");

                                            $(window).on("hashchange", function () {
                                                var hash = window.location.hash, // get current hash
                                                        menu_item$ = tabs$.filter('[href="' + hash + '"]'); // get the menu element

                                                menu_item$.tab("show"); // call bootstrap to show the tab
                                            }).trigger("hashchange");


                                            $(document.body).on("click", "a[data-toggle]", function (event)
                                            {
                                                location.hash = this.getAttribute("href");
                                            });

                                            var SITEURL = "{{URL('/')}}";
                                            $(function () {
                                                $(document).ready(function ()
                                                {
                                                    var bar = $('.bar');
                                                    var percent = $('.percent');
                                                    $('#id-message-form').ajaxForm({
                                                        beforeSend: function () {
                                                            var percentVal = '0%';
                                                            bar.width(percentVal)
                                                            percent.html(percentVal);
                                                            $('#pregressModal').modal('show');
                                                        },
                                                        uploadProgress: function (event, position, total, percentComplete) {
                                                            var percentVal = percentComplete + '%';
                                                            bar.width(percentVal)
                                                            percent.html(percentVal);
                                                        },

                                                        complete: function (xhr) {
                                                            $('#pregressModal .hide,#pregressModal .in').toggleClass('hide in');
                                                        }
                                                    });
                                                });
                                            });

                                            $('#id-add-attachment')
                                                    .on('click', function () {
                                                        var file = $('<input type="file" class="filename" name="attachment[]" />').appendTo('#form-attachments');
                                                        file.ace_file_input();
                                                        file.closest('.ace-file-input')
                                                                .addClass('width-90 inline')
                                                                .wrap('<div class="form-group file-input-container"><div class="col-sm-7"></div></div>')
                                                                .parent().append('<div class="action-buttons pull-right col-xs-1">\
            <a href="#" data-action="delete" class="middle">\
                <i class="ace-icon fa fa-trash-o red bigger-130 middle"></i>\
            </a>\
        </div>')
                                                                .find('a[data-action=delete]').on('click', function (e) {
                                                            e.preventDefault();
                                                            $(this).closest('.file-input-container').hide(300, function () {
                                                                $(this).remove()
                                                            });
                                                        });
                                                    });
                                            function showIcon() {
                                                $('.remove').show();
                                            }
                                            $('.filename').on('change', function () {
                                                var fileName = $(this).val().replace(/.*(\/|\\)/, '');
                                                $(this).next().attr('data-title', 'Change').addClass('selected');
                                                $(this).next().find('.fa-upload').removeClass('fa-upload').addClass('fa-file');
                                                $(this).next().find('.ace-file-name').attr('data-title', fileName);
                                            })
                                            $('.remove').on('click', function () {
                                                $(this).prev().attr('data-title', 'Choose');
                                                $(this).prev().find('.fa-file').removeClass('fa-file').addClass('fa-upload');
                                                $(this).prev().find('.ace-file-name').attr('data-title', 'No File...');
                                                $(this).hide();
                                            });
</script>
@endsection
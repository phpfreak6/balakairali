@if ($message = Session::get('success'))
<script>
    toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
    toastr.success('<?= $message ?>');
</script>
@endif
@if ($message = Session::get('error'))
<script>
    toastr.options = {"closeButton": true, "timeOut": "0", "extendedTimeOut": "0"};
    toastr.error('<?= $message ?>');
</script>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
    <strong>{{ $message }}</strong>
</div>
@endif

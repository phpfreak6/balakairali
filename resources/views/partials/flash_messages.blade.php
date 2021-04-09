@if ($message = Session::get('success'))
<script>
    swal({
        toast: true,
        timer: 3000,
        showConfirmButton: false,
        type: 'success',
        position: 'top',
        title: '<?php echo $message; ?>',
        width: "400px"
    });
</script>
@endif


@if ($message = Session::get('error'))
<script>
    swal({
        toast: true,
        timer: 3000,
        showConfirmButton: false,
        type: 'error',
        position: 'top',
        title: '<?php echo $message; ?>'
    });
</script>
@endif


@if ($message = Session::get('warning'))
<script>
    swal({
        toast: true,
        timer: 3000,
        showConfirmButton: false,
        type: 'warning',
        position: 'top',
        title: '<?php echo $message; ?>'
    });
</script>
@endif


@if ($message = Session::get('info'))
<script>
    swal({
        toast: true,
        timer: 3000,
        showConfirmButton: false,
        type: 'info',
        position: 'top',
        title: '<?php echo $message; ?>'
    });
</script>
@endif
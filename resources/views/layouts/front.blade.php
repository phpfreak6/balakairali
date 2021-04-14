<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="base-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="<?= url('assets/images/favicon.png') ?>" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="<?= url('assets/theme/plugins/toastr/toastr.css') ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <script src="{{ asset('assets/js/front/jquery-3.3.1.min.js') }}"></script>
        <title>Bala Kairali</title>
        <script>
var AUTHENTICATION_TOKEN = '<?= csrf_token() ?>';
        </script>
    </head>
    <body class="LoginPageBody">
        @yield('content')
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <script src="{{ asset('assets/js/front/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/front/bootstrap.min.js') }}"></script>
        <script src="<?= url('assets/theme/plugins/toastr/toastr.js') ?>"></script>
        @yield('scripts')
        @include('templates.flash_messages')
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('templates/header_includes')
    </head>
    <body class="no-skin">
        @include('templates/header')
        <div class="main-container" id="main-container">
            @include('templates/sidebar')
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="page-content">
                        @include('templates/flash_messages')
                        <div class="page-header">
                            <h1>
                                @yield('title')
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('templates/footer')
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @include('templates/footer_includes')
        @yield('scripts')
    </body>
</html>

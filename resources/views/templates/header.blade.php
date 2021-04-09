<div id="navbar" class="navbar navbar-default">
    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
            <a id="navbar-brand" style="padding-left: 25px;" href="#" class="navbar-brand">
                <img src="{{ asset('assets/images/admin_logo.png') }}" width="150" style="margin-top: 5px">
            </a>
        </div>
        <p class="center_header" id="ct"></p>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?= url('assets/theme/avatars/avatar5.png') ?>">
                        <span class="user-info">
                            <small>Welcome,</small>
                            Admin
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="{{ route('admin.profile.setting') }}">
                                <i class="ace-icon fa fa-key"></i>
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.profile') }}">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="sidebar" class="sidebar responsive">
    <ul class="nav nav-list">
        <li class="{{ request()->is('admin') ? 'active' : '' }}">
            <a href="<?= url('admin') ?>">
                <i class="menu-icon glyphicon glyphicon-star"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        <li class="{{ (request()->is('admin/centres') || request()->is('admin/centres/*') || request()->is('admin/centre/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.centres') }}">
                <i class="menu-icon fa fa-university"></i>
                Manage Centres
            </a>
        </li>
        <li class="{{ (request()->is('admin/classes') || request()->is('admin/classes/*') || request()->is('admin/class/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.classes') }}">
                <i class="menu-icon glyphicon-th-list glyphicon"></i>
                Manage Classes
            </a>
        </li>
        @admin
        <li class="{{ (request()->is('admin/teachers') || request()->is('admin/teachers/*') || request()->is('admin/teacher/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.teachers') }}">
                <i class="menu-icon glyphicon-user glyphicon"></i>
                Manage Teachers
            </a>
        </li>
        @endadmin
        <li class="{{ (request()->is('admin/students') || request()->is('admin/students/*') || request()->is('admin/student/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.students') }}">
                <i class="menu-icon fa fa-users"></i>
                Manage Students
            </a>
        </li>
        <li class="{{ (request()->is('admin/signin-signout-kids') || request()->is('admin/signin-signout-kids/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.signinSignoutKids') }}">
                <i class="menu-icon fa fa-exchange"></i>
                Sign-in/Sign-out Kids
            </a>
        </li>
        <li class="{{ (request()->is('admin/signin-signout') || request()->is('admin/signin-signout/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.signinSignout') }}">
                <i class="menu-icon fa fa-info-circle"></i>
                Sign-in/Sign-out Record
            </a>
        </li>
        <li class="{{ (request()->is('admin/attendance')) ? 'active' : '' }}">
            <a href="{{ route('admin.attendance') }}">
                <i class="menu-icon glyphicon glyphicon-book"></i>
                Mark Attendance
            </a>
        </li>
        <li class="{{ (request()->is('admin/teachers-resource') || request()->is('admin/teachers-resource/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.resourceIndex') }}">
                <i class="menu-icon glyphicon glyphicon-cloud"></i>
                Teachers Resource
            </a>
        </li>
        <li class="{{ (request()->is('admin/payment-reports/index')) ? 'active' : '' }}">
            <a href="{{ route('admin.paymentReport') }}">
                <i class="menu-icon fa fa-usd"></i>
                Manage Payments
            </a>
        </li>
        <li class="{{ (request()->is('admin/attendance/report') || request()->is('admin/payment/report')) ? 'open active' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-file-o"></i>
                <span class="menu-text">
                    Reports
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu {{ (request()->is('admin/attendance/report') || request()->is('admin/payment/report')) ? 'nav-show' : '' }}">
                <li class="">
                    <a href="{{ route('admin.attendanceReport') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Attendance Report
                    </a>
                    <b class="arrow"></b>
                </li>
                <!-- <li class="">
                    <a href="{{ route('admin.paymentReport') }}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Payment Report
                    </a>
                    <b class="arrow"></b>
                </li> -->
            </ul>
        </li>
        @admin
        <li class="{{ (request()->is('admin/settings') || request()->is('admin/settings/*')) ? 'active' : '' }}">
            <a href="{{ route('admin.settings') }}">
                <i class="menu-icon fa fa-cogs"></i>
                Settings
            </a>
        </li>
        @endadmin
    </ul>
</div>
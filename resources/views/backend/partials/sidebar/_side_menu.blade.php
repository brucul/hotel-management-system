<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('storage/backend/user/'.auth()->user()->profile->pict) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->profile->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ route('home.index') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            {{--@can('reservasi')--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Reservasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('checkin') }}"><i class="fa fa-circle-o"></i> Check In</a></li>
                    <li><a href="{{ route('checkout') }}"><i class="fa fa-circle-o"></i> Check Out</a></li>
                    <li><a href="{{ route('check') }}"><i class="fa fa-circle-o"></i> Room Status</a></li>
                    <li><a href="{{ route('report.index') }}"><i class="fa fa-circle-o"></i> Report</a></li>
                    <li><a href="{{ route('guest.inhouse') }}"><i class="fa fa-circle-o"></i> Guest In House</a></li>
                </ul>
            </li>
            {{--@endcan--}}
            @hasanyrole('Admin|admin|ADMIN')
            <li class="header">MENU</li>
            {{--@can('master data')--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Category</a></li>
                    <li><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Permission</a></li>
                    <li><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Admin</a></li>
                    <li><a href="{{ route('card.index') }}"><i class="fa fa-circle-o"></i> Debit Card</a></li>
                    <li><a href="{{ route('discount.index') }}"><i class="fa fa-circle-o"></i> Discount</a></li>
                </ul>
            </li>
            {{--@endcan--}}
            {{--@can('kamar')--}}
            <li>
                <a href="{{ route('room.index') }}">
                    <i class="fa fa-hotel"></i> <span>Kamar</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            {{--@endcan--}}
            {{--@can('staff')--}}
            <li>
                <a href="{{ route('staff.index') }}">
                    <i class="fa fa-user"></i> <span>Staff</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            {{--@endcan--}}
            {{--@can('guest')--}}
            <li>
                <a href="{{ route('guest.index') }}">
                    <i class="fa fa-group"></i> <span>Guest History</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            {{--@endcan--}}
            {{--@can('pengaturan')--}}
            <li>
                <a href="{{ route('home.setting') }}">
                    <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            {{--@endcan--}}
            @endrole
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

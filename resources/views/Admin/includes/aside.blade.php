
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/admin/images')}}/logo.png"
             alt="logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Vgs Travel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/images') }}/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                    <li class="nav-item">
                    <a href="{{route('admin.voucher')}}" class="nav-link">
                        <i class="nav-icon fa fa-arrow-right"></i>
                        <p>
                            Voucher
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.voucher_user')}}" class="nav-link">
                        <i class="nav-icon fa fa-arrow-right"></i>
                        <p>
                            List book voucher
                        </p>
                    </a>
                </li>

                 <li class="nav-item">
                    <a href="{{url('users')}}" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('permissions')}}" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            Permissions
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('roles')}}" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

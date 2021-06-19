
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/admin/images')}}/logo.jpg"
             alt="logo"
             class="brand-image  elevation-3"
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
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('voucher_types')}}" class="nav-link">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                        <p>
                            Loại voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('properties')}}" class="nav-link">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                        <p>
                            Thuộc tính voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.voucher')}}" class="nav-link">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                        <p>
                            Voucher
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.voucher_user')}}" class="nav-link">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <p>
                            Danh sách mua voucher
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <p>
                            Quản lý Tour
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.hotel')}}" class="nav-link">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <p>
                            Quản lý khách sạn
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.airport')}}" class="nav-link">
                        <i class="fa fa-plane" aria-hidden="true"></i>
                        <p>
                            Quản lý dịch vụ sân bay
                        </p>
                    </a>
                </li>
            @role('Admin')
                 <li class="nav-item">
                    <a href="{{route('admin.user')}}" class="nav-link">
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
                    <a href="{{route('admin.role')}}" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <p>
                            Role
                        </p>
                    </a>
                </li>
            @endrole
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

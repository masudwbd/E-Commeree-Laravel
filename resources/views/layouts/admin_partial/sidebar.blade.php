@php
    $data = DB::table('settings')->first();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url($data->logo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }} </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                @php
                   $user = DB::table('users')->where('id', Auth::id())->first();
                @endphp

                @if ($user->role == 'admin')
                    {{-- //category --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Category
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('childcategory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Child Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('warehouse.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Warehouse</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- //settings --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('seo.setting') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Seo Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('website.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Website Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('page.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Page Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('smtp.setting') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SMTP Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment.gateway') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment Gateway</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- //offers --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Offers
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('campaign.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Campaign</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('coupon.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Coupon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pickup_point.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pickup Point</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- //product --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Product
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pickup_point.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- //orders --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Orders
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('coupon.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Coupon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pickup_point.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pickup Point</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- //ticket --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Ticket
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.ticket.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tickets</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- //blogs --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Blogs
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('blog.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blogs</p>
                                </a>
                                <a href="{{ route('blog.categories') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog Categories</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- //reports --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.reports.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order Reports</p>
                                </a>
                                <a href="{{ route('blog.categories') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog Categories</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- all --}}
                    <li class="nav-header">
                        Profile
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.password.change') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Change Password</p>
                        </a>
                    </li>
                @elseif($user->role == 'editor')
                    {{-- //category --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Category
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('childcategory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Child Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Brand</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('warehouse.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Warehouse</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- //product --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Product
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>New Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pickup_point.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Product</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- //orders --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Orders
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('coupon.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Coupon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pickup_point.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pickup Point</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- //reports --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('order.reports.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order Reports</p>
                                </a>
                                <a href="{{ route('blog.categories') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog Categories</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- all --}}
                    <li class="nav-header">
                        Profile
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.password.change') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Change Password</p>
                        </a>
                    </li>
                    @elseif($user->role == 'blogger')
                        {{-- //blogs --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Blogs
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">6</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('blog.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blogs</p>
                                </a>
                                <a href="{{ route('blog.categories') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog Categories</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- all --}}
                    {{-- all --}}
                    <li class="nav-header">
                        Profile
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.password.change') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Change Password</p>
                        </a>
                    </li>
                    @elseif($user->role == null)
                    please request your admin for a role
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Logout</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.password.change') }}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Change Password</p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

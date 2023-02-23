<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ isManagerLogged() ? getLoggedInUser()->name : 'Admin' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('admin.dashboard.index') }}" class="nav-link @yield('active-dashboard')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Bảng Điều Khiển
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.products.index') }}" class="nav-link @yield('active-products')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý Sản Phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link @yield('active-categories')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh Mục Sản Phẩm
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link @yield('active-orders')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý Đơn Hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.member.index') }}" class="nav-link @yield('active-members')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh Sách Thành Viên
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.manager.index') }}" class="nav-link @yield('active-manager')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý Nhân Viên
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.slides.index') }}" class="nav-link @yield('active-slide')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý Slide
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.role.index') }}" class="nav-link @yield('active-role')">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quản Lý Phân Quyền
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

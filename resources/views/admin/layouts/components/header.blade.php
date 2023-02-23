<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Trang chủ</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Liên hệ</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
            <form class="form-inline">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
            </form>
            </div>
        </li> --}}
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown admin-notify-section">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if ($unreadAdminNoti->count())
            <span class="badge badge-warning navbar-badge">{{ $unreadAdminNoti->count() }}</span>
            @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{ $unreadAdminNoti->count() }} Thông báo chưa đọc</span>
            <div class="dropdown-divider"></div>
            <div class="dropdown-divider"></div>
            {{-- scroll infinite notifications --}}
            <div class="infinite-scroll" style="height: 300px;width: 300px;overflow: scroll;">
                <div class="content-load">
                    @foreach ($adminNoti as $noti)
                        <a data-link="{{ $noti->link }}" data-noti-id="{{ $noti->id }}" class="read-at dropdown-item py-2 px-2 @empty($noti->read_at) bg-info @endempty" style="cursor: pointer;">
                            <div class="row">
                                <div class="col-2">
                                    <i class="fas fa-users mr-2"></i>
                                </div>
                                <div class="col-10">
                                    <p class="text-sm">{{ $noti->message }}</p>
                                    <p class="text-dark text-xs">{{ \Carbon\Carbon::parse($noti->time)->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                 
                    @endforeach
                    {{ $adminNoti->links('user.layouts.components.pagination') }}
                </div>
            </div>
            {{-- <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div> --}}
        </li>
        <div class="dropdown">
            <a class="dropdown-toggle d-block p-2" style="color: white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{getLoggedInUser()->email}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('admin.logout') }}">Đăng xuất</a>
            </div>
        </div>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
  </nav>

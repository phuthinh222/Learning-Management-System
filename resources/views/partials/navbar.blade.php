<div class="main-header" style="z-index: 1">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom" style="z-index: 1">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control text-truncate" />
                            </div>
                        </form>
                    </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                        <li>
                            <div class="dropdown-title d-flex justify-content-between align-items-center">
                                Messages
                                <a href="#" class="small">Mark all as read</a>
                            </div>
                        </li>

                        <li>
                            <a class="see-all" href="javascript:void(0);">See all messages<i
                                    class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                You have new notification
                            </div>
                        </li>

                        <li>
                            <a class="see-all" href="javascript:void(0);">See all notifications<i
                                    class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown">
                        <div class="avatar-sm">
                            <img src="{{ Auth::user()->avatar ? asset('storage/users/' . Auth::user()->avatar) : asset('assets/img/user_default.jpg') }}"
                                alt="..." class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Chào,</span>
                            @if (Auth::user()->hasRole('Admin'))
                                <span class="fw-bold">Quản trị viên</span>
                            @endif
                            @if (Auth::user()->hasRole('Teacher'))
                                <span class="fw-bold">Giáo viên</span>
                            @endif
                            @if (Auth::user()->hasRole('Student'))
                                <span class="fw-bold">Học sinh</span>
                            @endif
                            @if (Auth::user()->hasRole('Employee'))
                                <span class="fw-bold">Nhân viên</span>
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ Auth::user()->avatar ? asset('storage/users/' . Auth::user()->avatar) : asset('assets/img/user_default.jpg') }}"
                                            alt="image profile" class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text w-100">
                                        <h4 class = "text-truncate">{{ Auth::user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                        @if (Auth::user()->hasRole('Teacher'))
                                            <a href="{{ route('teacher.edit', ['teacher' => Auth::user()->id]) }}"
                                                class="btn btn-xs btn-secondary btn-sm">Thông tin cá nhân</a>
                                        @endif
                                        @if (Auth::user()->hasRole('Admin'))
                                        @endif
                                        @if (Auth::user()->hasRole('Student'))
                                            <a href="{{ route('student.edit', Auth::user()->id) }}"
                                                class="btn btn-xs btn-secondary btn-sm">Thông tin cá nhân</a>
                                        @endif

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                                @if (Auth::user()->hasRole('Teacher'))
                                    <a class="dropdown-item" href="{{ route('teacher.listTimeKeeping') }}">Chấm công</a>
                                @endif
                                <a class="dropdown-item" href="#">My Balance</a>
                                <a class="dropdown-item" href="#">Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Account Setting</a>
                                <div class="dropdown-divider"></div>

                                <div class="dropdown-item">
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Đăng Xuất</button>
                                    </form>
                                </div>

                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->


</div>


<script>
    document.getElementById('logout-form').addEventListener('submit', function(event) {
        if (!confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
            event.preventDefault();
        }
    });
</script>

      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
          <div class="sidebar-logo">
              <!-- Logo Header -->
              <div class="logo-header " data-background-color="light">
                  <a href="/" class="logo">
                      <img src="{{ asset('assets/img/logo-ECM01.png') }}" alt="navbar brand " class="navbar-brand"
                          height="150" />
                  </a>
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
          <div class="sidebar-wrapper scrollbar scrollbar-inner">
              <div class="sidebar-content">
                  <ul class="nav nav-secondary">
                      <li class="nav-item">
                          <a href="{{ route('dashboard') }}" class="dashboard">
                              <i class="fas fa-home"></i>
                              <p>Trang chủ</p>
                          </a>
                      </li>
                      @if (Auth::check() && Auth::user()->hasRole('Admin'))
                          <li class="nav-item">
                              <a href="{{ route('user.listuser') }}" class="dashboard">
                                  <i class="bi bi-person-fill"></i>
                                  <p>Quản lý người dùng</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('teacher.inactive') }}" class="dashboard">
                                  <i class="fa fa-briefcase"></i>
                                  <p>Quản lý giáo viên</p>
                              </a>
                          </li>
                      @endif
                      @if (Auth::check() && Auth::user()->hasRole('Teacher'))
                          <li class="nav-item">
                              <a href="{{ route('teacher.table_timekeeping') }}" class="dashboard">
                                  <i class="bi bi-person-fill"></i>
                                  <p>Bảng chấm công</p>
                              </a>
                          </li>
                         
                      @endif
                  </ul>
              </div>
          </div>

      </div>
      <!-- End Sidebar -->

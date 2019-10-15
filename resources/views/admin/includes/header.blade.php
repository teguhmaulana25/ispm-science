<!-- Header start-->
<header>
  <a href="#" class="brand pull-left">
    <img src="{{ asset('img/logo-andalas.png') }}" alt="Dumet School Logo" width="200" class="logo-sm">
  </a>
  <a href="javascript:;" role="button" class="hamburger-menu pull-left"><span></span></a>
  <ul class="notification-bar list-inline pull-right">
    {{-- <li class="visible-xs"><a href="javascript:;" role="button" class="header-icon search-bar-toggle"><i class="ti-search"></i></a></li> --}}
    {{-- <li class="dropdown">
      <a id="dropdownMenu1" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle bubble header-icon">
        <i class="ti-world"></i><span class="badge bg-danger">1</span>
      </a>
      <div aria-labelledby="dropdownMenu1" class="dropdown-menu dropdown-menu-right dm-medium fs-12 animated fadeInDown">
        <h5 class="dropdown-header">You have 1 notifications</h5>
        <ul data-mcs-theme="minimal-dark" class="media-list mCustomScrollbar">
          <li class="media"><a href="javascript:;">
              <div class="media-left avatar"><img src="{{ asset('images/04.jpg') }}" alt="" class="media-object img-circle"><span class="status bg-warning"></span></div>
              <div class="media-body">
                <h6 class="media-heading">William Carlson</h6>
                <p class="text-muted mb-0">Commented on your post</p>
              </div>
              <div class="media-right text-nowrap">
                <time datetime="2015-12-10T20:27:48+07:00" class="fs-11">5 mins</time>
              </div></a>
          </li>
        </ul>
        <div class="dropdown-footer text-center p-10"><a href="javascript:;" class="fw-500 text-muted">See all notifications</a></div>
      </div>
    </li> --}}
    <li class="dropdown hidden-xs">
      <a id="dropdownMenu2" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle header-icon lh-1 pt-15 pb-15">
        <div class="media mt-0">
          <div class="media-left avatar">
            <img src="{{ asset('build/images/users/04.jpg') }}" alt="" class="media-object img-circle">
            <span class="status bg-success"></span>
          </div>
          <div class="media-right media-middle pl-0">
            <p class="fs-12 mb-0">Hi, {{ Auth::user()->name }}</p>
          </div>
        </div>
      </a>
      <ul aria-labelledby="dropdownMenu2" class="dropdown-menu fs-12 animated fadeInDown">
        <li><a href="#"><i class="ti-user mr-5"></i> My Profile</a></li>
        <li><a href="#"><i class="ti-settings mr-5"></i> Account Settings</a></li>
        <li>
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="ti-power-off mr-5"></i>Logout
          </a>
          <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </li>
    {{-- <li>
      <a href="javascript:;" role="button" class="right-sidebar-toggle bubble header-icon">
        <i class="ti-layout-sidebar-right"></i><span class="dot bg-danger"></span>
      </a>
    </li> --}}
  </ul>
</header>
<!-- Header end-->

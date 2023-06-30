<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{ asset('storage/backend/setting/pict/'.$pict) }}" style="width: 175px;" alt=""></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{ asset('storage/backend/setting/pict/'.$pict) }}" style="width: 175px;" alt=""></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('storage/backend/user/'.auth()->user()->profile->pict) }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{auth()->user()->profile->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('storage/backend/user/'.auth()->user()->profile->pict) }}" class="img-circle" alt="User Image">

              <p>
                {{auth()->user()->profile->name}}
                <small>- 
                @foreach(auth()->user()->getRoleNames() as $role)
                {{$role}}
                @endforeach
                 -</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('staff.show', auth()->user()->profile->id) }}" class="btn btn-default btn-flat">Pengaturan Akun</a>
              </div>
              <div class="pull-right">
                <a class="btn btn-default btn-flat"
                  href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

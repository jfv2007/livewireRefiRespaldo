<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Appointments
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->is('admin/users') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-users" ></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Profile
              </p>
            </a>
          </li>

          <li class="nav-item">
                <a href="{{ route('admin.tag18s') }}" class="nav-link {{ request()->is('admin/tag18s') ? 'active': '' }}">
               {{--  <a href="{{ route('admin.centros') }}" class="nav-link {{ request()->is('admin/centros') ? 'active': '' }}"> --}}
              <i class="nav-icon fas fa-industry"></i>
              <p>
                List Tags
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.fallas') }}" class="nav-link {{ request()->is('admin/fallas') ? 'active': '' }}">
           {{--  <a href="{{ route('admin.centros') }}" class="nav-link {{ request()->is('admin/centros') ? 'active': '' }}"> --}}
          <i class="nav-icon far fa-frown"></i>
          <p>
            Falla de Tags
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('admin.trabajos') }}" class="nav-link {{ request()->is('admin.trabajos') ? 'active': '' }}">

      <i class="nav-icon far fa-frown"></i>
      <p>
        Trabajos de Tags
      </p>
    </a>
  </li>

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </form>
          </li>


          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

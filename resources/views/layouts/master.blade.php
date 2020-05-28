
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Specialised ApS</title>

    <link rel="stylesheet" href="/css/app.css"></link>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/logo.png" alt="Specialised Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Specliased ApS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/profile/{{Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link to="/profile" class="d-block headerColor">
            {{ Auth::user()->name }}
          </router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            @can('isEmployee')
            <li class="nav-item">
              <router-link to="/profile" class="nav-link">
                <i class="nav-icon nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </router-link>
            </li>
            @endCan
            @can('isSupervisor')
            <li class="nav-item">
              <router-link to="/profile" class="nav-link">
                <i class="nav-icon nav-icon fas fa-user"></i>
                <p>
                  Profile
                </p>
              </router-link>
            </li>
            @endCan
            @can('isSupervisor')
            <li class="nav-item">
              <router-link to="/addWorkDay" class="nav-link">
                <i class="nav-icon nav-icon fas fa-user-clock"></i>
                <p>
                  Add Workday
                </p>
              </router-link>
            </li>
            @endCan
            @can('isEmployee')
            <li class="nav-item">
              <router-link to="/addWorkDay" class="nav-link">
                <i class="nav-icon nav-icon fas fa-user-clock"></i>
                <p>
                  Add Workday
                </p>
              </router-link>
            </li>
            @endCan

            @can('isEmployee')
            <li class="nav-item">
              <router-link to="/timeregistration" class="nav-link">
                <i class="nav-icon nav-icon fas fa-table"></i>
                <p>
                  Timesheets
                </p>
              </router-link>
            </li>
            @endCan

            @can('isSupervisor')
            <li class="nav-item">
              <router-link to="/timeregistrationSupervisor" class="nav-link">
                <i class="nav-icon nav-icon fas fa-table"></i>
                <p>
                  Timesheets
                </p>
              </router-link>
            </li>
            @endCan
            @can('isAdmin')
            <li class="nav-item">
              <router-link to="/timeregistrationAdmin" class="nav-link">
                <i class="nav-icon nav-icon fas fa-table"></i>
                <p>
                  Timesheets
                </p>
              </router-link>
            </li>
            @endCan
            @can('isSupervisor')
            <li class="nav-item">
              <router-link to="/employeesSupervisor" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users nav-icon"></i>
                <p>
                  Employee overview
                </p>
              </router-link>
            </li>
            @endCan
            @can('isSupervisor')
            <li class="nav-item">
              <router-link to="/approvals" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users nav-icon"></i>
                <p>
                  Approvals
                </p>
              </router-link>
            </li>
            @endCan
            @can('isAdmin')
            <li class="nav-item">
              <router-link to="/approvalsAdmin" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users nav-icon"></i>
                <p>
                  Approvals
                </p>
              </router-link>
            </li>
            @endCan

            @can('isAdmin')
            <li class="nav-item">
              <router-link to="/employeesAdmin" class="nav-link">
                <i class="nav-icon nav-icon fas fa-users nav-icon"></i>
                <p>
                  Employee overview
                </p>
              </router-link>
            </li>
            @endCan

<!----            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                <i class="nav-icon nav-icon fas fa-cogs"></i>
                <p>
                  Developer
                </p>
              </router-link>
            </li>
          -->
           
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon nav-icon fa fa-power-off text-red"></i>
                <p>
                  {{ __('Logout') }}
                </p> 
            </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>


          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->




<!-- REQUIRED SCRIPTS -->
<script src="/js/app.js"></script>

</body>
</html>

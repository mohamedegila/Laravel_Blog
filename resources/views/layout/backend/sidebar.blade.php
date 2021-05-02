        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Blog</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Category -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-fw fa-list"></i>
              <span>Category</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="{{url('admin/category')}}">View All</a>
              <a class="dropdown-item" href="{{url('admin/category/create')}}">Add New</a>
            </div>
          </li>

            <!-- Post -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-fw fa-address-card"></i>
              <span>Post</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <a class="dropdown-item" href="#">View All</a>
              <a class="dropdown-item" href="#">Add New</a>
            </div>
          </li>
          <!-- Comments -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-comments"></i>
              <span>Comments</span>
            </a>
          </li>
          <!-- Users -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-users"></i>
              <span>Users</span>
            </a>
          </li>
          <!-- Settings -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-cog"></i>
              <span>Settings</span>
            </a>
          </li>
          <!-- Logout -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
        <!-- End of Sidebar -->
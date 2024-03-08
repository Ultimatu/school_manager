<div class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('parent-dashboard') }}" class="sidebar-logo">UTA</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Tableau de bord</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('parent-dashboard') }}" class="nav-link"><i class="ri-dashboard-3-line"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <a href="#" class="nav-label">
                Gestions de vos étudiants
            </a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('parent-students') }}" class="nav-link {{ request()->routeIs('parent-students') ? 'active' : '' }}"><i class="ri-file-user-line fs-2"></i>
                        <span>Mes étudiants</span>
                    </a>
                </li>
            </ul>
        </div><!-- nav-group -->
    </div><!-- sidebar-body -->
    <div class="sidebar-footer">
        <div class="sidebar-footer-top">
          <div class="sidebar-footer-thumb">
            <img src="{{ asset('users/avatar.png') }}" alt="">
          </div><!-- sidebar-footer-thumb -->
          <div class="sidebar-footer-body">
            <h6><a href="#">{{ Auth::user()->name }}</a></h6>
            <p>{{ Auth::user()->role }}</p>
          </div><!-- sidebar-footer-body -->
          <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
          <nav class="nav">
            <a href="{{ route('my-profile') }}"><i class="ri-edit-2-line"></i>Edit Profile</a>
            <a href="{{ route('my-profile') }}"><i class="ri-profile-line"></i> View Profile</a>
          </nav>
          <hr>
          <nav class="nav">
            <a href=""><i class="ri-question-line"></i> Help Center</a>
            <a href="/my-profile#secure"><i class="ri-lock-line"></i> Privacy Settings</a>
            <a href="/my-profile#edits"><i class="ri-user-settings-line"></i> Account Settings</a>
            <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line"></i> Se déconnecter</a>
          </nav>
        </div><!-- sidebar-footer-menu -->
      </div><!-- sidebar-footer -->
</div><!-- sidebar -->



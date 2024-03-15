<div class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">UTA</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Tableau de bord</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link"><i class="ri-dashboard-3-line fs-2 text-success"></i>
                        <span>Tableau de bord</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <a href="#" class="nav-label">Mes cours & notes & emplois du temps</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('etudiant.index') }}" class="nav-link {{ request()->routeIs('etudiant.*') ? 'active' : '' }}"><i class="ri-file-user-line fs-2 text-primary"></i>
                        <span>Mes étudiants</span></a>
                </li>
                {{-- Classe --}}
                <li class="nav-item">
                    <a href="{{ route('classe.index') }}" class="nav-link {{ request()->routeIs('classe.*') ? 'active' : '' }}"><i class="ri-group-fill fs-2 text-success"></i>
                        <span>Mes Classes</span></a>
                </li>
                {{-- Cours --}}
                <li class="nav-item">
                    <a href="{{ route('cours.index') }}" class="nav-link {{ request()->routeIs('cours.*') ? 'active' : '' }}"><i class="ri-book-2-fill fs-2 text-warning"></i>
                        <span>Mes Cours</span></a>
                </li>
                {{-- Emplois du temps --}}
                <li class="nav-item">
                    <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active' : '' }}"><i class="ri-calendar-check-fill fs-2 text-info"></i>
                        <span>Evements</span></a>
                </li>
                {{-- notes --}}
                <li class="nav-item">
                    <a href="{{ route('evaluations.index') }}" class="nav-link {{ request()->routeIs('evaluations.*') ? 'active' : '' }}"><i class="fas fa-book fs-2 text-warning"></i>
                        <span>Mes Evaluations</span></a>
                </li>
                {{-- examens --}}
                <li class="nav-item">
                    <a href="{{ route('examens.index') }}" class="nav-link {{ request()->routeIs('examens.*') ? 'active' : '' }}"><i class="ri-file-list-3-line fs-2 text-danger"></i>
                        <span>Mes examens</span></a>
                </li>
                {{-- reclamantions --}}
                <li class="nav-item">
                    <a href="{{ route('reclamations.index') }}" class="nav-link {{ request()->routeIs('reclamations.*') ? 'active' : '' }}"><i class="ri-file-list-3-line fs-2 text-info"></i>
                        <span>Réclamations</span></a>
                </li>
                {{-- emploi du temps --}}
                <li class="nav-item">
                    <a href="{{ route('professeur.emploi', ['professeur'=>auth()->user()->professeur->id]) }}" class="nav-link"><i class="ri-file-list-3-line fs-2 text-success"></i>
                        <span>Mon emploi du temps</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('appointment.index') }}" class="nav-link {{ request()->routeIs('appointment.*') ? 'active' : '' }}"><i class="ri-checkbox-multiple-line fs-2 text-info"></i>
                        <span>Liste de présence</span></a>
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
            <p>{{Auth::user()->role}}</p>
          </div><!-- sidebar-footer-body -->
          <a id="sidebarFooterMenu" href="" class="dropdown-link"><i class="ri-arrow-down-s-line"></i></a>
        </div><!-- sidebar-footer-top -->
        <div class="sidebar-footer-menu">
          <nav class="nav">
            <a href="{{ route('my-profile') }}"><i class="ri-edit-2-line text-warning"></i>Edit Profile</a>
            <a href="{{ route('my-profile') }}"><i class="ri-profile-line text-success"></i> View Profile</a>
          </nav>
          <hr>
          <nav class="nav">
            <a href=""><i class="ri-question-line"></i> Help Center</a>
            <a href="/my-profile#secure"><i class="ri-lock-line text-danger"></i> Privacy Settings</a>
            <a href="/my-profile#edits"><i class="ri-user-settings-line text-info"></i> Account Settings</a>
            <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line text-danger"></i> Se déconnecter</a>
          </nav>
        </div><!-- sidebar-footer-menu -->
      </div><!-- sidebar-footer -->
</div><!-- sidebar -->



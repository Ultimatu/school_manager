<div class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-logo">UTA</a>
    </div><!-- sidebar-header -->
    <div id="sidebarMenu" class="sidebar-body">
        <div class="nav-group show">
            <a href="#" class="nav-label">Tableau de bord</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link"><i class="ri-dashboard-3-line"></i>
                        <span>Tableau de bord</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <a href="#" class="nav-label">Gestion de l'administration</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="{{ route('administration.index') }}" class="nav-link {{ request()->routeIs('administration.*') ? 'active' : '' }}"><i class="ri-admin-line fs-2"></i>
                        <span>Administration</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('professeur.index') }}" class="nav-link {{ request()->routeIs('professeur.*') ? 'active' : '' }}"><i class="ri-file-user-line fs-2"></i>
                        <span>Enseignants</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('etudiant.index') }}" class="nav-link {{ request()->routeIs('etudiant.*') ? 'active' : '' }}"><i class="ri-user-3-line fs-2"></i>
                        <span>Etudiants</span></a>
                </li>
                {{-- parents --}}
                <li class="nav-item">
                    <a href="{{ route('parents.index') }}" class="nav-link {{ request()->routeIs('parents.*') ? 'active' : '' }}"><i class="ri-user-3-line fs-2"></i>
                        <span>Parents</span></a>
                </li>
                {{-- Filiere --}}
                <li class="nav-item">
                    <a href="{{ route('filiere.index') }}" class="nav-link {{ request()->routeIs('filiere.*') ? 'active' : '' }}"><i class="ri-book-3-line fs-2"></i>
                        <span>Filières</span></a>
                </li>
                {{-- Classe --}}
                <li class="nav-item">
                    <a href="{{ route('classe.index') }}" class="nav-link {{ request()->routeIs('classe.*') ? 'active' : '' }}"><i class="ri-group-fill fs-2"></i>
                        <span>Classes</span></a>
                </li>
                {{-- Cours --}}
                <li class="nav-item">
                    <a href="{{ route('cours.index') }}" class="nav-link {{ request()->routeIs('cours.*') ? 'active' : '' }}"><i class="ri-book-2-fill fs-2"></i>
                        <span>Cours</span></a>
                </li>
                {{-- Salles --}}
                <li class="nav-item">
                    <a href="{{ route('salle.index') }}" class="nav-link {{ request()->routeIs('salle.*') ? 'active' : '' }}"><i class="ri-home-2-line fs-2"></i>
                        <span>Salles</span></a>
                </li>
                {{-- Emplois du temps --}}
                <li class="nav-item">
                    <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active' : '' }}"><i class="ri-calendar-check-fill fs-2"></i>
                        <span>Evements</span></a>
                </li>
                {{-- notes --}}
                <li class="nav-item">
                    <a href="{{ route('evaluations.index') }}" class="nav-link {{ request()->routeIs('evaluations.*') ? 'active' : '' }}"><i class="fas fa-book fs-2 text-info"></i>
                        <span>Evaluations</span></a>
                </li>
                {{-- examens --}}
                <li class="nav-item">
                    <a href="{{ route('examens.index') }}" class="nav-link {{ request()->routeIs('examens.*') ? 'active' : '' }}"><i class="ri-file-list-3-line fs-2"></i>
                        <span>Examens</span></a>
                </li>
                {{-- annee scolaire --}}
                <li class="nav-item">
                    <a href="{{ route('years.index') }}" class="nav-link {{ request()->routeIs('years.*') ? 'active' : '' }}"><i class="ri-calendar-check-fill text-danger fs-2"></i>
                        <span>Annee Scolaire</span></a>
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



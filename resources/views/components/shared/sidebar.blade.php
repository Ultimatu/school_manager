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
                    <a href="{{ route('salle.index') }}" class="nav-link {{ request()->routeIs('salles.*') ? 'active' : '' }}"><i class="ri-home-2-line fs-2"></i>
                        <span>Salles</span></a>
                </li>
                {{-- Emplois du temps --}}
                <li class="nav-item">
                    <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active' : '' }}"><i class="ri-calendar-check-fill fs-2"></i>
                        <span>Evements</span></a>
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
                {{-- scolarite --}}
                <li class="nav-item">
                    <a href="{{ route('scolarite.index') }}" class="nav-link {{ request()->routeIs('scolarite.*') ? 'active' : '' }}"><i class="ri-money-dollar-circle-line text-warning fs-2"> </i>
                        <span>Scolarité</span></a>
                </li>
                {{-- versements --}}
                <li class="nav-item">
                    <a href="{{ route('versement.index') }}" class="nav-link {{ request()->routeIs('versement.*') ? 'active' : '' }}"><i class="ri-money-dollar-circle-line text-success fs-2">

                    </i>
                        <span>Versements</span></a>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show">
            <a href="#" class="nav-label">Gestion du cars</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-car-line"></i>
                         <span>Car & Transport</span></a>
                    <nav class="nav nav-sub">
                        <a href="{{route('cars.index')}}" class="nav-sub-link">
                            <i class="ri-car-line"></i>
                            Voitures</a>
                        <a href="#" class="nav-sub-link">
                            <i class="ri-user-3-line"></i>
                            Chauffeurs</a>
                        <a href="#" class="nav-sub-link">
                            <i class="ri-map-pin-line"></i>
                            Trajets</a>
                        <a href="{{route('car_inscriptions.index')}}" class="nav-sub-link">
                            <i class="ri-checkbox-multiple-line"></i>
                            Inscriptions</a>
                    </nav>
                </li>
            </ul>
        </div><!-- nav-group -->
        <div class="nav-group show mb-3">
            <a href="#" class="nav-label">Gestions de la cité</a>
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="" class="nav-link has-sub"><i class="ri-building-2-line"></i>
                        <span>Cité & Logements</span></a>
                    <nav class="nav nav-sub">
                        <a href="#" class="nav-sub-link">
                            <i class="ri-building-2-line"></i>
                            Batiments</a>
                        <a href="#" class="nav-sub-link">
                            <i class="ri-user-3-line"></i>
                            Etudiants</a>
                        <a href="#" class="nav-sub-link">
                            <i class="ri-map-pin-line"></i>
                            Chambres</a>
                        <a href="#" class="nav-sub-link">
                            <i class="ri-checkbox-multiple-line"></i>
                            Inscriptions</a>
                    </nav>
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
            <a href="{{route('my-profile')}}"><i class="ri-edit-2-line"></i> Edit Profile</a>
            <a href="{{route('my-profile')}}"><i class="ri-profile-line"></i> View Profile</a>
          </nav>
          <hr>
          <nav class="nav">
            <a href=""><i class="ri-question-line"></i> Help Center</a>
            <a href=""><i class="ri-lock-line"></i> Privacy Settings</a>
            <a href=""><i class="ri-user-settings-line"></i> Account Settings</a>
            <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line"></i> Se déconnecter</a>
          </nav>
        </div><!-- sidebar-footer-menu -->
      </div><!-- sidebar-footer -->
</div><!-- sidebar -->



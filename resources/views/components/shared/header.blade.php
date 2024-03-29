<div class="header-main px-3 px-lg-4">
    <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

    <div class="form-search me-auto">
        <input type="text" class="form-control" placeholder="Search">
        <i class="ri-search-line"></i>
    </div><!-- form-search -->

    <div class="dropdown dropdown-skin">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside"><i
                class="ri-settings-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <label>Choix de la couleur</label>
            <nav id="skinMode" class="nav nav-skin">
                <a href="" class="nav-link active">Light</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
            <hr>
            <label>Sidebar Skin</label>
            <nav id="sidebarSkin" class="nav nav-skin">
                <a href="" class="nav-link active">Default</a>
                <a href="" class="nav-link">Prime</a>
                <a href="" class="nav-link">Dark</a>
            </nav>
            <hr>
            <label>Direction</label>
            <nav id="layoutDirection" class="nav nav-skin">
                <a href="" class="nav-link active">LTR</a>
                <a href="" class="nav-link">RTL</a>
            </nav>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->

    <div class="dropdown dropdown-notification ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown"
            data-bs-auto-close="outside"><small>{{ $notifications->count() }}
            </small><i class="ri-notification-3-line"></i></a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f me--10-f">
            <div class="dropdown-menu-header">
                <h6 class="dropdown-menu-title">Notifications</h6>
            </div><!-- dropdown-menu-header -->
            <ul class="list-group">
                @forelse ($notifications as $notification)
                    <li class="list-group-item">
                        <a href="{{ $notification->link }}" class="text-dark">
                                <i class="{{ $notification->icon }}"></i>
                            <div class="list-group-body">
                                <p><strong>{{ $notification->message }}</strong></p>
                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </div><!-- list-group-body -->
                        </a>
                    </li>
                @empty
                  <div class="alert alert-info">
                    Aucune notifications
                  </div>
                @endforelse
            </ul>
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
    <div class="dropdown dropdown-profile ms-3 ms-xl-4">
        <a href="" class="dropdown-link" data-bs-toggle="dropdown" data-bs-auto-close="outside">
            <div class="avatar online">
                @switch(auth()->user()->role_auth)
                    @case('etudiant')
                        <img src="{{ asset(auth()->user()->etudiant->avatar ?? 'users/avatar.png') }}" alt="">
                    @break

                    @case('professeur')
                        <img src="{{ asset(auth()->user()->professeur->avatar ?? 'users/avatar.png') }}" alt="">
                    @break

                    @default
                        <img src="{{ asset(auth()->user()->administration->avatar ?? 'users/avatar.png') }}" alt="">
                @endswitch
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end mt-10-f">
            <div class="dropdown-menu-body">
                <div class="avatar avatar-xl online mb-3"><img src="{{ asset('users/avatar.png') }}" alt="">
                </div>
                <h5 class="mb-1 text-dark fw-semibold">{{ Auth::user()->name }}</h5>
                <p class="fs-sm text-secondary">{{ Auth::user()->role_auth }}</p>

                <nav class="nav">
                    <a href="{{ route('my-profile') }}"><i class="ri-profile-line"></i> Profile</a>
                </nav>
                <hr>
                <nav class="nav">
                    <a href="{{ route('logout') }}"><i class="ri-logout-box-r-line"></i> Se déconnecter</a>
                </nav>
            </div><!-- dropdown-menu-body -->
        </div><!-- dropdown-menu -->
    </div><!-- dropdown -->
</div><!-- header-main -->

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Affichage des messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <strong>Succès!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <strong>Erreur!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Topbar Search -->
    <form action="{{ route('search') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2" required>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    {{-- <!-- Affichage des alertes de paiement -->
    @if(is_array($alerts) && count($alerts) > 0)
    <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
        <strong>Attention!</strong> Vous avez des paiements imminents.
        <ul>
            @foreach($alerts as $alert)
                <li>
                    <strong>{{ $alert['participant']->prenom }} {{ $alert['participant']->nom }}</strong> doit effectuer un paiement pour la tontine <strong>{{ $alert['tontine']->nom_tontine }}</strong> dans 3 jours.
                </li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

        <!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Compteur - Nombre de demandes -->
        @if(isset($demandesNonLues) && $demandesNonLues->count() > 0)
            <span class="badge badge-danger badge-counter">{{ $demandesNonLues->count() }}</span>
        @endif
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Demandes d’adhésion
        </h6>
        @forelse($demandesNonLues as $demande)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('gerant.demandes') }}">
                <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="{{ asset('img/default-avatar.png') }}" alt="...">
                    <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                    <div class="text-truncate">
                        <!-- Afficher le prénom et le nom de l'utilisateur -->
                        {{ $demande->users->prenom }} {{ $demande->users->nom }} veut rejoindre
                        {{ $demande->tontine->nom_tontine }}.
                    </div>
                    <div class="small text-gray-500">{{ $demande->created_at->diffForHumans() }}</div>
                </div>
            </a>
        @empty
            <a class="dropdown-item text-center small text-gray-500" href="#">Aucune nouvelle demande</a>
        @endforelse
        <a class="dropdown-item text-center small text-gray-500" href="{{ route('gerant.demandes') }}">Voir toutes les demandes</a>
    </div>
</li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <span class="text-primary">
                        @if (Auth::user()->Profil == 'SUPER_ADMI' || Auth::user()->Profil == 'GERANT')
                            {{ Auth::user()->Profil ?? '' }}:{{ Auth::user()->prenom ?? '' }} {{ Auth::user()->nom ?? '' }}
                        @else
                            {{ Auth::user()->prenom ?? '' }} {{ Auth::user()->nom ?? '' }}
                        @endif
                    </span>
                </span>
                <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>

    </ul>

</nav>

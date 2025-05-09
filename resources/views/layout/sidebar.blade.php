<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
 <!--ajouter un logo -->
    <!-- Sidebar - Brand -->
    {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
            <img class="img-profile rounded-circle"
            src="img/logo.png"> --}}
            {{-- <i class="fas fa-laugh-wink"></i> --}}
        {{-- </div> --}}
        <div class="sidebar-brand-text mx-3">
    </a>

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="\home">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;">
        </div>
        <div class="sidebar-brand-text mx-3"> Natte
            <!-- Ton texte de marque ici -->
        </div>
    </a>



<!-- fin ajout logo -->
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Accueil
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{asset('home')}}">
            {{-- <i class="fas fa-fw fa-table"></i> --}}
            <span>Accueil</span></a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="colors">Colors</a>
                <a class="collapse-item" href="border">Borders</a>
                <a class="collapse-item" href="animation">Animations</a>
                <a class="collapse-item" href="other">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
          Espace Tontine
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            {{-- <i class="fas fa-fw fa-folder"></i> --}}
            <span>Tontines</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Espace Tontine:</h6>
                <a class="collapse-item" href="{{asset('Tontines')}}">Consulter les Tontines</a>
                <a class="collapse-item" href="{{asset('mestontines')}}">Mes Tontines</a>
                {{-- <a class="collapse-item" href="HistoriqueTontines">Historique </a> --}}

        </div>
    </li>

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
</li>
<li class="nav-item">
    <a class="nav-link" href="{{asset('/mes-transactions')}}">
        {{-- <i class="fas fa-fw fa-table"></i> --}}
        <span> Mes Transactions</span></a>
</li>

    <li class="nav-item">
        <a class="nav-link" href="{{asset('HistoriqueTontines')}}">
            {{-- <i class="fas fa-fw fa-table"></i> --}}
            <span>Historique</span></a>

    <li class="nav-item">
        <a class="nav-link" href="{{asset('tables')}}">
            {{-- <i class="fas fa-fw fa-table"></i> --}}
            <span>A propos</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

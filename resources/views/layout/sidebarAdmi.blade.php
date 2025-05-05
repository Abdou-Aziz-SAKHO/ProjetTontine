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

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" src="{{asset('img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
        </div>
        <div class="sidebar-brand-text mx-3"> Natte
            <!-- Ton texte de marque ici -->
        </div>
    </a>



<!-- fin ajout logo -->
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{asset('#')}}" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            {{-- <i class="fas fa-fw fa-cog"></i> --}}
            <span> Gestions des Tontines</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="{{asset('#accordionSidebar')}}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{asset('/creerTontine')}}">Creer une tontine</a>
                <a class="collapse-item" href="{{asset ( route('tontines.modifier') )}}">Modifier une tontine</a>
                <a class="collapse-item" href="{{asset('suptontines')}}">Supprimer une tontine</a>
                <a class="collapse-item" href="/tontinesconsulter">Consulter une tontine</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            {{-- <i class="fas fa-fw fa-wrench"></i> --}}
            <span>Tirage</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{asset('tirages')}}">Tirages</a>


            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="connexion">Login</a>
                <a class="collapse-item" href="register">Register</a>
                <a class="collapse-item" href="forgot">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404">404 Page</a>
                <a class="collapse-item active" href="home">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{asset('participants')}}">
            {{-- <i class="fas fa-fw fa-table"></i> --}}
            <i class="fas fa-fw fa-table"></i>
            <span>Participants</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{asset('tontines/historique')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Historique</span></a>

    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

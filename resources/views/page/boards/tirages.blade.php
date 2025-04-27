
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirage au sort</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebarAdmi')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="text-center">Tirage au sort</h1>

                    <!-- Afficher les messages de succès ou d'erreur -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Liste des tontines -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des Tontines</h6>
                        </div>
                        <div class="card-body">
                            @if ($tontines->isEmpty())
                                <p>Aucune tontine disponible.</p>
                            @else
                                <table class="table table-bordered">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Nomtontine</th>
                                            <th>Date de Début</th>
                                            <th>Date de Fin</th>
                                            <th>Montant Total</th>
                                            <th>Montant de Base</th>
                                            <th>Nombre de Participants</th>
                                            <th>Fréquence</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tontines as $tontine)
                                            <tr>
                                                <td>{{ $tontine->Image->nomImage ?? 'Aucune image' }}</td> <!-- Affiche le nom de l'image ou "Aucune image" si non défini -->
                                                <td>{{ $tontine->datedebut }}</td>
                                                <td>{{ $tontine->datefin }}</td>
                                                <td>{{ $tontine->montant_Total }}</td>
                                                <td>{{ $tontine->montant_base }}</td>
                                                <td>{{ $tontine->nbreParticipant }}</td>
                                                <td>{{ ucfirst($tontine->frequence) }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('tirage.tirer', $tontine->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Effectuer le tirage</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
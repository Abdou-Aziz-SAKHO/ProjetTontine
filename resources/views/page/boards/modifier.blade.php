<!-- filepath: c:\Users\USER\Desktop\git\ProjetTontine\resources\views\page\boards\modifier.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modifier une Tontine">
    <meta name="author" content="">

    <title>Modifier une Tontine</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- sama bootstrap --}}
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                <!-- Navbar -->
                @include('layout.navbar')
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Modifier une Tontine</h1>

                    @if ($tontines->isEmpty())
                        <p>Aucune tontine modifiable pour le moment.</p>
                    @else
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Nom de la Tontine</th>
                                    <th>Date de Début</th>
                                    <th>Date de Fin</th>
                                    <th>Montant de Base</th>
                                    <th>Montant Total</th>
                                    <th>Nombre de Participants</th>
                                    <th>Fréquence</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tontines as $tontine)
                                    <tr>
                                        <td>{{ $tontine->image->nomImage }}</td>
                                        <td>{{ $tontine->datedebut }}</td>
                                        <td>{{ $tontine->datefin }}</td>
                                        <td>{{ $tontine->montant_base }}</td>
                                        <td>{{ $tontine->montant_Total }}</td>
                                        <td>{{ $tontine->nbreParticipant }}</td>
                                        <td>{{ $tontine->frequence }}</td>
                                        <td>
                                            <a href="{{ route('tontines.edit', $tontine->id) }}" class="btn btn-warning">Modifier</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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

<!-- filepath: c:\Users\USER\Desktop\git\ProjetTontine\resources\views\page\boards\edit.blade.php -->
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
                    <h1 class="h3 mb-4 text-gray-800">Modifier la Tontine : {{ $tontine->image->nomImage ?? 'Aucun nom' }}</h1>

                    <form method="POST" action="{{ route('tontines.update', $tontine->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nom">Nom de la Tontine</label>
                            <input type="text" class="form-control" id="nomImage" name="nomImage" value="{{ $tontine->image->nomImage ?? '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="datedebut">Date de Début</label>
                            <input type="date" class="form-control" id="datedebut" name="datedebut" value="{{ $tontine->datedebut }}" required>
                        </div>

                        <div class="form-group">
                            <label for="datefin">Date de Fin</label>
                            <input type="date" class="form-control" id="datefin" name="datefin" value="{{ $tontine->datefin }}" required>
                        </div>

                        <div class="form-group">
                            <label for="montant_base">Montant de Base</label>
                            <input type="number" class="form-control" id="montant_base" name="montant_base" value="{{ $tontine->montant_base }}" required>
                        </div>

                        <div class="form-group">
                            <label for="montant_total">Montant Total</label>
                            <input type="number" class="form-control" id="montant_total" name="montant_total" value="{{ $tontine->montant_total }}" required>
                        </div>
                        <div class="form-group">
                            <label for="frequence">Fréquence :</label>
                            <select name="frequence" id="frequence"name='frequence' class="form-control" required>
                                <option value="hebdomadaire">Hebdomadaire</option>
                                <option value="mensuel">Mensuel</option>
                                <option value="annuel">Annuel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nbreParticipant">Nombre Participant</label>
                            <input type="number" class="form-control" id="nbreParticipant" name="nbreParticipant" value="{{ $tontine->nbreParticipant }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
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
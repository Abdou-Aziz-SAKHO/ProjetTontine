<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Créer une Tontine</title>

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

                <!-- Topbar -->
                @include('layout.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Créer une Tontine</h1>
                    </div>

                    <!-- Contenu principal -->
                    <div class="row">
                        <!-- Image à gauche -->
                        <div class="col-lg-6">
                            <img src="{{ asset('img/femmenoir.png') }}" alt="Image Tontine" class="img-fluid" style="height: 740px; object-fit: cover;">
                        </div>

                        <!-- Formulaire à droite -->
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Formulaire de création</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('tontines.store') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="datedebut">Date de début :</label>
                                            <input type="date" name="datedebut" id="datedebut" class="form-control" required>
                                            @error('datedebut')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="datefin">Date de fin :</label>
                                            <input type="date" name="datefin" id="datefin" class="form-control" required>
                                            @error('datefin')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="montant_total">Montant total :</label>
                                            <input type="number" name="montant_total" id="montant_total" class="form-control" required>
                                            @error('montant_total')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="montant_base">Montant de base :</label>
                                            <input type="number" name="montant_base" id="montant_base" class="form-control" required>
                                            @error('montant_base')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nbreParticipant">Nombre de participants :</label>
                                            <input type="number" name="nbreParticipant" id="nbreParticipant" class="form-control" required>
                                            @error('nbreParticipant')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <<label for="nom_tontine">Nom de la Tontine :</label>
                                            <input type="text" name="nom_tontine" id="nom_tontine" class="form-control" required>
                                            @error('nom_tontine')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="frequence">Fréquence :</label>
                                            <select name="frequence" id="frequence" class="form-control" required>
                                                <option value="HEBDOMADAIRE">Hebdomadaire</option>
                                                <option value="MENSUELLE">Mensuel</option>
                                                <option value="ANNUELLE">Annuel</option>
                                            </select>
                                            @error('frequence')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Créer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin du contenu principal -->

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

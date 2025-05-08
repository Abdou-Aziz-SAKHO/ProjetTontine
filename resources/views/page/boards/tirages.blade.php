<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirage au sort</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fireworks.css') }}" rel="stylesheet">

    <style>
        .spinner-circle {
            margin: 0 auto;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #007bff;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        canvas#fireworksCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        }
    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebarAdmi')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.navbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="text-center">Tirage au sort</h1>

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

                    <!-- Animation pendant le tirage -->
                    <div id="tirageAnimation" class="text-center my-4" style="display: none;">
                        <div class="spinner-circle"></div>
                        <p class="mt-2">Tirage en cours... 🍀</p>
                    </div>

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
                                                <td>{{ $tontine->Image->nomImage ?? 'Aucune image' }}</td>
                                                <td>{{ $tontine->datedebut }}</td>
                                                <td>{{ $tontine->datefin }}</td>
                                                <td>{{ $tontine->montant_Total }}</td>
                                                <td>{{ $tontine->montant_base }}</td>
                                                <td>{{ $tontine->nbreParticipant }}</td>
                                                <td>{{ ucfirst($tontine->frequence) }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('tirage.tirer', $tontine->id) }}" class="tirage-form">
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

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')

        </div>

    </div>

    <!-- Canvas for Fireworks -->
    <canvas id="fireworksCanvas"></canvas>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Audio -->
    <audio id="tirageSound" src="{{ asset('sounds/spin.mp3') }}" preload="auto"></audio>

    <!-- JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/fireworks.js') }}"></script>

    <!-- Animation de tirage JS -->
    <script>
        document.querySelectorAll('.tirage-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                // Affiche le spinner et désactive les boutons
                document.getElementById('tirageAnimation').style.display = 'block';
                document.querySelectorAll('button').forEach(btn => btn.disabled = true);

                // Lance le son
                document.getElementById('tirageSound').play();

                // Lance les feux d'artifice
                const fireworks = new Fireworks({
                    target: document.getElementById('fireworksCanvas'),
                    hue: 120,
                    startDelay: 0,
                    minDelay: 20,
                    maxDelay: 40,
                    speed: 2,
                    acceleration: 1.05,
                    friction: 0.97,
                    gravity: 1.5,
                    particles: 50,
                    trace: 3,
                    explosion: 5
                });
                fireworks.start();

                // Arrêt de l'animation après 3 secondes, soumission du formulaire
                setTimeout(() => {
                    fireworks.stop();
                    form.submit();
                }, 3000);
            });
        });
    </script>
</body>
</html>

<!-- filepath: c:\Users\USER\Desktop\git\ProjetTontine\resources\views\page\boards\details.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Détails de la Tontine</title>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layout.sidebarAdmi')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.navbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Détails de la Tontine</h1>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nom :</strong>
                            {{ $tontine->image->nomImage ?? 'Aucun nom disponible' }}
                        </li>
                        <li class="list-group-item"><strong>Date de Début :</strong> {{ $tontine->datedebut }}</li>
                        <li class="list-group-item"><strong>Date de Fin :</strong> {{ $tontine->datefin }}</li>
                        <li class="list-group-item"><strong>Montant de Base :</strong> {{ $tontine->montant_base }}</li>
                        <li class="list-group-item"><strong>Montant Total :</strong> {{ $tontine->montant_Total }}</li>
                        <li class="list-group-item"><strong>Nombre de Participants :</strong> {{ $tontine->nbreParticipant }}</li>
                        <li class="list-group-item"><strong>Fréquence :</strong> {{ $tontine->frequence }}</li>
                    </ul>
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
</body>

</html>

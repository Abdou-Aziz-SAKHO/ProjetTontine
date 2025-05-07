<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Consulter une Tontine</title>
    <link href="{{asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- sama bootstrap --}}
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



</head>

<body id="page-top">
    <div id="wrapper">
        @include('layout.sidebarAdmi')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.navbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Liste des Tontines a consulter</h1>
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nom de la Tontine</th>
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Montant de Base</th>
                                <th>Nombre de Participants</th>
                                <th>Fréquence</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tontines as $tontine)
                                <tr>
                                    <td>{{ $tontine->nom_tontine ?? 'Aucune nom' }}</td>
                                    <td>{{ $tontine->datedebut }}</td>
                                    <td>{{ $tontine->datefin }}</td>
                                    <td>{{ $tontine->montant_base }} FCFA</td>
                                    <td>{{ $tontine->nbreParticipant }}</td>
                                    <td>{{ ucfirst($tontine->frequence) }}</td>
                                    <td>
                                        <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
            <div>
            <a href="{{ route('participants') }}" class="btn btn-secondary mt-3">Retour</a>
        </div>
            @include('layout.footer')
        </div>
    </div>
</body>

</html>

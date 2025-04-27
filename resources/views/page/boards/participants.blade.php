@extends('layout.sidebarAdmi')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Liste des Participants</h1>

    @if ($participants->isEmpty())
        <p>Aucun participant trouvé.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Date de Naissance</th>
                    <th>CNI</th>
                    <th>Tontine</th>
                    <th>Montant Total Cotisé</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $participant->nom }}</td>
                        <td>{{ $participant->user->prenom ?? 'N/A' }}</td> <!-- Assurez-vous que le modèle User a un champ 'prenom' -->
                        <td>{{ $participant->Adresse }}</td>
                        <td>{{ $participant->dateNaissance }}</td>
                        <td>{{ $participant->cni }}</td>
                        <td>{{ $participant->tontine->nomtontine ?? 'Non inscrit' }}</td>
                        <td>{{ $participant->cotisations->sum('montant') }} FCFA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
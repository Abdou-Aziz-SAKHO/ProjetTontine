@extends('appAdmi') <!-- Assurez-vous que votre layout est correct -->

{{-- sama bootstrap --}}

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Résultats de recherche pour : "{{ $query }}"</h1>

    @if ($users->isEmpty() && $tontines->isEmpty())
        <p class="text-danger">Aucun résultat trouvé.</p>
    @else
        <h2>Utilisateurs</h2>
        @if ($users->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucun utilisateur trouvé.</p>
        @endif

        <h2>Tontines</h2>
        @if ($tontines->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom de la Tontine</th>
                        <th>Fréquence</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tontines as $tontine)
                        <tr>
                            <td>{{ $tontine->nomtontine }}</td>
                            <td>{{ ucfirst($tontine->frequence) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Aucune tontine trouvée.</p>
        @endif
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des demandes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Prenom Utilisateur</th>
                <th>Nom Utilisateur</th>
                <th>Tontine</th>
                <th>Date de création</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demandes as $demande)
                <tr>
                    <td>{{ $demande->id }}</td>
                    <td>{{ $demande->users->prenom ?? 'Non défini' }}</td>
                    <td>{{ $demande->users->nom ?? 'Non défini' }}</td>

                    <td>{{ $demande->tontines->nom_tontine ?? 'Non défini' }}</td>
                    <td>{{ $demande->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@extends('appAdmi') <!-- Assurez-vous que votre layout est correct -->

{{-- sama bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('contenue')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Liste des Participants</h1>

    @if ($users->isEmpty())
        <p class="text-danger">Aucun utilisateur trouvé.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telephone }}</td>


                         <td>
                            <!-- Bouton pour rediriger vers la page des détails -->
                            <a href="{{ route('userdetails', $user->id) }}" class="btn btn-info btn-sm">
                                Info
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

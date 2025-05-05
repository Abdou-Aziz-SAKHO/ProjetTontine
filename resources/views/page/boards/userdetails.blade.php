@extends('app')


@section('contenue')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Détails pour {{ $user->prenom }} {{ $user->nom }}</h1>

    @if ($user->tontines->isEmpty())
        <p class="text-danger">Cet utilisateur ne participe à aucune tontine.</p>
    @else
        <h5>Tontines et Cotisations</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tontine</th>
                    <th>Montant Total des Cotisations</th>
                    <th> Date Dernière Cotisation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->tontines as $tontine)
                    <tr>

                        <td>
                            {{ $tontine->image->nomImage }}
                            {{-- {{ $tontine->cotisations->where('iduser', $user->id)->sum('montant') }} FCFA --}}
                        </td>
                        <td>
                            @if ($tontine->cotisations->where('iduser', $user->id)->isNotEmpty())
                                {{ $tontine->cotisations->where('iduser', $user->id)->sum('montant') }} FCFA
                            @else
                                Aucune cotisation
                            @endif
                        <td>
                            @if ($tontine->cotisations->where('iduser', $user->id)->isNotEmpty())
                                {{ $tontine->cotisations->where('iduser', $user->id)->last()->created_at->format('d/m/Y') }}
                            @else
                                Aucune cotisation
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('participants') }}" class="btn btn-secondary mt-3">Retour</a>
</div>

@endsection

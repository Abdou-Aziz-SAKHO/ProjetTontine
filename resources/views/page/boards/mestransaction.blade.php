@extends('app')

@section('contenue')

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Mes Transactions</h1>

    @if ($cotisations->isEmpty())
        <p class="text-danger">Vous n'avez effectué aucune cotisation.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom de la Tontine</th>
                    <th>Montant</th>
                    <th>Date de Cotisation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotisations as $cotisation)
                    <tr>
                        <td>{{ $cotisation->tontine->image->nomImage ?? 'Tontine inconnue' }}</td>
                        <td>{{ $cotisation->montant }} FCFA</td>
                        <td>{{ $cotisation->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

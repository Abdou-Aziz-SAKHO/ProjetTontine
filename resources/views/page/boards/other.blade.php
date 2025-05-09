@extends('app')

@section('contenue')
<link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">


{{-- sama bootstrap --}}

<link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css')}}" rel="stylesheet">

<div class="container">
    <h1 class="mb-4 text-center">Paiement pour la Tontine : {{ $tontine->nom }}</h1>

    <p><strong>Date de début :</strong> {{ $tontine->datedebut }}</p>
    <p><strong>Date de fin :</strong> {{ $tontine->datefin }}</p>
    <p><strong>Montant de base :</strong> {{ $tontine->montant_base }} FCFA</p>

    <form action="{{ route('cotisation.process', $tontine->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mode_paiement" class="form-label">Mode de Paiement</label>
            <select class="form-select" id="mode_paiement" name="mode_paiement" required>
                <option value="" disabled selected>Choisissez un mode de paiement</option>
                <option value="ESPECE">Carte Bancaire</option>
                <option value="WAVE">WAVE</option>
                <option value="OM">OM</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Confirmer le paiement</button>
    </form>
</div>
@endsection

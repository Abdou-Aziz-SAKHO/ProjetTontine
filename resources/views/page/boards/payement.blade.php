@extends('app')

<link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">

@section('contenue')
{{-- Chargement du bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h1 class="mb-4 text-center">Paiement pour la Tontine : {{ $tontine->nom }}</h1>

    <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($tontine->datedebut)->format('d/m/Y') }}</p>
    <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($tontine->datefin)->format('d/m/Y') }}</p>
    <p><strong>Montant de base :</strong> {{ $tontine->montant_base }} FCFA</p>

    {{-- Afficher les messages d'erreur ou de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Calculer et afficher la prochaine date de paiement --}}
    @php
        $nextPaymentDate = \Carbon\Carbon::now(); // Initialisation
        if ($tontine->frequence == 'hebdomadaire') {
            $nextPaymentDate = \Carbon\Carbon::parse($tontine->datedebut)->addWeek();
        } elseif ($tontine->frequence == 'mensuel') {
            $nextPaymentDate = \Carbon\Carbon::parse($tontine->datedebut)->addMonth();
        } elseif ($tontine->frequence == 'annuel') {
            $nextPaymentDate = \Carbon\Carbon::parse($tontine->datedebut)->addYear();
        }
    @endphp

    <p><strong>Prochain paiement prévu :</strong> {{ $nextPaymentDate->format('d/m/Y') }}</p>

    @if(\Carbon\Carbon::now()->greaterThanOrEqualTo($nextPaymentDate))
        <p>Il est maintenant temps de faire votre paiement.</p>
    @else
        <p>Votre prochain paiement sera effectué le {{ $nextPaymentDate->format('d/m/Y') }}.</p>
    @endif

    {{-- Formulaire de paiement --}}
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

    {{-- Ajouter un lien vers l'historique des paiements (optionnel) --}}
    <div class="mt-3 text-center">
        <a href="{{ route('tontines.history', $tontine->id) }}" class="btn btn-secondary">Voir l'historique des paiements</a>
    </div>
</div>

<script>
    // Confirmation avant la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function (e) {
        if (!confirm('Êtes-vous sûr de vouloir effectuer ce paiement ?')) {
            e.preventDefault();
        }
    });
</script>
@endsection

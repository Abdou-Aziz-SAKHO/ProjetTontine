<!-- filepath: c:\Users\TECRA\Documents\testLaravel\ProjetTontine\resources\views\page\boards\mestontines.blade.php -->

@extends('app') <!-- Assurez-vous que votre layout est correct -->

@section('contenue')

 {{-- sama bootstrap --}}
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">




 <div class="container">
    <h1 class="mb-4 text-center">Mes Tontines</h1>

    @if($tontines->isEmpty())
        <p class="text-center">Vous n'avez participé à aucune tontine pour le moment.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nom</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Montant Total</th>
                    <th>Montant de base</th>
                    <th>Nbre de Participants max</th>
                    <th>Nbre de Participants actuel</th>
                    <th>Fréquence</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tontines as $tontine)
                    <tr>
                        <td>{{ $tontine->nom }}</td>
                        <td>{{ $tontine->datedebut }}</td>
                        <td>{{ $tontine->datefin }}</td>
                        <td>{{ $tontine->montant_total }}</td>
                        <td>{{ $tontine->montant_base }}</td>
                        <td>{{ $tontine->nbreParticipant }}</td>
                        <td>{{ $tontine->participants_count }}</td>
                        <td>{{ $tontine->frequence }}</td>
                        <td>
                            <!-- Bouton Se retirer -->
                            @if($tontine->datedebut > Carbon\Carbon::now())
                                <form action="{{ route('tontines_seRetirer', $tontine->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vous retirer de cette tontine ?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Se retirer</button>
                                </form>
                            @else
                                <!-- Bouton Paiement -->
                                <a href="{{ route('tontines_cotisation', $tontine->id) }}" class="btn btn-success btn-sm">Paiement</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>
@endsection

<!-- filepath: c:\Users\TECRA\Documents\testLaravel\ProjetTontine\resources\views\page\boards\Tontine.blade.php -->

@extends('app') <!-- Assurez-vous que votre layout est correct -->

@section('contenue')
 <!-- Ajoutez le script Bootstrap JS si ce n'est pas déjà fait -->
 <script src="(https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 {{-- sama bootstrap --}}
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



<div class="container">
    <h1 class="mb-4 text-center">Liste des Tontines Programmees</h1>
    </h1>

    @if($tontines->isEmpty())
        <p class="text-center">Aucune tontine active pour le moment.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>numero</th>
                    <th>Nom</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Montant Total</th>
                    <th>Montant de base</th>
                    <th>Nombre de Participants </th>
                    <th>Fréquence</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tontines as $tontine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tontine->nom_tontine}}</td>
                        <td>{{ $tontine->datedebut }}</td>
                        <td>{{ $tontine->datefin }}</td>
                        <td>{{ $tontine->montant_Total }}</td>
                        <td>{{ $tontine->montant_base }}</td>
                        <td>{{ $tontine->nbreParticipant }}</td>
                        <td>{{ $tontine->frequence }}</td>
                        <td>
                            <!-- Bouton Participer -->
                            <form action="{{ route('tontines_participer', $tontine->id) }}" method="POST" id="participationForm-{{ $tontine->id }}">
                                @csrf
                                <button type="button" class="btn btn-primary btn-sm" onclick="openConfirmationModal({{ $tontine->id }})">Participer</button>
                            </form>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <!-- Modale de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de Participation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir participer à cette tontine ?</p>
                <p>Veuillez accepter les conditions pour continuer.</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="acceptConditions">
                    <label class="form-check-label" for="acceptConditions">
                        J'accepte les <a href="#">conditions générales</a>.
                    </label>
                </div>
                <input type="hidden" id="modalCniInput" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmParticipationButton" disabled>Confirmer</button>
            </div>
        </div>
    </div>
</div>

    <!-- Fin de la modale -->



<script>
    let currentTontineId = null;

    function openConfirmationModal(tontineId) {
        currentTontineId = tontineId;

        // Réinitialiser la modale
        document.getElementById('acceptConditions').checked = false;
        document.getElementById('confirmParticipationButton').disabled = true;

        // Afficher la modale
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    }

    // Activer le bouton "Confirmer" si les conditions sont acceptées
    document.getElementById('acceptConditions').addEventListener('change', function () {
        document.getElementById('confirmParticipationButton').disabled = !this.checked;
    });

    // Gérer la confirmation de participation
    document.getElementById('confirmParticipationButton').addEventListener('click', function () {
        // Soumettre le formulaire correspondant
        document.getElementById(`participationForm-${currentTontineId}`).submit();
    });
</script>
</div>
@endsection

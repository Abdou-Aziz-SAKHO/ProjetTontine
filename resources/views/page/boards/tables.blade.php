@extends('app')

@section('contenue')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid my-5">
    <h1 class="text-center mb-5" style="font-family: 'Georgia', serif; font-weight: bold; color: #4b4874;">NATTE</h1>

    <!-- Deuxième partie -->
    <div class="row align-items-center mb-5 p-5" style="background-color: #e9ecef;">
        <div class="col-md-6 order-md-2">
            <h2 class="text-success" style="font-family: 'Arial', sans-serif; font-weight: bold;">Rencontrez l'équipe de Développeurs !</h2>
            <p style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                Notre équipe forme Breudeu yii, un ensemble de jeunes étudiants sénégalais talentueux en programmation,
                marketing, sécurité informatique, infographie et finance.
                Nous sommes engagés dans l’exploration des dernières avancées technologiques,
                de l’intelligence artificielle, de la cybersécurité et du secteur financier pour soutenir
                également Natte.
            </p>
        </div>
        <div class="col-md-6 text-center order-md-1">
            <img src="{{ asset('img/logouadb.jpg') }}" alt="Notre Équipe" class="img-fluid rounded" style="max-width: 400px;">
        </div>
    </div>

    <!-- Première partie -->
    <div class="row align-items-center mb-5 p-5" style="background-color: #f8f9fa;">
        <div class="col-md-6">
            <h2 class="text-primary" style="font-family: 'Arial', sans-serif; font-weight: bold;">Notre Vision</h2>
            <h3 class="text" style="font-family: 'Georgia', serif; font-style: italic; color: #7f8c8d;">Vers une Souveraineté Financière pour Tous en Afrique en partant du Sénégal</h3>
            <p style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                Notre vision est de devenir la plateforme de référence pour la gestion des tontines en Afrique.
                Nous aspirons à transformer la manière dont les gens perçoivent et utilisent les tontines,
                en les rendant accessibles, transparentes et sécurisées.
                Nous croyons fermement que la technologie peut jouer un rôle clé dans l'amélioration de la vie financière des individus.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('img/vision.png') }}" alt="Notre Vision" class="img-fluid rounded" style="max-width: 400px;">
        </div>
    </div>

    <!-- Deuxième slide de mission -->
    <div class="row align-items-center mb-5 p-5" style="background-color: #f8f9fa;">
        <div class="col-md-6 text-center order-md-1">
            <img src="{{ asset('img/mission.png') }}" alt="Notre Mission" class="img-fluid rounded" style="max-width: 400px;">
        </div>
        <div class="col-md-6 order-md-2">
            <h2 class="text-danger" style="font-family: 'Arial', sans-serif; font-weight: bold;">Notre Mission</h2>
            <h3 class="text" style="font-family: 'Georgia', serif; font-style: italic; color: #7f8c8d;">Épargnez pour réaliser vos rêves !</h3>
            <p style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                Notre mission est de faciliter l'accès aux tontines pour tous, en offrant une plateforme sécurisée et conviviale.
                Nous voulons permettre à chacun de participer à des tontines, de gérer ses finances et d'atteindre ses objectifs
                financiers grâce à la solidarité et à la confiance.
            </p>
        </div>
    </div>

    <!-- Troisième partie -->
    <div class="row align-items-center mb-5 p-5" style="background-color: #f1f3f5;">
        <div class="col-md-6">
            <h2 class="text-warning" style="font-family: 'Arial', sans-serif; font-weight: bold;">Nos Valeurs</h2>
            <p style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                Nous croyons en l'intégrité, la transparence et l'innovation. Ces valeurs guident toutes nos actions
                et nous permettent de bâtir une relation de confiance avec nos utilisateurs.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('img/valeur.png') }}" alt="Nos Valeurs" class="img-fluid rounded" style="max-width: 400px;">
        </div>
    </div>

    <!-- Quatrième partie : Contacts et Collaborations -->
    <div class="row align-items-center mb-5 p-5" style="background-color: #181a1d;">
        <div class="col-md-6">
            <h2 class="text-primary" style="font-family: 'Arial', sans-serif; font-weight: bold;">Contacts et Collaborations</h2>
            <p style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                Vous souhaitez collaborer avec nous ou avez des questions ? N'hésitez pas à nous contacter via les informations ci-dessous.
            </p>
            <ul style="font-family: 'Verdana', sans-serif; font-size: 1.1rem; color: #34495e;">
                <li><strong>Email :</strong> tontine2025@gmail.com</li>
                <li><strong>Téléphone :</strong> +221 33 123 45 67</li>
                <li><strong>Adresse :</strong> Bambey, Sénégal</li>
            </ul>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscription - Dalaal ak Jamm</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body style="background-color: #f2f2f5;"> <!-- Changement de la couleur de l'arrière-plan -->

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;"> <!-- Centrage vertical et horizontal -->
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    <div class="row">
                        <!-- Left Section: Image and Text -->
                        <div class="col-lg-6 d-flex align-items-center justify-content-center" style="background-color: #f2f2f5;">
                            <div class="text-center p-4">
                                <img src="{{ asset('img/logo.png') }}" alt="Register Image" class="img-fluid mb-4" style="max-width: 300px;">
                                <h3 class="text-primary" style="font-family: 'Arial', sans-serif; font-weight: bold;">Rejoignez-nous dès maintenant !</h3>
                                <p style="font-family: 'Verdana', sans-serif; font-size: 1rem; color: #34495e;">
                                    Inscrivez-vous pour accéder à votre espace personnel et commencer à gérer vos tontines en toute simplicité.
                                </p>
                            </div>
                        </div>

                        <!-- Right Section: Registration Form -->
                        <div class="col-lg-6" style="background-color: #ffffff;">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Inscrivez Vous </h1>
                                </div>
                                <form class="user" method="post" action="{{ route('Inscription_register') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" name="prenom" id="Prenom" placeholder="Prénom" value="{{ old('prenom') }}">
                                            @error('prenom')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" name="nom" id="Nom" placeholder="Nom" value="{{ old('nom') }}">
                                            @error('nom')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="Email" placeholder="Email" value="{{ old('email') }}">
                                        @error('email')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="telephone" id="tel" placeholder="Téléphone" value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="cni" id="cni" placeholder="Numéro de CNI" value="{{ old('cni') }}">
                                        @error('cni')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="Adresse" id="Adresse" placeholder="Adresse" value="{{ old('Adresse') }}">
                                        @error('Adresse')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control form-control-user" name="dateNaissance" id="naissance" placeholder="Date de naissance" value="{{ old('dateNaissance') }}">
                                        @error('dateNaissance')
                                            <small style="color: red">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" name="password" id="Password" placeholder="Mot de passe">
                                            @error('password')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" name="password_confirmation" id="RepeatPassword" placeholder="Confirmer le mot de passe">
                                            @error('password_confirmation')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        S'inscrire
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/connexion">Vous avez déjà un compte ? Connectez-vous !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>

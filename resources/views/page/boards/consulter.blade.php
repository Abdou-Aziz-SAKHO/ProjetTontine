<!-- filepath: c:\Users\USER\Desktop\git\ProjetTontine\resources\views\page\boards\consulter.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Consulter une Tontine</title>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layout.sidebarAdmi')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layout.navbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Liste des Tontines</h1>
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nom de la Tontine</th>
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tontines as $tontine)
                                <tr>
                                    <td>{{ $tontine->nomtontine }}</td>
                                    <td>{{ $tontine->datedebut }}</td>
                                    <td>{{ $tontine->datefin }}</td>
                                    <td>
                                        <a href="{{ route('tontines.show', $tontine->id) }}" class="btn btn-info">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @include('layout.footer')
        </div>
    </div>
</body>

</html>
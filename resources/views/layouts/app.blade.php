<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ton CSS ici -->
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
            <li><a href="{{ route('demandes.index') }}">Demandes</a></li>
            <li><a href="">Agents</a></li>
            <li><a href="#">Utilisateurs</a></li>
            <li><a href="{{ route('reclamations.index') }}">Réclamations</a></li>
            <li><a href="{{ route('infoattestation.index') }}">Attestations</a></li>
            <li><a href="#">Notifications</a></li>
        </ul>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>

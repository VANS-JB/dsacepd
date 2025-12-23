<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <header>
        <h1>Services DSA</h1>
        <nav>
            <a href="{{ route('welcome') }}">Accueil</a>
            <a href="{{ route('register') }}">Créer un compte</a>
            <a href="{{ route('login') }}">Se connecter</a>
        
        </nav>

        <div class="user-info">
            @auth
              
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            @endauth
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>

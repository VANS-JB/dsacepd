<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <header>
        <div><svg width="50" height="50" viewBox="0 0 200 200"
     xmlns="http://www.w3.org/2000/svg">

    <!-- Fond bleu avec coins arrondis -->
    <rect x="0" y="0" width="200" height="200" rx="40" ry="40"
          fill="#2563EB"/>

    <!-- Chapeau de diplômé -->
    <polygon points="100,45 35,80 100,115 165,80"
             fill="#FFFFFF"/>

    <!-- Base du chapeau -->
    <path d="M60 95 v30 c0 15 80 15 80 0 v-30 l-40 20 z"
          fill="#FFFFFF"/>

    <!-- Pampille -->
    <rect x="160" y="80" width="8" height="45"
          fill="#FFFFFF"/>
</svg>
</div>
        <h1 style="position: absolute; left: 120px;">DSACEPD</h1>
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

    <footer>
    <div class="footer-content">
        <div class="footer-section">
            <div><svg width="50" height="50" viewBox="0 0 200 200"
     xmlns="http://www.w3.org/2000/svg">

    <!-- Fond bleu avec coins arrondis -->
    <rect x="0" y="0" width="200" height="200" rx="40" ry="40"
          fill="#2563EB"/>

    <!-- Chapeau de diplômé -->
    <polygon points="100,45 35,80 100,115 165,80"
             fill="#FFFFFF"/>

    <!-- Base du chapeau -->
    <path d="M60 95 v30 c0 15 80 15 80 0 v-30 l-40 20 z"
          fill="#FFFFFF"/>

    <!-- Pampille -->
    <rect x="160" y="80" width="8" height="45"
          fill="#FFFFFF"/>
</svg></div>
            <h3>DSA‑CEPD</h3>
            <p>Plateforme numérique de demande et suivi d’attestation CEPD, effectuer vos demandes en ligne, suivre leur traitement et obtenir vos attestations rapidement et en toute sécurité.</p>
        </div>

        <div class="footer-section">
            <h4>Navigation</h4>
            <nav>
                <a href="{{ route('welcome') }}">Accueil</a> |
                <a href="{{ route('register') }}">Créer un compte</a> |
                <a href="{{ route('login') }}">Se connecter</a>
            </nav>
        </div>

        <div class="footer-section">
            <h4>Contact</h4>
            <p>Email : support@dsa-cepd.tg</p>
            <p>Téléphone : +228 92 77 76 21</p>
            <p>Adresse : Direction Régionale de l’Éducation, Lomé</p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 DSA‑CEPD. Tous droits réservés.</p>
    </div>
</footer>
    
</body>
</html>

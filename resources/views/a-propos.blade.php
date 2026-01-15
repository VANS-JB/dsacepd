@extends('layouts.site')

@section('title', 'À propos')

@section('content')
<div class="about-container">

    <h1>À propos de la plateforme DSACEPD</h1>

    <p class="about-intro">
        La plateforme officielle des attestations DSACEPD est un service numérique
        conçu pour faciliter l’accès aux attestations du Certificat d’Études
        Primaires et Élémentaires (CEPD), en toute sécurité et transparence.
    </p>

    <div class="about-section">
        <h2> Notre mission</h2>
        <p>
            Notre mission est de simplifier les démarches administratives liées
            aux attestations CEPD en offrant une solution en ligne rapide,
            fiable et accessible à tous, sans déplacement inutile.
        </p>
    </div>

    <div class="about-section">
        <h2> Notre vision</h2>
        <p>
            Nous aspirons à une administration éducative moderne, digitale et
            efficace, mettant la technologie au service des citoyens et de
            l’amélioration continue des services publics.
        </p>
    </div>

    <div class="about-section">
        <h2> Fonctionnalités principales</h2>
        <ul>
            <li>Demande d’attestation CEPD en ligne</li>
            <li>Suivi en temps réel de l’état des demandes</li>
            <li>Réduction des délais de traitement</li>
            <li>Sécurisation des données personnelles</li>
            <li>Accès simple via ordinateur ou smartphone</li>
        </ul>
    </div>

    <div class="about-section">
        <h2> Pourquoi choisir notre plateforme ?</h2>
        <p>
            Grâce à une interface intuitive et un processus automatisé,
            la plateforme DSACEPD permet aux usagers de gagner du temps,
            d’éviter les files d’attente et d’obtenir des informations
            claires à chaque étape de leur demande.
        </p>
    </div>

</div>
@endsection

<style>

    .about-container {
    max-width: 900px;
    margin: 60px auto;
    background: linear-gradient(180deg, #ffffff, #f9fbff);
    padding: 55px 60px;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
    font-family: "Segoe UI", Tahoma, sans-serif;
    animation: fadeIn 0.8s ease-in-out;
}

/* Animation douce */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Titre principal */
.about-container h1 {
    text-align: center;
    color: #1f2d3d;
    margin-bottom: 30px;
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 0.5px;
}

/* Introduction */
.about-intro {
    text-align: center;
    color: #555;
    font-size: 17px;
    line-height: 1.9;
    margin-bottom: 45px;
    max-width: 750px;
    margin-left: auto;
    margin-right: auto;
}

/* Sections */
.about-section {
    background: #ffffff;
    border-radius: 14px;
    padding: 28px 30px;
    margin-bottom: 30px;
    border-left: 6px solid #007BFF;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
}

.about-section:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* Titres des sections */
.about-section h2 {
    color: #007BFF;
    margin-bottom: 12px;
    font-size: 21px;
    font-weight: 600;
}

/* Texte */
.about-section p {
    color: #444;
    line-height: 1.9;
    font-size: 15.5px;
}

/* Liste */
.about-section ul {
    padding-left: 22px;
    margin-top: 10px;
}

.about-section ul li {
    margin-bottom: 12px;
    color: #444;
    font-size: 15px;
    position: relative;
}

/* Responsive */
@media (max-width: 768px) {
    .about-container {
        padding: 35px 25px;
    }

    .about-container h1 {
        font-size: 24px;
    }

    .about-intro {
        font-size: 16px;
    }
}

</style>

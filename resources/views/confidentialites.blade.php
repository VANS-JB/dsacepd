@extends('layouts.site')

@section('title', 'Politique de confidentialité')

@section('content')
<div class="privacy-container">

    <h1>Politique de confidentialité et protection des données</h1>

    <p class="privacy-intro">
        La présente politique de confidentialité explique comment la plateforme
        officielle des attestations CEPD collecte, utilise, protège et gère les
        données personnelles des utilisateurs, conformément aux règles en vigueur.
    </p>

    <div class="privacy-section">
        <h2> Accès et sécurité des données</h2>
        <p>
            L’accès aux données personnelles est strictement limité aux agents
            autorisés dans le cadre du traitement des demandes d’attestations CEPD.
            Des mesures de sécurité techniques et organisationnelles sont mises en
            place afin de prévenir tout accès non autorisé, perte ou altération
            des informations.
        </p>
    </div>

    <div class="privacy-section">
        <h2> Données collectées</h2>
        <p>
            Les données collectées via la plateforme comprennent notamment :
        </p>
        <ul>
            <li>Nom et prénoms</li>
            <li>Adresse email</li>
            <li>Informations liées à l’attestation demandée</li>
            <li>Données nécessaires au suivi des demandes</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2> Utilisation des données</h2>
        <p>
            Les données personnelles sont utilisées exclusivement pour :
        </p>
        <ul>
            <li>Le traitement des demandes d’attestations CEPD</li>
            <li>La communication avec les usagers</li>
            <li>L’amélioration continue du service</li>
            <li>Le respect des obligations administratives</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2> Partage des données</h2>
        <p>
            Les données personnelles ne sont ni vendues, ni cédées à des tiers.
            Elles peuvent toutefois être partagées avec des services administratifs
            compétents lorsque cela est requis par la réglementation.
        </p>
    </div>

    <div class="privacy-section">
        <h2> Conservation des données</h2>
        <p>
            Les données sont conservées pendant la durée strictement nécessaire
            au traitement des demandes et conformément aux exigences légales
            et réglementaires en vigueur.
        </p>
    </div>

    <div class="privacy-section">
        <h2> Droits des utilisateurs</h2>
        <p>
            Conformément aux règles de protection des données, les utilisateurs
            disposent des droits suivants :
        </p>
        <ul>
            <li>Droit d’accès à leurs données personnelles</li>
            <li>Droit de rectification des informations inexactes</li>
            <li>Droit à la limitation ou à la suppression des données</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2> Contact</h2>
        <p>
            Pour toute question relative à la protection des données personnelles
            ou à l’exercice de vos droits, vous pouvez nous contacter via la page
            <strong>Contact</strong> de la plateforme.
        </p>
    </div>

</div>
@endsection

<style>

    .privacy-container {
    max-width: 950px;
    margin: 60px auto;
    background: linear-gradient(180deg, #ffffff, #f7faff);
    padding: 55px 60px;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
    font-family: "Segoe UI", Tahoma, sans-serif;
    animation: fadeIn 0.8s ease-in-out;
}

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

.privacy-container h1 {
    text-align: center;
    color: #1f2d3d;
    margin-bottom: 30px;
    font-size: 28px;
    font-weight: 700;
}

.privacy-intro {
    text-align: center;
    color: #555;
    font-size: 16.5px;
    line-height: 1.9;
    margin-bottom: 45px;
    max-width: 780px;
    margin-left: auto;
    margin-right: auto;
}

.privacy-section {
    background: #ffffff;
    border-radius: 14px;
    padding: 28px 30px;
    margin-bottom: 30px;
    border-left: 6px solid #007BFF;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.privacy-section h2 {
    color: #007BFF;
    margin-bottom: 12px;
    font-size: 20px;
    font-weight: 600;
}

.privacy-section p {
    color: #444;
    line-height: 1.9;
    font-size: 15.5px;
}

.privacy-section ul {
    padding-left: 22px;
    margin-top: 10px;
}

.privacy-section ul li {
    margin-bottom: 12px;
    color: #444;
    font-size: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .privacy-container {
        padding: 35px 25px;
    }

    .privacy-container h1 {
        font-size: 24px;
    }

    .privacy-intro {
        font-size: 15.5px;
    }
}

</style>

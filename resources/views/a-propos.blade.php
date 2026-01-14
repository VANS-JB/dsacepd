@extends('layouts.site')

@section('title', 'À propos')

@section('content')
<div class="about-page">
    <h1>À propos</h1>

    <section class="intro">
        <p>
            Bienvenue sur notre plateforme. Notre mission est de moderniser les services administratifs 
            et de faciliter l’accès aux démarches pour tous les citoyens.
        </p>
    </section>

    <section class="vision">
        <h2>Notre vision</h2>
        <p>
            Nous croyons en une administration transparente, inclusive et efficace. 
            Grâce au numérique, nous voulons réduire les barrières et améliorer l’expérience des utilisateurs.
        </p>
    </section>

    <section class="team">
        <h2>Notre équipe</h2>
        <p>
            Une équipe passionnée de développeurs, designers et responsables projets, 
            engagés pour l’innovation sociale et la transformation digitale au Togo.
        </p>
    </section>

    <section class="contact">
        <h2>Nous contacter</h2>
        <p>
            Pour toute question ou suggestion, rendez-vous sur la page <a href="{{ route('contact.form') }}">Contact</a>.
        </p>
    </section>
</div>
@endsection

<style>
.about-page {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px;
    font-family: Arial, sans-serif;
    line-height: 1.6;
}
.about-page h1 {
    text-align: center;
    margin-bottom: 30px;
}
.about-page h2 {
    margin-top: 20px;
    color: #2c3e50;
}
.about-page p {
    margin-bottom: 15px;
}
</style>
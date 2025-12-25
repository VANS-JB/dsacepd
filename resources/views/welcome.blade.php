@extends('layouts.site')

@section('title', 'Accueil - Services DSA')

@section('content')

   
    <h1>Bienvenue sur la plateforme officielle des attestations CEPD</h1>
    
    <div class="services">
        <div class="service-box">
            <h3>Faire une demande</h3>
            <p>Soumettez votre relevé et acte de naissance pour demander votre attestation.</p>
            <a href="{{ route('demandeur.demande') }}">Commencer</a>
        </div>

        <div class="service-box">
            <h3>Suivre ma demande</h3>
            <p>Consultez le statut de votre demande en temps réel.</p>
            <a href="{{ route('demandeur.suivi') }}">Suivre</a>
        </div>

        <div class="service-box">
            <h3>Faire une réclamation</h3>
            <p>Signalez un problème ou une erreur concernant votre demande.</p>
            {{-- Si $demande existe, on passe l'id ; sinon on propose un lien de secours (inscription) --}}
            @if(isset($demande) && $demande)
                <a href="{{ route('demandeur.reclamation', ['demandeId' => $demande->id]) }}">Réclamer</a>
            @else
                <a href="{{ route('register') }}">Réclamer</a>
            @endif
        </div>
    </div>

    <h2>Comment ça marche ?</h2>
    <ol>
        <li>Faire la demande</li>
        <li>Traitement</li>
        <li>Validation</li>
        <li>Récupération</li>
    </ol>

    <h2>Questions - Réponses</h2>
    <ul>
        <li>⏱ Combien de temps faut-il pour obtenir mon attestation ?</li>
        <li>📄 Dois-je fournir des pièces justificatives ?</li>
        <li>🔍 Comment puis-je suivre ma demande ?</li>
        <li>❗ Que faire s’il y a un problème avec ma demande ?</li>
    </ul>

   
@endsection
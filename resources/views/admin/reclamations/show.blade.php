@extends('layouts.app')

@section('title', 'Détail réclamation')

@section('content')
    <h1>Détail de la réclamation</h1>

    <p><strong>Objet :</strong> {{ $reclamation->objet }}</p>
    <p><strong>Message :</strong> {{ $reclamation->message }}</p>
    <p><strong>Demandeur :</strong> {{ $reclamation->demande->user->name }} ({{ $reclamation->demande->user->email }})</p>
    <p><strong>Date :</strong> {{ $reclamation->created_at->format('Y-m-d H:i') }}</p>

    <a href="{{ route('reclamations.index') }}">Retour à la liste</a>
@endsection

<style>

    /* ================= DÉTAIL RÉCLAMATION ================= */

.main-content h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 25px;
}

/* CONTENEUR DU DÉTAIL */
.main-content p {
    background: #ffffff;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 15px;
    font-size: 14px;
    color: #374151;
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
}

/* TITRES DES CHAMPS */
.main-content p strong {
    display: inline-block;
    min-width: 100px;
    color: #1f2937;
}

/* MESSAGE (contenu long) */
.main-content p:nth-child(3) {
    line-height: 1.6;
}

/* BOUTON RETOUR */
.main-content a {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 18px;
    background: #1f6bff;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.main-content a:hover {
    background: #1e40af;
    transform: translateY(-1px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .main-content p strong {
        display: block;
        margin-bottom: 6px;
    }
}
</style>
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
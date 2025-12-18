@extends('layouts.app')
@section('title', 'Modifier demande')

@section('content')
<h1>Modifier la demande #{{ $demande->id }}</h1>

<form method="POST" action="{{ route('admin.demandes.update', $demande->id) }}">
    @csrf
    @method('PUT')

    <label>Statut :</label>
    <select name="statut">
        <option value="en attente" {{ $demande->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
        <option value="validée" {{ $demande->statut == 'validée' ? 'selected' : '' }}>Validée</option>
        <option value="rejetée" {{ $demande->statut == 'rejetée' ? 'selected' : '' }}>Rejetée</option>
    </select><br><br>

    <button type="submit">Mettre à jour</button>
</form>
@endsection
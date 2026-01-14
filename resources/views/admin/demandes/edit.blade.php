@extends('layouts.app')

@section('title', 'Modifier demande')

@section('content')
<h1>Modifier la demande</h1>

<form method="POST" action="{{ route('demandes.update', $demande->id) }}">
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

<style>

    /* Titre */
.page-title,
h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #1e293b;
    font-size: 26px;
}

/* Conteneur du formulaire */
.form-container,
form {
    max-width: 500px;
    margin: auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

/* Labels */
form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #334155;
}

/* Select */
form select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
}

form select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
}

/* Bouton */
form button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

form button:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 600px) {
    form {
        padding: 20px;
    }

    h1 {
        font-size: 22px;
    }
}

</style>
@endsection
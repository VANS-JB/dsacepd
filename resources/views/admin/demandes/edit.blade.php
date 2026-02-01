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

    :root {
    --admin-blue: #1f3a5f;
    --admin-blue-dark: #162b46;
    --border-light: #e5e7eb;
    --text-main: #111827;
    --text-muted: #6b7280;
}


  /* ================= PAGE MODIFIER DEMANDE ================= */

/* TITRE */
.main-content h1 {
    text-align: center;
    margin-bottom: 28px;
    font-size: 22px;
    font-weight: 600;
    color: var(--text-main);
}

/* FORMULAIRE */
.main-content form {
    max-width: 480px;
    margin: 0 auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 10px;
    border: 1px solid var(--border-light);
}

/* LABEL */
.main-content form label {
    display: block;
    margin-bottom: 6px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
}

/* SELECT */
.main-content form select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    color: var(--text-main);
    background: #ffffff;
}

/* FOCUS */
.main-content form select:focus {
    outline: none;
    border-color: var(--admin-blue);
    box-shadow: 0 0 0 2px rgba(31, 58, 95, 0.15);
}

/* BOUTON */
.main-content form button {
    margin-top: 22px;
    width: 100%;
    padding: 12px;
    background: var(--admin-blue);
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
}

.main-content form button:hover {
    background: var(--admin-blue-dark);
}

/* RESPONSIVE */
@media (max-width: 600px) {
    .main-content form {
        padding: 20px;
    }

    .main-content h1 {
        font-size: 20px;
    }
}


</style>
@endsection

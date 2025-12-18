@extends('layouts.app')

@section('title', 'Gestion des demandes')

@section('content')
    <h1>Gestion des demandes</h1>

    <!-- Filtres de recherche -->
    <form method="GET" action="{{ route('demandes.index') }}">
        <input type="text" name="search" placeholder="Nom ou type de demande">
        <select name="statut">
            <option value="">-- Statut --</option>
            <option value="en attente">En attente</option>
            <option value="validée">Validée</option>
            <option value="rejetée">Rejetée</option>
        </select>
        <select name="agent">
            <option value="">-- Agent --</option>
            <!-- Exemple dynamique -->
            @foreach($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
            @endforeach
        </select>
        <input type="date" name="date">
        <button type="submit">Filtrer</button>
        <a href="{{ route('demandes.create') }}">Nouvelle demande</a>
    </form>

    <!-- Tableau des demandes -->
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Demandeur</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->reference }}</td>
                    <td>
                        {{ optional($demande->user)->name ?? 'Utilisateur supprimé' }}<br>
                        {{ optional($demande->user)->email ?? '—' }}
                    </td>
                    <td>{{ $demande->type ?? '—' }}</td>
                    <td>{{ ucfirst($demande->statut ?? 'en attente') }}</td>
                    <td>{{ optional($demande->created_at)->format('Y-m-d') ?? '' }}</td>
                    <td>
                        <a href="{{ route('demandes.show', $demande->id) }}">Voir</a> |
                        <a href="{{ route('demandes.edit', $demande->id) }}">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucune demande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

<style>

    /* ================= PAGE TITLE ================= */
.main-content h1 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
}

/* ================= FILTER FORM ================= */
.main-content form {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    margin-bottom: 25px;
}

.main-content form input,
.main-content form select {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    background: #fff;
}

.main-content form input:focus,
.main-content form select:focus {
    outline: none;
    border-color: #1f6bff;
}

/* Boutons */
.main-content form button {
    background: #1f6bff;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
}

.main-content form a {
    background: #f0f3ff;
    color: #1f6bff;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
}

/* ================= TABLE ================= */
table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

thead {
    background: #f3f5f9;
}

thead th {
    padding: 14px;
    font-size: 13px;
    text-align: left;
    color: #555;
}

tbody td {
    padding: 14px;
    font-size: 14px;
    border-top: 1px solid #eee;
}

tbody tr:hover {
    background: #f9fbff;
}

/* ================= STATUT BADGES ================= */
tbody td:nth-child(4) {
    font-weight: 600;
}

tbody td:nth-child(4)::before {
    content: "● ";
}

tbody td:nth-child(4):contains("en attente") {
    color: #f59e0b;
}

tbody td:nth-child(4):contains("validée") {
    color: #16a34a;
}

tbody td:nth-child(4):contains("rejetée") {
    color: #dc2626;
}

/* ================= ACTION LINKS ================= */
tbody td a {
    color: #1f6bff;
    text-decoration: none;
    font-size: 13px;
}

tbody td a:hover {
    text-decoration: underline;
}

/* ================= EMPTY STATE ================= */
tbody tr td[colspan] {
    text-align: center;
    padding: 30px;
    color: #777;
}

</style>
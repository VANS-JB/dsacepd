@extends('layouts.app')
@section('title', 'Liste des demandes')

@section('content')
<h1>Demandes enregistrées</h1>

<a href="{{ route('demandes.create') }}">➕ Nouvelle demande</a>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<!-- Formulaire de recherche -->
<form method="GET" action="{{ route('demandes.index') }}" style="margin:20px 0; display:flex; gap:15px; align-items:center;">
    <input type="text" name="search" placeholder="Nom du demandeur" value="{{ request('search') }}">
    <label>Date début :</label>
    <input type="date" name="date_debut" value="{{ request('date_debut') }}">
    <label>Date fin :</label>
    <input type="date" name="date_fin" value="{{ request('date_fin') }}">
    <button type="submit">🔍 Filtrer</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($demandes as $demande)
            <tr>
                <td>{{ $demande->id }}</td>
                <td>{{ $demande->user->name }}</td>
                <td>{{ $demande->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('demandes.edit', $demande->id) }}">✏️ Modifier</a>
                    <form  action="{{ route('demandes.destroy', $demande->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                       <span> <button class="btn btn-danger" type="submit" onclick="return confirm('Supprimer cette demande ?')">🗑 Supprimer</button> </span>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Aucune demande trouvée.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $demandes->appends(request()->query())->links() }}
@endsection

<style>

   /* ================= PAGE DEMANDES ================= */

/* TITRE */
.main-content h1 {
    font-size: 28px;
    color: #1f6bff;
    font-weight: 700;
    margin-bottom: 20px;
}

/* BOUTON NOUVELLE DEMANDE */
.main-content > a {
    display: inline-block;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.main-content > a:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(31,107,255,0.4);
}

/* MESSAGE SUCCESS */
div[style*="color:green"] {
    background: #d1fae5;
    color: #065f46;
    padding: 12px 16px;
    border-radius: 10px;
    font-weight: 600;
    margin-bottom: 20px;
    max-width: 600px;
}

/* ================= FORMULAIRE FILTRE ================= */
form[action*="demandes"] {
    background: #ffffff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    flex-wrap: wrap;
}

form[action*="demandes"] label {
    font-size: 13px;
    font-weight: 600;
    color: #4b5563;
}

form[action*="demandes"] input {
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    font-size: 14px;
}

form[action*="demandes"] input:focus {
    outline: none;
    border-color: #1f6bff;
    box-shadow: 0 0 0 3px rgba(31,107,255,0.15);
}

form[action*="demandes"] button {
    background: #1f6bff;
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.2s ease, transform 0.2s ease;
}

form[action*="demandes"] button:hover {
    background: #3b82f6;
    transform: translateY(-2px);
}

/* ================= TABLE ================= */
.main-content table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.main-content thead {
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
}

.main-content th {
    padding: 14px 16px;
    font-size: 14px;
    font-weight: 600;
    text-align: left;
}

.main-content td {
    padding: 13px 16px;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
}

.main-content tbody tr:hover {
    background: #f3f4f6;
}

/* ================= ACTIONS ================= */
.main-content td:last-child {
    white-space: nowrap;
}

/* Bouton Modifier */
.main-content td a {
    display: inline-block;
    background: #e0e7ff;
    color: #1f6bff;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.2s ease;
}

.main-content td a:hover {
    background: #c7d2fe;
    transform: translateY(-1px);
}

/* Bouton Supprimer */
.main-content td form {
    display: inline-block;
    margin-left: 6px;
}

.main-content td form button {
    background: #fee2e2;
    color: #dc2626;
    border: none;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
}

.main-content td form button:hover {
    background: #fecaca;
    transform: translateY(-1px);
}

/* ================= PAGINATION ================= */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 25px;
    gap: 6px;
}

.pagination li {
    list-style: none;
}

.pagination a,
.pagination span {
    padding: 8px 14px;
    background: #ffffff;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    text-decoration: none;
    font-size: 14px;
    color: #1f6bff;
    font-weight: 500;
}

.pagination .active span {
    background: #1f6bff;
    color: #ffffff;
    border-color: #1f6bff;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    form[action*="demandes"] {
        flex-direction: column;
        align-items: stretch;
    }
}

</style>
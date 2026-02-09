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
                    <div class="actions">
                        <a href="{{ route('demandes.edit', $demande->id) }}" class="edit">✏️ Modifier</a>
                        <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">🗑 Supprimer</button>
                        </form>
                    </div>
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

    :root {
    --admin-blue: #1f3a5f;      /* Bleu institutionnel */
    --admin-blue-light: #e6edf5;
    --admin-border: #e5e7eb;
    --text-main: #111827;
    --text-muted: #6b7280;
}


/* ================= PAGE ================= */
.main-content h1 {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 20px;
}

/* Bouton nouvelle demande */
.main-content > a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(30,64,175,0.2);
}

.main-content > a:hover {
    background: linear-gradient(135deg, #1e3a8a, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(30,64,175,0.3);
}

/* ================= FILTRE ================= */
form[action*="demandes"] {
    background: #ffffff;
    padding: 16px;
    border-radius: 8px;
    border: 1px solid var(--admin-border);
    margin-bottom: 25px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

form[action*="demandes"] label {
    font-size: 13px;
    color: var(--text-muted);
}

form[action*="demandes"] input {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 14px;
}

form[action*="demandes"] button {
    background: var(--admin-blue);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
}

/* ================= TABLE ================= */
.main-content table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--admin-border);
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
}

.main-content thead {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.main-content th {
    padding: 18px 20px;
    font-size: 13px;
    letter-spacing: 0.3px;
    font-weight: 700;
    text-align: left;
    vertical-align: middle;
    color: #ffffff
}

.main-content td {
    padding: 16px 20px;
    font-size: 14px;
    color: var(--text-main);
    border-bottom: 1px solid #f0f1f3;
    vertical-align: middle;
    transition: background 0.2s ease;
}

.main-content tbody tr {
    transition: all 0.3s ease;
}

.main-content tbody tr:hover {
    background: linear-gradient(90deg, rgba(30,64,175,0.04), rgba(30,58,138,0.04));
    box-shadow: 0 4px 12px rgba(30,64,175,0.1) inset;
}

.main-content tbody tr:last-child td {
    border-bottom: none;
}

.main-content tbody tr:nth-child(even) {
    background: #fafbfc;
}

/* ================= BADGES ================= */
.badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 999px;
}

/* Statuts */
.badge-attente {
    background: #fef3c7;
    color: #92400e;
}

.badge-validee {
    background: #dcfce7;
    color: #166534;
}

.badge-traitement {
    background: #e0ecff;
    color: var(--admin-blue);
}

.badge-rejetee {
    background: #fee2e2;
    color: #991b1b;
}

/* Priorité */
.badge-normal {
    background: var(--admin-blue-light);
    color: var(--admin-blue);
}

.badge-urgent {
    background: #fee2e2;
    color: #b91c1c;
}

/* ================= ACTIONS ================= */
.actions {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

.actions a,
.actions button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 9px 16px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-height: 38px;
}

.actions .edit { 
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #15803d;
    border: 1px solid #a7e6c4;
}

.actions .edit:hover {
    background: linear-gradient(135deg, #bbf7d0, #86efac);
    color: #166534;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(21,128,61,0.25);
}

.actions .delete {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.actions .delete:hover {
    background: linear-gradient(135deg, #fecaca, #fca5a5);
    color: #7f1d1d;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(185,28,28,0.25);
}

/* ================= PAGINATION ================= */
.pagination {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 25px;
}

.pagination a,
.pagination span {
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid var(--admin-border);
    font-size: 14px;
    color: var(--admin-blue);
    text-decoration: none;
}

.pagination .active span {
    background: var(--admin-blue);
    color: white;
    border-color: var(--admin-blue);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    form[action*="demandes"] {
        flex-direction: column;
    }
}


</style>

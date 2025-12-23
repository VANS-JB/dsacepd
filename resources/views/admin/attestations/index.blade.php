@extends('layouts.app')
@section('title', 'Liste des attestations')

@section('content')
<h1>Attestations générées</h1>

<a href="{{ route('demandes.create') }}">➕ Nouvelle attestation</a>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Demandeur</th>
            <th>Nom complet</th>
            <th>Session</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attestations as $attestation)
            <tr>
                <td>{{ $attestation->id }}</td>
                <td>{{ optional(optional($attestation->demande)->user)->name ?? 'Utilisateur supprimé' }}</td>
                <td>{{ $attestation->nom_complet }}</td>
                <td>{{ $attestation->session }}</td>
                <td>{{ optional($attestation->created_at)->format('Y-m-d H:i') ?? '' }}</td>
                <td>
                    <a href="{{ route('attestation.edit', $attestation->id) }}">✏️ Modifier</a> 
                    <form action="{{ route('attestation.destroy', $attestation->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette attestation ?')">🗑 Supprimer</button>
                    </form> 
                    <a href="{{ route('attestation.print', $attestation->id) }}">🖨️ Imprimer</a>

                    {{-- Envoi de notification : passer l'id utilisateur (route notifications.create attend userId) --}}
                    @if(optional(optional($attestation->demande)->user)->id)
                       <a href="{{ route('notifications.create', ['demandeId' => optional($attestation->demande)->id]) }}">
    📩 Envoyer notification
</a>

                    @else
                        <span title="Utilisateur introuvable">📩 Envoyer notification</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;">Aucune attestation trouvée.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $attestations->links() }}
@endsection

<style>

    /* ================= ATTESTATIONS ================= */

.main-content h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 25px;
}

/* Bouton nouvelle attestation */
.main-content > a {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 18px;
    background:linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.main-content > a:hover {
    background:0 12px 30px rgba(31,107,255,0.4);
}

/* Message succès */
.main-content div[style*="color:green"] {
    background: #ecfdf5;
    color: #047857 !important;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 500;
}

/* TABLE */
.main-content table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* EN-TÊTE */
.main-content thead {
    background: #1f6bff;
    color: #ffffff;
}

.main-content th {
    padding: 14px;
    font-size: 14px;
    font-weight: 600;
    text-align: left;
}

/* LIGNES */
.main-content td {
    padding: 12px 14px;
    font-size: 14px;
    color: #374151;
    border-bottom: 1px solid #e5e7eb;
}

.main-content tbody tr:hover {
    background: #f1f5ff;
}

/* ================= ACTIONS ================= */

.main-content td a,
.main-content td button {
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

/* Modifier */
.main-content td a[href*="edit"] {
    background: #c7d2fe;
    transform: translateY(-1px);
}

.main-content td a[href*="edit"]:hover {
    background: #eab308;
}

/* Supprimer */
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

/* Imprimer */
.main-content td a[href*="print"] {
    background: #6366f1;
    color: #fff;
}

.main-content td a[href*="print"]:hover {
    background: #4f46e5;
}

/* Notification */
.main-content td a[href*="notifications"] {
    background: #0ea5e9;
    color: #fff;
}

.main-content td a[href*="notifications"]:hover {
    background: #0284c7;
}

/* Notification désactivée */
.main-content td span {
    background: #e5e7eb;
    color: #6b7280;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 13px;
}

/* PAGINATION */
.pagination {
    margin-top: 25px;
    display: flex;
    justify-content: center;
    gap: 8px;
}

.pagination a,
.pagination span {
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
}

.pagination a {
    background: #e5e7eb;
    color: #374151;
}

.pagination .active span {
    background: #1f6bff;
    color: #ffffff;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .main-content table {
        font-size: 13px;
    }

    .main-content td a,
    .main-content td button {
        display: block;
        width: fit-content;
    }
}
</style>
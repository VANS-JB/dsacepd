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
    📩 notifier
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 25px;
}

/* Bouton nouvelle attestation */
.main-content > a {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 18px;
    background:linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.main-content > a:hover {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
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
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
}

/* EN-TÊTE */
.main-content thead {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.main-content th {
    padding: 18px 20px;
    font-size: 13px;
    font-weight: 700;
    text-align: left;
    letter-spacing: 0.3px;
    vertical-align: middle;
    color: #ffffff
}

/* LIGNES */
.main-content td {
    padding: 16px 20px;
    font-size: 14px;
    color: #374151;
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

/* ================= ACTIONS ================= */

.main-content td:last-child {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.main-content td a,
.main-content td button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #e0e7ff;
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    padding: 8px 14px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
    min-height: 36px;
}

/* Modifier */
.main-content td a[href*="edit"] {
    background: linear-gradient(135deg, #c7d2fe, #dbeafe);
    color: #1e40af;
}

.main-content td a[href*="edit"]:hover {
    background: linear-gradient(135deg, #a5b4fc, #bfdbfe);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30,64,175,0.2);
}

/* Supprimer */
.main-content td form button {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
    border: none;
    margin: 0;
}

.main-content td form button:hover {
    background: linear-gradient(135deg, #fecaca, #fca5a5);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220,38,38,0.2);
}

/* Imprimer */
.main-content td a[href*="print"] {
    background: linear-gradient(135deg, #6366f1, #818cf8);
    color: #fff;
}

.main-content td a[href*="print"]:hover {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99,102,241,0.3);
}

/* Notification */
.main-content td a[href*="notifications"] {
    background: linear-gradient(135deg, #0ea5e9, #38bdf8);
    color: #fff;
}

.main-content td a[href*="notifications"]:hover {
    background: linear-gradient(135deg, #0284c7, #0ea5e9);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(14,165,233,0.3);
}

/* Notification désactivée */
.main-content td span {
    background: #e5e7eb;
    color: #6b7280;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    min-height: 36px;
    display: flex;
    align-items: center;
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
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
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

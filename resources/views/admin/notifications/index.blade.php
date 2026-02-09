@extends('layouts.app')
@section('title', 'Liste des notifications')

@section('content')
<h1>Notifications envoyées</h1>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Demandeur</th>
            <th>Message</th>
            <th>Date</th>
            <th>Demande liée</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($notifications as $notif)
            <tr>
                <td>{{ $notif->id }}</td>
                <td>{{ $notif->user->name }}</td>
                <td>{{ $notif->message }}</td>
                <td>{{ $notif->date_notification->format('d/m/Y H:i') }}</td>
                <td>
                    {{ $notif->demande->id }}
                    <span class="status-badge status-{{ $notif->demande->statut ?? 'en_attente' }}">
                        {{ ucfirst($notif->demande->statut ?? 'en attente') }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('notifications.destroy', $notif->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette notification ?')">🗑 Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Aucune notification envoyée.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $notifications->links() }}
@endsection

<style>

    /* ================= NOTIFICATIONS ================= */

.main-content h1 {
    font-size: 26px;
    font-weight: 700;
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 25px;
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

/* CELLULES */
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
    /* display: flex;
    align-items: center;
    gap: 8px; */
}

.main-content td form button {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
    border: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
    min-height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-content td form button:hover {
    background: linear-gradient(135deg, #fecaca, #fca5a5);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220,38,38,0.2);
}

/* BADGE STATUT DEMANDE */
.main-content td:nth-child(5) {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ================= STATUT BADGES ================= */
.status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    min-width: 100px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* En attente */
.status-en_attente {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border: 1px solid #fcd34d;
}

.status-en_attente:hover {
    box-shadow: 0 4px 12px rgba(146,64,14,0.2);
    transform: translateY(-2px);
}

/* Validée */
.status-validee {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #15803d;
    border: 1px solid #86efac;
}

.status-validee:hover {
    box-shadow: 0 4px 12px rgba(21,128,61,0.2);
    transform: translateY(-2px);
}

/* Rejetée */
.status-rejetee {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.status-rejetee:hover {
    box-shadow: 0 4px 12px rgba(185,28,28,0.2);
    transform: translateY(-2px);
}

/* En traitement */
.status-en_traitement,
.status-traitement {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1e40af;
    border: 1px solid #93c5fd;
}

.status-en_traitement:hover,
.status-traitement:hover {
    box-shadow: 0 4px 12px rgba(30,64,175,0.2);
    transform: translateY(-2px);
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

/* AUCUNE DONNÉE */
.main-content td[colspan] {
    text-align: center;
    padding: 25px;
    font-style: italic;
    color: #6b7280;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .main-content table {
        font-size: 13px;
    }

    .main-content td form button {
        width: 100%;
    }
}
</style>

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
                <td>{{ $notif->demande->id }} ({{ $notif->demande->statut }})</td>
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
    color: #1f6bff;
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

/* CELLULES */
.main-content td {
    padding: 12px 14px;
    font-size: 14px;
    color: #374151;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: top;
}

/* Message long */
.main-content td:nth-child(3) {
    max-width: 350px;
    line-height: 1.5;
}

/* Hover */
.main-content tbody tr:hover {
    background: #f1f5ff;
}

/* ================= ACTIONS ================= */

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

/* BADGE STATUT DEMANDE */
.main-content td:nth-child(5) {
    font-weight: 600;
}

.main-content td:nth-child(5)::before {
    content: "📄 ";
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
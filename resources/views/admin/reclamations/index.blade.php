@extends('layouts.app')

@section('title', 'Réclamations')

@section('content')
    <h1>Réclamations des demandeurs</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Objet</th>
                <th>Demandeur</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reclamations as $reclamation)
                <tr>
                    <td>{{ $reclamation->id }}</td>
                    <td>{{ $reclamation->objet }}</td>
                    <td>
                        {{ optional(optional($reclamation->demande)->user)->name ?? 'Utilisateur supprimé' }}
                        ({{ optional(optional($reclamation->demande)->user)->email ?? '—' }})
                    </td>
                    <td>{{ optional($reclamation->created_at)->format('Y-m-d H:i') ?? '' }}</td>
                    <td>
                        <a href="{{ route('reclamations.show', $reclamation->id) }}">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune réclamation trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reclamations->links() }}
@endsection

<style>

    /* ================= PAGE RÉCLAMATIONS ================= */

/* TITRE */
.main-content h1 {
    font-size: 28px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 25px;
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

/* TEXTE UTILISATEUR */
.main-content td:nth-child(3) {
    font-size: 13px;
    color: #374151;
}

/* ================= BOUTON ACTION : VOIR ================= */
.main-content td a {
    display: inline-block;
    background: #e0f2fe;
    color: #0284c7;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}

.main-content td a:hover {
    background: #bae6fd;
    transform: translateY(-1px);
}

/* ================= MESSAGE AUCUNE DONNÉE ================= */
.main-content tbody tr td[colspan] {
    text-align: center;
    font-weight: 600;
    color: #6b7280;
    padding: 20px;
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
    .main-content table {
        font-size: 13px;
    }
}
</style>
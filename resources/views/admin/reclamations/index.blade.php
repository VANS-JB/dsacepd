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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 25px;
}

/* ================= TABLE ================= */
.main-content table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
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
    font-weight: 700;
    text-align: left;
    letter-spacing: 0.3px;
    vertical-align: middle;
    color: #ffffff
}

.main-content td {
    padding: 16px 20px;
    font-size: 14px;
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

/* TEXTE UTILISATEUR */
.main-content td:nth-child(3) {
    font-size: 13px;
    color: #374151;
}

/* ================= BOUTON ACTION : VOIR ================= */
.main-content td:last-child {
    display: flex;
    align-items: center;
    gap: 8px;
}

.main-content td a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe, #cffafe);
    color: #0284c7;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
    min-height: 36px;
}

.main-content td a:hover {
    background: linear-gradient(135deg, #bae6fd, #a5f3fc);
    color: #0369a1;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(2,132,199,0.2);
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    font-weight: 500;
}

.pagination .active span {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
    border-color: linear-gradient(135deg, #1e40af, #1e3a8a);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    .main-content table {
        font-size: 13px;
    }
}
</style>

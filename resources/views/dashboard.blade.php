@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <h1>Tableau de bord</h1>

    <!-- Statistiques -->
    <div class="stats-grid" style="display:flex; gap:20px; margin-bottom:20px;">
        <div class="stat-box">📋 Total des demandes : <strong>{{ $totalDemandes }}</strong></div>
        <div class="stat-box">📄 Attestations générées : <strong>{{ $attestationsGenerees }}</strong></div>
        <div class="stat-box">📬 Réclamations : <strong>{{ $totalReclamations }}</strong></div>
        <div class="stat-box">🔔 Notifications envoyées : <strong>{{ $totalNotifications }}</strong></div>
    </div>

    <hr>

    <!-- Liste des demandes -->
    <h2>Demandes des demandeurs</h2>
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Demandeur</th>
                <th>Email</th>
                <th>Photo naissance</th>
                <th>Photo relevé</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->id }}</td>
                    <td>{{ optional($demande->user)->name ?? 'Utilisateur supprimé' }}</td>
                    <td>{{ optional($demande->user)->email ?? '—' }}</td>
                    <td>
    <img 
    src="{{ asset('storage/' . $demande->photo_naissance) }}"
    style="width:50px;height:50px;object-fit:cover;cursor:pointer"
    onclick="openLightbox('{{ asset('storage/' . $demande->photo_naissance) }}')"
/>

</td>
<td>
    <img 
    src="{{ asset('storage/' . $demande->photo_releve) }}"
    style="width:50px;height:50px;object-fit:cover;cursor:pointer"
    onclick="openLightbox('{{ asset('storage/' . $demande->photo_releve) }}')"
/>

</td>



                    <td>{{ ucfirst($demande->statut ?? 'en attente') }}</td>
                    <td>{{ optional($demande->created_at)->format('Y-m-d H:i') ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune demande trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $demandes->links() }}

   <div id="lightbox" onclick="closeLightbox()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.9);z-index:9999;justify-content:center;align-items:center;">
    <img id="lightbox-img" style="max-width:90%;max-height:90%;">
</div>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>

@endsection

<style>

    /* ================= DASHBOARD ================= */

/* TITRES */
.main-content h1 {
    font-size: 28px;
    color: #1f6bff;
    margin-bottom: 25px;
    font-weight: 700;
}

.main-content h2 {
    font-size: 22px;
    color: #1f6bff;
    margin: 30px 0 20px;
    font-weight: 600;
}

/* ================= STATS ================= */
.stats-grid {
    display: flex !important;
    gap: 20px;
    flex-wrap: wrap;
}

.stat-box {
    flex: 1;
    min-width: 220px;
    background: #ffffff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    font-size: 15px;
    font-weight: 500;
    color: #333;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-box strong {
    display: block;
    margin-top: 8px;
    font-size: 22px;
    color: #1f6bff;
}

.stat-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(31,107,255,0.25);
}

/* ================= SEPARATEUR ================= */
hr {
    border: none;
    height: 1px;
    background: #e5e7eb;
    margin: 30px 0;
}

/* ================= TABLE ================= */
.main-content table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.main-content thead {
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
}

.main-content th {
    padding: 14px 16px;
    font-size: 14px;
    text-align: left;
    font-weight: 600;
}

.main-content td {
    padding: 13px 16px;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
}

.main-content tbody tr:hover {
    background: #f3f4f6;
}

.main-content tbody tr:last-child td {
    border-bottom: none;
}

/* ================= PAGINATION LARAVEL ================= */
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




.lightbox {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    justify-content: center;
    align-items: center;
}

.lightbox img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 8px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    .stats-grid {
        flex-direction: column;
    }
}
</style>
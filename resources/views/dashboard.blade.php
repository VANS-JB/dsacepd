@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <h1>Tableau de bord</h1>

    <!-- Statistiques -->
    <div class="stats-grid" style="display:flex; gap:20px; margin-bottom:20px;">
        <div class="stat-box"> Total des demandes : <strong>{{ $totalDemandes }}</strong></div>
        <div class="stat-box"> Attestations générées : <strong>{{ $attestationsGenerees }}</strong></div>
        <div class="stat-box"> Réclamations : <strong>{{ $totalReclamations }}</strong></div>
        <div class="stat-box"> Notifications envoyées : <strong>{{ $totalNotifications }}</strong></div>
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



                    <td>
                        <span class="status-badge status-{{ $demande->statut ?? 'en_attente' }}">
                            {{ ucfirst($demande->statut ?? 'en attente') }}
                        </span>
                    </td>
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 25px;
    font-weight: 700;
}

.main-content h2 {
    font-size: 22px;
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
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
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    margin-bottom: 20px;
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
    text-align: left;
    font-weight: 700;
    letter-spacing: 0.3px;
    vertical-align: middle;
}

.main-content td {
    padding: 16px 20px;
    font-size: 14px;
    border-bottom: 1px solid #f0f1f3;
    vertical-align: middle;
    color: #374151;
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    font-weight: 500;
}

.pagination .active span {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #ffffff;
    border-color: linear-gradient(135deg, #1e40af, #1e3a8a);
}

/* ================= STATUT BADGES ================= */
.status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-width: 120px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

/* Approuvée */
.status-approuvee {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border: 1px solid #6ee7b7;
}

.status-approuvee:hover {
    box-shadow: 0 4px 12px rgba(6,95,70,0.2);
    transform: translateY(-2px);
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

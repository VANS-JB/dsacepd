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
@endsection
@extends('layouts.site')

@section('title', 'Suivi de mes demandes')

@section('content')

<div class="dashboard-container">

    <!-- HEADER -->
    <div class="dashboard-header">
        <h1> Suivi de mes demandes</h1>
        <p>Consultez l’état de vos demandes et vos notifications en temps réel</p>
    </div>

    <!-- MESSAGE SUCCESS -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE DEMANDES -->
    <div class="card">
        <h2> Mes demandes</h2>

        <table>
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $d)
                    <tr>
                        <td>{{ $d->reference }}</td>

                        <td>
                            <span class="status {{ $d->statut }}">
                                @if($d->statut === 'validée')
                                    Validée ✅
                                @elseif($d->statut === 'rejetée')
                                    Rejetée ❌
                                @else
                                    En attente ⏳
                                @endif
                            </span>
                        </td>

                        <td>{{ $d->created_at->format('d/m/Y H:i') }}</td>

                        <td>
                            <a class="action-link"
                               href="{{ route('demandeur.reclamation', $d->id) }}">
                               Faire une réclamation
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Aucune demande enregistrée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="card">
        <h2> Mes notifications</h2>

        @if($notifications->isEmpty())
            <p class="empty">Aucune notification pour le moment.</p>
        @else
            <ul class="notifications">
                @foreach($notifications as $notif)
                    <li>
                        <span> {{ $notif->message }}</span>
                        <small>{{ $notif->date_notification->format('d/m/Y H:i') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>

@endsection


<style>
/* GLOBAL */
.dashboard-container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: "Segoe UI", system-ui, sans-serif;
}

/* HEADER */
.dashboard-header {
    text-align: center;
    margin-bottom: 40px;
}

.dashboard-header h1 {
    font-size: 30px;
    color: #1f3cff;
    font-weight: 700;
}

.dashboard-header p {
    color: #555;
    margin-top: 8px;
}

/* ALERT */
.alert-success {
    background: #e6f9f0;
    color: #065f46;
    padding: 14px 18px;
    border-radius: 12px;
    font-weight: 600;
    margin-bottom: 25px;
    text-align: center;
}

/* CARD */
.card {
    background: #ffffff;
    border-radius: 18px;
    padding: 30px;
    margin-bottom: 35px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    animation: fadeUp 0.6s ease;
}

.card h2 {
    color: #1f3cff;
    margin-bottom: 20px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: linear-gradient(135deg, #1f3cff, #4f7cff);
    color: #fff;
}

th, td {
    padding: 14px;
    font-size: 14px;
}

tbody tr {
    border-bottom: 1px solid #e5e7eb;
}

tbody tr:hover {
    background: #f9fbff;
}

/* STATUS */
.status {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 13px;
}

.status.validée {
    background: #d1fae5;
    color: #065f46;
}

.status.rejetée {
    background: #fee2e2;
    color: #991b1b;
}

.status.en.attente,
.status.en_attente {
    background: #fef3c7;
    color: #92400e;
}

/* ACTION */
.action-link {
    color: #1f3cff;
    font-weight: 600;
    text-decoration: none;
}

.action-link:hover {
    text-decoration: underline;
}

/* EMPTY */
.empty {
    text-align: center;
    color: #777;
    padding: 20px;
}

/* NOTIFICATIONS */
.notifications {
    list-style: none;
    padding: 0;
}

.notifications li {
    background: #f9fbff;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 20px rgba(0,0,0,0.06);
}

/* ANIMATION */
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>

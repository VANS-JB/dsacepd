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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
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
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 20px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    border: 1px solid #e5e7eb;
}

thead {
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

th, td {
    padding: 16px 20px;
    font-size: 14px;
    vertical-align: middle;
}

th {
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 0.3px;
}

tbody tr {
    border-bottom: 1px solid #f0f1f3;
    transition: all 0.3s ease;
}

tbody tr:hover {
    background: linear-gradient(90deg, rgba(30,64,175,0.04), rgba(30,58,138,0.04));
    box-shadow: 0 4px 12px rgba(30,64,175,0.1) inset;
}

tbody tr:last-child td {
    border-bottom: none;
}

tbody tr:nth-child(even) {
    background: #fafbfc;
}

/* STATUS */
.status {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    min-width: 120px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.status.validée {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #15803d;
    border: 1px solid #86efac;
}

.status.validée:hover {
    box-shadow: 0 4px 12px rgba(21,128,61,0.2);
    transform: translateY(-2px);
}

.status.rejetée {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.status.rejetée:hover {
    box-shadow: 0 4px 12px rgba(185,28,28,0.2);
    transform: translateY(-2px);
}

.status.en.attente,
.status.en_attente {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border: 1px solid #fcd34d;
}

.status.en.attente:hover,
.status.en_attente:hover {
    box-shadow: 0 4px 12px rgba(146,64,14,0.2);
    transform: translateY(-2px);
}

/* ACTION */
.action-link {
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
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

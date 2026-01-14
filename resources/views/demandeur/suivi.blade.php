@extends('layouts.site')

@section('title', 'Suivi de mes demandes')

@section('content')
    <h1>Suivi de mes demandes</h1>

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $d)
            
                <tr>
                    <td>{{ $d->reference }}</td>
                    <td>
                        @if($d->statut === 'validée')
                            <span style="color:green;font-weight:bold;">Validée ✅</span>
                        @elseif($d->statut === 'rejetée')
                            <span style="color:red;font-weight:bold;">Rejetée ❌</span>
                        @else
                            <span style="color:orange;font-weight:bold;">En attente ⏳</span>
                        @endif

                    </td>
                    <td>{{ $d->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('demandeur.reclamation', $d->id) }}">Faire une réclamation</a>
                    </td>
                </tr>
            @empty
            
                <tr>
                    <td colspan="4">Vous n’avez encore soumis aucune demande.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

  
<h2>Mes notifications</h2>

@if($notifications->isEmpty())
    <p>Aucune notification pour le moment.</p>
@else
    <ul>
        @foreach($notifications as $notif)
            <li>
                📩 {{ $notif->message }}
                <small style="color:gray;">
                    ({{ $notif->date_notification->format('Y-m-d H:i') }})
                </small>
            </li>
        @endforeach
    </ul>
@endif





@endsection

<style>
/* ================= SUIVI DEMANDES & NOTIFICATIONS ================= */
* {
    box-sizing: border-box;
    font-family: "Segoe UI", system-ui, sans-serif;
}

body {
    background: linear-gradient(135deg, #1f6bff, #6fa8ff);
    min-height: 100vh;
    margin: 0;
    /* padding: 20px; */
}

/* TITRES */

h1, h2{
    color: #1f6bff;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
}


h1 {
    font-size: 28px;
}

h2 {
    font-size: 24px;
    margin-top: 40px;
}

/* MESSAGES SUCCESS */
div[style*="color:green"] {
    max-width: 600px;
    margin: 0 auto 20px;
    padding: 14px 20px;
    background: #d1fae5;
    color: #065f46;
    border-radius: 12px;
    font-weight: 600;
}

/* TABLEAU */
table {
    width: 100%;
    max-width: 900px;
    margin: 0 auto 30px;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    animation: slideFade 0.6s ease;
}

thead {
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    font-weight: 600;
}

th, td {
    padding: 14px 12px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

tr:last-child td {
    border-bottom: none;
}

tbody tr:hover {
    background: #f3f4f6;
}

/* LIENS DANS TABLEAU */
table a {
    color: #1f6bff;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.25s ease;
}

table a:hover {
    color: #3b82f6;
}

/* LISTE NOTIFICATIONS */
ul {
    max-width: 600px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
}

ul li {
    background: #ffffff;
    margin-bottom: 12px;
    padding: 14px 18px;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    font-size: 14px;
    display: flex;
    align-items: center;
    animation: slideFade 0.6s ease;
}

ul li:last-child {
    margin-bottom: 0;
}

/* ANIMATION */
@keyframes slideFade {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@extends('layouts.app')
@section('title', 'Envoyer une notification')

@section('content')
<h1>Envoyer une notification au demandeur</h1>

<form method="POST" action="{{ route('notifications.store', $demande->id) }}">
    @csrf
    <p><strong>Demandeur :</strong> {{ $demande->user->name }} ({{ $demande->user->email }})</p>
    <p><strong>Statut actuel :</strong> {{ $demande->statut }}</p>

    <label>Message :</label><br>
    <textarea name="message" rows="4" cols="50" required></textarea><br><br>

    <button type="submit"> Envoyer notification</button>
</form>
@endsection

<style>

    /* ================= SEND NOTIFICATION ================= */

.main-content h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 25px;
}

/* FORMULAIRE */
.main-content form {
    max-width: 650px;
    background: #ffffff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* INFOS DEMANDEUR */
.main-content form p {
    font-size: 14px;
    margin-bottom: 12px;
    color: #374151;
}

.main-content form p strong {
    color: #1f6bff;
}

/* LABEL */
.main-content form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
}

/* TEXTAREA */
.main-content form textarea {
    width: 100%;
    min-height: 120px;
    padding: 14px;
    font-size: 14px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    resize: vertical;
    margin-bottom: 20px;
}

/* FOCUS */
.main-content form textarea:focus {
    outline: none;
    border-color: #1f6bff;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(31,107,255,0.15);
}

/* BOUTON */
.main-content form button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* HOVER */
.main-content form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(31,107,255,0.35);
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .main-content form {
        max-width: 100%;
    }
}
</style>
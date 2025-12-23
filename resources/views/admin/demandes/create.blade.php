@extends('layouts.app')
@section('title', 'Nouvelle demande')

@section('content')
<h1>Nouvelle demande avec attestation</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<!-- Ajout de enctype pour l'upload de fichiers -->
<form method="POST" action="{{ route('demandes.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Demandeur :</label>
    <select name="user_id" required>
        <option value="">-- Sélectionner --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
        @endforeach
    </select><br><br>

    <label>Nom complet :</label>
    <input type="text" name="nom_complet" required><br><br>

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance" required><br><br>

    <label>Lieu de naissance :</label>
    <input type="text" name="lieu_naissance" required><br><br>

    <label>École :</label>
    <input type="text" name="ecole" required><br><br>

    <label>Numéro de table :</label>
    <input type="number" name="numero_table" required><br><br>

    <label>Session :</label>
    <input type="text" name="session" required><br><br>

    <label>Centre :</label>
    <input type="text" name="centre" required><br><br>

    <label>Numéro registre :</label>
    <input type="text" name="numero_registre" required><br><br>

    <!-- Champs fichiers obligatoires -->
    <label>Photo du relevé (jpg/png/pdf) :</label>
    <input type="file" name="photo_releve" accept=".jpg,.jpeg,.png,.pdf" required><br>
    @error('photo_releve')
        <div style="color:red;font-size:13px;">{{ $message }}</div>
    @enderror
    <br>

    <label>Photo de l'acte de naissance (jpg/png/pdf) :</label>
    <input type="file" name="photo_naissance" accept=".jpg,.jpeg,.png,.pdf" required><br>
    @error('photo_naissance')
        <div style="color:red;font-size:13px;">{{ $message }}</div>
    @enderror
    <br>

    <button type="submit">Enregistrer</button>
</form>
@endsection

<style>

    /* ================= FORM DEMANDE + ATTESTATION ================= */

.main-content {
    padding: 30px;
    overflow-x: hidden; /* empêche tout débordement horizontal */
}

/* TITRE */
.main-content h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 25px;
}

/* FORMULAIRE */
.main-content form {
    max-width: 700px;      /* largeur contrôlée */
    width: 100%;
    background: #ffffff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* LABELS */
.main-content form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* INPUTS / SELECT / FILE */
.main-content form input,
.main-content form select,
.main-content form textarea {
    width: 100%;
    padding: 12px 14px;
    font-size: 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    margin-bottom: 18px;
}

/* FOCUS */
.main-content form input:focus,
.main-content form select:focus,
.main-content form textarea:focus {
    outline: none;
    border-color: #1f6bff;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(31,107,255,0.15);
}

/* INPUT FILE */
.main-content input[type="file"] {
    padding: 10px;
    background: #ffffff;
}

/* ERREURS */
.main-content div[style*="color:red"] ul {
    background: #fff1f2;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.main-content div[style*="color:red"] li {
    font-size: 13px;
    color: #be123c;
}

/* BOUTON */
.main-content form button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
    transition: all 0.2s ease;
}

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
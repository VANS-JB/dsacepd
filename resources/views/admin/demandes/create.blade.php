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
     <!-- Sélection de la demande existante -->
    <label>Demande :</label>
    <select name="id_demande" required>
        <option value="">-- Sélectionner une demande --</option>
        @foreach($demandes as $demande)
            <option value="{{ $demande->id }}">
                Réf: {{ $demande->reference }} - {{ $demande->user->name }}
                (Statut: {{ $demande->statut }})
            </option>
        @endforeach
    </select><br><br>


    <label>Nom complet :</label>
    <input type="text" name="nom_complet" required><br><br>

    <label>Sexe :</label>
    <select name="sexe" required>
        <option value="">-- Sélectionner le sexe --</option>
        <option value="M">M</option>
        <option value="F">F</option>
    </select><br><br>

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

    <label>Anonymat :</label>
    <input type="text" name="anonymat" required><br><br>

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

    :root {
    --admin-blue: #1f3a5f;
    --admin-blue-dark: #162b46;
    --admin-blue-light: #e6edf5;
    --border-light: #e5e7eb;
    --text-main: #111827;
    --text-muted: #6b7280;
}


   /* ================= FORM DEMANDE + ATTESTATION ================= */

.main-content {
    padding: 30px;
}

/* TITRE */
.main-content h1 {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 25px;
}

/* ================= ERREURS ================= */
.main-content div[style*="color:red"] {
    background: #fff1f2;
    border: 1px solid #fecdd3;
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.main-content div[style*="color:red"] li {
    font-size: 13px;
    color: #9f1239;
}

/* ================= FORMULAIRE ================= */
.main-content form {
    max-width: 720px;
    width: 100%;
    background: #ffffff;
    padding: 28px;
    border-radius: 10px;
    border: 1px solid var(--border-light);
}

/* LABELS */
.main-content form label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 6px;
}

/* INPUTS / SELECT */
.main-content form input,
.main-content form select {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    margin-bottom: 18px;
    color: var(--text-main);
}

/* FILE INPUT */
.main-content form input[type="file"] {
    padding: 8px;
    background: #f9fafb;
}

/* FOCUS */
.main-content form input:focus,
.main-content form select:focus {
    outline: none;
    border-color: var(--admin-blue);
    box-shadow: 0 0 0 2px rgba(31, 58, 95, 0.15);
}

/* ================= BOUTON ================= */
.main-content form button {
    width: 100%;
    padding: 13px;
    background: var(--admin-blue);
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    cursor: pointer;
    transition: background 0.2s ease;
}

.main-content form button:hover {
    background: var(--admin-blue-dark);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 900px) {
    .main-content {
        padding: 20px;
    }

    .main-content form {
        padding: 20px;
    }
}

</style>

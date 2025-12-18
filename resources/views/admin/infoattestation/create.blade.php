@extends('layouts.app')

@section('title', 'Nouvelle attestation')

@section('content')
    <h1>Nouvelle attestation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('infoattestation.store') }}">
        @csrf

        <label>Nom complet :</label><br>
        <input type="text" name="nom_complet" required><br><br>

        <label>Date de naissance :</label><br>
        <input type="date" name="date_naissance" required><br><br>

        <label>Lieu de naissance :</label><br>
        <input type="text" name="lieu_naissance" required><br><br>

        <label>École :</label><br>
        <input type="text" name="ecole" required><br><br>

        <label>Numéro de table :</label><br>
        <input type="number" name="numero_table" required><br><br>

        <label>Session :</label><br>
        <input type="text" name="session" placeholder="Ex: 2024" required><br><br>

        <label>Centre :</label><br>
        <input type="text" name="centre" required><br><br>

        <label>Numéro registre :</label><br>
        <input type="text" name="numero_registre" required><br><br>

        <!-- Lien avec la demande -->
        @php
            // valeur sécurisée pour l'id de la demande :
            // priorité : variable $demande passée par le contrôleur,
            // puis old() (si validation échouée), puis paramètre GET 'demandeId'
            $idDemande = isset($demande) ? $demande->id : (old('id_demande') ?? request()->get('demandeId'));
        @endphp

        <input type="hidden" name="id_demande" value="{{ $idDemande }}">

        <button type="submit">Enregistrer</button>
    </form>
@endsection

<style>

   /* ================= MAIN CONTENT ================= */
.main-content {
    height: 100vh;              /* même hauteur que la sidebar */
    overflow: hidden;           /* empêche le scroll global */
    padding: 30px 40px;
}

/* ================= FORM CONTAINER ================= */
.main-content form {
    width: 100%;
    max-width: 100%;
    background: #ffffff;
    padding: 24px 26px;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);

    max-height: calc(100vh - 140px); /* 👈 hauteur contrôlée */
    overflow-y: auto;                /* 👈 scroll interne */
}

/* ================= LABELS ================= */
.main-content form label {
    font-size: 13px;
    font-weight: 600;
    color: #374151;
}

/* ================= INPUTS ================= */
.main-content form input {
    width: 100%;
    padding: 11px 13px;
    margin-top: 6px;
    margin-bottom: 14px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    font-size: 14px;
}

/* ================= BOUTON ================= */
.main-content form button {
    position: sticky;      /* 👈 bouton toujours visible */
    bottom: 0;
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
}


</style>
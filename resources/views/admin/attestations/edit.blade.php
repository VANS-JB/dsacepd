@extends('layouts.app')

@section('title', 'Modifier une attestation')

@section('content')
<div class="container">
    <h1>Modifier l’attestation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attestation.update', $attestation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nom_complet">Nom complet :</label>
            <input type="text" name="nom_complet" id="nom_complet" 
                   value="{{ old('nom_complet', $attestation->nom_complet) }}" required>
        </div>

        <div>
            <label for="sexe">Sexe :</label>
            <select name="sexe" id="sexe" required>
                <option value="M" {{ old('sexe', $attestation->sexe) == 'M' ? 'selected' : '' }}>M</option>
                <option value="F" {{ old('sexe', $attestation->sexe) == 'F' ? 'selected' : '' }}>F</option>
            </select>
        </div>

        <div>
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" 
                   value="{{ old('date_naissance', $attestation->date_naissance) }}" required>
        </div>

        <div>
            <label for="lieu_naissance">Lieu de naissance :</label>
            <input type="text" name="lieu_naissance" id="lieu_naissance" 
                   value="{{ old('lieu_naissance', $attestation->lieu_naissance) }}" required>
        </div>

        <div>
            <label for="ecole">École :</label>
            <input type="text" name="ecole" id="ecole" 
                   value="{{ old('ecole', $attestation->ecole) }}" required>
        </div>

        <div>
            <label for="numero_table">Numéro de table :</label>
            <input type="text" name="numero_table" id="numero_table" 
                   value="{{ old('numero_table', $attestation->numero_table) }}" required>
        </div>

        <div>
            <label for="session">Session :</label>
            <input type="text" name="session" id="session" 
                   value="{{ old('session', $attestation->session) }}" required>
        </div>

        <div>
            <label for="centre">Centre :</label>
            <input type="text" name="centre" id="centre" 
                   value="{{ old('centre', $attestation->centre) }}" required>
        </div>

        <div>
            <label for="anonymat">Anonymat :</label>
            <input type="text" name="anonymat" id="anonymat" 
                   value="{{ old('anonymat', $attestation->anonymat) }}" required>
        </div>

        <div>
            <label for="numero_registre">Numéro registre :</label>
            <input type="text" name="numero_registre" id="numero_registre" 
                   value="{{ old('numero_registre', $attestation->numero_registre) }}" required>
        </div>

        <button type="submit"> Mettre à jour</button>
        <a href="{{ route('attestations.index') }}">⬅️ Retour</a>
    </form>
</div>
@endsection

<style>

    /* ================= MODIFIER ATTESTATION ================= */

/* CONTENEUR PRINCIPAL */
.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    height: 100vh;           /* même hauteur que sidebar */
    overflow: hidden;        /* empêche dépassement */
}

/* TITRE */
.container h1 {
    font-size: 26px;
    font-weight: 700;
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
    margin-bottom: 15px;
}

/* ERREURS */
.container div[style*="color:red"] {
    background: #fff1f2;
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 15px;
}

/* FORMULAIRE (SCROLL INTERNE) */
.container form {
    height: calc(100vh - 120px); /* espace titre + erreurs */
    background: #ffffff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    overflow-y: auto;            /* SCROLL ICI */
}

/* BLOCS CHAMPS */
.container form > div {
    margin-bottom: 16px;
}

/* LABEL */
.container label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* INPUTS & SELECT */
.container input,
.container select {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    font-size: 14px;
}

/* FOCUS */
.container input:focus,
.container select:focus {
    outline: none;
    border-color: linear-gradient(135deg, #1e40af, #1e3a8a);
    box-shadow: 0 0 0 3px rgba(31,107,255,0.15);
}

/* BOUTON FIXÉ EN BAS */
.container form button {
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    border: none;
    border-radius: 12px;
    font-weight: 600;
    color: white;
    position: sticky;
    bottom: 0;
}

/* LIEN RETOUR */
.container a {
    display: inline-block;
    margin-top: 15px;
    font-weight: 600;
    color: #374151;
    text-decoration: none;
}

.container a:hover {
    color: linear-gradient(135deg, #1e40af, #1e3a8a);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .container {
        padding: 12px;
    }

    .container form {
        height: calc(100vh - 100px);
        padding: 20px;
    }
}


</style>


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
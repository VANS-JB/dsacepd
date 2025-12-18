@extends('layouts.site')

@section('title', 'Faire une demande')

@section('content')
    <h1>Faire une demande d’attestation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('demandeur.demande.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="photo_naissance">Acte de naissance :</label><br>
        <input type="file" name="photo_naissance" required><br><br>

        <label for="photo_releve">Relevé de notes :</label><br>
        <input type="file" name="photo_releve" required><br><br>

        <p><strong>Date de demande :</strong> {{ now()->format('Y-m-d H:i') }} (automatique)</p>

        <button type="submit">Soumettre la demande</button>
    </form>
@endsection
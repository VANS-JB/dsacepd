@extends('layouts.site')

@section('title', 'Faire une réclamation')

@section('content')
    <h1>Faire une réclamation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('demandeur.reclamation.store', $demandeId) }}">
        @csrf

        <label for="objet">Objet :</label><br>
        <input type="text" name="objet" required><br><br>

        <label for="message">Message :</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Envoyer la réclamation</button>
    </form>
@endsection
@extends('layouts.app')
@section('title', 'Liste des demandes')

@section('content')
<h1>Demandes enregistrées</h1>

<a href="{{ route('demandes.create') }}">➕ Nouvelle demande</a>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<!-- Formulaire de recherche -->
<form method="GET" action="{{ route('demandes.index') }}" style="margin:20px 0; display:flex; gap:15px; align-items:center;">
    <input type="text" name="search" placeholder="Nom du demandeur" value="{{ request('search') }}">
    <label>Date début :</label>
    <input type="date" name="date_debut" value="{{ request('date_debut') }}">
    <label>Date fin :</label>
    <input type="date" name="date_fin" value="{{ request('date_fin') }}">
    <button type="submit">🔍 Filtrer</button>
</form>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Demandeur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($demandes as $demande)
            <tr>
                <td>{{ $demande->id }}</td>
                <td>{{ $demande->user->name }}</td>
                <td>{{ $demande->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('demandes.edit', $demande->id) }}">✏️ Modifier</a> |
                    <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette demande ?')">🗑 Supprimer</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Aucune demande trouvée.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $demandes->appends(request()->query())->links() }}
@endsection
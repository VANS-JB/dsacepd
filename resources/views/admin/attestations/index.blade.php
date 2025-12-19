@extends('layouts.app')
@section('title', 'Liste des attestations')

@section('content')
<h1>Attestations générées</h1>

<a href="{{ route('demandes.create') }}">➕ Nouvelle attestation</a>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Demandeur</th>
            <th>Nom complet</th>
            <th>Session</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attestations as $attestation)
            <tr>
                <td>{{ $attestation->id }}</td>
                <td>{{ $attestation->demande->user->name }}</td>
                <td>{{ $attestation->nom_complet }}</td>
                <td>{{ $attestation->session }}</td>
                <td>{{ $attestation->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('attestation.edit', $attestation->id) }}">✏️ Modifier</a> |
                    <form action="{{ route('attestation.destroy', $attestation->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Supprimer cette attestation ?')">🗑 Supprimer</button>
                    </form> |
                    <a href="{{ route('attestation.print', $attestation->id) }}">🖨️ Imprimer</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Aucune attestation générée.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $attestations->links() }}
@endsection
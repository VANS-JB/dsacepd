@extends('layouts.app')

@section('title', 'Liste des attestations')

@section('content')
    <h1>Liste des attestations générées</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Demandeur</th>
                <th>Nom complet</th>
                <th>Session</th>
                <th>Date création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attestations as $attestation)
                <tr>
                    <td>{{ $attestation->id }}</td>
                    <td>{{ $attestation->demande->user->name }} ({{ $attestation->demande->user->email }})</td>
                    <td>{{ $attestation->nom_complet }}</td>
                    <td>{{ $attestation->session }}</td>
                    <td>{{ $attestation->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('attestation.show', $attestation->id) }}">🖨️ Imprimer</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucune attestation générée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $attestations->links() }}
@endsection
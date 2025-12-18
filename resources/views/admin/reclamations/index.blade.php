@extends('layouts.app')

@section('title', 'Réclamations')

@section('content')
    <h1>Réclamations des demandeurs</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Objet</th>
                <th>Demandeur</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reclamations as $reclamation)
                <tr>
                    <td>{{ $reclamation->id }}</td>
                    <td>{{ $reclamation->objet }}</td>
                    <td>
                        {{ optional(optional($reclamation->demande)->user)->name ?? 'Utilisateur supprimé' }}
                        ({{ optional(optional($reclamation->demande)->user)->email ?? '—' }})
                    </td>
                    <td>{{ optional($reclamation->created_at)->format('Y-m-d H:i') ?? '' }}</td>
                    <td>
                        <a href="{{ route('reclamations.show', $reclamation->id) }}">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune réclamation trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reclamations->links() }}
@endsection
@extends('layouts.site')

@section('title', 'Suivi de mes demandes')

@section('content')
    <h1>Suivi de mes demandes</h1>

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $demande)
                <tr>
                    <td>{{ $demande->id }}</td>
                    <td>{{ ucfirst($demande->statut ?? 'en attente') }}</td>
                    <td>{{ $demande->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('demandeur.reclamation', $demande->id) }}">Faire une réclamation</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Vous n’avez encore soumis aucune demande.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
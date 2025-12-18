@extends('layouts.site')

@section('title', 'Mes notifications')

@section('content')
    <h1>Mes notifications</h1>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Message</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notif)
                <tr>
                    <td>{{ $notif->id }}</td>
                    <td>{{ $notif->message }}</td>
                    <td>{{ $notif->date_notification }}</td>
                    <td>
                        @if($notif->is_read)
                            ✅ Lu
                        @else
                            🔔 Non lu
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Vous n’avez aucune notification.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
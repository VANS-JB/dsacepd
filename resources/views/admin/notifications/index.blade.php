@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
    <h1>Notifications envoyées</h1>

    @if(session('success'))
        <div style="color:green;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Demandeur</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->user->name }} ({{ $notification->user->email }})</td>
                    <td>{{ $notification->message }}</td>
                    <td>{{ $notification->date_notification }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune notification envoyée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $notifications->links() }}
@endsection
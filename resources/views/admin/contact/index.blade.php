@extends('layouts.app')

@section('content')
<h1>Messages de contact</h1>

@if(session('success'))
    <div style="color:green;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($messages as $msg)
            <tr>
                <td>{{ $msg->id }}</td>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->message }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucun message reçu.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $messages->links() }} <!-- pagination -->
@endsection

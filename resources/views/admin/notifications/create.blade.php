@extends('layouts.app')

@section('title', 'Envoyer une notification')

@section('content')
    <h1>Notifier {{ $user->name }}</h1>

    <form method="POST" action="{{ route('notifications.store') }}">
        @csrf
        <input type="hidden" name="id_users" value="{{ $user->id }}">

        <label>Message :</label><br>
        <textarea name="message" rows="5" required>
Votre attestation est prête. Vous pouvez la récupérer auprès du service.
        </textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
@endsection
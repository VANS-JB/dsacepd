@extends('layouts.site')

@section('title', 'Contactez-nous')

@section('content')
<div class="contact-container">

    <h1>Contactez-nous</h1>
    <p class="contact-subtitle">
        Une question, une suggestion ou un besoin d’assistance ?
        N’hésitez pas à nous écrire.
    </p>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="contact-form">
        @csrf

        <div class="form-group">
            <label for="name">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="message">Votre message</label>
            <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn-submit">Envoyer le message</button>
    </form>

</div>

<style>

    /* Global */
.contact-container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff;
    padding: 35px 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    font-family: "Segoe UI", Tahoma, sans-serif;
}

.contact-container h1 {
    text-align: center;
    margin-bottom: 10px;
    color: #333;
}

.contact-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 25px;
    font-size: 15px;
}

/* Alerts */
.alert-success {
    background-color: #e6f9f0;
    border: 1px solid #2ecc71;
    color: #1e8449;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-error {
    background-color: #fdecea;
    border: 1px solid #e74c3c;
    color: #922b21;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-error ul {
    margin-left: 20px;
}

/* Form */
.contact-form .form-group {
    margin-bottom: 18px;
}

.contact-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 11px 12px;
    border-radius: 7px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #1e40af;
    box-shadow: 0 0 0 2px rgba(30,64,175,0.15);
    outline: none;
}

/* Button */
.btn-submit {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, #1e40af, #1e3a8a);
    border: none;
    color: #ffffff;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    font-size: 15px;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-submit:hover {
    background-color: linear-gradient(135deg, #1e40af, #1e3a8a);
    transform: translateY(-1px);
}

</style>



@endsection

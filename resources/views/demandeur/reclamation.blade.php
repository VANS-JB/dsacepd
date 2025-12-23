@extends('layouts.site')

@section('title', 'Faire une réclamation')

@section('content')
    <h1>Faire une réclamation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('demandeur.reclamation.store', $demandeId) }}">
        @csrf

        <label for="objet">Objet :</label><br>
        <input type="text" name="objet" required><br><br>

        <label for="message">Message :</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Envoyer la réclamation</button>
    </form>
@endsection

<style>
/* ================= FORMULAIRE RECLAMATION ================= */
* {
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, sans-serif;
}

/* TITRE */
h1 {
    text-align: center;
    font-size: 28px;
    color: #1f6bff;
    font-weight: 700;
    margin-bottom: 30px;
}

/* ERREURS */
div[style*="color:red"] {
    max-width: 500px;
    margin: 0 auto 20px;
    padding: 14px 20px;
    background: #fff1f2;
    color: #be123c;
    border-radius: 12px;
    font-weight: 600;
}

div ul {
    margin: 0;
    padding-left: 20px;
}

/* FORMULAIRE */
form {
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    background: #ffffff;
    padding: 36px 32px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
    animation: slideFade 0.6s ease;
}

/* LABELS */
form label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: 600;
    color: #4b5563;
}

/* INPUTS ET TEXTAREA */
form input,
form textarea {
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    font-size: 14px;
    transition: all 0.25s ease;
    resize: vertical;
}

form input:focus,
form textarea:focus {
    outline: none;
    border-color: #1f6bff;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(31,107,255,0.18);
}

/* BOUTON */
form button {
    width: 100%;
    margin-top: 10px;
    padding: 14px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(31,107,255,0.4);
}

/* ANIMATION */
@keyframes slideFade {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>





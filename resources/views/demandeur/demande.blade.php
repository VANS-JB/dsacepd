@extends('layouts.site')

@section('title', 'Faire une demande')

@section('content')
    <h1>Faire une demande d’attestation</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('demandeur.demande.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="photo_naissance">Acte de naissance :</label><br>
        <input type="file" name="photo_naissance" required><br><br>

        <label for="photo_releve">Relevé de notes :</label><br>
        <input type="file" name="photo_releve" required><br><br>

        <p><strong>Date de demande :</strong> {{ now()->format('Y-m-d H:i') }}</p>

        <button type="submit">Soumettre la demande</button>
    </form>
@endsection

<style>

/* ================= DEMANDE ATTESTATION (SITE) ================= */

/* TITRE */
main h1 {
    text-align: center;
    font-size: 26px;
    font-weight: 700;
    color: #1f6bff;
    margin-bottom: 30px;
}

/* ERREURS */
main div[style*="color:red"] {
    max-width: 500px;
    margin: 0 auto 20px auto;
    background: #fff1f2;
    padding: 16px;
    border-radius: 14px;
}

main div[style*="color:red"] li {
    font-size: 13px;
    color: #be123c;
}

/* FORMULAIRE */
main form {
    max-width: 500px;
    margin: auto;
    background: #ffffff;
    padding: 32px;
    border-radius: 18px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    animation: slideFade 0.5s ease;
}

/* LABELS */
main form label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

/* INPUT FILE */
main form input[type="file"] {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    background: #f9fafb;
    margin-bottom: 18px;
}

/* INFO DATE */
main form p {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 22px;
}

/* BOUTON */
main form button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.25s ease;
}

/* HOVER */
main form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(31,107,255,0.35);
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

/* RESPONSIVE */
@media (max-width: 600px) {
    main form {
        padding: 24px;
    }
}

</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <label>Nom complet :</label>
        <input type="text" name="name" required><br><br>

        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <label>Confirmer mot de passe :</label>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">S’inscrire</button>
    </form>
</body>
</html>

<style>

  /* ================= AUTH PREMIUM (LOGIN + REGISTER) ================= */
* {
    box-sizing: border-box;
    font-family: "Segoe UI", system-ui, sans-serif;
}

body {
    min-height: 100vh;
    margin: 0;
    background: linear-gradient(135deg, #1f6bff, #6fa8ff);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* TITRE */
h2 {
    margin-bottom: 22px;
    font-size: 26px;
    font-weight: 700;
    color: #ffffff;
}

/* CARTE FORMULAIRE */
form {
    width: 100%;
    max-width: 430px;
    background: #ffffff;
    padding: 36px 32px;
    border-radius: 20px;
    box-shadow: 0 30px 70px rgba(0,0,0,0.18);
    animation: slideFade 0.6s ease;
}

/* LABELS */
form label {
    display: block;
    margin-bottom: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #4b5563;
}

/* INPUTS */
form input {
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    font-size: 14px;
    transition: all 0.25s ease;
}

form input:focus {
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

/* ERREURS */
div ul {
    max-width: 430px;
    margin-bottom: 18px;
    padding: 16px;
    background: #fff1f2;
    border-radius: 14px;
}

div ul li {
    font-size: 13px;
    color: #be123c;
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
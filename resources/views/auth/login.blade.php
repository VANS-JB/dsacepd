<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

     <br>

    <p>
        Vous n’avez pas de compte ?
        <a href="{{ route('register') }}">S’inscrire</a>
    </p>

</body>
</html>

<style>

    /* ================= AUTH PREMIUM ================= */
body {
    min-height: 100vh;
    background: linear-gradient(135deg, #1f6bff, #6fa8ff);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-family: "Segoe UI", system-ui, sans-serif;
}

/* Titre */
h2 {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
}

/* Carte formulaire */
form {
    width: 100%;
    max-width: 420px;
    background: #ffffff;
    padding: 35px 30px;
    border-radius: 18px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    animation: fadeIn 0.6s ease;
}

/* Labels */
form label {
    font-size: 13px;
    font-weight: 500;
    color: #4b5563;
    margin-bottom: 6px;
    display: block;
}

/* Inputs */
form input {
    width: 94%;
    padding: 13px 15px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    background: #f9fafb;
    margin-bottom: 18px;
    transition: all 0.3s ease;
}

form input:focus {
    outline: none;
    border-color: #1f6bff;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(31,107,255,0.15);
}

/* Bouton */
form button {
    width: 100%;
    margin-top: 10px;
    padding: 13px;
    background: linear-gradient(135deg, #1f6bff, #3b82f6);
    border: none;
    border-radius: 12px;
    color: #ffffff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(31,107,255,0.35);
}

/* Erreurs */
div ul {
    max-width: 420px;
    margin: 15px auto;
    padding: 15px;
    background: #fff1f2;
    border-radius: 12px;
}

div ul li {
    font-size: 13px;
    color: #be123c;
}

/* Lien inscription */
p {
    margin-top: 18px;
    font-size: 14px;
    color: #ffffff;
}

p a {
    color: #ffffff;
    font-weight: 600;
    text-decoration: underline;
}

/* Animation */
@keyframes fadeIn {
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

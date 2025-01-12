<!-- resources/views/auth.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
</head>
<body>
    <h1>Authentification</h1>
    
    <h2>Inscription</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input name="name" type="text" placeholder="Nom" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Mot de passe" required>
        <input name="password_confirmation" type="password" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>

    <h2>Connexion</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input name="loginname" type="email" placeholder="Email" required>
        <input name="loginpassword" type="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

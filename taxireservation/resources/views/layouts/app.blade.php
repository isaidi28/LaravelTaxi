<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Liens vers les fichiers CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles') <!-- Permet d'ajouter des styles spécifiques à chaque vue -->
</head>
<body>
    <div id="app">
        <!-- Inclure la navigation si nécessaire -->
        <nav>
            <!-- Contenu de la barre de navigation -->
        </nav>

        <main class="py-4">
            @yield('content') <!-- Ici, le contenu des vues individuelles sera inséré -->
        </main>

        <footer>
            <!-- Contenu du pied de page -->
        </footer>
    </div>

    <!-- Liens vers les fichiers JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts') <!-- Permet d'ajouter des scripts spécifiques à chaque vue -->
</body>
</html>

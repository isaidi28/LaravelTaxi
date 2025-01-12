<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ env('APP_NAME') }}</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <style>
        /* Style de base */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh; /* Prend toute la hauteur de la fenêtre */
        }

        nav {
            background-color: #007bff;
            padding: 10px;
            color: white;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav a {
            color: white;
            padding: 10px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

        /* Contenu principal */
        .content {
            flex-grow: 1; /* Permet au contenu de prendre l'espace restant */
            margin: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

@if (Auth::check())
        @php
            $user_auth_data = [
                'isLoggedin' => true,
                'user' => Auth::user(),
            ];
        @endphp
    @else
        @php
            $user_auth_data = [
                'isLoggedin' => false,
            ];
        @endphp
    @endif
    <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
    </script>
    <div class="content">
    <h1>Bienvenue sur la page monopage !</h1>
    <!-- <script>
        window.Laravel = @json($user_auth_data);
    </script> -->

    <div id="app">
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

    <div class="footer">
        <h6>Site monopage créé avec Laravel 8 et Vue.js</h6>
        <h6>Cours : Applications Web Transactionnelles</h6>
        <h6>Créé par : Ines Saidi</h6>
    </div>
</body>

</html>

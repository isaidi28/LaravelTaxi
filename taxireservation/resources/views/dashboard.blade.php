<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #343a40;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        h2 {
            color: #495057;
            font-size: 1.8rem;
            border-bottom: 2px solid #6c757d;
            padding-bottom: 10px;
            margin-top: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: #ffffff;
            margin: 15px 0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        li:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .nav-link {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 25px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1.1rem;
        }

        .nav-link:hover {
            background-color: #0056b3;
        }

        .button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        .button:hover {
            background-color: #218838;
        }

        .course-details {
            font-size: 1rem;
            line-height: 1.6;
        }

        .inactive {
            color: #999;
            pointer-events: none;
            cursor: not-allowed;
        }

        .inactive:hover {
            text-decoration: none;
        }
        #search {
            padding: 8px 12px;
            font-size: 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <h1>{{ __('general.dashboard') }}
        <input type="text" id="search" placeholder="{{ __('general.search_chauffeur') }}" />
    </h1>





    

    
    @auth
    <!-- Afficher le bouton de déconnexion si l'utilisateur est authentifié -->
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="nav-link">{{ __('general.logout') }}</button>
    </form>
@else
    <!-- Sinon, afficher les liens de connexion et d'inscription -->
    <a href="{{ route('login') }}" class="nav-link">{{ __('general.login') }}</a>
    <a href="{{ route('register') }}" class="nav-link">{{ __('general.register') }}</a>
@endauth


    <a href="{{ url('/apropos') }}" class="nav-link">{{ __('general.go_to_about') }}</a>
    <a href="{{ route('language.switch', 'en') }}">{{ __('general.language_english') }}</a>
    <a href="{{ route('language.switch', 'fr') }}">{{ __('general.language_french') }}</a>
    <a href="{{ route('language.switch', 'de') }}">{{ __('general.language_german') }}</a>
    
    <h2>{{ __('general.chauffeurs') }}</h2>
    <ul>
        @foreach($chauffeurs as $chauffeur)
        <li>
            <a href="{{ route('chauffeurs.show', $chauffeur->id) }}">
                {{ $chauffeur->nom }} {{ $chauffeur->prenom }} - {{ $chauffeur->modele_taxi }} ({{ __('general.pocket_number') }} : {{ $chauffeur->pocket_number }})
            </a>
        </li>
        @endforeach
    </ul>
    @auth
    <button class="button">
        <a href="{{ route('chauffeurs.create') }}" style="color: white; text-decoration: none;">{{ __('general.add_chauffeur') }}</a>
    </button>
@endauth
    
    <h2>{{ __('general.courses') }}</h2>
    <ul>
        @foreach($courses as $course)
        <li>
            <a href="{{ route('courses.show', $course->id) }}">
                <div class="course-details">
                    <strong>{{ __('general.course') }} #</strong>{{ $course->id }}<br>
                    <strong>{{ __('general.chauffeur') }}:</strong> {{ $course->chauffeur->nom }} {{ $course->chauffeur->prenom }}<br>
                    <strong>{{ __('general.client') }}:</strong> {{ $course->utilisateur->name }}<br>
                    <strong>{{ __('general.statut') }}:</strong> {{ $course->statut }}<br>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
   
    
    <h2>{{ __('general.users') }}</h2>
    <ul>
        @foreach($utilisateurs as $utilisateur)
        <li>
            <span class="inactive">{{ $utilisateur->name }} - {{ $utilisateur->email }}</span>
        </li>
        @endforeach
    </ul>
    <a href="{{ route('utilisateurs.create') }}" class="button">{{ __('general.add_user') }}</a>
    

</body>
</html>

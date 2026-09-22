<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Garage Boutique')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
</head>
<body class="nice mb-4">
    <a class="home-button" href="{{ route('home') }}">Accueil</a>
    @yield('content')
</body>
</html>
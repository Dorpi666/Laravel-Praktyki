<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Main </title>
</head>
<body>
    <ol>
        <li><a href="{{ route('general.home') }}">Główna</a></li>
        <li><a href="{{ route('general.about_us') }}">O nas</a></li>
        <li><a href="{{ route('characters.index') }}">Postacie</a></li>
    </ol>

    
    @yield('content')
</body>
</html>
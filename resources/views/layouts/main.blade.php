<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body{
            background-color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .content-wrapper{
            text-align: center;
        }
        .linki {
            text-align: center;
            line-height: 4;
            background: linear-gradient(180deg, #616161 0%, #fff 100%);
            font-family: Lucida;
            color: #000000 !important;
            font-size: 18px;
            
            
        }
    </style>

    <title> Main </title>
</head>
<body>
    <div class="linki">
    <ol>
    
        <a href="{{ route('general.home') }}" style="text-decoration:none;">Główna</a>
        
        <a href="{{ route('characters.index') }}" style="text-decoration:none;">Postacie</a>
    
    </ol>
    </div>
    <div class="content-wrapper">
    @yield('content')
    </div>
</body>
</html>
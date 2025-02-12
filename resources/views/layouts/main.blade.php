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
        .ChampText{
            text-align: left;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 25px;
             width: 500px;
            
        }
        .Parigmate{
            
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 15px;
             width: 100%;
            display:flex;
            
            
        }
        .Paginate svg {
            width: 20px;
        }
        .awatarPicture {
             text-align: right;
        }
        .ChampPicture{
            overflow: hidden;
            float:right;
            
        }
        
        h1{
             text-align: center;
        }

        h2{
             text-align: center;
        }

        h3{
             text-align: center;
        }

        .form-group{
            text-align: center;
        }
        
        .card-header{
            text-align: center;
        }

    </style>

    <title> Main </title>

    


</head>
<body>
    <div class="linki">
    <ol>
    
        <a href="{{ route('general.home') }}" style="text-decoration:none;">Główna</a>
        
        <a href="{{ route('characters.index') }}" style="text-decoration:none;">Postacie</a>

        <a href="{{ route('registration.create') }}" style="text-decoration:none;">Rejestracja</a>

        <a href="{{ route('character.loldle') }}" style="text-decoration:none;">Loldle</a>

        <a href="{{ route('characters.rotation') }}" style="text-decoration:none;">Rotacja na ten tydzień</a>
       
        @auth
        <a href="{{ route('Show.Users') }}" style="text-decoration:none;">Użytkownicy</a>
        <a href="{{ route('options.index') }}" style="text-decoration:none;">Ustawienia</a>
        <?php

        $user = auth()->user();

        ?>
        <br> Zalogowany jako {{ auth()->user()->name }} <img src="{{ asset($user['userAwatar']) }}" width="60px" height="60px">
        
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <div class="flex items-center justify-between">
                    <input type="submit" value="Wyloguj" />
                </div>
    	    </form>
        
        @else
            <a href="{{ route('auth.login') }}" style="text-decoration:none;">Logowanie</a>
        @endauth

        
    </ol>
    </div>

    
    @yield('content')
   

</body>
</html>
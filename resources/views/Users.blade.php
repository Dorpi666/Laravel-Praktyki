@extends('layouts.main')

@section('content')

<h1>Użytkownicy strony LeagueCharacters</h1>
<h2>
@foreach($user as $User)
 Nick: {{$User['name']}}  Main Użytkownika: {{$User->Main->name ?? 'Brak'}}   <br>

@endforeach
</h2>
@endsection
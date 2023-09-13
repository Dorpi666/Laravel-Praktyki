@extends('layouts.main')

@section('content')

<h1>Użytkownicy strony LeagueCharacters</h1>
<h2>
@foreach($user as $User)
 Nick: {{$User['name']}}  Main Użytkownika: {{$User->Main->name ?? 'Brak'}} <img src="{{ asset($User['userAwatar']) }}" width="60px" height="60px">  <br>

@endforeach
</h2>
@endsection
@extends('layouts.main')

@section('content')

    <h2>Rejestracja do LeagueCharacters</h2>
    <form method="POST" action="{{route('registration.store')}}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        @error('name')
        <small>{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        @error('email')
        <small>{{ $message }}</small>
        @enderror

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        @error('password')
        <small>{{ $message }}</small>
        @enderror

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
       
    </form>

@endsection
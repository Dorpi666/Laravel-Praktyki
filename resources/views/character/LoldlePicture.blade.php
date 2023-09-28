@extends('layouts.main')

@section('content')

@if (Session::has('message'))
        <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

<div class="content-wrapper">

<h1> Loldle wersja z Obrazkami</h1>
<br>

<a href="{{ route('character.loldle') }}" style="text-decoration:none;">Loldle wersja Gorsza</a>

<br><br>

<img src="{{ $AbilityPicture }}" width="200px" height="200px">       

Podaj swoją odpowiedź, jakiego championa jest to umiejętność...
<form method="get" action="{{ route('character.loldlePictureAnswer', ['id'=>$character->id]) }}">

    <div class="input-group">
            <input type="text" class="form-control" style="width: 85%" name="search" id="" placeholder="Answer...">
    </div>

</form>


</div>
@endsection 

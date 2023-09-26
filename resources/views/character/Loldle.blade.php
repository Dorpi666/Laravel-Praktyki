@extends('layouts.main')

@section('content')

@if (Session::has('message'))
        <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

<div class="content-wrapper">

<h1> Loldle wersja gorsza</h1>
<br>

Moc postaci: {{$partype}}   <br>
Poziom trudności postaci: {{$difficulty}} <br>
Range ataku postaci: {{$stats}} <br>
@foreach($tags as $tag)
    Typ postaci: {{$tag}} <br>

@endforeach



Podaj swoją odpowiedź, jaki jest to champion...
<form method="get" action="{{ route('character.loldle.answer') }}">

    <div class="input-group">
            <input type="text" class="form-control" style="width: 85%" name="search" id="" placeholder="Answer...">
    </div>

</form>

</div>
@endsection 

@extends('layouts.main')

@section('content')
<h1>Wybrana Postać</h1>

    
            <h2 class="text -3xl hover:text-gray-300">

                Postać nr.{{$character['id']}}: <br>
                Nazwa: {{$character['name']}}   <br>
                Rola Postaci: {{$character['role']}}   <br>
                Linia Postaci: {{$character['lane']}}  <br>
                Cena Postaci: {{$character['shop-cost']}}  <br>
                Poziom trudności Postaci: {{$character['difficulty']}}

            </h2>
   
            
@endsection
@extends('layouts.main')

@section('content')
<h1>Wybrana Postać</h1>

    
            <h2 class="text -3xl hover:text-gray-300">

                Nazwa: {{$character['name']}}   <br>
                Rola Postaci: {{$character['role']}}   <br>
                Linia Postaci: {{$character['lane']}}  <br>
                Cena Postaci: {{$character['shop-cost']}}  <br>
                Poziom trudności Postaci: {{$character['difficulty']}}
                <img src="/Grafika/Bard_Render.png">

            </h2>
   
            
@endsection
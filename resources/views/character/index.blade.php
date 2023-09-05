@extends('layouts.main')

@section('content')
<h1>Wszystkie postacie</h1>

    @foreach ($characters as $index => $pub)
            <h2 class="text -3xl hover:text-gray-300">
 
                <a href="{{ route('characters.show', ['id' => $pub->id])}}">
                   
                    Nazwa: {{$pub['name']}}   <br> <br>
                    
                </a>

            </h2>
    @endforeach

@endsection
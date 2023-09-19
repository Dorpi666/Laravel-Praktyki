@extends('layouts.main')

@section('content')
<h1>Championy w rotacji na ten tydzień</h1>




@foreach ($champion as $key => $value)
            <h2 class="text -3xl hover:text-gray-300">
                
                <a href="{{ route('rotation.champion',[$value]) }}" style="text-decoration:none;">{{$value}}</a>

            </h2>
    @endforeach
    
@endsection
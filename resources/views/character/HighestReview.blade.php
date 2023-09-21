@extends('layouts.main')

@section('content')

<div class="content-wrapper">

<h1>Bohater z najwyższą średnią ocen to: {{$ReviewChampName}}: Średnio: {{$averageReview}} gwiazdki</h1>
<br>
<img src="{{ $imageUrlBanner }}" width="15%" height="15%">  

</div>
@endsection 

@extends('layouts.main')

@section('content')


<div class="content-wrapper">

<h1> Sugerowany team dla tej postaci:</h1>
<br>

Toplane: {{$toplaner}} <br>
Jungler: {{$jungler}} <br>
Midlaner: {{$midlaner}} <br>
ADC: {{$adc}} <br>
Support: {{$support}}

</div>
@endsection 

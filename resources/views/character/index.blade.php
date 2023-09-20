@extends('layouts.main')

@section('content')
<h1>Wszystkie postacie</h1>

    Filtry:
    <form method="get" action="{{ route('characters.filter') }}">
    
    Wyszukaj championa po nazwie:

    <div class="input-group">
        <input type="text" class="form-control" style="width: 85%" name="search" id="" placeholder="Search...">
        
    </div>

    Linia:
        <select  name="character_lane">
            <option value=""> Każda </option>
            <option value="Top"> Top </option>
            <option value="Jungle">Jungle</option>
            <option value="Mid">Mid</option>
            <option value="Botlane">Botlane</option>
            
         </select>
        <br>
    Rola:
         <select  name="character_role">
            <option value=""> Każda </option>
            <option value="Tank"> Tank </option>
            <option value="Mage"> Mage </option>
            <option value="Adc"> Adc </option>
            <option value="Support"> Support </option>
            <option value="Assasin"> Assasin </option>
            <option value="Bruiser"> Bruiser </option>
            
         </select>
         <br>
    Poziom trudności:
         <select  name="character_difficulty">

            <option value=""> Każda </option>
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            
         </select>
         <br>
    Cena:
         <select  name="character_cost">

            <option value=""> Każda </option>
            <option value="450"> 450 </option>
            <option value="1350"> 1350 </option>
            <option value="3150"> 3150 </option>
            <option value="4444"> 4444 </option>
            <option value="4800"> 4800 </option>
            <option value="6300"> 6300 </option>
            
         </select>
    <input type="submit" class="btn btn-success" value="show" />
    </form>

    

 
    @foreach ($characters as $index => $pub)
            <h2 class="text -3xl hover:text-gray-300">
 
                <a href="{{ route('characters.show', ['id' => $pub->id])}}" style="text-decoration:none;"><img src="{{ "http://ddragon.leagueoflegends.com/cdn/13.18.1/img/champion/".$pub->ChampPicture }}" width="100" height="100">
                   
                    {{$pub['name']}} <br>
                    
                </a>
                
            </h2>
    @endforeach
    
    <div class="Parigmate">
    <script src="https://cdn.tailwindcss.com"></script>
    {{ $characters->links() }}
    </div>

@endsection
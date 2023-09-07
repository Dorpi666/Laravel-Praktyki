@extends('layouts.main')

@section('content')
<h1>Wybrana Postać</h1>

    <div class="ChampPicture">
            
                <img src="{{ asset($character['ChampPicture']) }}" width="50%" height="50%">
            
    </div>

    <div class="ChampText">
           

                Nazwa: {{$character['name']}}   <br>
                Rola Postaci: {{$character['role']}}   <br>
                Linia Postaci: {{$character['lane']}}  <br>
                Cena Postaci: {{$character['shop-cost']}}  <br>
                Poziom trudności Postaci: {{$character['difficulty']}}
                
            
    </div>
    <br><br><br><br>
    
    <h4>Display Comments</h4>
    
                    @include('character.commentsDisplay', ['comments' => $character->comments, 'champion_id' => $character->id])
   
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="champion_id" value="{{ $character->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
    
@endsection
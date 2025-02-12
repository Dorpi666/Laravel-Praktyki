@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        
        <h1>Ustawienia Championów</h1>

        <br>
        <br>

        <h1>Dodaj championa</h1>

        <form action="{{ route('add.champions') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nameInput" class="form-label">Nazwa</label>
                                <input name="name" type="text" class="form-control" id="nameInput" placeholder="name">
                                
                            </div>

                            <div class="mb-3">
                                <label for="roleInput" class="form-label">Rola</label>
                                <input name="role" type="text" class="form-control" id="roleInput" placeholder="role">
                                
                            </div>

                            <div class="mb-3">
                                <label for="laneInput" class="form-label">Linia</label>
                                <input name="lane" type="text" class="form-control" id="laneInput" placeholder="lane">
                                
                            </div>

                            <div class="mb-3">
                                <label for="shop-costInput" class="form-label">Cena</label>
                                <input name="shop-cost" type="text" class="form-control" id="shop-costInput" placeholder="shop-cost">
                                
                            </div>

                            <div class="mb-3">
                                <label for="difficultyInput" class="form-label">Cena</label>
                                <input name="difficulty" type="text" class="form-control" id="difficultyInput" placeholder="difficulty">
                                
                            </div>
                            
                           

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success">Dodaj</button>
                        </div>

                    </form>

                    <br>
                    <br>

                    
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('store.Image',['id'=>$character->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Image</label> <br>
                            Dodając zdjęcie, pamiętaj aby nazywało się "NazwaPostaci.png" np. Bard.png lub Ornn.png oraz posiadało jako tlo kanał alfa (przezroczyste tło)

                            <div class="col-sm-9">
                              <input type="file" class="form-control" name="image" @error('image') is-invalid @enderror id="selectImage">
                            </div>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <img id="preview" src="#" alt="your image" class="mt-3" style="display:none;"/>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                        </div>
                    </form>


                    <br> 
                    <br>
                    

                    <form action="{{ route('update.champions',['id'=>$character->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">Champion Name</label>
                            <input type="text" name="name" value="{{$character->name}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Champion Role</label>
                            <input type="text" name="role" value="{{$character->role}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Champion Lane</label>
                            <input type="text" name="lane" value="{{$character->lane}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Champion Cost</label>
                            <input type="text" name="shop-cost" value="{{$character->cost}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Champion Difficulty</label>
                            <input type="text" name="difficulty" value="{{$character->difficulty}}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Champion</button>
                        </div>

                    </form>


                    <br> 
                    <br>

                
                    <form action="{{ route('delete.champions') }}" method="POST">
                    @csrf
                    
                       <select  name="champion_id">

                            <option>Select Champion to Delete</option>
                        
                            @foreach ($characters as $key => $value)
                                <option value="{{ $key }}"> 
                                    {{ $value }} 
                                
                                </option>
                            @endforeach
                        
                        </select>
                        
                        <input type="submit" value="delete"/>

                    </form>

    </div>
@endsection

@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
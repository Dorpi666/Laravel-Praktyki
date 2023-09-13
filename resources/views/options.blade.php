@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="content-wrapper">{{ __('Change Password') }}</div>

                    <form action="{{ route('login.reset.password') }}" method="POST">
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
                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">New Password</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirm New Password">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success">Submit</button>
                        </div>

                    </form>


                    <br>
                    <br>


                    <form action="{{ route('user.main') }}" method="POST">
                    @csrf
                    
                       <select  name="character_id">

                            <option>Select Champion</option>
                        
                            @foreach ($characters as $key => $value)
                                <option value="{{ $key }}" {{ ( $key == $selectedID) ? 'selected' : '' }}> 
                                    {{ $value }} 
                                
                                </option>
                            @endforeach
                        
                        </select>
                        
                        <input type="submit" value="save"/>

                    </form>

                    <br>
                    <br>
                    
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('store.Awatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Image</label> <br>
                            Dodaj awatar do swojego konta

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
        
                </div>
            </div>
        </div>
    </div>
@endsection

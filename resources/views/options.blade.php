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

                    <div class="card">
        
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
<h1>Logowanie do LeagueCharacters</h1>

<h3> 

    <form method="post" action="{{ route('auth.login') }}">
    @csrf
    <div class="form-group">
     <label>Enter Email</label>
     <input type="email" name="email" class="form-control" />
    </div>
    @error('email')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror


    <div class="form-group">
     <label>Enter Password</label>
     <input type="password" name="password" class="form-control" />
    </div>
    @error('password')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror

    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
    </div>
   </form>

   <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="checkbox">
                                      <label>
                                          <a href="{{ route('forget.password.get') }}">Reset Password</a>
                                      </label>
                                  </div>
                              </div>
                          </div>

</h3>
@endsection
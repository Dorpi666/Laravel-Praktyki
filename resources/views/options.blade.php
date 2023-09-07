@extends('layouts.main')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Ustawienia użytkownika</div>
                  <br><br>

                  <div class="card-header">Zresetuj hasło</div>

                  <div class="card-body">
  
                      <form action="{{ route('reset.password.post') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group row">
                              <label for="old-password" class="col-md-4 col-form-label text-md-right">Old Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="old-password" class="form-control" name="old-password" required autofocus>
                                  @if ($errors->has('old-password'))
                                      <br><span class="text-danger">{{ $errors->first('old-password') }}</span><br>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <br><span class="text-danger">{{ $errors->first('password') }}</span><br>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <br><span class="text-danger">{{ $errors->first('password_confirmation') }}</span><br>
                                  @endif
                              </div>
                          </div>
  
                          <div class="card-header">
                              <button type="submit" class="btn btn-primary">
                                  Reset Password
                              </button>
                          </div>
                      </form>
                        
                  </div>
                  <div class="card-header">Zmiana maina</div>
                    <?php 
                        foreach ($characters as $id) {
                        ?>
                            <option><?php echo $id['name']; ?> </option>
                            <?php 
                            }
                        ?>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection
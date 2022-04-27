@extends('layout')
  
@section('content')
@if ($message = session()->has('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session()->get('success') }}
    </div>
@endif
@if ($message = session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('error') }}
    </div>
@endif
{!! RecaptchaV3::initJs() !!}
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">
  
                      <form action="{{ route('user.store') }}" method="POST" id="form">
                          @csrf
                          <div class="form-group row">
                              <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="first_name" class="form-control" name="first_name"  autofocus>
                                  @if ($errors->has('first_name'))
                                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="last_name" class="form-control" name="last_name" required autofocus>
                                  @if ($errors->has('last_name'))
                                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="email" id="email" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group row">
                              <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                              <div class="col-md-6">
                                  <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" required autofocus max="<?php echo date("Y-m-d"); ?>">
                                  @if ($errors->has('date_of_birth'))
                                      <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="confirm_password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                                  @if ($errors->has('confirm_password'))
                                      <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                  @endif
                              </div>
                          </div>
                          <div class="col-md-6 offset-md-4">
                                <div class="g-recaptcha" data-sitekey="{{ config('recaptchav3.sitekey') }}" name="g_recaptcha_response"></div>
                                <div id="captcha_msg"></div>
                              <button type="submit" name="submit" id="submit" class="btn btn-primary">
                                  Submit
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection


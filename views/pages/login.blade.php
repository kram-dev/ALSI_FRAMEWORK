@extends('layouts.main')

@section('title', 'Login |')

@section('home')
  <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Sign In</h5>
              <form action="{{ url('ALSI') }}do_login" class="form-signin" method="post">
                @csrf
                @method('POST')
                <div class="form-label-group">
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ val('email') }}" autofocus>
                  <label for="inputEmail">Email address</label>
                    <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('email') }}</p>
                </div>
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  <label for="inputPassword">Password</label>
                    <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('password') }}</p>
                </div>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                <div class="custom-control mt-3">
                  Dont have an account ? <a href="{{ url('logout') }}"> Register here</a>
                  <!-- url('login', null, ['id' => 22]) -->
                </div>
                <hr class="my-4">
                <a href="{{ Session::Get('google_url') }}" class="btn btn-lg btn-google btn-block text-uppercase"><i class="fa fa-google-plus mr-2"></i> Sign in with Google</a>
                <a href="{{ Session::Get('facebook_url') }}" class="btn btn-lg btn-facebook btn-block text-uppercase"><i class="fa fa-facebook mr-2"></i> Sign in with Facebook</a>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection

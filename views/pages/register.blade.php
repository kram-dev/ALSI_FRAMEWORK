
@extends('layouts.main')

@section('title', 'Register |')

@section('register')
  <div class="container">
      <div class="row">
        <div class="col"
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Sign Up</h5>
              <form action="{{ app['url'] }}register/do_register" class="form-signin" method="post">
                @csrf
                <div class="form-label-group">
                  <input type="text" name="fname" id="inputFullname" class="form-control" placeholder="Full Name" value="{{ val('fname') }}" autofocus>
                  <label for="inputFullname">Full Name</label>
                  <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('fname') }}</p>
                </div>
                <div class="form-label-group">
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ val('email') }}" >
                  <label for="inputEmail">Email Address</label>
                  <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('email') }}</p>
                </div>
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  <label for="inputPassword">Password</label>
                  <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('password') }}</p>
                </div>
                <div class="form-label-group">
                  <input type="password" name="rpassword" id="repeatPassword"  class="form-control" placeholder="Confirm Password">
                  <label for="repeatPassword">Confirm Password</label>
                  <p class="small text-center mt-2 mb-2" style="color:red;">{{ error('rpassword') }}</p>
                </div>
                <button class="btn btn-lg btn-primary btn-block text-uppercase submit" type="submit">Sign up</button>
                <div class="custom-control mt-3">
                  Have an account ? <a href="{{ route('login') }}"> Login here</a> </br>
                </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection



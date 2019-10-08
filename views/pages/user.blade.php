@extends('layouts.main')

@section('title', 'Dashboard |')

@section('user')

@include('layouts.components.nav')

<div class="container">
<div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
          <div class="jumbotron">
            <h1 class="display-5">Hello,
               @if (Session::Get('id'))
                  {{ $user['name'] }} 
               @else 
                  {{ Session::Get('facebook_name') }}
                  {{ Session::Get('google_name') }}
              @endif
            </h1>
            <p class="lead">This is a simple work based in OOP/MVC structure with tagalog documentation. I hope you like it :)</p>
            <hr class="my-4">
            <div class="text-muted mt-2 text-center">
                <a href="" class="text-muted p non-decor">DOCUMENTATION</a> <br/>
            </div>
          </div>
          <center><a href="{{ route('') }}" class="btn btn-primary btn-md mt-3">Back to Home</a></center>
        </div>
    </div>
</div>
@endsection


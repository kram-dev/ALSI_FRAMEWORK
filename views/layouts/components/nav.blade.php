
  <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3 float-right">
                  @if(Session::Get('id') || Session::Get('facebook_id') || Session::Get('google_id'))
                   <div class="dropdown show">
                      <a class="text-muted dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          @if (Session::Get('id'))
                            {{ $user['name'] }}
                          @endif
                      </a>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="">Dashboard</a>
                        <a class="dropdown-item" href="">Logout</a>
                      </div>
                    </div>
                  @else
                     <a href="{{ url('login') }}" class="text-muted h6 non-decor">Login</a>
                  @endif
                </div>
            </div>
        </div>
    </div>
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container px-3">
          <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{asset('frontend/img/sitelogo.png')}}" alt="" width="100px">
          </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
              </button>

              <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                <ul class="navbar-nav scrollable-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/posts">Posts</a></li>
                    <li><a href="/categories">Categories</a></li>
                    @if (Route::has('login'))
                    @auth
                        <!-- Dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown" onclick="dropMenu()">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;
                        </a>
                        <div class="dropdown-menu menu1" style="display: none" id="dropMenu">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>

                    </li>
                    @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth

                 @endif
                </ul>
              </div>
        </div>
    </nav>
</header>

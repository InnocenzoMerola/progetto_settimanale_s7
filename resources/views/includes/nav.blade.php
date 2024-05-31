<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <p class="navbar-brand my-0">I&M</p>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Corsi
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('courses.index')}}">Lista</a></li>
                @auth
                @if(auth()->user()->isAdmin())
                  <li><a class="dropdown-item" href="{{route('courses.create')}}">Crea</a></li>
                @endif
                  
                @endauth 
               
            </ul>
          </li>
          @auth
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              Dashboard
            </a>
          </li>
          @endauth
          {{-- @auth
            @if (['user' => 'admin'])
              <li class="nav-item"><a class="nav-link" href="{{route('admin.index')}}">Admin</a></li>
            @endif
          @endauth --}}
        </ul>
        <ul  class="navbar-nav mb-2 mb-lg-0 me-2">
            @auth
                <li class="nav-item dropstart">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profilo</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">LogOut</button>
                        </form>
                    </li>
                    </ul>
                </li>
            @endauth
            @guest
                <li class="nav-item dropstart">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ospite
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{route('login')}}" class="dropdown-item">Accedi</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="dropdown-item">Registrati</a>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>
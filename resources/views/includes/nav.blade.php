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
              Progetti
            </a>
            {{-- <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('projects.index')}}">Lista</a></li>
                @auth
                <li><a class="dropdown-item" href="{{route('projects.yourProject')}}">Personali</a></li>
                <li><a class="dropdown-item" href="{{route('projects.create')}}">Crea</a></li>
                @endauth
            </ul> --}}
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Attività
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('courses.index')}}">Lista</a></li>
                @auth
                <li><a class="dropdown-item" href="{{route('courses.create')}}">Crea</a></li>
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
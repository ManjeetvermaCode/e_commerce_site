     <style>
      li{
        list-style-type: none;
      }
     </style>
     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Account</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Acl
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item">Roles</a>
                            <ul>
                              <li><a class="dropdown-item" href="{{route('roles.create')}}">Create</a></li>
                              <li><a class="dropdown-item" href="{{route('roles.index')}}">List</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item">Permissions</a>
                            <ul>
                              <li><a href="{{route('permissions.create')}}" class="dropdown-item">Create</a></li>
                              <li><a href="{{route('permissions.index')}}" class="dropdown-item">List</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item">User Role</a>
                            <ul>
                              <li><a href="#" class="dropdown-item">Assign User Role</a></li>
                            </ul>
                          </li>
                          <li><a class="dropdown-item">Role Permissions</a>
                            <ul>
                              <li><a href="#" class="dropdown-item">Assign Role Permission</a></li>
                            </ul>
                          </li>
                          {{-- <li><hr class="dropdown-divider"></li> --}}
                          {{-- <li><a class="dropdown-item" href="#">Users</a></li> --}}
                        </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Products
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Comming soon</a>
                      </li>
                    </ul>
                    <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
 
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-detail text-uppercase" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Storage::disk('public')->exists(Auth::user()->avatar))
                            <span class="float-left mr-2"><img id="prevImg" src="{{ config('global.type_asset')('/storage/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar-image"></span>
                            @else
                            <span class="float-left mr-2"><img id="prevImg" src="{{ config('global.type_asset')('img/users/avatar.png') }}" alt="Avatar" class="avatar-image"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                {{ __('Users') }}<span class="float-right"><i class="fas fa-users"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Roles') }}<span class="float-right"><i class="fas fa-tags"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.cities.index') }}">
                                {{ __('Cities') }}<span class="float-right"><i class="fas fa-city"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.states.index') }}">
                                {{ __('States') }}<span class="float-right"><i class="fas fa-flag"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.notices.index') }}">
                                {{ __('Notices') }}<span class="float-right"><i class="fas fa-bullhorn"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Reports') }}<span class="float-right"><i class="fas fa-chart-pie"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Process') }} - 1<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Process') }} - 2<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Process') }} - 3<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Process') }} - 4<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('default.cables.index') }}">
                                {{ __('Cables') }}<span class="float-right"><i class="fas fa-minus"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('default.boxes.index') }}">
                                {{ __('Boxes') }}<span class="float-right"><i class="fas fa-bookmark"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('default.splitters.index') }}">
                                {{ __('Splitters') }}<span class="float-right"><i class="fas fa-code-branch"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Process List') }}<span class="float-right"><i class="fas fa-list"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('default.customers.index') }}">
                                {{ __('Customers') }}<span class="float-right"><i class="fas fa-user-friends"></i></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}">
                                {{ __('My profile') }}<span class="float-right"><i class="fas fa-user-circle"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}<span class="float-right"><i class="fas fa-sign-out-alt"></i></span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
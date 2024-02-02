<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Insta') }} | @yield('title') </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Insta') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- search bar here --}}



                    <ul class="navbar-nav ms-auto">
                        <form action="{{route('search')}}" method="get">
                            {{-- @csrf --}}
                            <input type="text" name="search" id="" class="form-control" placeholder="Search...">
                        </form>
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
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="fa-solid fa-house text-dark icon-sm"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('post.create') }}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus text-dark icon-sm"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">



                                <a id="navbarDropdown" class="nav-link" href="" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->avatar)
                                        {{-- <div class="ratio ratio-1x1"> --}}
                                        <img src="{{ Auth::user()->avatar }}" alt=""
                                            class="img-fluid rounded rounded-circle avatar-sm" width="48px">
                                        {{-- </div> --}}
                                    @else
                                        <i class="fa-solid fa-circle-user text-dark icon-sm"></i>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    {{-- soon: admin controls --}}
                                    <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user-gear"></i> Admin
                                    </a>
                                    <hr class="dropdown-divider">

                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item">
                                        <i class="fa-solid fa-circle-user text-dark"></i> Profile
                                    </a>



                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
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

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">

                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users.index') }}"
                                    class="list-group-item {{ request()->is('admin/users/index') ? 'active' : '' }}">
                                    <i class="fa-solid fa-users"></i> Users
                                </a>
                                <a href="{{ route('admin.posts.index') }}"
                                    class="list-group-item {{ request()->is('admin/posts/index') ? 'active' : '' }}">
                                    <i class="fa-solid fa-newspaper"></i> Posts
                                </a>
                                <a href="{{route('admin.categories.index')}}" class="list-group-item {{ request()->is('admin/categories/index') ? 'active' : '' }}">
                                    <i class="fa-solid fa-tags"></i> Categories
                                </a>
                            </div>
                        </div>
                    @else
                    @endif

                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>

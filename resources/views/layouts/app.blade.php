<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts (Laravel Mix) -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles (Laravel Mix) -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-brown4">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-brown fixed-top" >
            <div class="container">
                <a class="navbar-brand text-brown4" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-brown4" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-brown4" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-brown4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <!-- avatar image -->
                                    @if ( null === auth()->user()->getFirstMedia('avatar') )
                                    <img src="/storage/noimage.png" alt="noimage" width="40" height="40" alt="" class="rounded-circle mr-2">
                                    @else
                                    <img src="{{ auth()->user()->getFirstMedia('avatar')->getUrl('thumb') }}" width="40" height="40" alt="" class="rounded-circle mr-2">
                                    @endif
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right bg-brown" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-brown4" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item text-brown4" href="{{ route('profile', ['id' => auth()->user()->id ])}}">プロフィール</a>

                                    <a href="{{ route('posts.create') }}" class="dropdown-item text-brown4">
                                        投稿する
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

        <main class="py-5">
            @if (session('status'))
                <div class="alert alert-success text-center my-4" role="alert">
                    {{ session('status')}}
                </div>
            @elseif (session('status_alert'))
                <div class="alert alert-danger text-center my-2" role="alert">
                    {{ session('status_alert')}}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>

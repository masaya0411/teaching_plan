<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Teaching Plan | @yield('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="app">
        <header class="l-header">
            <h1 class="l-header__title"><a href="/">Teaching Plan</a></h1>

            <div class="l-header__menuTrigger js-toggle-sp-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="l-header__nav js-toggle-sp-menu-target">
                <ul class="l-header__list">
                    @guest
                        <li class="l-header__item js-close-menu-item">
                            <a class="l-header__link" href="{{ route('register') }}">ユーザー登録</a>
                        </li>
                        <li class="l-header__item js-close-menu-item">
                            <a class="l-header__link" href="{{ route('login') }}">ログイン</a>
                        </li>
                    @else
                        <li class="l-header__item js-close-menu-item">
                            <a class="l-header__link" href="{{ route('lessons.mypage') }}">HOME</a>
                        </li>
                        <li class="l-header__item js-close-menu-item">
                            <a class="l-header__link" href="{{ route('logout') }}"onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">ログアウト</a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </header>

        <div class="u-padding-top"></div>

        <!-- フラッシュメッセージ -->
        @if (session('flash_message'))
        <div class="alert alert-primary text-center mb-0" role="alert">
            {{ session('flash_message') }}
        </div>
        @endif

        <main class="py-4 l-main">
            @yield('content')
        </main>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/post.js') }}"></script>
</body>
</html>

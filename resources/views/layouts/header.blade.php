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
                    <a class="l-header__link" href="{{ route('lessons.mypage') }}">マイページ</a>
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


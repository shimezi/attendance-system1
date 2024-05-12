<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ 'css/sanitize.css' }}">
    <link rel="stylesheet" href="{{ 'css/common.css' }}">
    @yield('css')
</head>

<body>
    <header class="header">
        @yield('header')
        <div class="header__inner">
            <a class="header__logo" href="/">
                Atte
            </a>
            <nav>
                @if (Auth::check())
                    <ul>
                        <li><a href="/">ホーム</a></li>
                        <li><a href="/attendance">日付一覧</a></li>
                        <form class="form" action="/logout" method="post">
                            @csrf
                            <li><a href="/auth/login">ログアウト</a></li>
                        </form>
                    </ul>
                @endif
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <fotter class="fotter">
        @yield('footer')
        <div class="footer__inner">
            <p class="footer__text"><small>Atte,inc.</small></p>
        </div>
    </fotter>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header-inner">
            <h1 class="logo">
                <a href="{{ route('index') }}">Atte</a>
            </h1>
            @if (Auth::check())
                <div class="nav-container">
                    <ul class="nav-list">
                        <li><a href="{{ route('index') }}">ホーム</a></li>
                        <li><a href="{{ route('attendance') }}">日付一覧</a></li>
                    </ul>
                    <a href="#" class="logout-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <small>Atte, Inc.</small>
    </footer>
</body>

</html>

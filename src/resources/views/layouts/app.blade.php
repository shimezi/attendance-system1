<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>勤怠管理システム</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        @if (Auth::check())
            <nav>
                <ul>
                    <li><a href="{{ route('index') }}">ホーム</a></li>
                    <li><a href="{{ route('attendance') }}">日付一覧</a></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="logout-link">ログアウト</button>
                        </form>
                    </li>
            </nav>
        @endif
    </header>
    <main>
        @yield('content')
    </main>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <!-- 他のフッターコンテンツ -->
</body>

</html>

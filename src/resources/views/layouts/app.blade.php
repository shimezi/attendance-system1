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
        <div class="header__inner">
            <a class="header__logo" href="/">
                Atte
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <fotter class="fotter">
        <small>Atte,inc.</small>
    </fotter>
</body>

</html>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
    <title>もぎたて</title>
</head>
<body>
    <header class="header">
        <a href="#">ロゴ</a>
    </header>
    <main class="main">
        @yield('content')
    </main>
</body>
@yield('js')
</html>
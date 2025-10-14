<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('styles')
</head>
<body>
    @yield('header')

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <title>FashionablyLate</title>
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-logo">
                <h1>FashionablyLate</h1>
            </div>
            <nav class="header-nav">
                @yield('header_button')
            </nav>
        </div>
    </header>
    <main class="main">
        @yield('content')
    </main>
</body>
</html>
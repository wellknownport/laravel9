<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @viteReactRefresh
    @vite(['resources/css/app.scss', 'resources/js/form.input.file.jsx'])
</head>
<body>
<header>
    <h1 class="app-title">1行日記</h1>
</header>
<main class="content">
    @yield('content')
</main>
</body>
</html>

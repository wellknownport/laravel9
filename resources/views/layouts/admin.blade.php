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
    <h1 class="app-title">1行日記 管理画面</h1>
    <div class="user-status">
        {{ Auth::user()->name }}
        <form method="POST" action="{{ route('logout') }}">
            <input type="submit" name="submit" value="ログアウト">
            @csrf
        </form>
    </div>
</header>

<main class="content">
    @if (session('flash'))
        <div class="flash-messages">
            <div class="inner">
                {{ session('flash') }}
            </div>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>

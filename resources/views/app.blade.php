<!DOCTYPE html>
<html lang="ru">

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Персонажи Don't Starve Together</title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/characters">Characters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('users.characters', Auth::user()->name) }}" class="nav-link">My characters</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
@yield('content')

</body>
</html>

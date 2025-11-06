<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel - Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: Figtree, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f3f4f6;
        }
        .card {
            background-color: white;
            padding: 2rem 3rem;
            border-radius: 1rem;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h1 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #111827;
        }
        .links a {
            display: inline-block;
            margin: 0.5rem 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            color: white;
            background-color: #FF2D20;
            transition: background-color 0.3s;
        }
        .links a:hover {
            background-color: #e02a1c;
        }
        @media (prefers-color-scheme: dark) {
            body { background-color: #111111; }
            .card { background-color: #1f1f1f; color: #f3f4f6; }
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Selamat Datang</h1>
        @if (Route::has('login'))
        <div class="links">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
        @endif
    </div>
</body>
</html>

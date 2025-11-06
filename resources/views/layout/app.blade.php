<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div class="text-xl font-bold">
            <a href="{{ route('produk.index') }}">{{ config('app.name') }}</a>
        </div>
        <div class="space-x-4">
            @auth
                <a href="{{ route('produk.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
                <a href="{{ route('lokasi.index') }}" class="text-gray-700 hover:text-blue-600">Lokasi</a>
                <a href="{{ route('mutasi.index') }}" class="text-gray-700 hover:text-blue-600">Mutasi</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow p-4 text-center text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

</body>
</html>

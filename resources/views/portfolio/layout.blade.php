<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portfolio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <header class="bg-white shadow">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="font-semibold text-lg">Portfolio</a>
                <a href="{{ route('projects') }}" class="text-sm text-indigo-600 hover:underline">Projects</a>
            </div>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    <span>Halo, {{ Auth::user()->name }}</span>
                    <a href="{{ route('post.projects.index') }}" class="text-indigo-600 hover:underline">Kelola Project</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>
</html>

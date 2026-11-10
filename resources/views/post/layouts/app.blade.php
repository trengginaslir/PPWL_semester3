<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white min-h-screen">

            <div class="p-6 text-xl font-bold border-b border-gray-700">
                Admin Panel
            </div>

            <nav class="mt-4">

                {{-- Menu Dashboard --}}
                <a href="{{ route('post.dashboard') }}"
                   class="block px-6 py-3 hover:bg-gray-700
                   {{ request()->routeIs('post.dashboard') ? 'bg-gray-700' : '' }}">
                    Dashboard
                </a>

                {{-- Menu Projects --}}
                <a href="{{ route('post.projects.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700
                   {{ request()->routeIs('post.projects.*') ? 'bg-gray-700' : '' }}">
                    Projects
                </a>

                {{-- Menu Skills --}}
                <a href="{{ route('post.skills.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700
                   {{ request()->routeIs('post.skills.*') ? 'bg-gray-700' : '' }}">
                    Skills
                </a>

            </nav>
        </aside>


        {{-- Bagian Konten --}}
        <div class="flex-1">

            {{-- Navbar --}}
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

                <h1 class="font-semibold text-gray-800">
                    @yield('header', 'Dashboard')
                </h1>

                <div class="flex items-center gap-4">

                    <span class="text-gray-600">
                        {{ Auth::user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>

                </div>

            </header>


            {{-- Konten Halaman --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>
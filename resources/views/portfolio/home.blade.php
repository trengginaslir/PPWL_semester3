<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">
    <header class="bg-white shadow">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-semibold text-lg">Portfolio</a>

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
        <h1 class="text-2xl font-bold mb-6">Project Saya</h1>

        @forelse ($projects as $project)
            <div class="bg-white rounded-lg shadow p-5 mb-4">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('projects.show', $project) }}" class="hover:underline">{{ $project->title }}</a>
                </h2>
                <p class="mt-2 text-gray-600">{{ $project->description }}</p>
                <small class="text-gray-400">{{ $project->created_at->format('d M Y') }}</small>
            </div>
        @empty
            <p class="text-gray-500">Belum ada project.</p>
        @endforelse
    </main>
</body>
</html>
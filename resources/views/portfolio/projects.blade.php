@extends('portfolio.layout')

@section('title', 'Projects - Portfolio')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Daftar Project</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @forelse ($projects as $project)
            <a href="{{ route('projects.show', $project) }}"
               class="block bg-white rounded-lg shadow hover:shadow-md overflow-hidden">

                @if ($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                        No Image
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $project->title }}</h2>
                    <p class="text-sm text-indigo-600 mt-1">
                        {{ $project->category->name ?? 'Belum ada kategori' }}
                    </p>
                    <p class="mt-2 text-gray-600 text-sm">
                        {{ Str::limit($project->description, 100) }}
                    </p>
                </div>
            </a>
        @empty
            <p class="text-gray-500">Belum ada project.</p>
        @endforelse
    </div>
@endsection

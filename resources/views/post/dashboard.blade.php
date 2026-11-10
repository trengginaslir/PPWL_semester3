@extends('post.layouts.app')

@section('header', 'Dashboard Admin')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">
        Dashboard Admin
    </h1>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <x-stat-card
            label="Projects"
            :value="$totalProjects"
        />

        <x-stat-card
            label="Categories"
            :value="$totalCategories"
            color="text-green-600"
        />

        <x-stat-card
            label="Technologies"
            :value="$totalTechnologies"
            color="text-purple-600"
        />

        <x-stat-card
            label="Skills"
            :value="$totalSkills"
            color="text-orange-600"
        />

    </div>

    {{-- Statistik Status Project --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">

        <x-stat-card
            label="Published"
            :value="$totalPublished"
            color="text-green-600"
        />

        <x-stat-card
            label="Draft"
            :value="$totalDraft"
            color="text-red-600"
        />

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

        {{-- Skill Teratas --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Skill Teratas</h2>

            @forelse ($topSkills as $skill)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $skill->name }}</span>
                    <span class="text-sm text-gray-500">
                        {{ $skill->projects_count }} project
                    </span>
                </div>
            @empty
                <p class="text-gray-500">Belum ada skill.</p>
            @endforelse
        </div>

        {{-- Jumlah Project per Kategori --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold mb-4">Project per Kategori</h2>

            @forelse ($categories as $category)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $category->name }}</span>
                    <span class="text-sm text-gray-500">
                        {{ $category->projects_count }} project
                    </span>
                </div>
            @empty
                <p class="text-gray-500">Belum ada kategori.</p>
            @endforelse
        </div>

    </div>

    {{-- Lima Project Terbaru --}}
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">

        <h2 class="text-lg font-bold mb-4">
            5 Project Terbaru
        </h2>

        @forelse ($latestProjects as $project)

            <div class="border-b py-4 flex flex-col sm:flex-row gap-4">

                {{-- Thumbnail Project --}}
                <div class="flex-shrink-0">

                    @if ($project->thumbnail)
                        <img
                            src="{{ asset('storage/' . $project->thumbnail) }}"
                            alt="Thumbnail {{ $project->title }}"
                            class="w-full sm:w-32 h-40 sm:h-24 object-cover rounded-lg"
                        >
                    @else
                        <div class="w-full sm:w-32 h-40 sm:h-24 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                            No Image
                        </div>
                    @endif

                </div>

                {{-- Informasi Project --}}
                <div class="flex-1">

                    <h3 class="font-semibold">
                        {{ $project->title }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ Str::limit($project->description, 100) }}
                    </p>

                    <p class="text-sm text-blue-600 mt-1">
                        Kategori:
                        {{ $project->category->name ?? 'Belum ada kategori' }}
                    </p>

                    <div class="mt-3">
                        <a
                            href="{{ route('post.projects.show', $project) }}"
                            class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700"
                        >
                            Lihat Detail
                        </a>
                    </div>

                </div>

            </div>

        @empty
            <p class="text-gray-500">
                Belum ada project.
            </p>
        @endforelse

    </div>

</div>
@endsection

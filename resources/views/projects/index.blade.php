
@extends('post.layouts.app')

@section('header', 'Daftar Project')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">
        Daftar Project
    </h1>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol Tambah Project --}}
    <div class="mb-6">
        <a href="{{ route('post.projects.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Tambah Project
        </a>
    </div>

    {{-- Daftar Project --}}
    @forelse ($projects as $project)

        <div class="bg-white rounded-lg shadow-md p-4 mb-4 flex flex-col md:flex-row gap-4">

            {{-- Thumbnail --}}
            <div class="flex-shrink-0">
                @if ($project->thumbnail)
                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="Thumbnail {{ $project->title }}"
                        class="w-full md:w-40 h-40 object-cover rounded-lg"
                    >
                @else
                    <div class="w-full md:w-40 h-40 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
            </div>

            {{-- Informasi Project --}}
            <div class="flex-1">

                <h2 class="text-xl font-bold">
                    {{ $project->title }}

                    <span class="ml-2 text-xs px-2 py-1 rounded align-middle
                        {{ $project->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Tanggal: {{ $project->created_at->format('d M Y') }}
                </p>

                <p class="text-gray-700 mt-2">
                    {{ Str::limit($project->description, 150) }}
                </p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap gap-2 mt-4">

                    <a href="{{ route('post.projects.show', $project) }}"
                       class="bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
                        Detail
                    </a>

                    <a href="{{ route('post.projects.edit', $project) }}"
                       class="bg-yellow-500 text-white px-3 py-2 rounded text-sm hover:bg-yellow-600">
                        Edit
                    </a>

                </div>

            </div>

        </div>

    @empty

        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            Belum ada Project.
        </div>

    @endforelse

</div>
@endsection

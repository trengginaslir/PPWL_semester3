
@extends('post.layouts.app')

@section('header', 'Detail Project')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Tombol kembali --}}
    <a href="{{ route('post.projects.index') }}"
       class="text-blue-600 hover:underline mb-6 inline-block">
        &larr; Kembali ke daftar project
    </a>

    {{-- Informasi Project --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">

        {{-- Thumbnail --}}
        @if ($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                alt="{{ $project->title }}"
                class="w-full max-h-96 object-cover rounded-lg mb-6"
            >
        @endif

        <h1 class="text-2xl font-bold mb-3">
            {{ $project->title }}
        </h1>

        <p class="text-gray-600 whitespace-pre-line">
            {{ $project->description }}
        </p>

        <div class="mt-6">
            <a href="{{ route('post.projects.edit', $project) }}"
               class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Edit Project
            </a>
        </div>
    </div>

    {{-- Gallery Project --}}
    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-semibold mb-4">
            Gallery Project
        </h2>

        @if ($project->images->count() > 0)

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                @foreach ($project->images as $image)
                    <div>
                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="Gallery {{ $project->title }}"
                            class="w-full h-48 object-cover rounded-lg"
                        >
                    </div>
                @endforeach

            </div>

        @else

            <p class="text-gray-500">
                Belum ada gambar Gallery.
            </p>

        @endif

    </div>

</div>
@endsection

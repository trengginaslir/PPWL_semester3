@extends('portfolio.layout')

@section('title', $project->title . ' - Portfolio')

@section('content')
    <a href="{{ route('projects') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali</a>

    <div class="bg-white rounded-lg shadow p-6 mt-4">
        <h1 class="text-2xl font-bold">{{ $project->title }}</h1>

        <p class="text-sm text-gray-500 mt-1">
            {{ $project->category->name ?? 'Belum ada kategori' }}
            &middot; {{ $project->created_at->format('d M Y') }}
        </p>

        @if ($project->thumbnail)
            <img src="{{ asset('storage/' . $project->thumbnail) }}"
                 alt="{{ $project->title }}"
                 class="w-full max-h-96 object-cover rounded-lg mt-4">
        @endif

        <p class="mt-4 text-gray-700">{{ $project->description }}</p>

        @if ($project->images->count() > 0)
            <h2 class="text-xl font-semibold mt-8 mb-4">Gallery</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($project->images as $img)
                    <figure>
                        <img src="{{ asset('storage/' . $img->image) }}"
                             alt="{{ $img->caption ?: $project->title }}"
                             class="w-full h-40 object-cover rounded">
                        @if ($img->caption)
                            <figcaption class="text-sm text-gray-500 mt-1">{{ $img->caption }}</figcaption>
                        @endif
                    </figure>
                @endforeach
            </div>
        @endif
    </div>
@endsection


@extends('post.layouts.app')

@section('header', 'Edit Project')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Project</h1>

    <form action="{{ route('post.projects.update', $project) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow">

        @csrf
        @method('PUT')

        @include('projects._form')

        {{-- Thumbnail Lama --}}
        @if ($project->thumbnail)
            <div class="mt-4">
                <p class="font-medium mb-2">Thumbnail Saat Ini:</p>

                <img
                    src="{{ asset('storage/' . $project->thumbnail) }}"
                    alt="{{ $project->title }}"
                    class="w-40 h-28 object-cover rounded"
                >
            </div>
        @endif

        {{-- Upload Thumbnail Baru --}}
        <div class="mt-4">
            <label for="thumbnail" class="block font-medium mb-2">
                Ganti Thumbnail Project
            </label>

            <input
                type="file"
                name="thumbnail"
                id="thumbnail"
                accept="image/*"
                class="w-full border rounded p-2"
            >

            @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

            <p class="text-gray-500 text-sm mt-1">
                Kosongkan jika tidak ingin mengganti thumbnail.
            </p>
        </div>

        <div class="mt-6 flex gap-3">
            <x-primary-button>Perbarui</x-primary-button>

            <a href="{{ route('post.projects.index') }}"
               class="px-4 py-2 text-sm text-gray-600 hover:underline">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection

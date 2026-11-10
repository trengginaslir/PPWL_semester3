@extends('post.layouts.app')

@section('header', 'Tambah Project')
@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Tambah Project</h1>

    <form action="{{ route('post.projects.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow">

        @csrf

        @include('projects._form')

        {{-- Input Thumbnail --}}
        <div class="mt-4">
            <label for="thumbnail" class="block font-medium mb-2">
                Thumbnail Project
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
        </div>

        <div class="mt-6 flex gap-3">
            <x-primary-button>Simpan</x-primary-button>

            <a href="{{ route('post.projects.index') }}"
               class="px-4 py-2 text-sm text-gray-600 hover:underline">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection

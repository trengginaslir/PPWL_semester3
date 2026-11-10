
@extends('post.layouts.app')

@section('header', 'Lihat Project')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">

    <div class="bg-white p-6 rounded-lg shadow">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Informasi Project --}}
        <h1 class="text-2xl font-bold">
            {{ $project->title }}
        </h1>

        <small class="text-gray-500">
            Tanggal: {{ $project->created_at->format('d M Y') }}
            &middot; Kategori: {{ $project->category->name ?? 'Belum ada kategori' }}
        </small>

        @if ($project->thumbnail)
            <img
                src="{{ asset('storage/' . $project->thumbnail) }}"
                alt="{{ $project->title }}"
                class="w-full max-h-72 object-cover rounded-lg mt-4"
            >
        @endif

        <p class="mt-4 text-gray-700">
            {{ $project->description }}
        </p>

        {{-- Gallery Project --}}
        <div class="mt-8">

            <h2 class="text-xl font-semibold mb-4">
                Gallery Project
            </h2>

            {{-- Upload gambar gallery (multiple) --}}
            <form action="{{ route('post.projects.images.store', $project) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="mb-6">
                @csrf

                <input type="file" name="images[]" multiple accept="image/*"
                       class="block w-full border rounded p-2">

                @foreach ($errors->get('images') as $message)
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @endforeach
                @foreach ($errors->get('images.*') as $messages)
                    @foreach ($messages as $message)
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @endforeach
                @endforeach

                <p class="text-sm text-gray-500 mt-1">
                    Terpakai {{ $project->images->count() }} dari 10 gambar.
                    Lebar gambar minimal 800 px.
                </p>

                <button type="submit"
                        class="mt-2 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700">
                    Upload Gambar
                </button>
            </form>

            @if ($project->images->count() > 0)

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    @foreach ($project->images as $image)

                        <div class="bg-white rounded-lg shadow p-2">

                            {{-- Gambar Gallery --}}
                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->caption ?: $project->title }}"
                                class="w-full h-48 object-cover rounded"
                            >

                            {{-- Form Edit Caption --}}
                            <form
                                action="{{ route('post.projects.images.update', [$project, $image]) }}"
                                method="POST"
                                class="mt-2"
                            >
                                @csrf
                                @method('PUT')

                                <input
                                    type="text"
                                    name="caption"
                                    value="{{ $image->caption }}"
                                    placeholder="Tulis caption gambar"
                                    class="w-full border rounded p-2 text-sm"
                                >

                                @error('caption')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror

                                <button
                                    type="submit"
                                    class="mt-1 w-full bg-yellow-500 text-white px-3 py-2 rounded text-sm hover:bg-yellow-600"
                                >
                                    Simpan Caption
                                </button>
                            </form>

                            {{-- Tombol Hapus Gambar --}}
                            <form
                                action="{{ route('post.projects.images.destroy', [$project, $image]) }}"
                                method="POST"
                                class="mt-2"
                                onsubmit="return confirm('Yakin ingin menghapus gambar ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full bg-red-600 text-white px-3 py-2 rounded text-sm hover:bg-red-700"
                                >
                                    Hapus Gambar
                                </button>

                            </form>

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

    {{-- Tombol Kembali --}}
    <a
        href="{{ route('post.projects.index') }}"
        class="inline-block mt-4 text-sm text-indigo-600 hover:underline"
    >
        &larr; Kembali
    </a>

</div>
@endsection

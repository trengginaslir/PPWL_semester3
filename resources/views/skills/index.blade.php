@extends('post.layouts.app')

@section('header', 'Daftar Skill')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6">
        Daftar Skill
    </h1>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">

        @forelse ($skills as $skill)
            <div class="flex justify-between items-center border-b py-3">

                <div>
                    <p class="font-semibold">{{ $skill->name }}</p>
                    <p class="text-sm text-gray-500">
                        Dipakai di {{ $skill->projects_count }} project
                    </p>
                </div>

                <a href="{{ route('post.skills.edit', $skill) }}"
                   class="bg-yellow-500 text-white px-3 py-2 rounded text-sm hover:bg-yellow-600">
                    Edit
                </a>

            </div>
        @empty
            <p class="text-gray-500">Belum ada skill.</p>
        @endforelse

    </div>

</div>
@endsection

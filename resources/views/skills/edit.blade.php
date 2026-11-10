@extends('post.layouts.app')

@section('header', 'Edit Skill')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Skill</h1>

    <form action="{{ route('post.skills.update', $skill) }}"
          method="POST"
          class="bg-white p-6 rounded-lg shadow">

        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" value="Nama Skill" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                :value="old('name', $skill->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-6 flex gap-3">
            <x-primary-button>Perbarui</x-primary-button>

            <a href="{{ route('post.skills.index') }}"
               class="px-4 py-2 text-sm text-gray-600 hover:underline">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection

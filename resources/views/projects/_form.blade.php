<div>
    <x-input-label for="title" value="Title" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
        :value="old('title', $project->title ?? '')" />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="description" value="Description" />
    <textarea id="description" name="description" rows="5"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $project->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="category_id" value="Kategori" />
    <select id="category_id" name="category_id"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Pilih kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $project->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

<div class="mt-4">
    <x-input-label for="status" value="Status" />
    <select id="status" name="status"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="published" @selected(old('status', $project->status ?? 'published') === 'published')>
            Published
        </option>
        <option value="draft" @selected(old('status', $project->status ?? 'published') === 'draft')>
            Draft
        </option>
    </select>
    <x-input-error :messages="$errors->get('status')" class="mt-2" />
</div>

<div class="mb-4">
    <label for="gallery" class="block font-medium text-sm text-gray-700">
        Gallery Project
    </label>

    <input
        type="file"
        name="gallery[]"
        id="gallery"
        multiple
        accept="image/*"
        class="mt-1 block w-full"
    >

    <p class="text-sm text-gray-500 mt-1">
        Pilih beberapa gambar sekaligus. Maksimal 10 gambar per project,
        lebar minimal 800 px.
    </p>

    @foreach ($errors->get('gallery') as $message)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @endforeach
    @foreach ($errors->get('gallery.*') as $messages)
        @foreach ($messages as $message)
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @endforeach
    @endforeach
</div>
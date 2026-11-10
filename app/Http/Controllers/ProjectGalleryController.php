<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    // Upload banyak gambar gallery sekaligus
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images' => 'required|array|max:' . Project::MAX_GALLERY_IMAGES,
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
                'dimensions:min_width=800',
            ],
        ], [
            'images.max' => 'Maksimal ' . Project::MAX_GALLERY_IMAGES . ' gambar sekali upload.',
            'images.*.dimensions' => 'Lebar gambar gallery minimal 800 px.',
        ]);

        // Batas total gambar per project (gambar lama + gambar baru)
        $sisaSlot = Project::MAX_GALLERY_IMAGES - $project->images()->count();

        if (count($request->file('images')) > $sisaSlot) {
            return back()->withErrors([
                'images' => 'Gallery project maksimal ' . Project::MAX_GALLERY_IMAGES
                    . ' gambar. Sisa slot saat ini: ' . max($sisaSlot, 0) . '.',
            ]);
        }

        $currentOrder = $project->images()->max('sort_order') ?? -1;

        foreach ($request->file('images') as $index => $file) {
            $project->images()->create([
                'image' => $file->store('projects/gallery', 'public'),
                'sort_order' => $currentOrder + $index + 1,
            ]);
        }

        return back()->with('success', 'Gambar gallery berhasil ditambahkan.');
    }

    // Ubah caption satu gambar gallery
    public function update(Request $request, Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $image->update([
            'caption' => $validated['caption'] ?? null,
        ]);

        return back()->with('success', 'Caption gambar berhasil diperbarui.');
    }

    // Hapus satu gambar gallery (file fisik dulu, lalu baris database)
    public function destroy(Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar dihapus.');
    }
}

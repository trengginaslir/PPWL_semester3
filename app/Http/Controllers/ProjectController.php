<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::with('category')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('projects.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=400,min_height=300',
            ],

            'gallery' => 'nullable|array|max:' . Project::MAX_GALLERY_IMAGES,
            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
                'dimensions:min_width=800',
            ],
        ], [
            'gallery.max' => 'Gambar gallery maksimal ' . Project::MAX_GALLERY_IMAGES . ' per project.',
            'gallery.*.dimensions' => 'Lebar gambar gallery minimal 800 px.',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            'thumbnail' => $validated['thumbnail'] ?? null,
        ]);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');

                $project->images()->create([
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load('images');

        return view('projects.edit', [
            'project' => $project,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                'dimensions:min_width=400,min_height=300',
            ],

            'gallery' => 'nullable|array|max:' . Project::MAX_GALLERY_IMAGES,
            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
                'dimensions:min_width=800',
            ],
        ], [
            'gallery.max' => 'Gambar gallery maksimal ' . Project::MAX_GALLERY_IMAGES . ' per project.',
            'gallery.*.dimensions' => 'Lebar gambar gallery minimal 800 px.',
        ]);

        // Batas total gambar gallery per project (gambar lama + gambar baru)
        if ($request->hasFile('gallery')) {
            $sisaSlot = Project::MAX_GALLERY_IMAGES - $project->images()->count();

            if (count($request->file('gallery')) > $sisaSlot) {
                return back()
                    ->withErrors([
                        'gallery' => 'Gallery project maksimal ' . Project::MAX_GALLERY_IMAGES
                            . ' gambar. Sisa slot saat ini: ' . max($sisaSlot, 0) . '.',
                    ])
                    ->withInput();
            }
        }

        if ($request->hasFile('thumbnail')) {

            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'status' => $validated['status'],
            'thumbnail' => $validated['thumbnail'] ?? $project->thumbnail,
        ]);

        if ($request->hasFile('gallery')) {
            $currentOrder = $project->images()->max('sort_order') ?? -1;

            foreach ($request->file('gallery') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');

                $project->images()->create([
                    'image' => $path,
                    'sort_order' => $currentOrder + $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $project->delete(); // baris project_images ikut hilang (cascadeOnDelete)

        return redirect()
            ->route('post.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}

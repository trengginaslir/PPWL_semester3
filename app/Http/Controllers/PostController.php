<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }
        if ($request->get('status') === 'published') {
            $query->published();
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $totalPosts = Post::count();

        return view('posts.index', compact('posts', 'totalPosts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:200',
            'description' => 'required|min:10',
            'status' => 'required|in:draft,published',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $data = [
            'posts' => Post::findOrFail($id)
        ];
        return view('posts.show')->with($data);
    }

    public function edit(string $id)
    {
        $data = [
            'posts' => Post::findOrFail($id)
        ];
        return view('posts.edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:200',
            'description' => 'required|min:10',
            'status' => 'required|in:draft,published',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('posts.trash', compact('posts'));
    }

    public function restore(string $id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('posts.trash')
            ->with('success', 'Post berhasil dikembalikan.');
    }

    public function forceDelete(string $id)
    {
        Post::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('posts.trash')
            ->with('success', 'Post dihapus permanen.');
    }
}
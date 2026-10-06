@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h1>Blog Posts</h1>
  <p>Total post: {{ $totalPosts }}</p>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="mb-3">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Tambah Post</a>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Semua</a>
    <a href="{{ route('posts.index', ['status' => 'published']) }}" class="btn btn-outline-success">Published</a>
    <a href="{{ route('posts.trash') }}" class="btn btn-outline-danger">Trash</a>
  </div>

  <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul...">
  </form>

  @forelse ($posts as $post)
    <div class="border rounded p-3 mb-2">
      <h3><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>
      <small>Tanggal: {{ $post->created_at }}</small>
      <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">{{ $post->status }}</span>
    </div>
  @empty
    <h3>Tidak ada data.</h3>
  @endforelse

  {{ $posts->links() }}
</div>
@endsection
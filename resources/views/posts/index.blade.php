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

  <form action="{{ route('posts.index') }}" method="GET" class="row g-2 mb-3">
    @if (request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <div class="col-md-8">
      <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari judul...">
    </div>
    <div class="col-md-2">
      <select name="per_page" class="form-select" onchange="this.form.submit()">
        @foreach ([5, 10, 25] as $n)
          <option value="{{ $n }}" @selected($perPage == $n)>{{ $n }} / halaman</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-dark w-100">Cari</button>
    </div>
  </form>

  @forelse ($posts as $post)
    <div class="border rounded p-3 mb-2">
      <h3>
        {{ $posts->firstItem() + $loop->index }}.
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
      </h3>
      <small>Tanggal: {{ $post->created_at }}</small>
      <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'secondary' }}">{{ $post->status }}</span>

      <a href="{{ route('post.projects.show', $project) }}"
      class="text-blue-600 hover:underline">
        Detail
    </a>
    </div>
  @empty
    <h3>Tidak ada data.</h3>
  @endforelse

  <div class="mt-4 text-muted small">
    Halaman : {{ $posts->currentPage() }} dari {{ $posts->lastPage() }} <br>
    Jumlah Data : {{ $posts->total() }} <br>
    Data Per Halaman : {{ $posts->perPage() }}
  </div>

  <div class="mt-3">
    {{ $posts->links() }}
  </div>
</div>
@endsection
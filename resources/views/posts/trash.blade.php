@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h1>Trash</h1>
  <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">Kembali</a>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @forelse ($posts as $post)
    <div class="border rounded p-3 mb-2">
      <h5>{{ $post->title }}</h5>
      <small>Dihapus: {{ $post->deleted_at }}</small>
      <div class="mt-2">
        <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="d-inline">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success btn-sm">Restore</button>
        </form>

        <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Hapus permanen? Tidak bisa dikembalikan!')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">Hapus Permanen</button>
        </form>
      </div>
    </div>
  @empty
    <p>Trash kosong.</p>
  @endforelse
</div>
@endsection
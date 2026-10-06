@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>{{ $posts->title }}</h1>
    <small>Tanggal: {{ $posts->created_at }}</small>
    <span class="badge bg-{{ $posts->status === 'published' ? 'success' : 'secondary' }}">{{ $posts->status }}</span>
    <p>{{ $posts->description }}</p>
    <a href="{{ route('posts.edit', $posts->id) }}" class="btn btn-secondary">Edit</a>

    <form action="{{ route('posts.destroy', $posts->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Delete</button>
    </form>
  </div>
</div>
@endsection
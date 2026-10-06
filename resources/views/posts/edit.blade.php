@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Edit Blog Post</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('posts.update', $posts->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $posts->title) }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="5" name="description">{{ old('description', $posts->description) }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
          <option value="draft" @selected(old('status', $posts->status) == 'draft')>Draft</option>
          <option value="published" @selected(old('status', $posts->status) == 'published')>Published</option>
        </select>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
@endsection
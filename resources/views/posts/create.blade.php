@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Add Blog Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      <div class="form-group mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="5" name="description">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group mb-3">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
          <option value="draft" @selected(old('status', 'draft') == 'draft')>Draft</option>
          <option value="published" @selected(old('status') == 'published')>Published</option>
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
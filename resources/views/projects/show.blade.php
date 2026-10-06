@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>{{$projects->title}}</h1>
    <small>Tanggal: {{$projects->created_at}}</small>
    <p>{{$projects->description}}</p>
  </div>
</div>
@endsection
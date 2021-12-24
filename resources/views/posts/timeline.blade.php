@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container mt-5">
    @foreach ($posts as $post)
      @include('posts/card')
    @endforeach
  </div>
@endsection

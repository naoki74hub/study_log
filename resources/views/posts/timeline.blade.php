@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container mt-5">
    @foreach ($posts as $post)
      @include('posts/card')
    @endforeach
    @if ($posts->count() === 0 && Auth::user()->id)
    <div class="container">
     <div class="user-container text-center">
        <i class="fas fa-user-edit fa-5x user-image"></i>
        <p class="user-title">フォロー中のユーザーの投稿</p>
        <p class="user-content">ここにフォロー中のユーザーの投稿が表示されます。
     </div>
    @endif
  </div>
@endsection

@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
  <div class="container col-lg-5 pt-5">
     <div class="text-center">
      <div class="user-header h3 mt-3">「{{ $user->name }}」の投稿</div>
     </div>
    
    @isset($search_result)
    <div class="search-title h3 mt-3">{{ $search_result }}</div>
    @endisset
    
    @foreach($user->posts as $post)
      @include('posts.card')
    @endforeach
 </div>
@endsection

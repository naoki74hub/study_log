@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
  <div class="container col-lg-5 pt-5">
  @isset($search_result)
    <div class="text-center">
     <div class="search-title h3 mt-3">{{ $search_result }}</div>
    </div>
    @endisset
    
    @foreach($posts as $post)
      @include('posts.card')
    @endforeach
 </div>
@endsection

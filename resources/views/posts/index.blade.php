@extends('app')

@section('title', '記事一覧')

@section('content')

<div class="container">
  @isset($search_result)
    <div class="text-center">
     <div class="search-title h3 mt-5">{{ $search_result }}</div>
    </div>
    @endisset
    
    @foreach($posts as $post)
      @include('posts.card')
    @endforeach
 </div>
@endsection
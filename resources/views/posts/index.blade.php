@extends('app')

@section('title', '記事一覧')

@section('content')
 <div class="container mt-5">
   @isset($search_result)
     <div class="text-center">
       <div class="search-title h3 mt-5">{{ $search_result }}</div>
     </div>
   @endisset
   @foreach ($posts as $post)
     @include('posts.card')
   @endforeach
  
   <div class="top-back">
     <a href="#"><div class="to-top"><i class="fas fa-3x fa-chevron-up"></i></div></a>
   </div>
</div>
 @if (session('status'))
     <script src="{{ mix('js/level_alert.js') }}"></script>
   @endif
@endsection
@extends('app')

@section('title','投稿詳細')

@section('content')
  <div class="container mt-5">
    @include('posts.card')
    <div class="pt-3">
      <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary">コメントする</a>
        @foreach ($post->comments as $comment)
          <div class="card mt-2" style="position:relative;">
            <div class="card-body darkmode-post">
              <div class="card-body d-flex flex-row">
                <div class="d-flex flex-row">
                  <div>
                    <i class="fas fa-user-circle fa-3x mr-1"></i>
                  </div>
                    <div>
                      <div class="font-weight-bold d-block">
                        <a href="{{ route('users.show', [$comment->user->id]) }}">
                         {{ $comment->user->name }}
                        </a>
                      </div>
                       <div class="font-weight-lighter d-block">
                         {{ $comment->created_at->format('Y/m/d H:i') }} 
                       </div>
                    </div>
                </div>
                <p class="card-text ml-5">{{ $comment->comment }}</p>
              </div>
            </div>
          </div>
        @endforeach
    </div> 
 </div>
@endsection
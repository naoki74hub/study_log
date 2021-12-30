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
                @if ( Auth::id() === $comment->user_id )
                  <!-- dropdown -->
                  <div class="ml-auto card-text">
                    <div class="dropdown">
                      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2" style="position:absolute; top:-20px; right:-20px;">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route("comments.edit", ['comment' => $comment]) }}">
                          <i class="fas fa-pen mr-1"></i>コメントを更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
                          <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- dropdown -->
               
                  <!-- modal -->
                  <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                          @csrf
                          @method('DELETE')
                          <div class="modal-body">
                            {{ $comment->comment }}を削除します。よろしいですか？
                          </div>
                          <div class="modal-footer justify-content-between">
                            <a class="btn border" data-dismiss="modal">キャンセル</a>
                            <button type="submit" class="btn btn-danger">削除する</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- modal -->
                @endif
              </div>
              <div class="row justify-content-end">
                <!--コメント機能-->
                <div class="mt-4">
                  <a href="{{ route('comments.create')}}" class='comments mr-3'>
                    <div class="btn btn-primary py-1">
                      <i class="far fa-comment-alt fa-lg mr-2"></i>
                    </div>
                  </a>
                </div>
                <div class="mt-4" style="width:70px;">
                @if ($post->likes()->where('user_id', Auth::id())->exists())
                  <div class="col-md-3">
                    <form method="POST" action="{{ route('unlikes', $post) }}">
                      @csrf
                      <input type="submit" class="fas btn btn-danger mr-2 py-2 js-like-toggle" data-postid="{{ $post->id }}" value="&#xf004; {{ $post->likes()->count() }}">
                    </form>
                  </div>
                @else
                  <div class="col-md-3">
                    <form method="POST" action="{{ route('likes', $post) }}">
                      @csrf
                      <input type="submit" class="fas btn border py-2 js-like-toggle darkmode-like" data-postid="{{ $post->id }}" value="&#xf004; {{ $post->likes()->count() }}" style="color:#6c7176;">
                    </form>
                  </div>
                @endif
                </div> 
                  <div style="width:32px; height:32px;" class="pr-2 pt-4">
                    <a href="{{ route('likes.users', ['post' => $post]) }}">
                      <span><i class="fas fa-user fa-2x" style="height:32px; color:#E3342F;"></i></span>
                    </a>
                  </div>
              </div>
            </div>
          </div>
        @endforeach
    </div> 
 </div>
@endsection
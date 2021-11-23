@extends('app')

@section('title','投稿詳細')

@section('content')

<div class="container mt-5">
 @include('posts.card')
<div class="pt-3">
   <a href="{{ route('comments.create',['post_id'=>$post->id]) }}" class="btn btn-primary">コメントする</a>
 @foreach($post->comments as $comment)
  <div class="card">
    <div class="card-body">
     <div class="card-body d-flex flex-row border-top border-bottom">
      <div class="d-flex flex-row">
       <div>
        <i class="fas fa-user-circle fa-3x mr-1"></i>
       </div>
       <div>
        <div class="font-weight-bold d-block">
         <a href="{{ route('users.show',[$comment->user->id]) }}">
          {{$comment->user->name}}
         </a>
        </div>
       <div class="font-weight-lighter d-block">
       {{ $comment->created_at->format('Y/m/d H:i')}} 
       </div>
      </div>
      </div>
     <p class="card-text ml-5">{{ $comment->comment }}</p>
      @if( Auth::id() === $comment->user_id )
        <!-- dropdown -->
          <div class="ml-auto card-text">
            <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
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
   </div>
 </div>
 @endforeach
 </div> 
</div>

@endsection
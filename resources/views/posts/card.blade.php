   <div class="card mt-3 border-light">
     <div class="card-body d-flex flex-row border-top border-bottom">
      <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div>
          <div class="font-weight-bold">
            <a href="{{ route('users.show',[$post->user_id]) }}">
              {{$post->user->name}}
            </a>
          </div>
          <div class="font-weight-lighter">
            {{ $post->created_at->format('Y/m/d H:i')}} 
          </div>
          <div class="card-image mt-2">
            <img src="{{'/storage/images/'.$post['image_url']}}" width="200px" height="180px">
          </div>
        </div>
    <div class="card-body">
      <h3 class="h4 card-title">
          <a class="text-dark" href="{{ route('posts.show' , ['post' => $post->id]) }}">
           {{$post->title}}
           </a>
        </h3>
         <div class="post-card">
         <div class="d-flex flex-row pt-2" >
          <i class="far fa-clock fa-2x text-success"></i>
          <div class="study-time ml-2">
            <p class="h3 mb-0">{{$post->time}}</p>
          </div>
        </div>
        <div class="card-text mt-3">
          {{$post->body}}
       </div>
      </div>
      <div class="tags">
        @foreach($post->tags as $tag)
          <a href="{{ route('posts.index', ['tag_name'=>$tag->tag_name]) }}">
            #{{ $tag->tag_name }}
          </a>
        @endforeach
      </div>
      
      <!--コメント機能-->
    <div class="mt-3">
      <a href="{{ route('posts.show',['post'=> $post->id]) }}" class='comments mr-3'>
        <i class="far fa-comment-alt fa-2x"></i>
      </a>
    
      @auth
       <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
        @if (!$post->isLikedBy(Auth::user()))
           <span class="likes">
            <i class="fas fa-heart fa-2x like-toggle" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
           </span><!-- /.likes -->
        @else
          <span class="likes">
            <i class="fas fa-heart heart fa-2x like-toggle liked" data-post-id="{{ $post->id }}"></i>
            <span class="like-counter">{{$post->likes_count}}</span>
          </span><!-- /.likes -->
        @endif
        @endauth
        @guest
         <span class="likes">
          <i class="fas heart heart fa-2x"></i>
          <span class="like-counter">{{$post->likes_count}}</span>
         </span><!-- /.likes -->
    @endguest
        </div>
      </div>
     
     @if( Auth::id() === $post->user_id )
        <!-- dropdown -->
          <div class="ml-auto card-text">
            <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-link text-muted m-0 p-2">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
                  <i class="fas fa-pen mr-1"></i>記事を更新する
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
                  <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                </a>
              </div>
            </div>
          </div>
          <!-- dropdown -->
       
          <!-- modal -->
          <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                  @csrf
                  
                  <div class="modal-body">
                    {{ $post->title }}を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
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
   <div class="card mt-3 border-light darkmode-post">
     <div class="card-body d-flex flex-row border-top border-bottom">
        <div class="avatar mr-3" style="width:70px; height:70px; border-radius:50%;">
          @if (empty($post->user->avatar))
            <i class="fas fa-user-circle fa-4x"></i>
          @elseif (!empty($post->user->avatar))
            <img src="{{ $post->user->avatar }}" style="width:70px; height:70px; border-radius:50%;">
          @endif
        </div>
        <div>
         <div class="font-weight-bold">
          <a href="{{ route('users.show', [$post->user_id]) }}" class="text-decoration-none">
            {{ $post->user->name }}
          </a>
         </div>
         <div class="font-weight-lighter">
            {{ $post->created_at->format('Y/m/d H:i') }} 
         </div>
        @if (auth()->user()->isFollowed($post->user->id))
          <span class="bg-secondary text-white" style="width:145px;">フォローされています</span>
        @endif
        @if (auth()->user()->isFollowing($post->user->id))
          <form method="POST" action="{{ route('posts.unfollow', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger py-1 px-2" style="width:145px;"><i class="fas fa-user-minus"></i>フォロー解除</button>
          </form>
        @else
          <form method="POST" action="{{ route('posts.follow', ['post' => $post]) }}">
            @csrf
            <button type="submit" class="btn btn-primary py-1 px-2" style="width:140px;"><i class="fas fa-user-plus mr-2"></i>フォローする</button>
          </form>
        @endif
        @if (!empty($post->image_url))
          <div class="card-image mt-2">
            <img src="{{ $post->image_url }}" style="width:110px; height:145px;">        
          </div>
        @endif
       </div>
       <div class="card-body ml-3">
        <div class="d-flex justify-content-between">
          <h3 class="h4 card-title">{{ $post->title }}</h3>
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

                  <div class="modal-body bg-dark text-white">
                    {{ $post->title }}を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn btn-outline-grey border" data-dismiss="modal">キャンセル</a>
                    <button type="submit" class="btn btn-danger">削除する</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- modal -->
        @endif
          </div>
            <div class="post-card">
              <div class="d-flex flex-row pt-2" >
                <i class="far fa-clock fa-2x text-success"></i>
                <div class="study-time ml-2">
                  <p class="h3 mb-0">{{ substr($post->time, 0,2) }}時間 {{ substr($post->time, 3,2) }}分</p>
                </div>
              </div>
              <div class="card-text mt-3">
                {{$post->body}}
              </div>
            </div>
            <div class="tags">
            @foreach ($post->tags as $tag)
              <a href="{{ route('posts.index', [ 'tag_name' => $tag->tag_name]) }}">
                #{{ $tag->tag_name }}
              </a>
            @endforeach
           </div>
        <div class="row justify-content-end">
          <!--コメント機能-->
          <div class="mt-4">
            <a href="{{ route('posts.show', ['post'=> $post->id]) }}" class='comments mr-3'>
            <div class="btn btn-primary py-1" style="height:37px;">
              <i class="far fa-comment-alt fa-lg mr-2 mt-2"></i>{{ $post->comments()->count() }}
            </div>
            </a>
          </div>
         <div class="mt-4" style="width:70px;">
          @if ($post->likes()->where('user_id', Auth::id())->exists())
            <div class="col-md-3">
              <form method="POST" action="{{ route('unlikes', $post) }}">
                @csrf
                <input type="submit" class="fas border btn-danger js-like-toggle rounded-left" style="height:37px; width:55px;" data-postid="{{ $post->id }}" value="&#xf004; {{ $post->likes()->count() }}">
              </form>
            </div>
          @else
          <div class="col-md-3" style="width:70px;">
            <form method="POST" action="{{ route('likes', $post) }}">
              @csrf
              <input type="submit" class="fas border py-2 js-like-toggle darkmode-like bg-white rounded-left" data-postid="{{ $post->id }}" value="&#xf004; {{ $post->likes()->count() }}" style="color:#6c7176; width:56px; height:37px;">
            </form>
          </div>
          @endif
         </div> 
          <div class="pr-2 pt-4">
            <a href="{{ route('likes.users', ['post' => $post]) }}">
              <span><i class="fas fa-user border fa-2x rounded-right" style="height:37px; width:37px; padding-top:4px; padding-left:5px; color:#E3342F;"></i></span>
            </a>
          </div>
        </div>
      </div> 
    </div>
  </div>
 
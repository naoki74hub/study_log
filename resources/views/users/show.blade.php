@extends('app')

@section('title', 'ユーザー詳細')

@section('content')
  <div class="container mt-5">
    <div class="mt-3">
      <div>
        <div class="card darkmode-post">
          <div>
            <div class="d-flex justify-content-center">
              <div class="ml-2 mr-4">
                <div class="avatar mt-3 mr-4" style="width:110px;height:110px;border-radius:50%;">
                  @if (empty($user->avatar))
                    <i class="fas fa-user-circle fa-8x"></i>
                  @elseif (!empty($user->avatar))
                    <img src="{{ $user->avatar }}" style="width:110px;height:110px;border-radius:50%;">
                  @endif
                </div>
                <div class="font-weight-bold text-center mt-2 mr-3">
                  {{$user->name}}
                </div>
                <div class="user-level border bg-dark text-white text-center" style="height:30px;"><span style="font-size:20px;">Lv.{{ $user->level }}</span></div>
              </div>
              @if ( Auth::id() === $user->id )
                <div class="mr-5" style="max-width:600px;width:100%;">
                  <div class="border mt-3 ml-3 rounded balloon" style="max-width:600px; width:100%;height:130px;">
                    @if ($user->id === Auth::user()->id && empty($user->self_introduction))
                      <p class="mt-5 ml-4" style="font-size:18px;">自己紹介を設定し、自分を表現しよう!!
                    @elseif (!empty($user->self_introduction))
                      <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                    @endif
                  </div>
              @else
                <div class="border mt-3 mr-2 speech-bubbles" style="max-width:600px; width:100%; height:130px;">
                  <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                </div>
              @endif
                </div>
                @if ($user->id === Auth::user()->id && empty($user->self_introduction || $user->goal || $user->important_day_title || $user->important_day))
                  <div class="ml-2">
                    <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">プロフィールを設定する</a>
                  </div>
                @elseif ($user->id === Auth::user()->id && !empty($user->self_introduction || $user->goal || $user->important_day_title || $user->important_day))
                  <div>
                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary mt-3">プロフィールを編集する</a>
                  </div>
                @endif
            </div>
            <div class="text-center">
              <div class="d-inline-block mt-4 text-center rounded  bg-success" style="max-width:235px;height:180px;width:100%;display:teble-cell;vertical-align:middle;">
                @if ($user->id === Auth::user()->id && empty($user->important_day_title))
                  <p class="p-2 text-left mb-0">イベントタイトルとその日までのカウントダウンを設定しよう!</p><hr style="margin:0;">
                @elseif (!empty($user->important_day_title))
                  <p class="p-2 text-left">{{ $user->important_day_title }}</p><hr class="m-0">
                @endif
                @if ( Auth::user()->id === $user->id && empty($user->important_day))
                  <p class="pt-3 mb-0 bg-warning pb-4 text-dark" style="color:#333; position:relative;"><i class="far fa-3x fa-calendar-alt" style="position:absolute; top:10px; left:10px;"></i>あと<span class="display-3">000</span>日</p>
                @elseif (!empty($user->important_day))
                  <p class="pt-3 mb-0 bg-warning pb-4" style="color:#333; position:relative;"><i class="far fa-3x fa-calendar-alt" style="position:absolute; top:10px; left:10px;"></i>あと<span class="display-3">{{ $count_down }}</span>日</p>
                @endif
              </div>
              <div class="d-inline-block mt-4 border text-center rounded mb-3 ml-4" style="max-width:500px;height:150px;width:100%;display:teble-cel;vertical-align: middle;">
                <div class="bg-success"><i class="far fa-flag fa-2x py-2 pr-2" style="color:black;"></i><span class="font-weight-bold h4 mb-0 py-2">達成目標</span>
                </div><hr class="m-0">
                @if ($user->id === Auth::user()->id && empty($user->goal))
                  <p style="padding-top:40px;font-size:18px;">達成したい目標を視覚化すると効果的!! ぜひ設定しよう</p>
                @elseif (!empty($user->goal))
                  <p class="p-2 text-left">{{ $user->goal ?? old('goal') }}</p>
                @endif
              </div>
              </div>
                <div>
                  <div class="d-flex justify-content-center align-items-center h5 mt-4">
                    <div class="p-2 d-flex flex-column align-items-center">
                      <p class="font-weight-bold">ツイート数</p>
                      <span>{{ $post_count }}</span>
                    </div>
                    @if ($follow_count === 0 && $user->id !== Auth::user()->id)
                      <div class="p-2 d-flex flex-column align-items-center ml-2">
                        <p class="font-weight-bold">フォロー数</p>
                        <span>{{ $follow_count }}</span>
                      </div>
                    @elseif ($follow_count > 0 || $follow_count === 0 )
                      <div class="p-2 d-flex flex-column align-items-center ml-2">
                        <p class="font-weight-bold">フォロー数</p>
                        <a href ="{{ route('users.followings', ['user' => $user->id])  }}" class="text-decoration-none">{{ $follow_count }}</a>
                      </div>
                    @endif
                    @if ($follower_count === 0 && $user->id !== Auth::user()->id)
                      <div class="p-2 d-flex flex-column align-items-center ml-2">
                        <p class="font-weight-bold">フォロワー数</p>
                        <span>{{ $follower_count }}</span>
                      </div>
                    @elseif ($follower_count > 0 || $follower_count === 0)
                      <div class="p-2 d-flex flex-column align-items-center ml-2">
                        <p class="font-weight-bold">フォロワー数</p>
                        <a href="{{ route('users.followers', ['user' => $user->id])  }}" class="text-decoration-none">{{ $follower_count }}</a>
                      </div>
                    @endif
                  </div>
                </div>
            </div>
          </div>
       </div>
       <div class="w-30 text-center mt-3">
         <a href="{{ route('posts.followings.timeline') }}" class="text-decoration-none text-white bg-primary rounded p-2"><i class="fas fa-eye pr-2"></i>フォロー中の投稿一覧を見る</a>
       </div>
       @if (isset($timelines))
         @foreach ($timelines as $timeline)
           <div class="container">
             <div class="card mt-3 border-light darkmode-post">
               <div class="card-body d-flex flex-row border-top border-bottom">
                 <div class="avatar mr-3" style="width:70px;height:70px;border-radius:50%;">
                   @if (empty($user->avatar))
                     <i class="fas fa-user-circle fa-4x"></i>
                   @elseif (!empty($user->avatar))
                     <img src="{{ $user->avatar }}" style="width:70px;height:70px;border-radius:50%;">
                   @endif
                 </div>
                 <div>
                   <div class="font-weight-bold">
                     <p class="mb-0">{{ $timeline->user->name }}</p>
                   </div>
                   <div class="font-weight-lighter">
                     <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                   </div>
                   @if (!empty($timeline->image_url))
                     <div class="card-image mt-2">
                       <img src="{{ $timeline->image_url }}" width="110px" height="145px">
                     </div>
                   @endif
                 </div>
                 <div class="card-body ml-3">
                   <div class="d-flex justify-content-between">
                     <h3 class="h4 card-title">
                       {{$timeline->title}}
                     </h3>
                       @if( Auth::id() === $timeline->user_id )
                       <!-- dropdown -->
                         <div class="ml-auto card-text">
                           <div class="dropdown">
                             <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <button type="button" class="btn btn-link text-muted m-0 p-2">
                                 <i class="fas fa-ellipsis-v"></i>
                               </button>
                             </a>
                             <div class="dropdown-menu dropdown-menu-right">
                               <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $timeline->id])}}">
                                 <i class="fas fa-pen mr-1"></i>記事を更新する
                               </a>
                               <div class="dropdown-divider"></div>
                                 <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $timeline->id }}">
                                   <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                                 </a>
                             </div>
                           </div>
                         </div>
                        <!-- dropdown -->
                     
                        <!-- modal -->
                        <div id="modal-delete-{{ $timeline->id }}" class="modal fade" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form method="POST" action="{{ route('posts.destroy', ['post' => $timeline->id]) }}">
                                @csrf
                                <div class="modal-body">
                                  {{ $timeline->title }}を削除します。よろしいですか？
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
                   <div class="post-card">
                     <div class="d-flex flex-row pt-2" >
                       <i class="far fa-clock fa-2x text-success"></i>
                       <div class="study-time ml-2">
                         <p class="h3 mb-0">{{ substr($timeline->time, 0,2) }}時間 {{ substr($timeline->time, 3,2)}}分</p>
                       </div>
                    </div>
                    <div class="card-text mt-3">
                      {{$timeline->body}}
                    </div>
                   </div>
                  <div class="tags">
                    @foreach ($timeline->tags as $tag)
                      <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}">
                        #{{ $tag->tag_name }}
                      </a>
                    @endforeach
                  </div>
                  <div class="row justify-content-end">
                  <!--コメント機能-->
                    <div class="mt-4">
                      <a href="{{ route('posts.show', ['post' => $timeline->id]) }}" class='comments mr-3'>
                        <div class="btn btn-primary py-1" style="height:37px;">
                          <i class="far fa-comment-alt fa-lg mr-2 mt-2"></i>{{ $timeline->comments()->count() }}
                        </div>
                      </a>
                    </div>
                    <div class="mt-4" style="width:70px;">
                      @if ($timeline->likes()->where('user_id', Auth::id())->exists())
                        <div class="col-md-3" style="width:70px;">
                          <form method="POST" action="{{ route('unlikes', $timeline) }}">
                            @csrf
                            <input type="submit" class="fas border btn-danger rounded-left" style="height:37px; width:55px;" value="&#xf004; {{ $timeline->likes()->count() }}">
                          </form>
                        </div>
                      @else
                        <div class="col-md-3">
                          <form method="POST" action="{{ route('likes', $timeline) }}">
                            @csrf
                            <input type="submit" class="fas border py-2 darkmode-like bg-white rounded-left" value="&#xf004; {{ $timeline->likes()->count() }}"  style="color:#6c7176; width:56px; height:37px;">
                          </form>
                        </div>
                      @endif
                    </div>
                    <div style="width:32px; height:32px;" class="pr-2 pt-4">
                      <a href="{{ route('likes.users', ['post' => $timeline]) }}">
                        <span><i class="fas fa-user fa-2x border rounded-right" style="height:37px; width:37px; color:#E3342F; padding-top:4px; padding-left:5px;"></i></span>
                      </a>
                    </div>
                  </div>
                </div>
             </div>
          </div>
        </div>
      @endforeach
    @endif
    @if ($timelines->count() === 0 && $user->id === Auth::user()->id)
      <div class="container">
        <div class="user-container text-center user-post">
          <i class="fas fa-user-edit fa-5x user-image"></i> 
          <p class="user-title">自分の投稿</p>
          <p class="user-content">ここに自分の投稿が表示されます。
        </div>
      </div>
    @endif
      <div class="top-back">
        <a href="#"><div class="to-top"><i class="fas fa-3x fa-chevron-up"></i></div></a>
      </div>
  </div>
@endsection

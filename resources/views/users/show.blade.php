@extends('app')

@section('title', 'ユーザー詳細')

@section('content')
<div class="container mt-5">
   <div class="mt-3">
        <div>
            <div class="card">
                <div>
                  <div class="d-flex justify-content-center">
                    <!--<div class="border" style="width:70px;height:70px;border-radius:50%;position:relative;">-->
                    <!--  <span style="position:absolute;top:25%;left:10%;">{{ $level }}</span>-->
                    <!--</div>-->
                    <div class="ml-2">
                      <div class="avatar mt-3 mr-3" style="width:110px;height:110px;border-radius:50%;">
                      @if(empty($user->avatar))
                        <i class="fas fa-user-circle fa-8x"></i>
                        @elseif(!empty($user->avatar))
                        <img src="{{ $user->avatar }}" style="width:110px;height:110px;border-radius:50%;">
                        @endif
                      </div>
                     <div class="font-weight-bold text-center mt-2 mr-3">
                      {{$user->name}}
                     </div>
                     </div>
                    @if( Auth::id() === $user->id )
                   <div class="mr-5" style="max-width:600px;width:100%;">
                    <div class="border mt-3 ml-3 rounded" style="max-width:600px; width:100%;height:130px;">
                      @if($user->id === Auth::user()->id && empty($user->self_introduction))
                      <p>自己紹介を設定し、自分を表現しよう!!
                      @elseif(!empty($user->self_introduction))
                      <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                      @endif
                    </div>
                    @else
                     <div class="border mt-3 mr-2" style="max-width:600px; width:100%; height:130px;">
                      <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                    </div>
                    @endif
                    </div>
                     @if ($user->id === Auth::user()->id && empty($user->self_introduction && $user->goal && $user->important_day_title && $user->important_day))
                    <div class="ml-2">
                      <a href="{{ route('users.create') }}" class="btn btn-primary mt-3">プロフィールを設定する</a>
                    </div>
                    @elseif($user->id === Auth::user()->id && !empty($user->self_introduction || $user->goal || $user->important_day_title || $user->important_day))
                    <div>
                      <a href="{{ route('users.edit',['user'=>$user]) }}" class="btn btn-primary mt-3">プロフィールを編集する</a>
                    </div>
                    @endif
                    </div>
                    <div class="text-center">
                     <div class="d-inline-block mt-4 border text-center rounded  bg-success" style="max-width:235px;height:180px;width:100%;display:teble-cell;vertical-align:middle;">
                       @if($user->id === Auth::user()->id && empty($user->important_day_title))
                       <p class="p-2 text-left mb-0">イベントタイトルとその日までのカウントダウンを設定しよう!</p><hr style="margin:0 0 10px 0;">
                       @elseif(!empty($user->important_day_title))
                       <p class="p-2 text-left">{{ $user->important_day_title }}</p><hr>
                      @endif
                      @if( Auth::user()->id === $user->id && empty($user->important_day))
                      <p>あと<span class="display-3">000</span>日</p>
                      @elseif(!empty($user->important_day))
                      <p>あと<span class="display-3">{{ $count_down }}</span>日</p>
                      @endif
                     </div>
                    <div class="d-inline-block mt-4 border text-center rounded mb-3 ml-4" style="max-width:500px;height:150px;width:100%;display:teble-cel;vertical-align: middle;">
                      <i class="far fa-flag fa-2x py-2 pr-2" style="color:red;"></i><span class="font-weight-bold h4 mb-0 py-2">達成目標</span><hr class="m-0">
                      @if($user->id === Auth::user()->id && empty($user->goal))
                      <p style="padding-top:40px;">達成したい目標を視覚化すると効果的!! ぜひ設定しよう</p>
                      @elseif(!empty($user->goal))
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
                          <div class="p-2 d-flex flex-column align-items-center ml-2">
                            <p class="font-weight-bold">フォロー数</p>
                            <a href ="{{ route('users.followings',['name'=>$user->name])  }}" class="text-decoration-none">{{ $follow_count }}</a>
                          </div>
                        <div class="p-2 d-flex flex-column align-items-center ml-2">
                            <p class="font-weight-bold">フォロワー数</p>
                            <a href="{{ route('users.followers',['name'=>$user->name])  }}" class="text-decoration-none">{{ $follower_count }}</a>
                        </div>
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
                    <div class="card mt-3 border-light">
                        <div class="card-body d-flex flex-row border-top border-bottom">
                             <div class="avatar mr-3" style="width:70px;height:70px;border-radius:50%;">
                                @if(empty($user->avatar))
                                  <i class="fas fa-user-circle fa-4x"></i>
                                  @elseif(!empty($user->avatar))
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
                            <div class="card-image mt-2">
                                 <img src="{{ $timeline->image_url }}" width="110px" height="145px">
                            </div>
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
                                    <p class="h3 mb-0">{{ substr($timeline->time,0,2) }}時間 {{ substr($timeline->time,3,2)}}分</p>
                                  </div>
                                </div>
                                <div class="card-text mt-3">
                                  {{$timeline->body}}
                               </div>
                              </div>
                              <div class="tags">
                                @foreach($timeline->tags as $tag)
                                  <a href="{{ route('posts.index', ['tag_name'=>$tag->tag_name]) }}">
                                    #{{ $tag->tag_name }}
                                  </a>
                                @endforeach
                              </div>
                        <div class="row justify-content-end">
                          <!--コメント機能-->
                          <div class="mt-4">
                            <a href="{{ route('posts.show',['post'=> $timeline->id]) }}" class='comments mr-3'>
                           <div class="btn btn-primary py-1">
                              <i class="far fa-comment-alt fa-lg mr-2"></i>{{ $timeline->comments()->count() }}
                          </div>
                            </a>
                        </div>
                        <div class="mt-4">
                         @if($timeline->likes()->where('user_id', Auth::id())->exists())
                          <div class="col-md-3">
                            <form method="POST" action="{{ route('unlikes',$timeline) }}">
                              @csrf
                              <input type="submit" class="fas btn btn-danger mr-2 py-2" value="&#xf004;{{ $timeline->likes()->count() }}">
                            </form>
                          </div>
                        @else
                          <div class="col-md-3">
                            <form method="POST" action="{{ route('likes',$timeline) }}">
                              @csrf
                              <input type="submit" class="fas btn border-dark py-2" value="&#xf004;{{ $timeline->likes()->count() }}">
                            </form>
                          </div>
                         @endif
                        </div>
                      </div>
                    </div>
                 </div>
              </div>
            </div>
          @endforeach
        @endif
     </div>
  </div>
@endsection

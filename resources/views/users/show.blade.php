@extends('app')

@section('title', 'ユーザー詳細')

@section('content')
<div class="container">
   <div class="card mt-3">
        <div class="card-body">
            <div class="card">
                <div>
                  <div class="d-flex justify-content-center">
                    <div>
                     <i class="fas fa-user-circle fa-3x mt-3 "></i>
                     <div class="font-weight-bold mt-2 mr-3">
                      {{$user->name}}
                     </div>
                    <div class="mt-3 align-items-center">
                     <i class="fab fa-2x fa-font-awesome" style="color:red; margin-right:70px"><span class="font-weight-bold h4">目標</span></i>
                     {{ $user->profile->goal ?? 'エラー' }}
                     </div>
                    </div>
                    dd($user->profile);
                   @if( Auth::id() === $user->id )
                    <div class="mt-3">
                      <textarea name="self_introduction" cols="70" row="6" class="form-control textarea" placeholder="自己紹介" style="height:100px;resize:none;">{{ $user->profile->self_introduction ?? 'エラー' }}</textarea>
                    </div>
                    @else
                     <div class="mt-3">
                      <textarea name="self_introduction" cols="90" row="6" class="form-control textarea" placeholder="自己紹介" style="height:100px;resize:none;"></textarea>
                    </div>
                    @endif
                    @if ($user->id === Auth::user()->id && ($user->profile->self_introduction && $user->profile->goal == null))
                    <div>
                      <a href="{{ route('users.create') }}" class="btn btn-primary ml-5 mt-3">プロフィールを設定する</a>
                    </div>
                    @endif
                    @if ($user->id === Auth::user()->id && ($user->profile->self_introduction || $user->profile->goal !== null))
                    <div>
                      <a href="{{ route('users.edit',['user'=>$user->profile->user_id]) }}" class="btn btn-primary ml-5 mt-3">プロフィールを編集する</a>
                    </div>
                    @endif
                  </div>
                    <div>
                      <div class="d-flex justify-content-center h5">
                        <div class="p-2 d-flex flex-column align-items-center">
                          <p class="font-weight-bold">ツイート数</p>
                          <span>{{ $post_count }}</span>
                        </div>
                          <div class="p-2 d-flex flex-column align-items-center">
                            <p class="font-weight-bold">フォロー数</p>
                            <span>{{ $follow_count }}</span>
                          </div>
                        <div class="p-2 d-flex flex-column align-items-center">
                            <p class="font-weight-bold">フォロワー数</p>
                            <span>{{ $follower_count }}</span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        @if (isset($timelines))
            @foreach ($timelines as $timeline)
                <div class="container">
                    <div class="card mt-3">
                        <div class="card-body d-flex flex-row border-top border-bottom">
                          <i class="fas fa-user-circle fa-3x mr-1"></i>
                           <div>
                            <div class="font-weight-bold">
                                <p class="mb-0">{{ $timeline->user->name }}</p>
                            </div>
                            <div class="font-weight-lighter">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="card-image mt-2">
                                 <img src="/storage/{{ $timeline->image_url }}" width="200px" height="180px">
                            </div>
                           </div>
                            <div class="card-body">
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

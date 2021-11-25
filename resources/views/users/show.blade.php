@extends('app')

@section('title', 'ユーザー詳細')

@section('content')
<div class="container">
   <div class="card mt-3">
        <div class="card-body">
            <div class="card">
                <div>
                  <div class="d-flex justify-content-center">
                    <div class="ml-5">
                     <i class="fas fa-user-circle fa-3x mt-3 "></i>
                     <div class="font-weight-bold mt-2 mr-3">
                      {{$user->name}}
                     </div>
                     </div>
                    @if( Auth::id() === $user->id )
                    <div style="max-width:720px; width:100%; height:120px;">
                    <div class="border mt-3 ml-3" style="max-width:700px; width:100%; height:120px;">
                      <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                    </div>
                    @else
                     <div class="border mt-3 mr-2" style="max-width:720px; width:100%; height:120px;">
                      <p class="p-2">{{ $user->self_introduction ?? old('self_introduction') }}</p>
                    </div>
                    @endif
                    </div>
                     @if ($user->id === Auth::user()->id && empty($user->self_introduction && $user->goal))
                    <div class="ml-2">
                      <a href="{{ route('users.create') }}" class="btn btn-primary ml-2 mt-3">プロフィールを設定する</a>
                    </div>
                    @endif
                    @if ($user->id === Auth::user()->id && !empty($user->self_introduction || $user->goal))
                    <div>
                      <a href="{{ route('users.edit',['user'=>$user]) }}" class="btn btn-primary ml-2 mt-3">プロフィールを編集する</a>
                    </div>
                    @endif
                    </div>
                     <div class="mt-3 mb-2">
                      <div class="mt-4 border mx-auto text-center" style="max-width:500px;height:150px;width:100%;">
                         <i class="far fa-flag fa-2x py-2 pr-2" style="color:red;"></i><span class="font-weight-bold h4 mb-0 py-2">達成目標</span><hr class="m-0">
                      <p class="p-2 text-left">{{ $user->goal ?? old('goal') }}</p>
                      </div>
                    </div>
                    <div>
                      <div class="d-flex justify-content-center align-items-center h5 ">
                        <div class="p-2 d-flex flex-column align-items-center">
                          <p class="font-weight-bold">ツイート数</p>
                          <span>{{ $post_count }}</span>
                        </div>
                          <div class="p-2 d-flex flex-column align-items-center ml-2">
                            <p class="font-weight-bold">フォロー数</p>
                            <span>{{ $follow_count }}</span>
                          </div>
                        <div class="p-2 d-flex flex-column align-items-center ml-2">
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

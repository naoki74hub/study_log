@extends('app')

@section('title', '記事一覧')

@section('content')
  <div class="container mt-5">
    @foreach ($post->likes as $user)
      <div class="card mt-3 border-light darkmode-post">
        <div class="card-body border-top border-bottom d-flex">
          <div>
            <div class="following-name">
              <div class="avatar mr-3">
                @if (empty($user->avatar))
                  <i class="fas fa-user-circle fa-3x"></i>
                @elseif (!empty($user->avatar))
                  <img src="{{ $user->avatar }}" style="width:70px; height:70px; border-radius:50%;">
                @endif
              </div>
              <a href="{{ route('users.show', ['user' => $user->id]) }}" class="text-decoration-none">
                {{ $user->name }}
              </a>
            </div>
          @if (auth()->user()->isFollowed($user->id))
            <span class="bg-secondary text-white">フォローされています</span>
          @endif
          @if (auth()->user()->isFollowing($user->id))
            <form method="POST" action="{{ route('users.unfollow', ['user' => $user->id]) }}" style="width:150px;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger py-1 px-2" style="width:130px;"><i class="fas fa-user-minus"></i>フォロー解除</button>
            </form>
          @else
            <form method="POST" action="{{ route('users.follow', ['user' => $user->id]) }}">
              @csrf
              <button type="submit" class="btn btn-primary py-1 px-2" style="width:140px;"><i class="fas fa-user-plus mr-2"></i>フォローする</button>
            </form>
          @endif
          </div>
          <div clss="self_introduction ml-3" style="max-width:750px;width:100%;">
            <p class="ml-5">{{ $user->self_introduction }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection

@extends('app')

@section('title', '記事一覧')

@section('content')

<div class="container mt-5">
  @foreach($followings as $following)
  <div class="card mt-3 border-light darkmode-post">
    <div class="card-body border-top border-bottom d-flex">
     <div>
      <div class="following-name">
        <div class="avatar mr-3">
        @if(empty($following->avatar))
           <i class="fas fa-user-circle fa-3x"></i>
           @elseif(!empty($following->avatar))
           <img src="{{ $following->avatar }}" style="width:70px;height:70px;border-radius:50%;">
           @endif
         </div>
         <a href="{{ route('users.show',['user'=>$following->id]) }}" class="text-decoration-none">
         {{$following->name}}
        </a>
      </div>
      @if(auth()->user()->isFollowed($following->id))
      <span class="bg-secondary text-white">フォローされています</span>
      @endif
      @if(auth()->user()->isFollowing($following->id))
       <form method="POST" action="{{ route('users.unfollow',['user'=>$following->id]) }}" style="width:150px;">
         @csrf
         @method('DELETE')
         <button type="submit" class="btn btn-danger py-1 px-2" style="width:130px;"><i class="fas fa-user-minus"></i>フォロー解除</button>
       </form>
       @else
       <form method="POST" action="{{ route('users.follow',['user'=>$following->id]) }}">
         @csrf
         <button type="submit" class="btn btn-primary py-1 px-2" style="width:140px;"><i class="fas fa-user-plus mr-2"></i>フォローする</button>
       </form>
       @endif
     </div>
    <div clss="self_introduction ml-3" style="max-width:750px;width:100%;">
      <p class="ml-5">{{ $following->self_introduction}}</p>
    </div>
    </div>
   </div>
  @endforeach
  <div class="top-back">
      <a href="#"><div class="to-top"><i class="fas fa-3x fa-chevron-up"></i></div></a>
    </div>
 </div>
@endsection

@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
  <div class="container col-lg-5 pt-5">
    @foreach($posts as $post)
    <div class="card mt-3 border-left-0 border-right-0 border-light" >
     <div class="d-flex flex-row">
      <div class="card-body d-flex flex-row">
        <i class="fas fa-user-circle fa-3x mr-1"></i>
        <div>
          <div class="font-weight-bold">
            {{$post->user->name}}
          </div>
          <div class="font-weight-lighter">
            {{ $post->created_at->format('Y/m/d H:i')}} 
          </div>
          <div class="card-image mt-2">
            <img src="{{asset('img/text.jpg')}}" width="140px" height="140px">
          </div>
        </div>
      </div>
      <div class="card-body">
        <h3 class="h4 card-title">
           {{$post->title}}
        </h3>
        <div class="post-card">
         <div class="d-flex flex-row pt-2" >
          <i class="far fa-clock fa-2x text-success"></i>
          <div class="study-time ml-2">
            <p class="h3 mb-0">1時間40分</p>
          </div>
        </div>
        <div class="card-text mt-3">
          {{$post->body}}
       </div>
      </div>
     </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

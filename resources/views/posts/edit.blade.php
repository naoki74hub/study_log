@extends('app')

@section('title', '投稿更新')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3 darkmode-post">
         @include('error_list')
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{route('posts.update',['post'=>$post->id])}}">
               @include('posts.form')
                <button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('app')

@section('title', '記事投稿')

@include('nav')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
             </div>
          @endif
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{route('posts.store')}}">
                  @include('posts.form')
                <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
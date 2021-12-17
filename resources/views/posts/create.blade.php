@extends('app')

@section('title', '記事投稿')

@section('content')
<div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3 darkmode-post">
          @include('error_list')
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                  @include('posts.form')
                <div class="d-flex justify-content-center">
                 <div class="mr-5">
                   <button type="submit" class="btn btn-block shadow p-3 mb-5 btn-primary text-white" style="width:174px;">投稿する</button>
                 </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@extends('app')

@section('title', 'プロフィール更新')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
         @include('error_list')
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{route('users.update',['user'=>$user->profile->user_id]) }}">
                @include('users.form')
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
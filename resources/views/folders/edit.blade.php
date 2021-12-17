@extends('app')

@section('title', 'ToDo')

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-8 mx-auto">
        <nav class="card mt-3 darkmode-post">
          <div class="card-text text-white bg-primary pl-2 py-2">フォルダを編集する</div>
            <div class="card-body">
              @include('error_list')
              <form method="POST" action="{{ route('folders.update', ['folder' => $folder]) }}">
                @csrf
                <div class="form-group">
                  <label for="title">フォルダ名</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ $folder->title ?? old('title') }}">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">送信</button>
                </div>
              </form>
            </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
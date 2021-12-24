@extends('app')

@section('title', 'コメント')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          @include('error_list')
          <div class="card-body pt-0 darkmode-post">
            <div class="card-text">
              <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}">
                  @csrf
                  @method('PUT')
                  <div class="form-group mt-3">
                    <label for="comment">コメント:</label>
                    <textarea class="form-control" row="5" id="comment" name="comment">{{ $comment->comment ?? old('comment') }}</textarea>
                  </div>
                <button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
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
              <form method="POST" action="{{route('comments.store')}}">
                  @csrf
                  <div class="form-group mt-3">
                    <label for="comment">コメント:</label>
                    <textarea class="form-control" row="5" id="comment" name="comment"></textarea>
                  </div>
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                  <input type="hidden" name="post_id" value="{{ $post_id }}">
                 <button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">コメントする</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
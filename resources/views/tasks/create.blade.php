@extends('app')

@section('title', 'ToDo')

@include('share.flatpickr.styles')
@section('content')
<main>
  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <nav class="card mt-5 darkmode-post">
          <div class="card-text bg-primary text-white pl-2 py-2">タスクを追加する</div>
          <div class="card-body">
             @include('error_list')
            <form action="{{ route('folders.tasks.store', ['id' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="estimate_hour">見積もり時間</label>
                <input type="text" class="form-control" name="estimate_hour" id="estimate_hour" value="{{ old('estimate_hour') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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
</main>
@include('share.flatpickr.scripts')
@endsection
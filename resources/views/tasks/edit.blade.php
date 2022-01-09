@extends('app')

@section('title', 'ToDo')

@include('share.flatpickr.styles')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <nav class="card mt-5 darkmode-post">
          <div class="card-text text-white pl-2 py-2" style="background-color:#1b253c;">タスクを編集する</div>
          <div class="card-body">
           @include('error_list')
            <form method="POST" action="{{ route('folders.tasks.update', ['folder' => $task->folder_id, 'task' => $task->id]) }}">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $task->title }}" />
              </div>
              <div class="form-group">
                <label for="status">状態</label>
                <select name="status" id="status" class="form-control">
                  //Taskモデルで定義した配列定数をループ
                  @foreach(\App\Models\Task::STATUS as $key => $val)
                  //ループしたキーと直前の入力値、あるいは、データベースに登録済みの値を比べて、一致すれば'selected'を出力
                    <option value="{{ $key }}" {{ $key == old('status', $task->status) ? 'selected' : '' }}>
                      {{ $val['badge'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="estimate_hour">見積もり時間</label>
                <input type="text" class="form-control" name="estimate_hour" id="estimate_hour" value="{{ old('estimate_hour') ?? $task->estimate_hour }}" />
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') ?? $task->due_date }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </foerm>
          </div>
        </nav>
      </div>
    </div>
  </div>
@include('share.flatpickr.scripts')

@endsection
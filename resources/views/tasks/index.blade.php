@extends('app')

@section('title', '管理')
 <link href="{{ asset('css/stopwatch.css')}}" rel="stylesheet">
 <script src="{{ asset('js/stopwatch.js') }}"></script>
@section('content')
<main>
 <div class="time-container">
    <div id="timer" class="mt-5">00:00.000</div>
    <div class="controls">
      <div id="start" class="time-btn">Start</div>
      <div id="stop" class="time-btn">Stop</div>
      <div id="reset" class="time-btn">Reset</div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-4 card mt-5 px-0">
       <div class="card-text text-white pl-2 py-2" style="background-color:#1b253c;"><i class="far fa-folder mr-2"></i>フォルダー</div>
        <nav>
          <div class="card-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block btn-primary mb-2">
              <i class="fas fa-plus mr-2"></i>フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach($folders as $folder)
              <a href="{{ route('folders.tasks.index', ['id' => $folder->id]) }}" class="list-group-item  {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                {{ $folder->title }}
              </a>
            @endforeach
          </div>
     </nav>
  </div>
<div class="column col-md">
<div class="card mt-5">
 <div class="card-text text-white pl-2 py-2" style="background-color:#1b253c;"><i class="fas fa-fire mr-2"></i>タスク</div>
  <div class="card-body">
    <div class="text-center">
      <a href="{{ route('folders.tasks.create',['id'=>$current_folder_id]) }}" class="btn btn-default btn-block bg-primary text-white">
        <i class="fas fa-plus mr-2"></i>タスクを追加する
      </a>
    </div>
  </div>
  <table class="table">
    <thead>
    <tr>
      <th>タイトル</th>
      <th>状態</th>
      <th>見積もり時間</th>
      <th>期限</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
        <tr>
          <td>{{ $task->title }}</td>
          <td>
            <span class="badge {{ $task->status_class }}">{{  $task->status_badge }}</span>
          </td>
          <td>{{ $task->estimate_hour }}</td>
          <td>{{ $task->due_date }}</td>
          <td><a href="{{ route('folders.tasks.edit',['id'=>$task->folder_id,'task_id'=>$task->id]) }}"><i class="fa fa-pen"></i></a></td>
          <td><a data-toggle="modal" data-target="#modal-delete-{{ $task->id }}"><i class="fa fa-trash-alt text-danger"></i></a></td>
       </tr>
      <!-- modal -->
          <div id="modal-delete-{{ $task->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="{{ route('folders.tasks.destroy',['id'=>$task->folder_id,'task_id'=>$task->id]) }}">
                  @csrf
                 <div class="modal-body">
                    {{ $task->title }}を削除します。よろしいですか？
                  </div>
                  <div class="modal-footer justify-content-between">
                    <a class="btn border" data-dismiss="modal">キャンセル</a>
                    <button type="submit" class="btn btn-danger">削除する</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- modal -->
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
</div>
</main>
@endsection


@extends('app')
@section('title', '管理')
 
@section('content')
  <div class="time-container darkmode-post">
    <div id="timer" class="mt-5 text-dark">00:00</div>
      <div class="controls">
        <div id="start" class="time-btn border darkmode-post">スタート</div>
        <div id="stop" class="time-btn border  darkmode-post">ストップ</div>
        <div id="reset" class="time-btn border  darkmode-post">リセット</div>
      </div>
  </div>
  <div id="container">
    <h3 class="title">ポモドーロテクニックで効率的かつ集中力UP！！</h3>
      <div id="page1">
        <div class="mContainer">
          <div class="d-flex flex-row justify-content-center" style="height: 100%;">
            <div class="p-2 areaStyle1 align-self-center flexFill">
              <p class="textStyle1">活動中</p>
              <div class="dropdown">
                <div class="d-flex justify-content-center">
                  <div class="p-2">
                    <button class="btn text-white btn-size dropdown-toggle" style="width:100px;height:60px; font-size:32px;" type="button" id="dropdownMenu1"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      25
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  　   <a class="dropdown-item" value="15">15</a>
                      <a class="dropdown-item" value="20">20</a>
                      <a class="dropdown-item" value="25">25</a>
                      <a class="dropdown-item" value="30">30</a>
                      <a class="dropdown-item" value="35">35</a>
                      <a class="dropdown-item" value="40">40</a>
                      <a class="dropdown-item" value="45">45</a>
                      <a class="dropdown-item" value="50">50</a>
                      <a class="dropdown-item" value="55">55</a>
                      <a class="dropdown-item" value="60">60</a>
                    </div>
                  </div>
                  <div class="align-self-center">
                    <p class="textStyle2 mb-0">分</p>
                  </div>
                </div>
              </div>
            </div>
             <div class="p-2 areaStyle1 align-self-center flexFill">
               <p class="textStyle1">休憩中</p>
               <div class="dropdown">
                 <div class="d-flex justify-content-center">
                   <div class="p-2">
                     <button class="btn dropdown-toggle text-white" style="width:100px;height:60px;font-size:32px;" type="button" id="dropdownMenu2"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       05
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                       <a class="dropdown-item" value="05">05</a>
                       <a class="dropdown-item" value="10">10</a>
                       <a class="dropdown-item" value="15">15</a>
                       <a class="dropdown-item" value="20">20</a>
                     </div>
                   </div>
                   <div class="align-self-center">
                     <p class="textStyle2 mb-0">分</p>
                   </div>
                 </div>
               </div>
             </div>
          </div>
        </div>
        <div>
          <button id="startBtn" type="button" class="secBtn btn btn-outline-primary">スタート</button>
         </div>
      </div>
      <!-- タイマーページ -->
      <div id="page2" class="displayNone">
      <!-- カウントダウン -->
        <div class="mContainer">
          <div class="d-flex flex-column justify-content-center" style="height: 100%;">
            <div class="p-2 mt-4 align-self-center">
              <p class="mb-0 textStyle1" id="work">活動中</p>
            </div>
            <div class="align-self-center">
              <p id="pomodoro-timer" style="font-size:80px;"></p>
            </div>
          </div>
        </div>
        <!-- button -->
        <div>
          <button id="stopBtn" type="button" class="btn btn-outline-danger">一時停止</button>
          <button id="cancelBtn" type="button" class="btn btn-outline-secondary">キャンセル</button>
        </div>
        <!-- audio -->
        <audio id="sound-file-decision1" preload="auto">
          <source src="{{ asset('sound/pomodoro2.mp3') }}" type="audio/mp3">
        </audio>
        <audio id="sound-file-decision4" preload="auto">
          <source src="{{ asset('sound/pomodoro1.mp3') }}" type="audio/mp3">
        </audio>
     </div>
  </div>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-4 mt-5 px-0">
       <div class="card-text text-white pl-2 py-2" style="background-color:#1b253c;"><i class="far fa-folder mr-2"></i>フォルダー</div>
        <nav class="darkmode-post card">
          <div class="card-body">
            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block btn-primary mb-2">
              <i class="fas fa-plus mr-2"></i>フォルダを追加する
            </a>
          </div>
          <div class="list-group">
            @foreach ($folders as $folder)
              <div class="d-flex">
                <a href="{{ route('folders.tasks.index', ['folder' => $folder]) }}" class="list-group-item text-decoration-none {{ $current_folder_id === $folder->id ? 'active' : ''}}" style="width:285px;">
                  {{ $folder->title }}
                </a>
                <a href="{{route('folders.edit', ['folder' => $folder])}}"><i class="fa fa-pen mt-3 ml-2"></i></a></td>
              @if ($folder->id === 1)
              @else
                <span class="folder-delete mr-2" data-toggle="modal" data-target="#modal-delete-{{ $folder->id }}"><i class="fa fa-trash-alt text-danger mt-3 ml-4"></i></span>
              @endif
             </div>
             <!-- modal -->
             <div id="modal-delete-{{ $folder->id }}" class="modal fade" tabindex="-1" role="dialog">
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <form method="POST" action="{{ route('folders.destroy', ['folder' => $folder]) }}">
                     @csrf
                     <div class="modal-body bg-dark text-white">
                       {{ $folder->title }}を削除します。よろしいですか？
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
          </div>
        </nav>
      </div>
      <div class="column col-md">
        <div class="card mt-5 darkmode-post">
          <div class="card-text text-white pl-2 py-2" style="background-color:#1b253c;"><i class="fas fa-fire mr-2"></i>タスク</div>
          <div class="card-body">
            <div class="text-center">
              <a href="{{ route('folders.tasks.create', ['folder' => $current_folder_id]) }}" class="btn btn-default btn-block bg-primary text-white">
                <i class="fas fa-plus mr-2"></i>タスクを追加する
              </a>
            </div>
          </div>
          <table class="table text-primary" id="table">
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
              @foreach ($tasks as $task)
                <tr>
                  <td>{{ $task->title }}</td>
                  <td>
                  <span class="badge {{ $task->status_class }}">{{  $task->status_badge }}</span>
                  </td>
                  <td>{{ $task->estimate_hour }}</td>
                  <td>{{ $task->due_date }}</td>
                  <td><a href="{{ route('folders.tasks.edit', ['folder' => $task->folder_id, 'task' => $task]) }}"><i class="fa fa-pen"></i></a></td>
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
                      <form method="POST" action="{{ route('folders.tasks.destroy', ['folder' => $task->folder_id, 'task' => $task]) }}">
                        @csrf
                       <div class="modal-body bg-dark text-white">
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
  <div class="container">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">
  Bootstrap modal fade-in
</button>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalLabelId">modal title</h3>
            </div>
            <div class="modal-body">
                <label>mobal body</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>
  </div>
 @section('script')
 <script src="{{ asset('js/pomodoro_timer.js') }}"></script>
 <script src="{{ asset('js/stopwatch.js') }}"></script>
 @endsection
@endsection
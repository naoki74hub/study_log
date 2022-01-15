
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
                 <div class="modal-content darkmode-post">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <form method="POST" action="{{ route('folders.destroy', ['folder' => $folder]) }}">
                     @csrf
                     <div class="modal-body">
                       {{ $folder->title }}を削除します。よろしいですか？
                     </div>
                     <div class="modal-footer justify-content-between">
                       <a class="btn border" style="color:#8c8b88"; data-dismiss="modal">キャンセル</a>
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
                    <div class="modal-content darkmode-post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="{{ route('folders.tasks.destroy', ['folder' => $task->folder_id, 'task' => $task]) }}">
                        @csrf
                       <div class="modal-body">
                          {{ $task->title }}を削除します。よろしいですか？
                        </div>
                        <div class="modal-footer justify-content-between">
                          <a class="btn border" style="color:#8c8b88;" data-dismiss="modal">キャンセル</a>
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
  <div class="container　mt-5">
      <div class="text-center mt-5">
          <div class="heading"><span class="heading1">勉強に取りかかれる、集中できるアドバイス！！</span></div> 
            <button type="button" class="btn btn-danger study-tips" data-toggle="modal" data-target="#modal1">
              <i class="fas fa-sad-tear fa-2x mr-2"></i><span class="study-tips-text">勉強に集中できないあなたへ</span>
            </button>
       </div>
       <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
           <div class="modal-dialog" style="max-width:inherit; width:45%;">
               <div class="modal-content darkmode-post">
                   <div class="modal-body mt-4" style="padding-left:55px;">
                        <div class="d-flex align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-building fa-5x"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">勉強する場所を変える</p>
                                <p>勉強する場所を変えてみてはいかがでしょうか？<br>静かな場所がいいのであれば図書館。ざわついた雰囲気の中でも集中できるのならカフェ。自分が1番集中できる場所を見つけよう。</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-running fa-5x"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">運動を取り入れる</p>
                                <p>運動すれば、やる気ホルモンといわれるドーパミンが生成されます。勉強の合間に少しストレッチをしたり、軽い筋トレをしたりするのがおすすめです。<br>朝のウォーキングなどの有酸素運動も、 脳の働きを活性化させます。有酸素運動を取り入れると、記憶力、集中力がアップし、暗記や計算などもうまくこなせるようになります。</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-brain fa-5x" style="width:60px;"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">とりあえず行動する</p>
                                <p>「やる気」というのは、脳の側坐核という部分が働き、脳内物質が分泌することで「やる気」ができます。では、どうすれば側坐核が働き、「やる気」を出すことができるのか？答えは、実際に行動することです。
                                勉強などの作業に入ると、脳の側坐核が働き、「やる気」に繋がります。つまり、ほんの一歩行動するだけで「やる気」が引き出されるのです。最初は「やる気」がなかったけど、勉強し始めたらだんだん「やる気」が出てきて、気づけば長時間勉強していたなんて経験はないでしょうか？考える必要はありません。まずは行動してみましょう！！</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-bed fa-5x" style="width:60px;"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">適度な休憩を取り入れる</p>
                                <p>長時間の勉強は、疲れや眠気などで集中力が切れてしまうものです。１５分間仮眠したり、少しストレッチしてみたり、軽く軽食を取ったりなどしましょう。適度な休憩を取り入れることで、リラックスでき、気持ちをリセットできます。このアプリにはポモドーロタイマーがついています。ぜひ活用してください。</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-ban fa-5x" style="width:60px;"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">誘惑するものを片付ける</p>
                                <p>スマホ、ゲームなどが目に見える場所にあると、ついつい触ってしまって勉強に集中できなという人もいるでしょう。机の上を整理整頓し、誘惑するものが視界に入らないようにしましょう。
                                または、スマホの使用時間制限を利用したり、電源を切って別の部屋に置いておくなど、いろいろな工夫をしてみましょう。</p>
                            </div>
                        </div>
                      　<div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-tshirt fa-5x" style="width:60px;"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">勉強するための服装に着替える</p>
                                <p>パジャマやジャージなどの部屋着だと、メリハリがつかず、集中できないこともあるでしょう。メリハリをつけるために、勉強するための服装に着替えましょう。
                                寝る前にパジャマに着替える習慣がある人は、そうでない人よりも睡眠の質が高いという研究結果もあります。勉強の前に、勉強するための服装に着替える習慣をつけることによって、即座に勉強モードに切り替えることができるようになります。</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="far fa-clock fa-5x" style="width:60px;"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">アクショントリガーを決める</p>
                                <p>アクショントリガーとは、「ある行動をとったら勉強を始める」というルーティンを決めておくことです。朝起きたら３０分間ランニング→7時からプログラミングの勉強→昼15分間仮眠→１3時から英語、というように行動を書き記しておきましょう。
                                計画を立てておけば、考えることなく即座に行動に移せます。このアプリにはタスク管理機能がついています。ぜひ活用しましょう！！</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-headphones-alt fa-5x"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">勉強する前に好きな音楽を聴く</p>
                                <p>好きな音楽を聴くと、脳内でドーパミンが分泌されるという研究結果があります。好きな音楽を聴くことによって、やる気が沸き上がってきて、パフォーマンス向上につながります。
                                勉強前に自分の好きな音楽を聴いて、気分を高めてはいかがでしょうか？</p>
                            </div>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="tips-image">
                                <i class="fas fa-music fa-5x"></i>
                            </div>
                            <div class="tips-content">
                                <p class="tips-title">勉強中に自然音や環境音を流す</p>
                                <p>音楽を聴きながら勉強する人は多いと思いますが、好きな音楽を聴きながら勉強するのは作業効率が落ちると言われています。しかし、50デジヘル程度の音楽であれば、学習効果を高める効果があります。
                                自然音がそれに当たります。具体的には、「雨音」「川のせせらぎ」「鳥の声」などがあります。また、カフェなどで耳にするような、静かなメロディーが繰り返されるタイプの環境音も同じような効果があります。Youtubeなどにはこのような自然音や環境音がたくさんあります。ぜひ活用しましょう！！</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn tips-close border" data-dismiss="modal" style="color: #787e87;">閉じる</button>
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
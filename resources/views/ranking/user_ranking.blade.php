@extends('app')

@section('title', 'ToDo')

@section('content')
<div class="d-flex justify-content-around">
  <div class="card mb-4" style="max-width:450px; width:100%; margin-top:65px;">
    <div class="card-header text-center darkmode-post border-bottom">
      <div>
        <i class="fas fa-2x fa-crown" style="color:#ffd700;"></i>
        <span class="mr-1 font-weight-bold" style="font-size:18px;">総勉強時間ランキング</span>
      </div>
    </div>
    <div class="card-body user-ranking-list darkmode-post">
      <?php $rank = 1;?>
      <?php $count = 1;?>
      <?php $before_point = 0;?>
      @foreach ($user_rankings as $key => $value) 
        @if ($before_point !== $value['total_hour'])
          <?php $rank = $count;?>
        @endif
        <div class="d-flex align-items-center">
          @if($rank === 1)
          <div class="rank rank-color1"><span class="rank-text">{{ $rank }}</span></div>
          @elseif ($rank === 2)
          <div class="rank rank-color2"><span class="rank-text">{{ $rank }}</span></div>
          @elseif ($rank == 3)
          <div class="rank rank-color3"><span class="rank-text">{{ $rank }}</span></div>
          @elseif($rank >= 4)
          <div class="rank rank-colors border border-dark"><span class="rank-texts">{{ $rank }}</span></div>
          @endif
            <div class="avatar mt-3 mr-5">
              @if (empty($value->avatar))
                <i class="fas fa-user-circle fa-4x"></i>
              @elseif (!empty($value->avatar))
                <img src="{{ $value->avatar }}" style="width:60px;height:60px;border-radius:50%;">
              @endif
            </div>
            <div class="font-weight-bold text-center mr-auto">
              <a href="{{ route('users.show', ['user' => $value]) }}" style="font-size:16px; text-decoration:none;">
                {{ $value->name }}
              </a>
            </div>
            <div class="font-weight-bold text-center mr-3" style="font-size:16px;">
              {{ $value->total_hour }}時間
            </div>
        </div>
        <?php $before_point = $value['total_hour'];?>
        <?php $count++;?>
      @endforeach
    </div>
  </div>
  <div class="card mb-4" style="max-width:450px; width:100%; margin-top:65px;">
    <div class="card-header text-center darkmode-post d-flex justify-content-around border-bottom">
      <div>
        <i class="fas fa-2x fa-crown" style="color:#ffd700;"></i>
        <span class="mr-1 font-weight-bold" style="font-size:18px;">今月の勉強時間ランキング</span>
      </div>
      <div class="bg-success rounded ml-2">
        <span class="font-weight-bold text-white px-2" style="font-size:18px;">{{ date('m') }}月</span>
      </div>
    </div>
    <div class="card-body user-ranking-list darkmode-post">
      <?php $rank = 1;?>
      <?php $count = 1;?>
      <?php $before_point = 0;?>
      @foreach ($user_month_rankings as $key => $value) 
        @if ($before_point != $value['total_hour'])
          <?php $rank = $count;?>
        @endif
        <div class="d-flex align-items-center">
          @if($rank === 1)
          <div class="rank rank-color1"><span class="rank-text">{{ $rank }}</span></div>
          @elseif ($rank === 2)
          <div class="rank rank-color2"><span class="rank-text">{{ $rank }}</div>
          @elseif ($rank == 3)
          <div class="rank rank-color3"><span class="rank-text">{{ $rank }}</span></div>
          @elseif($rank >= 4)
          <div class="rank rank-colors border border-dark"><span class="ranks-text">{{ $rank }}</span></div>
          @endif
          <div class="avatar mt-3 mr-5">
            @if (empty($value->avatar))
              <i class="fas fa-user-circle fa-4x"></i>
            @elseif (!empty($value->avatar))
              <img src="{{ $value->avatar }}" style="width:60px;height:60px;border-radius:50%;">
            @endif
          </div>
          <div class="font-weight-bold text-center mr-auto">
            <a href="{{ route('users.show', ['user' => $value]) }}" style="font-size:16px; text-decoration:none;">
              {{ $value->name }}
            </a>
          </div>
          <div class="font-weight-bold text-center mr-3" style="font-size:16px;">
            {{ $value->total_hour }}時間
          </div>
        </div>
        <?php $before_point = $value['total_hour'];?>
        <?php $count++;?>
      @endforeach
  　</div>
  </div>
</div>
<div class="top-back">
  <a href="#"><div class="to-top"><i class="fas fa-3x fa-chevron-up"></i></div></a>
</div>
@endsection
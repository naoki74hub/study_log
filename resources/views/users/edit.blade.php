@extends('app')

@section('title', 'プロフィール更新')
@include('share.flatpickr.styles')
@section('content')z
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3 darkmode-post">
         @include('error_list')
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user]) }}">
                @csrf
                @method('PUT')
                  <div class="form-image_url mt-4">
                    <input type="file" name="avatar">
                  </div>
                  <div class="md-form mt-4">
                    <label class="font-weight-bold">自己紹介</label>
                    <textarea name="self_introduction" class="form-control textarea" placeholder="自己紹介" style="height:80px;">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
                    <p class="text-muted">現在<span id="inputlength6">0</span>文字入力中です。(160字以内)</p>
                  </div>  
                  <div class="form-group">
                    <label class="font-weight-bold">目標</label>
                    <textarea name="goal" class="form-control textarea" placeholder="達成目標" style="height:80px;">{{ $user->goal ?? old('goal') }}</textarea>
                    <p class="text-muted">現在<span id="inputlength7">0</span>文字入力中です。(120字以内)</p>
                  </div>
                  <div class="from-group mt-4">
                    <label class="font-weight-bold">イベントタイトル（試験名など)→カウントダウンの上に表示されるよ</label>
                    <input type="text" name="important_day_title" class="form-control text" placeholder="イベントタイトル" value="{{$user->important_day_title ?? old('important_day_title') }}">
                    <p class="text-muted">現在<span id="inputlength8">0</span>文字入力中です。(30字以内)</p>
                  </div>
                  <div class="form-group mt-4">
                    <label class="font-weight-bold">大切な日の日付（試験日など）→今日から大切な日までのカウントダウンを実行できるよ！！</label>
                    <input type="text" class="form-control text" name="important_day" id="important_day" placeholder="日付" value="{{ $user->important_day ?? old('important_day') }}" />
                  </div>
                 <button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">編集完了</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @include('share.flatpickr.scripts')
@endsection
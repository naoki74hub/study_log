@extends('app')

@section('title', 'プロフィール更新')
<script>
'use strict';
function ShowLength( idn, str ) {
   document.getElementById(idn).innerHTML = str.length;
}
</script>
@include('share.flatpickr.styles')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
         @include('error_list')
          <div class="card-body pt-0 darkmode-post">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                @csrf
                  <div class="form-image_url mt-4">
                    <input type="file" name="avatar">
                  </div>
                  <div class="md-form mt-4">
                    <label class="font-weight-bold">自己紹介</label>
                    <textarea name="self_introduction" class="form-control textarea" onkeyup="ShowLength('inputlength1', value);" placeholder="自己紹介" style="height:80px;">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
                    <p class="text-muted">現在<span id="inputlength1">0</span>文字入力中です。(160字以内)</p>
                  </div>  
                  <div class="form-group mt-4">
                    <label class="font-weight-bold">目標</label>
                    <textarea name="goal" class="form-control textarea" rows="4" placeholder="達成目標" onkeyup="ShowLength('inputlength2', value);" style="height:80px;">{{ $user->goal ?? old('goal') }}</textarea>
                    <p class="text-muted">現在<span id="inputlength2">0</span>文字入力中です。(120字以内)</p>
                  </div>
                  <div class="from-group mt-4">
                    <label class="font-weight-bold">イベントタイトル（試験名など）→カウントダウンの上に表示されるよ！！</label>
                    <input type="text" name="important_day_title" class="form-control textarea" onkeyup="ShowLength('inputlength3', value);" placeholder="イベントタイトル" value="{{ $user->important_day_title ?? old('important_day_title') }}">
                    <p class="text-muted">現在<span id="inputlength3">0</span>文字入力中です。(30字以内)</p>
                  </div> 
                   <div class="form-group mt-4">
                     <label class="font-weight-bold">大切な日の日付（試験日など）→今日から大切な日までのカウントダウンを実行できるよ！！</label>
                    <input type="text" class="form-control textarea" name="important_day" id="important_day" placeholder="日付" value="{{ old('important_day') }}" />
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
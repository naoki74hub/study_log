@extends('app')

@section('title', 'プロフィール更新')

@section('content')
  <div class="container pt-5">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
         @include('error_list')
          <div class="card-body pt-0">
            <div class="card-text">
              <form method="POST" enctype="multipart/form-data" action="{{ route('users.store') }}">
                @csrf
                  <div class="form-image_url mt-4">
                    <input type="file" name="image_url">
                  </div>
                  <div class="md-form mt-3">
                    <label></label>
                    <textarea name="self_introduction" class="form-control textarea" placeholder="自己紹介" style="height:80px;">{{ $user->self_introduction ?? old('self_introduction') }}</textarea>
                    <p>現在<span class="string_num">0</span>文字入力中です。(160字以内)</p>
                  </div>  
                  <div class="form-group">
                    <label></label>
                    <textarea name="goal" class="form-control textarea" rows="4" placeholder="達成目標" style="height:80px;">{{ $user->goal ?? old('goal') }}</textarea>
                    <p>現在<span class="string_num">0</span>文字入力中です。(120字以内)</p>
                  </div>
                 <button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">編集完了</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
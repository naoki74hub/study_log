 @csrf
  @if ($user->id === Auth::user()->id && ($user->profile->self_introduction || $user->profile->goal !== null))
  @method('PUT')
  @endif
<div class="form-image_url mt-4">
  <input type="file" name="image_url">
</div>
<div class="md-form mt-3">
  <label></label>
  <textarea name="self_introduction" class="form-control textarea" placeholder="自己紹介">{{ $profile->self_introduction ?? old('self_introduction') }}</textarea>
  <p>現在<span class="string_num">0</span>文字入力中です。(210字以内)</p>
</div>  
<div class="form-group">
  <label></label>
  <textarea name="goal" class="form-control textarea" rows="4" placeholder="達成目標">{{ $profile->goal ?? old('goal') }}</textarea>
  <p>現在<span class="string_num">0</span>文字入力中です。(210字以内)</p>
</div>

<button type="submit" class="btn btn-block shadow p-3 mb-5 w-25 mx-auto btn-primary text-white">編集完了</button>
@csrf
<div class="form-image_url mt-4">
  <input type="file" name="image_url">
</div>
<div class="md-form mt-3">
  <label class="font-weight-bold">タイトル</label>
  <input type="text" name="title" class="form-control textarea" onkeyup="ShowLength('inputlength1', value);" required value="{{ $post->title ?? old('title') }}">
  <p style="color:#919599;">現在<span id="inputlength1">0</span>文字入力中です。(40字以内)</p>
</div>  
<dic class="form-time">
  <span class="font-weight-bold">勉強時間</span><input type="time" name="time" class="ml-3 mt-3" value="03:00{{ $post->time ?? old('time') }}">
</div>
<div class="form-group mt-3">
  <label class="font-weight-bold">本文</label>
  <textarea name="body" required class="form-control textarea" rows="6" onkeyup="ShowLength('inputlength2', value);">{!!nl2br(e(($post->body ?? old('body')))) !!}</textarea>
  <p style="color:#919599;">現在<span id="inputlength2">0</span>文字入力中です。(210字以内)</p>
</div>
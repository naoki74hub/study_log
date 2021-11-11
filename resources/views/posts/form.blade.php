@csrf
 <div class="form-image_url mt-4">
  <input type="file" name="image_url">
</div>
<div class="md-form mt-3">
  <input type="text" name="title" class="form-control text" placeholder="タイトル" required value="{{$post->title ?? old('title') }}">
</div>  
<dic class="form-time">
  勉強時間<input type="time" name="time" class="ml-3 mt-3" value="{{$post->time ?? old('time')}}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="body" required class="form-control textarea" rows="6" placeholder="本文">{{ $post->body ?? old('body') }}</textarea>
  <p>現在<span class="string_num">0</span>文字入力中です。(210字以内)</p>
</div>
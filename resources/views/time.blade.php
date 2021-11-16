@extends('app')

@section('title', '時間管理')

@include('nav')

@section('content')
<div class="container pt-5">
 <div class="clock">
   <p class="clock-date"></p> 
   <p class="clock-time"></p>
 </div> 
</div>
@endsection
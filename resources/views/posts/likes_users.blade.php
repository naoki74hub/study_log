@extends('app')

@section('title', '記事一覧')

@section('content')

<div class="container mt-5">
@foreach($users as $user)
dd($user);
@endforeach
</div>
@endsection

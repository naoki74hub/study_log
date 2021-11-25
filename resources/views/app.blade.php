<!DOCTYPE html>
<html lang="ja">
<head>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>

 <body>
　<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="position:fixed; top:0; left:0; width:100%; height:50px;">
    <i class="fas fa-pencil-alt ml-2" style="color:white;"><a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-white" href="#">スタマネ</a></i>
  <form  method="POST" action="{{route('posts.search')}}">
    @csrf
    <input type="text" class="form-control input-lg mx-auto" name="search" placeholder="検索" style="position:relative;top:20px;">
    <span class="input-group-btn">
      <button class="btn btn-info" type="submit" style="position:relative;top:-17px;right:-200px;height:37px;">
        <i class="fas fa-search"></i>
      </button>
    </span>
  </form>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <!-- <a class="nav-link" href="#">Sign out</a> -->
      <a class="nav-link text-white" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        {{ __('ログアウト') }}
     </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
       @csrf
      </form>
    </li>
  </ul>
</header>

<div class="container-fluid">
 <div class="row vh-100">
   <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse pt-5" style="background-color:#1b253c;">
      <div class="sidebar-sticky sticky-top">
        <ul class="nav flex-column">
          <div class="level mt-5">
              <span class="display-3 text-white">{{ $level }}</span>
          </div>
          <div class="sum-time mt-3 border border-white text-center py-2">
            <i class="far fa-clock text-white">総学習時間</i><br><br>
            <span class="h3 text-white">{{ $total_time }}</span>
          </div>
          <div class="continuation-days text-center border border-white mt-5 py-2">
               <i class="fas fa-pencil-alt text-white">活動日数</i><br><br>
              <span class="h3 text-white">{{ $post_day }}</span>
          </div>
          <div class="continuation-days text-center border border-white mt-5 py-2">
              <i class="fas fa-running text-white">継続日数</i><br><br>
              <span class="h3 text-white"></span>
          </div>
          <li class="nav-item mt-5">
            <a class="nav-link text-white h5" href=" {{route('posts.index')}}">
            <i class="fas fa-home"></i>
              <span data-feather="home">ホーム</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white h5" href="">
            <i class="far fa-clock"></i>
              <span data-feather="record">管理</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white h5" href="#">
            <i class="far fa-calendar-alt"></i>
            <span data-feather="report">レポート</span>
            </a>
          </li>
         
         <li class="nav-item">
          <a class="nav-link text-white h5" href="{{ route('users.show',['user'=>Auth::user()->id]) }}">
          <i class="fas fa-user-circle"></i>
              <span data-feather="profile text-white">プロフィール</span>
            </a>
          </li>
          <li class="nav-item border border-light text-center py-3">
            <a class="post-link text-white" href="{{route('posts.create')}}">
            <span data-feather="post">投稿する</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @yield('content')
      
    </main>
  </div>
</div>

</body>


</html>

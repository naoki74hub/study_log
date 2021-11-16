 <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="height:50px">
  <!-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a> -->
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">スタログ</a>
  <form  method="POST" action="{{route('posts.search')}}">
    @csrf
    <input type="text" class="form-control input-lg mx-auto" name="search" placeholder="検索" style="position:relative;top:20px;">
    <span class="input-group-btn">
      <button class="btn btn-info" type="submit" style="position:relative;top:-17px;right:-200px;">
        <i class="fas fa-search"></i>
      </button>
    </span>
  </form>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <!-- <a class="nav-link" href="#">Sign out</a> -->
      <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        {{ __('ログアウト') }}
     </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
       @csrf
      </form>
    </li>
  </ul>
</nav>

<div class="container-fluid">
 <div class="row vh-100">
   <nav class="col-md-2 d-none d-md-block pt-5" style="background-color:#1b253c;">
      <div class="sidebar-sticky sticky-top">
         <ul class="nav flex-column pt-5">
          <div class="level">
              <span class="display-3 text-white">Lv.23</span>
          </div>
          <div class="sum-time mt-3 border border-white text-center py-2">
            <i class="far fa-clock text-white">総学習時間</i><br><br>
            <span class="h3 text-white">98時間40分</span>
          </div>
          <div class="continuation-days text-center border border-white mt-5 py-2">
              <i class="fas fa-running text-white">継続日数</i><br><br>
              <span class="h3 text-white">87日</span>
          </div>
          <li class="nav-item mt-5">
            <a class="nav-link text-white h5" href=" {{route('posts.index')}}">
            <i class="fas fa-home"></i>
              <span data-feather="home">ホーム</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white h5" href="{{ route('time') }}">
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
            <a class="nav-link text-white h5" href="#">
            <i class="fas fa-user-circle"></i>
              <span data-feather="profile text-white">プロフィール</span>
            </a>
          </li>
          <li class="nav-item border border-light text-center">
            <a class="post-link text-white" href="{{route('posts.create')}}">
            <span data-feather="post rounded-circle">投稿する</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
 

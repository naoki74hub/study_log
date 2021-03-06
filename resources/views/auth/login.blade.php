@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color:#1b253c;">{{ __('ログイン') }}</div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('パスワードをお忘れですか?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div style="max-width:600px; width:100%; margin:0 auto; margin-left:100px">
                                <button type="submit" class="btn" style="background-color:#1b253c;">
                                    <a class="text-white text-decoration-none">{{ __('ログイン') }}</a>
                                </button>
                                <button class="btn btn-danger">
                                  <a href="/login/google" class="text-white text-decoration-none"><i class="fab fa-google mr-2"></i>Googleでログイン</a>
                                </button>
                                 <button class="btn btn-primary">
                                    <a href="{{ route('twitter.login') }}" class="text-white text-decoration-none"><i class="fab fa-twitter"></i> Twitterでログイン</a>
                                </button>
                                <button class="btn btn-success">
                                    <a href="{{ route('login.guest') }}" class="text-white text-decoration-none"><i class="fas fa-user mr-2"></i>ゲストログイン</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

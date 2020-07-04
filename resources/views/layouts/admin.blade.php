<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  {{-- {{}}は中身を文字列に置換し、HTMLの中に記載するということ --}}
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--スマートフォンやPCの画面サイズを小さくした時に文字や画像の大きさを調整してくれる指示-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--CSRF Token-->
    {{-- 後の章で説明します --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
    <title>@yield('title')</title>
    
    <!--Scripts-->
    {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
    {{-- これを打ち込まないとjavaが適応されない --}}
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    
    <!--Fonts-->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" 
    rel="stylesheet" type="text/css">
    
    <!--Styles-->
    {{-- Laravel標準で用意されているCSSを読み込みます --}}
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
  
  </head>
  <body>
    <div id="app">
      {{-- 画面上部に表示するナビゲーションバーです。 --}}
      <!--navbar-expand-mdは大きさの指定-->
      <!--navbar-darkは色の指定-->
      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <!--上部にlaravelというボタンが表示される-->
            {{ config('app.name', 'News') }}
          </a>
          {{-- navbar-toggleでメニューバーみたいなボタンを作成可能 --}}
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--Left Side Of Navber-->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                    <a class="nav-link" href="{{ route('NewsCreate') }}">ニュースを投稿する</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="{{ route('ProfileCreate') }}">プロフィールを作る</a>
              </li>
            </ul>
            <!--Right Side Of Navber-->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
            </ul>
          </div>
        </div>
      </nav>
      {{-- ここまでナビゲーションバー --}}
      
      <main class="py-4">
        {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
        @yield('content')
      </main>
    </div>
  </body>
</html>
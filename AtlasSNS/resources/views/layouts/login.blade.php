<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <a href= "{{ route('top') }}"><img src="{{ asset('/images/atlas.png') }}" alt="AtlasSNS" class="logo"></a>
        </div>
                    <div id = "head">
                    <span class="right-align">{{ Auth::user()->username }}さん
                    <button class="menu-toggle dli-chevron-down" aria-controls="menu" aria-expanded="false"></button></span>
                <div class="menu head" id="menu">
                  <ul>
                      <li><a href="/top"><p>HOME</p></a></li>
                      <li><a href="/profile"><p>プロフィール編集</p></a></li>
                      <li><a href="/logout"><p>ログアウト</p></a></li>
                  </ul>
                </div>
    <img src="{{ asset('/images/'.auth()->user()->images) }}" alt="{{ auth()->user()->username }}" class="icon"></div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ Auth::user()->username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>{{ Auth::user()->followingCount() }}名</p>
                </div>
                <p class="btn-search"><a href="{{ route('followList') }}">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>{{ Auth::user()->followerCount() }}名</p>
                </div>
                <p class="btn-search"><a href="{{ route('followerList') }}">フォロワーリスト</a></p>
            </div>
            <p class="btn-search"><a href="{{ route('search') }}">ユーザー検索</a></p>
        </div>
    </div>

    <footer>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/js/sns.js') }}"></script>
</body>
</html>

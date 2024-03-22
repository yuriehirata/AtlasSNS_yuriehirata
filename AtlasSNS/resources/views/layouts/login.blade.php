<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
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
        <h1><a href= "top"><img src="images/atlas.png" alt="AtlasSNS" class="logo"></a></h1>
</div>

            <div id="">
                <div id="">
                    <div id = "head">
                    <p class="right-align">{{ Auth::user()->username }}さん
                    <button class="menu-toggle dli-chevron-down" aria-controls="menu" aria-expanded="false"></button></p>
</div>
                <div class="menu" id="menu">
                  <ul>
                      <li><a href="/top"><p>HOME</p></a></li>
                      <li><a href="/profile"><p>プロフィール編集</p></a></li>
                      <li><a href="/logout"><p>ログアウト</p></a></li>
                  </ul>
                </div>
        </div>
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
                <p>名</p>
                </div>
                <p class="btn-search"><a href="followList">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>名</p>
                </div>
                <p class="btn-search"><a href="followerList">フォロワーリスト</a></p>
            </div>
            <p class="btn-search"><a href="search">ユーザー検索</a></p>
        </div>
    </div>

    <footer>
    </footer>
    <script src="{{ asset('/js/sns.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>

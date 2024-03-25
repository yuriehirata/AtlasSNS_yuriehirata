@extends('layouts.login')

@section('content')

<div class="container">
    <h2>プロフィール編集</h2>
    {!! Form::open(['url' => '/profile/update', 'enctype' => 'multipart/form-data']) !!} <!-- enctype属性を追加してファイルのアップロードに対応 -->

    <br>
    <br>
    <br>
    <div class="transparent-border">
        <br>
        <p class="contents-title">{{ Form::label('ユーザー名') }}</p>
        <p class="subcontents">{{ Form::text('username', Auth::user()->username, ['class' => 'input']) }}</p> <!-- ユーザー名のデフォルト値をAuth::user()->usernameで設定 -->

        <br>
        <p class="contents-title">{{ Form::label('メールアドレス') }}</p>
        <p class="subcontents">{{ Form::text('mail', Auth::user()->mail, ['class' => 'input']) }}</p> <!-- メールアドレスのデフォルト値をAuth::user()->mailで設定 -->

        <br>
        <p class="contents-title">{{ Form::label('パスワード') }}</p>
        <p class="subcontents">{{ Form::password('password', ['class' => 'input']) }}</p> <!-- パスワードフィールドにtype="password"を設定 -->

        <br>
        <p class="contents-title">{{ Form::label('パスワード確認') }}</p>
        <p class="subcontents">{{ Form::password('password_confirmation', ['class' => 'input']) }}</p> <!-- パスワード確認フィールドにtype="password"を設定 -->

        <br>
        <p class="contents-title">{{ Form::label('自己紹介') }}</p>
        <p class="subcontents">{{ Form::textarea('bio', Auth::user()->bio, ['class' => 'input']) }}</p> <!-- 自己紹介文のデフォルト値をAuth::user()->bioで設定 -->

        <br>
        <p class="contents-title">{{ Form::label('アイコン画像') }}</p>
        <p class="subcontents">{{ Form::file('images', ['class' => 'input']) }}</p> <!-- アイコン画像のアップロードフィールドを追加 -->

        <br>
        <p class="btn">{{ Form::submit('更新') }}</p>
        <br>
        <br>
        <br>
        <p class="subcontents"><a href="/top">topへ戻る</a></p>
    </div>
    {!! Form::close() !!}
</div>

@endsection

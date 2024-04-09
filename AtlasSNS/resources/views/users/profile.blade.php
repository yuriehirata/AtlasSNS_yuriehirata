@extends('layouts.login')

@section('content')

<div id="container">
    @if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
    </div>
    @endif

    {!! Form::open(['url' => '/profile/update', 'enctype' => 'multipart/form-data']) !!}
    <!-- enctype属性を追加してファイルのアップロードに対応 -->
    <div>
        <div class="transparent-border flex">
            <div>
                <img src="{{ asset('/images/'.Auth()->user()->images) }}" alt="{{ Auth::user()->username }}" class="icon">
            </div>
                <div>
                    <div class="flex_profile">
                        <p class="left_profile">{{ Form::label('ユーザー名') }}</p>
                        <p class="center_profile">{{ Form::text('username', Auth()->user()->username, ['class' => 'input']) }}</p> <!-- ユーザー名のデフォルト値をAuth::user()->usernameで設定 -->
                    </div>
                    <div class="flex">
                        <p class="left_profile">{{ Form::label('メールアドレス') }}</p>
                        <p class="center_profile">{{ Form::text('mail', Auth()->user()->mail, ['class' => 'input']) }}</p> <!-- メールアドレスのデフォルト値をAuth::user()->mailで設定 -->
                    </div>
                    <div class="flex">
                        <p class="left_profile">{{ Form::label('パスワード') }}</p>
                        <p class="center_profile">{{ Form::password('password', ['class' => 'input']) }}</p> <!-- パスワードフィールドにtype="password"を設定 -->
                    </div>
                    <div class="flex">
                        <p class="left_profile">{{ Form::label('パスワード確認') }}</p>
                        <p class="center_profile">{{ Form::password('password_confirmation', ['class' => 'input']) }}</p> <!-- パスワード確認フィールドにtype="password"を設定 -->
                    </div>
                    <div class="flex">
                        <p class="left_profile">{{ Form::label('自己紹介') }}</p>
                        <p class="center_profile">{{ Form::textarea('bio', Auth()->user()->bio, ['class' => 'input','cols' => 20, 'rows' => 2]) }}</p> <!-- 自己紹介文のデフォルト値をAuth::user()->bioで設定 -->
                    </div>
                    <div class="flex">
                        <p class="left_profile">{{ Form::label('icon', 'アイコン画像') }}</p>
                        <p class="center_profile">{{ Form::file('icon', ['class' => 'input']) }}</p>
                    </div>
                    <div class="center_profile">
                        <p>{{ Form::submit('更新', ['class' => 'update-btn']) }}</p>
                    </div>
                </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection

@extends('layouts.logout')
@section('content')

<!-- エラーをまとめて表示する記述 -->
@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}
<br>
<br>
<br>
<div class="transparent-border">
    <br>
    <h2 class="contents">新規ユーザー登録</h2>

    <div class="center item_right">
        <p class="subcontents">{{ Form ::label('ユーザー名') }}</p>
        <p class="subcontents">{{ Form::text('username',null,['class' => 'input']) }}</p>
        <br>
        <p class="subcontents">{{ Form::label('メールアドレス') }}</p>
        <p class="subcontents">{{ Form::text('mail',null,['class' => 'input']) }}</p>
        <br>
        <p class="subcontents">{{ Form::label('パスワード') }}</p>
        <p class="subcontents">{{ Form::password('password',['class' => 'input']) }}</p>
        <br>
        <p class="subcontents">{{ Form::label('パスワード確認') }}</p>
        <p class="subcontents">{{ Form::password('password_confirmation',['class' => 'input']) }}
        <br>
        <button type="submit" class="btn register">新規登録</button>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p class="link subcontents"><a href="/login">ログイン画面へ戻る</a></p>
</div>
{!! Form::close() !!}


@endsection

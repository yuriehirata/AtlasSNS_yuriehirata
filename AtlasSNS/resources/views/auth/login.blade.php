@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<div class="transparent-border">
  <p class="contents">AtlasSNSへようこそ</p>

  <div class="center item_right">
    <p class="subcontents">{{ Form::label('メールアドレス') }}</p>
    <p class="subcontents">{{ Form::text('mail',null,['class' => 'input']) }}</p>
    <br>
    <p class="subcontents">{{ Form::label('パスワード') }}</p>
    <p class="subcontents">{{ Form::password('password',['class' => 'input']) }}</p>
    <br>
    <p>{{ Form::submit('ログイン',['class' => 'btn']) }}</p>
  </div>
  <br>
  <br>
  <br>
  <br>
  <p class="center link"><a href="/register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</div>
@endsection

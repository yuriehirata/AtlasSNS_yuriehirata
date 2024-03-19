@extends('layouts.logout')

@section('content')

<div id="clear">
  <p class="subcontents">{{ $registeredUsername }} さん</p>
  <p class="subcontents">ようこそ！AtlasSNSへ！</p>
  <p class="subcontents">ユーザー登録が完了しました。</p>
  <p class="subcontents">早速ログインをしてみましょう。</p>

  <p><a href="/login">{{ Form::submit('ログイン画面へ',['class' => 'btn']) }}</a></p>
</div>

@endsection

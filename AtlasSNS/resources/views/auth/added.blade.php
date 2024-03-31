@extends('layouts.logout')

@section('content')

<div class="transparent-border">
  <div id="center">
    <p class="added"><strong>{{ $registeredUsername }}</strong>さん</p>
    <p class="added">ようこそ！<strong>AtlasSNSへ！</strong></p>
    <br>
    <br>
    <p class="added">ユーザー登録が完了いたしました。</p>
    <p class="added">早速ログインをしてみましょう。</p>
    <br>
    <br>
    <p class="added"><a href="/login">{{ Form::submit('ログイン画面へ',['class' => 'btn-center']) }}</a></p>
    <br>
    <br>
  </div>
</div>

@endsection

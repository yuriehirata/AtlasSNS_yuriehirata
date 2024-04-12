@extends('layouts.logout')

@section('content')

<div class="transparent-border">
  <div id="center" class="item_right">
    <p class="added_bold padding"><strong style="font-weight:bold">{{ $registeredUsername }}さん</strong></p>
    <p class="added_bold padding"><strong style="font-weight:bold">ようこそ！AtlasSNSへ！</strong></p>
    <br>
    <br>
    <p class="added padding">ユーザー登録が完了いたしました。</p>
    <p class="added padding">早速ログインをしてみましょう。</p>
    <br>
    <br>
    <p class="added"><a href="/login">{{ Form::submit('ログイン画面へ',['class' => 'btn-center']) }}</a></p>
    <br>
    <br>
  </div>
</div>

@endsection

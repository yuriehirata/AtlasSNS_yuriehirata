@extends('layouts.logout')
<?php
public function added(){
    // セッションから登録したユーザー名を取得
    $registeredUsername = Session::get('registered_username');

    // 登録完了ページに登録したユーザー名を渡して表示
    return view('auth.added', ['registeredUsername' => $registeredUsername]);
}
?>
@section('content')

<div id="clear">
  <p><?php $user = Auth::user(); ?>{{ $user->name }}さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection

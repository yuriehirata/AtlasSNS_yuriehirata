@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<h2>フォーム</h2>
<form action="/bbs" method="POST">
    名前:<br>
    <input name="name">
    <br>
    コメント:<br>
    <textarea name="comment" rows="4" cols="40"></textarea>
    <br>
    {{ csrf_field() }}
    <button class="btn btn-success"> 送信 </button>
</form>
@endsection

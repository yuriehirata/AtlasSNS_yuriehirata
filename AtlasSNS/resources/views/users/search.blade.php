@extends('layouts.login')

@section('content')

<!-- 検索フォーム -->
<form action="/search" method="GET">
    <input type="text" name="query" placeholder="検索キーワードを入力してください">
    <button type="submit">検索</button>
</form>


@endsection

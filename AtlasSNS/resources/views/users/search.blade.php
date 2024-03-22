@extends('layouts.login')

@section('content')

<!-- 検索フォーム -->
<form action="/search" method="GET">
    <input type="text" name="query" placeholder="ユーザー名">
    <button type="submit"><img src="images/search.png" class="btn btn-post" alt="検索"></button>
</form>


@endsection

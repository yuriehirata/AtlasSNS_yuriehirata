@extends('layouts.login')

@section('content')

<!-- 検索フォーム -->
<form action="/search" method="GET">
    <input type="text" name="query" placeholder="ユーザー名">
    <button type="submit"><img src="images/search.png" class="btn btn-post" alt="検索"></button>
</form>

<!-- 検索ワードの表示 -->
@if(request()->input('query'))
    <p>検索ワード: {{ request()->input('query') }}</p>
@endif

<!-- 検索結果の表示 -->
<div>
    <h2>検索結果</h2>
@if(!is_null($users) && count($users) > 0)
    <ul>
        @foreach($users as $user)
            <li>
                <img src="{{ $user->icon }}" alt="ユーザーアイコン">
                <span>{{ $user->name }}</span>
            </li>
        @endforeach
    </ul>
@else
    <p>該当するユーザーが見つかりませんでした。</p>
@endif
</div>

@endsection

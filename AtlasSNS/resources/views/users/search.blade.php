@extends('layouts.login')

@section('content')

<!-- 検索フォーム -->
<div class="search-form">
<form action="/search" method="GET">
    <input type="text" name="query" placeholder="ユーザー名">
    <button type="submit"><img src="images/search.png" class="btn btn-post" alt="検索"></button>
</form>
</div>

<!-- 検索ワードの表示 -->
@if(request()->input('query'))
    <p>検索ワード: {{ request()->input('query') }}</p>
@endif

<!-- 検索結果の表示 -->
<div>

@if(!is_null($users) && count($users) > 0)
        @foreach($users as $user)
<div class="search_layout">
    <span class="search_layout_item">
        <a href="{{ route('profile.show', ['user' => $user->id]) }}"><img src="{{ asset('/images/'.$user->images) }}" alt="{{ auth()->user()->username }}" class="icon"></a>
    </span>


    <span class="search_layout_item">
        {{ $user->username }}
    </span>

    <span class="search_layout_item">
        @if(auth()->user()->isFollowing($user->id))
        {{-- フォロー解除ボタン --}}
        <form action="{{ route('unfollow') }}" method="POST">
        @csrf
        <input type="hidden" name="followed_id" value="{{ $user->id }}">
        <button type="submit" class="unfollow_btn">フォロー解除</button>
        </form>
        @else
        {{-- フォローボタン --}}
        <form action="{{ route('follow') }}" method="POST">
        @csrf
        <input type="hidden" name="followed_id" value="{{ $user->id }}">
        <button type="submit" class="follow_btn">フォローする</button>
        </form>
        @endif
    </span>
</div>

        @endforeach
@else
    <p>該当するユーザーが見つかりませんでした。</p>
@endif
</div>

@endsection
